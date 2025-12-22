<?php

namespace App\Models;

use CodeIgniter\Model;

class PemeliharaanModel extends Model
{
    protected $table            = 'tb_pemeliharaan';
    protected $primaryKey       = 'id_pemeliharaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kendaraan', 'id_sopir', 'tanggal_keluhan', 'bengkel', 'tindakan_perbaikan', 'biaya', 'dibuat_oleh', 'nota'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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

    public function getKendaraanWithTotalPemeliharaan()
    {
        return $this->db->table('tb_kendaraan k')
            ->select('
            k.id_kendaraan,
            k.nopol,
            k.jenis_kendaraan,
            k.merk,
            k.tipe,
            k.tahun_pembuatan,
            COALESCE(GROUP_CONCAT(DISTINCT s.nama_sopir), "") AS nama_sopir,
            COALESCE(SUM(p.biaya), 0) AS total_biaya,
            COUNT(p.id_pemeliharaan) AS jumlah_record,
            k.id_sopir,
            k.source
        ')
            ->join(
                'tb_pemeliharaan p',
                'p.id_kendaraan = k.id_kendaraan AND YEAR(p.tanggal_keluhan) = ' . date('Y'),
                'left'
            )
            ->join('tb_sopir s', 's.id_sopir = k.id_sopir', 'left')
            ->groupBy('k.id_kendaraan')
            ->orderBy('k.nopol', 'DESC')
            ->get()
            ->getResultArray();
    }


    // getPemeliharaanByKendaraan 
    public function getPemeliharaanByKendaraan($id_kendaraan)
    {
        return $this->select('
                tb_pemeliharaan.id_pemeliharaan,
                tb_pemeliharaan.id_kendaraan,
                tb_pemeliharaan.id_sopir,
                tb_pemeliharaan.tanggal_keluhan,
                tb_pemeliharaan.bengkel,
                tb_pemeliharaan.tindakan_perbaikan,
                tb_pemeliharaan.biaya,
                tb_pemeliharaan.dibuat_oleh,
                tb_pemeliharaan.nota,
                tb_user.nama as nama_user,
                tb_sopir.nama_sopir as nama_sopir
            ')
            ->join('tb_user', 'tb_user.id_user = tb_pemeliharaan.dibuat_oleh', 'left')
            ->join('tb_sopir', 'tb_sopir.id_sopir = tb_pemeliharaan.id_sopir', 'left')
            ->where('tb_pemeliharaan.id_kendaraan', $id_kendaraan)
            ->findAll();
    }

    // getKendaraanId
    public function getKendaraanId($id_pemeliharaan)
    {
        return $this->select('id_kendaraan')
            ->where('id_pemeliharaan', $id_pemeliharaan)
            ->first()['id_kendaraan'];
    }

    // get id user by id_pemeliharaan
    public function getUserId($id_pemeliharaan)
    {
        return $this->select('dibuat_oleh')
            ->where('id_pemeliharaan', $id_pemeliharaan)
            ->first()['dibuat_oleh'];
    }
    // get all data in tb_user by dibuat_oleh
    public function getDataUserById($id_user)
    {
        return $this->select('*')
            ->join('tb_user', 'tb_user.id_user = tb_pemeliharaan.dibuat_oleh', 'left')
            ->where('id_user', $id_user)
            ->first();
    }

    // filter data pemeliharaan by tahun and bulan
    public function getKendaraanWithTotalPemeliharaanByTahunBulan($tahun = null, $bulan = null)
    {
        $builder = $this->db->table('tb_kendaraan k')
            ->select('
            k.id_kendaraan,
            k.nopol,
            k.jenis_kendaraan,
            k.merk,
            k.tipe,
            k.tahun_pembuatan,
            COALESCE(GROUP_CONCAT(DISTINCT s.nama_sopir), "") AS nama_sopir,
            COALESCE(SUM(p.biaya), 0) AS total_biaya,
            COUNT(p.id_pemeliharaan) AS jumlah_record,
            k.id_sopir
        ')
            ->join('tb_pemeliharaan p', 'p.id_kendaraan = k.id_kendaraan', 'left')
            ->join('tb_sopir s', 's.id_sopir = k.id_sopir', 'left')
            ->groupBy('k.id_kendaraan')
            ->orderBy('k.nopol', 'DESC');

        // ==============================
        //   FILTER LOGIC BENAR
        // ==============================

        // Jika tahun diisi
        if (!empty($tahun)) {
            $builder->where('YEAR(p.tanggal_keluhan)', $tahun);

            // Jika bulan = all → tidak filter bulan
            if ($bulan === 'all') {
                // tidak ada filter bulan
            }
            // Jika bulan diisi angka → filter bulan
            else if (!empty($bulan) && ctype_digit((string)$bulan)) {
                $builder->where('MONTH(p.tanggal_keluhan)', $bulan);
            }
            // Jika bulan kosong → tetap hanya filter tahun
        }

        return $builder->get()->getResultArray();
    }

    public function getPemeliharaanByKendaraanFilter($id_kendaraan, $tahun = null)
    {
        return $this->select('
                tb_pemeliharaan.id_pemeliharaan,
                tb_pemeliharaan.id_kendaraan,
                tb_pemeliharaan.id_sopir,
                tb_pemeliharaan.tanggal_keluhan,
                tb_pemeliharaan.bengkel,
                tb_pemeliharaan.tindakan_perbaikan,
                tb_pemeliharaan.biaya,
                tb_pemeliharaan.dibuat_oleh,
                tb_pemeliharaan.nota,
                tb_user.nama as nama_user,
                tb_sopir.nama_sopir as nama_sopir
            ')
            ->join('tb_user', 'tb_user.id_user = tb_pemeliharaan.dibuat_oleh', 'left')
            ->join('tb_sopir', 'tb_sopir.id_sopir = tb_pemeliharaan.id_sopir', 'left')
            ->where('tb_pemeliharaan.id_kendaraan', $id_kendaraan)
            ->where('YEAR(tanggal_keluhan)', $tahun)
            ->findAll();
    }
}
