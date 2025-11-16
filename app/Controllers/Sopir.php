<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Sopir extends BaseController
{
    protected $sopirModel;
    public function __construct()
    {
        $this->sopirModel = new \App\Models\SopirModel();
        $this->db = \Config\Database::connect();
        helper(['id_helper']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Sopir',
            'sopir' => $this->sopirModel->findAll(),
        ];

        foreach ($data['sopir'] as &$s) {
            $s['enc_id'] = encode_id($s['id_sopir']);
        }

        return view('sopir/sopir', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Sopir',
        ];
        return view('sopir/tambah_sopir', $data);
    }

    public function simpan()
    {

        $data = [
            'nama_sopir' => $this->request->getPost('nama_sopir'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_sopir' => $this->request->getPost('status'),
        ];

        $this->sopirModel->insert($data);

        return redirect()->to('/sopir')->with('success', 'Data sopir berhasil ditambahkan');
    }

    public function edit($enc_id)
    {
        $id_sopir = decode_id($enc_id);
        $sopir = $this->sopirModel->find($id_sopir);

        if (!$sopir) {
            return redirect()->to('/sopir')->with('error', 'Data sopir tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Data Sopir',
            'sopir' => $sopir,
            'enc_id' => $enc_id,
        ];

        return view('sopir/edit_sopir', $data);
    }

    public function update($enc_id)
    {
        $id_sopir = decode_id($enc_id);
        $sopir = $this->sopirModel->find($id_sopir);

        if (!$sopir) {
            return redirect()->to('/sopir')->with('error', 'Data sopir tidak ditemukan');
        }

        $data = [
            'nama_sopir' => $this->request->getPost('nama_sopir'),
            'no_hp' => $this->request->getPost('no_hp'),
            'status_sopir' => $this->request->getPost('status'),
        ];

        $this->sopirModel->update($id_sopir, $data);

        if (strtolower($data['status_sopir']) != 'aktif') {
            $this->db->table('tb_kendaraan')
                ->where('id_sopir', $id_sopir)
                ->update(['id_sopir' => null]);
        } else {
            $this->db->table('tb_kendaraan')
                ->where('id_sopir', null)
                ->update(['id_sopir' => $id_sopir]);
        }

        return redirect()->to('/sopir')->with('success', 'Data sopir berhasil diupdate');
    }

    public function hapus($enc_id)
    {
        $id_sopir = decode_id($enc_id);
        $sopir = $this->sopirModel->find($id_sopir);

        if (!$sopir) {
            return redirect()->to('/sopir')->with('error', 'Data sopir tidak ditemukan');
        }

        $this->sopirModel->delete($id_sopir);

        return redirect()->to('/sopir')->with('success', 'Data sopir berhasil dihapus');
    }
}
