<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pemeliharaan extends BaseController
{
    protected $pemeliharaanModel;
    public function __construct()
    {
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
        helper(['id_helper']);
    }
    public function index()
    {
        $data['title'] = 'Data Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaan();

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        return view('pemeliharaan/pemeliharaan', $data);
    }

    public function detail($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);
        $data['title'] = 'Detail Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaan($id_kendaraan);

        return view('pemeliharaan/detail', $data);
    }
}
