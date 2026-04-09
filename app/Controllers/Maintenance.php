<?php

namespace App\Controllers;

class Maintenance extends BaseController
{
    public function index()
    {
        // Cek status maintenance (samakan dengan cara Anda di Filter/.env)
        $isMaintenance = env('app.isMaintenance', false);

        // JIKA MAINTENANCE MATI (false), JANGAN KASIH AKSES HALAMAN INI
        if (!$isMaintenance) {
            return redirect()->to(site_url('/'));
        }

        return view('maintenance');
    }
}
