<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Main extends BaseController
{
    public function __construct()
    {
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        $this->supirModel = new \App\Models\SopirModel();
        $this->userModel = new \App\Models\UserModel();
        $this->pajakModel = new \App\Models\PajakModel();
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
    }

    public function index()
    {
        helper('dashboard');

        $kendaraanModel = $this->kendaraanModel;
        $supirModel = $this->supirModel;
        $userModel = $this->userModel;
        $pajakModel = $this->pajakModel;
        $pemeliharaanModel = $this->pemeliharaanModel;

        // CARD DATA
        $data['total_kendaraan'] = $kendaraanModel->countAll();
        $data['total_supir'] = $supirModel->countAll();
        $data['total_user'] = $userModel->countAll();

        // Pajak jatuh tempo <= 30 hari
        $data['jatuh_tempo'] = $pajakModel
            ->where('tanggal_stnk <=', date('Y-m-d', strtotime('+30 days')))
            ->countAllResults();

        // Grafik pemeliharaan (Count by nopol)
        $data['grafik_pemeliharaan'] = $pemeliharaanModel
            ->select('id_kendaraan, COUNT(*) AS total')
            ->groupBy('id_kendaraan')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->findAll();

        // Grafik pajak terbayar
        $data['grafik_pajak'] = $pajakModel
            ->select('MONTH(tanggal_stnk) AS bulan, COUNT(*) AS total')
            ->where('status_pajak', 'Sudah Terbayar')
            ->groupBy('MONTH(tanggal_stnk)')
            ->findAll();

        $data['title'] = 'Dashboard';
        // dd(session()->get());
        return view('admin/home', $data);
    }
}
