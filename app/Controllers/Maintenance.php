<?php

namespace App\Controllers;

class Maintenance extends BaseController
{
    public function index()
    {
        $isMaintenance = env('app.isMaintenance', false);
        $isExpired = time() > strtotime(MAINTENANCE_UNTIL);

        // Cek Bypass (Cookie)
        $cookieName = md5("mas-ganteng-fajar-aji-kusuma085293617889" . $this->request->getIPAddress());
        $hasBypass = isset($_COOKIE[$cookieName]);
        // dd(!$isMaintenance || $isExpired || $hasBypass);

        // JIKA SUDAH TIDAK MAINTENANCE (Sesuai alasan Anda tadi)
        if (!$isMaintenance || $isExpired || $hasBypass) {
            return redirect()->to(site_url('/'));
        }

        return view('maintenance', [
            'targetDate' => MAINTENANCE_UNTIL
        ]);
    }
}
