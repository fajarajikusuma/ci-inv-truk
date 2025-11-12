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
            return redirect()->to('/user')->with('error', 'Data user tidak ditemukan');
        }

        $this->userModel->delete($id_user);

        return redirect()->to('/user')->with('success', 'User berhasil dihapus.');
    }
}
