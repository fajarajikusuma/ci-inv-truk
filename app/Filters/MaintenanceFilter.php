<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ubah jadi false jika ingin mematikan
        // $isMaintenance = true;
        $isMaintenance = env('app.isMaintenance', false);

        // if (!$isMaintenance) {
        //     if (url_is('maintenance-mode')) {
        //         return redirect()->to(site_url('/'));
        //     }
        // }

        if ($isMaintenance) {
            // Jika rute saat ini ADALAH maintenance-mode, BERHENTI (jangan redirect)
            if (url_is('maintenance-mode')) {
                return;
            }

            // Jika bukan, baru lempar ke halaman maintenance
            return redirect()->to(site_url('maintenance-mode'));
        } else {
            // Jika mode maintenance dimatikan, dan sedang di halaman maintenance, redirect ke root
            if (url_is('maintenance-mode')) {
                return redirect()->to(site_url('/'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
