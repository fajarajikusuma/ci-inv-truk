<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $table = 'tb_kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields = ['nopol', 'jenis_kendaraan', 'merk', 'tipe', 'tahun_pembuatan', 'no_rangka', 'no_mesin', 'status', 'foto_kendaraan', 'id_sopir'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

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

    public function getKendaraanWithSopir()
    {
        return $this->select('tb_kendaraan.*, tb_sopir.*')
            ->join('tb_sopir', 'tb_kendaraan.id_sopir = tb_sopir.id_sopir', 'left')
            ->findAll();
    }

    public function getKendaraanDetail($id)
    {
        return $this->select('tb_kendaraan.*, tb_sopir.nama_sopir')
            ->join('tb_sopir', 'tb_kendaraan.id_sopir = tb_sopir.id_sopir', 'left')
            ->where('tb_kendaraan.id_kendaraan', $id)
            ->first();
    }
}
