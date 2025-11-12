<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ValidationFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika tidak ada argumen rules, lewati
        if (!$arguments) {
            return;
        }

        // Ambil rules dari argumen (misal: kendaraan_tambah)
        $rules = config('Validation')->{$arguments[0]} ?? [];

        if (empty($rules)) {
            return;
        }

        // Gunakan service request agar bisa panggil getPost()
        $req = service('request');

        $validation = \Config\Services::validation();

        if (! $validation->setRules($rules)->run($req->getPost())) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $validation->getErrors());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak digunakan
    }
}
