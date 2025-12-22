<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('id_user')) {
            // hanya redirect kalau bukan di halaman login
            if (!in_array(uri_string(), ['login', 'auth/login'])) {
                return redirect()->to(base_url('login'))->with('error', 'Silakan login terlebih dahulu.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
