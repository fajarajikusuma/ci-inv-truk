<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $roles = null)
    {
        // Lewatkan halaman login
        if (in_array(uri_string(), ['login', 'auth/login'])) {
            return;
        }

        // 🔐 CEK LOGIN (SATU SUMBER)
        if (!session()->get('id_user')) {
            return redirect()->to('/login');
        }

        // 🔑 CEK ROLE
        if ($roles !== null) {
            $userRole = session()->get('role');

            if (is_string($roles)) {
                $roles = explode(',', $roles);
            }

            if (!in_array($userRole, $roles, true)) {
                return redirect()->to('/')
                    ->with('toast_error', 'Anda tidak memiliki hak akses ke halaman tersebut');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
