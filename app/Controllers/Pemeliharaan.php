<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pemeliharaan extends BaseController
{
    protected $pemeliharaanModel;
    protected $kendaraanModel;
    protected $sopirModel;
    public function __construct()
    {
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        helper(['id_helper']);
    }
    public function index()
    {
        $data['title'] = 'Data Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaan();

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        return view('pemeliharaan/pemeliharaan', $data);
    }

    public function detail($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);
        $data = [
            'title' => 'Detail Pemeliharaan Kendaraan',
            'pemeliharaan' => $this->pemeliharaanModel->getPemeliharaanByKendaraan($id_kendaraan),
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'enc_id' => $enc_id,
        ];

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id_pemeliharaan'] = encode_id($p['id_pemeliharaan']);
        }

        return view('pemeliharaan/detail_pemeliharaan', $data);
    }

    public function tambah($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);

        $data = [
            'title' => 'Input Pemeliharaan Kendaraan',
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'enc_id' => $enc_id,
            // 'sopir' => $this->sopirModel->findAll(),
        ];

        return view('pemeliharaan/tambah_pemeliharaan', $data);
    }

    public function simpan($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);

        $data = [
            'id_kendaraan' => $id_kendaraan,
            'id_sopir' => $this->request->getPost('id_sopir'),
            'tanggal_keluhan' => $this->request->getPost('tanggal_keluhan'),
            'tindakan_perbaikan' => $this->request->getPost('tindakan_perbaikan'),
            'bengkel' => $this->request->getPost('bengkel'),
            'biaya' => $this->request->getPost('biaya'),
            'dibuat_oleh' => $this->request->getPost('id_user'),
        ];
        // dd($data);
        $this->pemeliharaanModel->insert($data);

        return redirect()->to(base_url('pemeliharaan/detail/' . $enc_id))->with('success', 'Data pemeliharaan kendaraan berhasil disimpan.');
    }

    // edit pemeliharaan
    public function edit($enc_id_pemeliharaan)
    {
        $id_pemeliharaan = decode_id($enc_id_pemeliharaan);
        // get id_kendaraan from id_pemeliharaan
        $id_kendaraan = $this->pemeliharaanModel->getKendaraanId($id_pemeliharaan);
        $id_user = $this->pemeliharaanModel->getUserId($id_pemeliharaan);
        $data = [
            'title' => 'Edit Pemeliharaan Kendaraan',
            'pemeliharaan' => $this->pemeliharaanModel->find($id_pemeliharaan),
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'user' => $this->pemeliharaanModel->getDataUserById($id_user),
            'enc_id_pemeliharaan' => $enc_id_pemeliharaan,
            'enc_id_kendaraan' => encode_id($id_kendaraan),
            // 'sopir' => $this->sopirModel->findAll(),
        ];
        // dd($data);
        return view('pemeliharaan/edit_pemeliharaan', $data);
    }

    // update pemeliharaan
    public function update($enc_id_pemeliharaan)
    {
        $id_pemeliharaan = decode_id($enc_id_pemeliharaan);
        $id_kendaraan = $this->pemeliharaanModel->getKendaraanId($id_pemeliharaan);

        $data = [
            'id_kendaraan' => $id_kendaraan,
            'id_sopir' => $this->request->getPost('id_sopir'),
            'tanggal_keluhan' => $this->request->getPost('tanggal_keluhan'),
            'tindakan_perbaikan' => $this->request->getPost('tindakan_perbaikan'),
            'bengkel' => $this->request->getPost('bengkel'),
            'biaya' => $this->request->getPost('biaya'),
            'dibuat_oleh' => $this->request->getPost('dibuat_oleh'),
        ];
        // dd($data);
        $this->pemeliharaanModel->update($id_pemeliharaan, $data);

        return redirect()->to(base_url('pemeliharaan/detail/' . encode_id($id_kendaraan)))->with('success', 'Data pemeliharaan kendaraan berhasil diupdate.');
    }

    // hapus pemeliharaan
    public function hapus($enc_id_pemeliharaan)
    {
        $id_pemeliharaan = decode_id($enc_id_pemeliharaan);
        $id_kendaraan = $this->pemeliharaanModel->getKendaraanId($id_pemeliharaan);

        $this->pemeliharaanModel->delete($id_pemeliharaan);

        return redirect()->to(base_url('pemeliharaan/detail/' . encode_id($id_kendaraan)))->with('success', 'Data pemeliharaan kendaraan berhasil dihapus.');
    }
}
