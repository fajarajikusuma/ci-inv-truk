<?php

namespace App\Controllers;

class Maintenance extends BaseController
{
    public function index()
    {
        $isMaintenance = filter_var(env('app.isMaintenance', false), FILTER_VALIDATE_BOOLEAN);
        $targetMaintenance = env('app.maintenanceUntil', MAINTENANCE_UNTIL);
        $isExpired = $targetMaintenance ? time() > strtotime(trim($targetMaintenance)) : false;

        // Cek Bypass (Cookie)
        $cookieName = md5("mas-ganteng-fajar-aji-kusuma085293617889" . $this->request->getIPAddress());
        $hasBypass = isset($_COOKIE[$cookieName]);

        // JIKA SUDAH TIDAK MAINTENANCE
        if (!$isMaintenance || $hasBypass) {
            return redirect()->to(site_url('/'));
        }

        return view('maintenance', [
            'targetDate' => $targetMaintenance,
            'targetLabel' => env('app.maintenanceLabel', '')
        ]);
    }
}
