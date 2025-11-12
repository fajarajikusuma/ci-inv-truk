<?php

use CodeIgniter\Database\Config;

if (!function_exists('catat_log')) {
    function catat_log(string $controller, string $method, string $deskripsi)
    {
        $db = Config::connect();

        $session = session();
        $id_user = $session->get('id_user') ?? null;
        $nama_user = $session->get('nama_user') ?? 'Guest';

        $data = [
            'id_user'     => $id_user,
            'nama_user'   => $nama_user,
            'controller'  => $controller,
            'method'      => $method,
            'deskripsi'   => $deskripsi,
            'ip_address'  => $_SERVER['REMOTE_ADDR'] ?? '',
            'user_agent'  => $_SERVER['HTTP_USER_AGENT'] ?? '',
        ];

        $db->table('tb_log_aktivitas')->insert($data);
    }
}
