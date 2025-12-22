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
            return redirect()->to('/');
        }
        $title = 'Login - Inventory Truk';
        return view('auth/login', compact('title'));
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('username', $username)->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session = session();
                $session->set('id_user', $user['id_user']);
                $session->set('nama', $user['nama']);
                $session->set('role', $user['role']);
                return redirect()->to('/');
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    // CEK RIWAYAT KENDARAAN
    public function cek_riwayat_kendaraan($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);
        $data = [
            'title' => 'Detail Pemeliharaan Kendaraan',
            'pemeliharaan' => $this->pemeliharaanModel->getPemeliharaanByKendaraan($id_kendaraan),
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'enc_id' => $enc_id,
        ];
        return view('pemeliharaan/cek_riwayat_kendaraan', $data);
    }
}
