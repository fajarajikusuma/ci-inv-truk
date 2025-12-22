<?php

namespace App\Models;

use CodeIgniter\Model;

class PajakModel extends Model
{
    protected $table            = 'tb_pajak_kendaraan';
    protected $primaryKey       = 'id_pajak';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kendaraan',
        'tanggal_stnk',
        'tanggal_tnkb',
        'status_pajak',
        'keterangan_pajak',
        'created_at',
        'updated_at',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDataPajakByTahun($tahun)
    {
        return $this->db->table('tb_pajak_kendaraan')
            ->select('*')
            ->where('YEAR(tanggal_stnk)', $tahun)
            ->orderBy('tanggal_stnk', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getKendaraanWithDataPajak()
    {
        return $this->db->table('tb_kendaraan k')
            ->select("
            k.id_kendaraan,
            k.nopol,
            k.jenis_kendaraan,
            k.merk,
            k.tipe,
            k.tahun_pembuatan,
            COALESCE(GROUP_CONCAT(DISTINCT s.nama_sopir), '') AS nama_sopir,

            -- tanggal terbaru (tanpa batas tahun)
            COALESCE(MAX(p.tanggal_stnk), '') AS tanggal_stnk,
            COALESCE(MAX(p.tanggal_tnkb), '') AS tanggal_tnkb,
            COALESCE(MAX(p.keterangan_pajak), '') AS keterangan,

            -- status pajak terbaru (berdasarkan tanggal STNK terbaru)
            (
                SELECT p2.status_pajak 
                FROM tb_pajak_kendaraan p2
                WHERE p2.id_kendaraan = k.id_kendaraan
                ORDER BY p2.tanggal_stnk DESC
                LIMIT 1
            ) AS status,

            k.id_sopir
        ")
            ->join('tb_pajak_kendaraan p', 'p.id_kendaraan = k.id_kendaraan', 'left')
            ->join('tb_sopir s', 's.id_sopir = k.id_sopir', 'left')
            ->groupBy('k.id_kendaraan')
            ->orderBy('k.nopol', 'DESC')
            ->get()
            ->getResultArray();
    }

    public function updateStatusPajakOtomatis()
    {
        $builder = $this->db->table('tb_pajak_kendaraan');
        $builder->select('id_kendaraan, tanggal_stnk, tanggal_tnkb');

        $result = $builder->get()->getResult();

        $today = date('Y-m-d');
        $currentYear = date('Y');

        foreach ($result as $row) {

            $stnk = $row->tanggal_stnk;
            $tnkb = $row->tanggal_tnkb;

            $year_stnk = date('Y', strtotime($stnk));
            $year_tnkb = date('Y', strtotime($tnkb));

            // ==============================
            // 1. Tahun pajak lewat tahun sekarang
            // ==============================
            if ($year_stnk < $currentYear || $year_tnkb < $currentYear) {
                $status = 'Sudah Terbayar';
            }

            // ==============================
            // 2. Sudah lewat jatuh tempo
            // ==============================
            elseif ($stnk < $today || $tnkb < $today) {
                $status = 'Sudah Melewati Jatuh Tempo';
            }

            // ==============================
            // 3. Hari ini jatuh tempo
            // ==============================
            elseif ($stnk == $today || $tnkb == $today) {
                $status = 'Jatuh Tempo';
            }

            // ==============================
            // 4. Akan jatuh tempo (1 bulan sebelum)
            // ==============================
            else {
                $stnk_minus = date('Y-m-d', strtotime('-1 month', strtotime($stnk)));
                $tnkb_minus = date('Y-m-d', strtotime('-1 month', strtotime($tnkb)));

                if ($today >= $stnk_minus || $today >= $tnkb_minus) {
                    $status = 'Akan Jatuh Tempo';
                } else {
                    $status = 'Sudah Terbayar';
                }
            }

            // ==============================
            // UPDATE
            // ==============================
            $this->db->table('tb_pajak_kendaraan')
                ->where('id_kendaraan', $row->id_kendaraan)
                ->update([
                    'status_pajak' => $status
                ]);
        }
    }
}
