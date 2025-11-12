<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class ActivityLogFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        helper('log');

        // Ambil objek URI dari request (lebih aman daripada service('uri'))
        // $request adalah RequestInterface, tapi getUri() tersedia di IncomingRequest
        $uriObj = null;
        try {
            $uriObj = $request->getUri();
        } catch (\Throwable $e) {
            // fallback ke service('uri') jika ada error (sangat jarang)
            $uriObj = service('uri');
        }

        // Pastikan total segmen diketahui
        $total = 0;
        try {
            $total = (int) $uriObj->getTotalSegments();
        } catch (\Throwable $e) {
            $total = 0;
        }

        $controller = ($total >= 1) ? $uriObj->getSegment(1) : 'home';
        $method     = ($total >= 2) ? $uriObj->getSegment(2) : 'index';

        // Ambil request lengkap untuk get/post secara aman
        $req = service('request');

        $get = $req->getGet() ?? [];
        $post = $req->getPost() ?? [];

        // Pastikan tipe array
        if (!is_array($get)) {
            $get = (array) $get;
        }
        if (!is_array($post)) {
            $post = (array) $post;
        }

        // Gabungkan namun hindari duplicate keys by prioritizing POST
        $paramsArr = array_merge($get, $post);

        // Buat string parameter yang aman dan tidak terlalu panjang
        $paramParts = [];
        foreach ($paramsArr as $k => $v) {
            if (is_array($v)) {
                $val = json_encode($v);
            } else {
                $val = (string) $v;
            }
            // potong panjang nilai untuk mencegah log berukuran besar
            if (mb_strlen($val) > 200) {
                $val = mb_substr($val, 0, 200) . '...';
            }
            $paramParts[] = $k . '=' . $val;
        }
        $paramString = implode(', ', $paramParts);

        // Deskripsi dinamis
        $deskripsi = ucfirst($method) . ' data pada controller ' . ucfirst($controller);
        if ($paramString) {
            $deskripsi .= ' dengan parameter: ' . $paramString;
        }

        // Simpan log
        catat_log($controller, $method, $deskripsi);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // tidak digunakan
    }
}
