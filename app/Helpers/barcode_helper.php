<?php

use Picqer\Barcode\BarcodeGeneratorPNG;

if (!function_exists('generateBarcode')) {
    function generateBarcode($text)
    {
        $generator = new BarcodeGeneratorPNG();
        $barcode = $generator->getBarcode($text, $generator::TYPE_CODE_128);
        return 'data:image/png;base64,' . base64_encode($barcode);
    }
}
