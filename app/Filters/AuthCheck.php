<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel; // Sesuaikan dengan nama model user kamu

class AuthCheck implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $userId = $session->get('id_user');

        // Jika sedang mengakses halaman login, abaikan filter
        if (in_array(uri_string(), ['login', 'auth/login'])) {
            return;
        }

        // 1. Cek jika sesi hilang (karena sudah lewat 15 menit)
        if (!$userId) {
            return redirect()->to(base_url('login'))->with('error', 'Sesi Anda telah berakhir karena tidak ada aktivitas.');
        }

        if ($userId) {
            $model = new UserModel();
            $user = $model->find($userId);

            // Cek jika user tiba-tiba dihapus atau statusnya berubah jadi nonaktif
            if (!$user || $user['status'] !== 'aktif') {
                $session->remove(['id_user', 'nama', 'role', 'isLoggedIn']);
                return redirect()->to(base_url('login'))->with('error', 'Akun Anda telah dinonaktifkan oleh Admin.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu aksi setelah request
    }
}
