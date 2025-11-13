<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
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
}
