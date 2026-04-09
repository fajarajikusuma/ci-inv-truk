<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class User extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        helper(['id_helper']);
    }

    public function index()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->userModel->findAll();

        foreach ($data['user'] as &$u) {
            $u['enc_id'] = encode_id($u['id_user']);
        }

        return view('user/user', $data);
    }

    public function tambah()
    {
        $data['title'] = 'Tambah User';

        return view('user/tambah_user', $data);
    }

    public function simpan()
    {
        $this->userModel->insert([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($enc_id)
    {
        $id_user = decode_id($enc_id);
        $user = $this->userModel->find($id_user);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'Data user tidak ditemukan');
        }

        $data['title'] = 'Edit User';
        $data['user'] = $user;
        $data['enc_id'] = $enc_id;

        return view('user/edit_user', $data);
    }

    public function update($enc_id)
    {
        $id_user = decode_id($enc_id);
        $user = $this->userModel->find($id_user);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'Data user tidak ditemukan');
        }

        $this->userModel->update($id_user, [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) : $user['password'],
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ]);

        return redirect()->to('/user')->with('success', 'User berhasil diupdate.');
    }

    public function hapus($enc_id)
    {
        $id_user = decode_id($enc_id);
        $user = $this->userModel->find($id_user);

        if (!$user) {
            return redirect()->to('/user')->with('error', 'Data user tidak ditemukan.');
        }

        $db = \Config\Database::connect();

        // 1. Cek apakah user sudah pernah menginput data di tabel pemeliharaan
        $cekPemeliharaan = $db->table('tb_pemeliharaan')->where('dibuat_oleh', $id_user)->countAllResults();

        // 2. Cek apakah user terkait dengan data pajak (jika ada relasi)
        $cekLog = $db->table('tb_log_aktivitas')->where('id_user', $id_user)->countAllResults();

        // 3. Tambahkan cek tabel lain jika perlu (misal: tb_kendaraan jika ada kolom 'created_by')

        // LOGIKA PROTEKSI:
        if ($cekPemeliharaan > 0 || $cekLog > 0) {
            return redirect()->to('/user')->with('error', 'Gagal: User "' . $user['nama'] . '" tidak bisa dihapus karena memiliki riwayat data pemeliharaan. Silakan nonaktifkan saja akunnya.');
        }

        // Jika lolos pengecekan (tidak ada riwayat data), baru boleh hapus log dan usernya
        try {
            // Hapus log aktivitas dulu agar tidak gagal Foreign Key
            $db->table('tb_log_aktivitas')->where('id_user', $id_user)->delete();

            // Hapus User
            $this->userModel->delete($id_user);

            return redirect()->to('/user')->with('success', 'User berhasil dihapus secara permanen.');
        } catch (\Exception $e) {
            return redirect()->to('/user')->with('error', 'Terjadi kesalahan sistem saat menghapus data.');
        }
    }
}
