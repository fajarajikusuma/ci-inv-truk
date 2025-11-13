<?php
// app/Helpers/qrcode_helper.php

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;

if (!function_exists('generateQRCode')) {
    /**
     * Generate QR as data-uri PNG (works for most endroid/qr-code versions)
     *
     * @param string $text
     * @param int $size
     * @return string data:image/png;base64,...
     */
    function generateQRCode(string $text, int $size = 150): string
    {
        // pastikan library ter-install
        if (!class_exists(Builder::class)) {
            throw new \RuntimeException('Library endroid/qr-code tidak ditemukan. Jalankan: composer require endroid/qr-code');
        }

        // build QR (gunakan pengaturan minimal agar kompatibel dengan berbagai versi)
        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($text)
            ->size($size)
            ->margin(10)
            ->build();

        return 'data:image/png;base64,' . base64_encode($result->getString());
    }
}
