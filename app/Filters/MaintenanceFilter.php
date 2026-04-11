<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class MaintenanceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $encrypter = Services::encrypter();
        $secretKey = "bypass-v-mars-security-key085293617889" . $request->getIPAddress();
        $nameIdentifier = "mas-ganteng-fajar-aji-kusuma085293617889" . $request->getIPAddress();

        // 1. Ambil target waktu dari Konstanta
        $targetMaintenance = MAINTENANCE_UNTIL;
        $isExpired = time() > strtotime($targetMaintenance);
        $isMaintenance = env('app.isMaintenance', false);

        // 2. LOGIKA PINTU RAHASIA
        $accessKey = $_GET['access'] ?? null;

        if ($accessKey === 'secretadmin') {
            // Enkripsi Isi dan Nama (sebagai value di dalam cookie)
            $encryptedValue = base64_encode($encrypter->encrypt($secretKey));

            // Kita gunakan md5 dari nameIdentifier sebagai Nama Cookie agar statis namun sulit ditebak
            $cookieName = md5($nameIdentifier);

            setcookie($cookieName, $encryptedValue, time() + 86400, "/", "", false, true);

            return redirect()->to(current_url());
        }

        if ($accessKey === 'lock') {
            $cookieName = md5($nameIdentifier);
            setcookie($cookieName, '', time() - 3600, "/");
            return redirect()->to(site_url('/'));
        }

        // 3. CEK AKSES BYPASS (Cookie)
        $hasBypass = false;
        $cookieName = md5($nameIdentifier);
        $cookieValue = $_COOKIE[$cookieName] ?? null;

        if ($cookieValue) {
            try {
                // Dekripsi value cookie
                $decryptedValue = $encrypter->decrypt(base64_decode($cookieValue));

                // Validasi apakah isi dekripsi sesuai dengan secretKey (IP Match)
                if ($decryptedValue === $secretKey) {
                    $hasBypass = true;
                }
            } catch (\Exception $e) {
                $hasBypass = false;
            }
        }

        // 4. EKSEKUSI FILTER
        if ($isMaintenance && !$isExpired && !$hasBypass) {
            if (url_is('maintenance-mode')) {
                return;
            }
            return redirect()->to(site_url('maintenance-mode'));
        }

        // 5. AUTO-OFF
        if (url_is('maintenance-mode')) {
            if (!$isMaintenance || $isExpired || $hasBypass) {
                return redirect()->to(site_url('/'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
