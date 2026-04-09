<?php

namespace App\Controllers;

class Landing extends BaseController
{
    public function index()
    {
        helper(['ui', 'url', 'dashboard']);
        // --- LOGIKA COUNTER VIEW ---
        $db = \Config\Database::connect();
        $session = session();

        // Ambil URL saat ini
        $currentFullUrl = current_url();

        // Cek apakah di dalam URL mengandung kata 'pemeliharaan'
        // Ini akan mencakup dlh.ruijieddns.com/pemeliharaan/ apa pun di belakangnya (*)
        if (strpos($currentFullUrl, 'pemeliharaan') !== false) {

            if (!$session->has('has_visited_v_mars')) {
                // Lakukan increment
                $db->table('tb_visitor_logs')
                    ->where('page_key', 'pemeliharaan')
                    ->increment('total_hits', 1);

                $session->set('has_visited_v_mars', true);
            }
        }

        // Ambil data counter untuk ditampilkan
        $visitor = $db->table('tb_visitor_logs')->where('page_key', 'pemeliharaan')->get()->getRow();
        $total_view = $visitor ? $visitor->total_hits : 0;
        // ---------------------------

        $tahun = $this->request->getGet('tahun') ?? date('Y');

        $kendaraanModel = new \App\Models\KendaraanModel();
        $supirModel = new \App\Models\SopirModel();
        $userModel = new \App\Models\UserModel();
        $pajakModel = new \App\Models\PajakModel();
        $pemeliharaanModel = new \App\Models\PemeliharaanModel();

        $data = [
            'title' => 'V-MARS | Monitoring Armada',
            'tahun_pilih' => $tahun,
            'total_kendaraan' => $kendaraanModel->countAll(),
            'total_supir' => $supirModel->countAll(),
            'total_user' => $userModel->countAll(),
            'total_view' => $total_view, // Tambahkan ke data view
            'jatuh_tempo' => $pajakModel->where('tanggal_stnk <=', date('Y-m-d', strtotime('+30 days')))->countAllResults(),
            'sudah_bayar_pajak' => $pajakModel->where('status_pajak', 'Sudah Terbayar')->countAllResults(),
            'nama_dev' => 'Fajar Aji Kusuma, S.Kom.',

            'grafik_pemeliharaan' => $pemeliharaanModel
                ->select('id_kendaraan, COUNT(*) AS total')
                ->where("YEAR(tanggal_keluhan)", $tahun)
                ->groupBy('id_kendaraan')
                ->orderBy('total', 'DESC')
                ->limit(10) // Kita ubah ke 15 sesuai request grafik vertikal sebelumnya
                ->findAll(),
        ];

        return view('landing_page', $data);
    }
}