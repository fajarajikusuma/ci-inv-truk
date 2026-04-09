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

    // public function index()
    // {
    //     helper('dashboard');

    //     $kendaraanModel = $this->kendaraanModel;
    //     $supirModel = $this->supirModel;
    //     $userModel = $this->userModel;
    //     $pajakModel = $this->pajakModel;
    //     $pemeliharaanModel = $this->pemeliharaanModel;

    //     // CARD DATA
    //     $data['total_kendaraan'] = $kendaraanModel->countAll();
    //     $data['total_supir'] = $supirModel->countAll();
    //     $data['total_user'] = $userModel->countAll();

    //     // Pajak jatuh tempo <= 30 hari
    //     $data['jatuh_tempo'] = $pajakModel
    //         ->where('tanggal_stnk <=', date('Y-m-d', strtotime('+30 days')))
    //         ->countAllResults();

    //     // Grafik pemeliharaan (Count by nopol)
    //     $data['grafik_pemeliharaan'] = $pemeliharaanModel
    //         ->select('id_kendaraan, COUNT(*) AS total')
    //         ->groupBy('id_kendaraan')
    //         ->orderBy('total', 'DESC')
    //         ->limit(10)
    //         ->findAll();

    //     // Grafik pajak terbayar
    //     $data['grafik_pajak'] = $pajakModel
    //         ->select('MONTH(tanggal_stnk) AS bulan, COUNT(*) AS total')
    //         ->where('status_pajak', 'Sudah Terbayar')
    //         ->groupBy('MONTH(tanggal_stnk)')
    //         ->findAll();

    //     $data['title'] = 'Dashboard';
    //     // dd(session()->get());
    //     return view('admin/home', $data);
    // }

    // public function index()
    // {
    //     helper('dashboard');

    //     // 1. Ambil tahun dari filter dropdown (jika tidak ada, gunakan tahun berjalan)
    //     $tahun = $this->request->getGet('tahun') ?? date('Y');

    //     $kendaraanModel     = $this->kendaraanModel;
    //     $supirModel         = $this->supirModel;
    //     $userModel          = $this->userModel;
    //     $pajakModel         = $this->pajakModel;
    //     $pemeliharaanModel = $this->pemeliharaanModel;

    //     // CARD DATA
    //     $data['total_kendaraan'] = $kendaraanModel->countAll();
    //     $data['total_supir']     = $supirModel->countAll();
    //     $data['total_user']      = $userModel->countAll();

    //     // Pajak jatuh tempo (Tetap global atau bisa Anda filter juga jika perlu)
    //     $data['jatuh_tempo'] = $pajakModel
    //         ->where('tanggal_stnk <=', date('Y-m-d', strtotime('+30 days')))
    //         ->countAllResults();

    //     // 2. Grafik pemeliharaan (DIFILTER PER TAHUN)
    //     $data['grafik_pemeliharaan'] = $pemeliharaanModel
    //         ->select('id_kendaraan, COUNT(*) AS total')
    //         ->where("YEAR(tanggal_keluhan)", $tahun) // Pastikan nama kolom benar
    //         ->groupBy('id_kendaraan')
    //         ->orderBy('total', 'DESC')
    //         ->limit(10)
    //         ->findAll();

    //     // 3. Grafik pajak terbayar (DIFILTER PER TAHUN)
    //     $data['grafik_pajak'] = $pajakModel
    //         ->select('MONTH(tanggal_stnk) AS bulan, COUNT(*) AS total')
    //         ->where('status_pajak', 'Sudah Terbayar')
    //         ->where("YEAR(tanggal_stnk)", $tahun) // Filter tahun
    //         ->groupBy('MONTH(tanggal_stnk)')
    //         ->orderBy('MONTH(tanggal_stnk)', 'ASC')
    //         ->findAll();

    //     $data['title'] = 'Dashboard Tahun ' . $tahun;
    //     $data['tahun_pilih'] = $tahun; // Kirim ke view untuk menandai pilihan dropdown

    //     return view('admin/home', $data);
    // }

    public function index()
    {
        helper('dashboard');

        // Ambil tahun dari filter untuk Pemeliharaan saja
        $tahun = $this->request->getGet('tahun') ?? date('Y');

        // ... (inisialisasi model tetap sama) ...
        $kendaraanModel = $this->kendaraanModel;
        $supirModel = $this->supirModel;
        $userModel = $this->userModel;
        $pajakModel = $this->pajakModel;
        $pemeliharaanModel = $this->pemeliharaanModel;
        // CARD DATA
        $data['total_kendaraan'] = $kendaraanModel->countAll();
        $data['total_supir'] = $supirModel->countAll();
        $data['total_user'] = $userModel->countAll();

        // 1. Grafik pemeliharaan (DIFILTER PER TAHUN)
        $data['grafik_pemeliharaan'] = $this->pemeliharaanModel
            ->select('id_kendaraan, COUNT(*) AS total')
            ->where("YEAR(tanggal_keluhan)", $tahun)
            ->groupBy('id_kendaraan')
            ->orderBy('total', 'DESC')
            ->limit(10)
            ->findAll();

        // 2. Grafik pajak terbayar (TIDAK BERPENGARUH FILTER / SEMUA DATA)
        // Pajak jatuh tempo <= 30 hari
        $data['jatuh_tempo'] = $pajakModel
            ->where('tanggal_stnk <=', date('Y-m-d', strtotime('+30 days')))
            ->countAllResults();
        // Jika ingin per bulan secara akumulatif dari semua tahun:
        $data['grafik_pajak'] = $this->pajakModel
            ->select('MONTH(tanggal_stnk) AS bulan, COUNT(*) AS total')
            ->where('status_pajak', 'Sudah Terbayar')
            ->groupBy('MONTH(tanggal_stnk)')
            ->orderBy('MONTH(tanggal_stnk)', 'ASC')
            ->findAll();

        $data['title'] = 'Dashboard';
        $data['tahun_pilih'] = $tahun;

        // ... (sisanya tetap sama) ...
        return view('admin/home', $data);
    }
}
