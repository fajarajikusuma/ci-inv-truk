<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;
    protected $kendaraanModel;
    protected $pemeliharaanModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
        helper(['id_helper']);
    }

    public function index()
    {
        if (session()->get('id_user')) {
            return redirect()->to('/dashboard');
        }
        $title = 'Login - Inventory Kendaraan';
        return view('auth/login', compact('title'));
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();

        if ($user) {
            // 1. Cek apakah status user aktif
            if ($user['status'] !== 'aktif') {
                return redirect()->to('/login')->with('error', 'Akun Anda nonaktif. Akses ditolak.');
            }

            // 2. Verifikasi password
            if (password_verify($password, $user['password'])) {
                $session = session();
                $session->set([
                    'id_user' => $user['id_user'],
                    'nama' => $user['nama'],
                    'role' => $user['role'], // Tetap disimpan di session untuk keperluan lain
                    'logged_in' => true
                ]);

                return redirect()->to('/dashboard'); // Langsung ke dashboard utama
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/landing');
    }

    // CEK RIWAYAT KENDARAAN
    public function cek_riwayat_kendaraan($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);

        // Ambil tahun filter dari POST, default ke 'all' agar saat pertama scan QR semua riwayat muncul
        $tahun_filter = $this->request->getPost('tahun_filter') ?? date('Y');

        if ($tahun_filter == 'all') {
            // Tampilkan semua data pemeliharaan
            $pemeliharaan = $this->pemeliharaanModel->getPemeliharaanByKendaraan($id_kendaraan);
        } else {
            // Tampilkan data pemeliharaan berdasarkan tahun
            $pemeliharaan = $this->pemeliharaanModel->getPemeliharaanByKendaraanFilter($id_kendaraan, $tahun_filter);
        }

        $data = [
            'title' => 'Riwayat Pemeliharaan Kendaraan',
            'pemeliharaan' => $pemeliharaan,
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'enc_id' => $enc_id,
            'tahun' => $tahun_filter,
        ];

        // Encode ID pemeliharaan agar link detail (jika ada) tetap aman
        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id_pemeliharaan'] = encode_id($p['id_pemeliharaan']);
        }

        // Karena ini halaman publik (cek riwayat via QR), arahkan ke view khusus riwayat
        return view('pemeliharaan/cek_riwayat_kendaraan', $data);
    }
}
