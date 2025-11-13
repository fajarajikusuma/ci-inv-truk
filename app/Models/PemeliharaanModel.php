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
    protected $allowedFields    = ['id_kendaraan', 'id_sopir', 'tanggal_keluhan', 'bengkel', 'tindakan_perbaikan', 'biaya', 'dibuat_oleh'];

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
        return $this->select('
                tb_kendaraan.id_kendaraan,
                tb_kendaraan.nopol,
                tb_kendaraan.jenis_kendaraan,
                tb_kendaraan.merk,
                tb_kendaraan.tipe,
                tb_kendaraan.tahun_pembuatan,
                COALESCE(SUM(tb_pemeliharaan.biaya), 0) AS total_biaya,
                COUNT(tb_pemeliharaan.id_pemeliharaan) AS jumlah_record
            ')
            ->join('tb_kendaraan', 'tb_kendaraan.id_kendaraan = tb_pemeliharaan.id_kendaraan', 'right')
            // atau gunakan left dari tb_kendaraan: ubah model referensi jadi kendaraan utama
            // alternatif safer: mulai query dari tb_kendaraan (lebih jelas)
            ->groupBy('tb_kendaraan.id_kendaraan')
            ->orderBy('tb_kendaraan.nopol', 'DESC')
            ->findAll();
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
                tb_user.nama as nama_user
            ')
            ->join('tb_user', 'tb_user.id_user = tb_pemeliharaan.dibuat_oleh', 'left')
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
}
