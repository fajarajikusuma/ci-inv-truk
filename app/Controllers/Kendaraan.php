<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kendaraan extends BaseController
{
    protected $kendaraanModel;
    protected $sopirModel;

    public function __construct()
    {
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        $this->sopirModel = new \App\Models\SopirModel();
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
        $this->pajakModel = new \App\Models\PajakModel();
        helper(['id_helper']);
    }

    public function index()
    {
        $role = session()->get('role');

        $data = [
            'title'     => 'Data Kendaraan',
            'kendaraan' => $this->kendaraanModel->getKendaraanWithSopir()
        ];

        foreach ($data['kendaraan'] as $key => &$k) {

            // encode id
            $k['enc_id'] = encode_id($k['id_kendaraan']);

            // tampilkan nama sopir untuk role tertentu
            if (in_array($role, ['operator_pemeliharaan', 'admin'])) {
                $k['nama_sopir'] = $k['nama_sopir'] ?? '-';
            }

            // jika sopir tidak aktif, kosongkan nama sopir
            if ($k['status_sopir'] !== 'aktif') {
                $k['nama_sopir'] = null;
            }

            // filter data untuk operator pemeliharaan
            if ($role === 'operator_pemeliharaan' && $k['source'] !== 'operator_pemeliharaan') {
                unset($data['kendaraan'][$key]);
            }
        }

        return view('kendaraan/kendaraan', $data);
    }


    public function tambah()
    {
        $data = [
            'title' => 'Tambah Data Kendaraan',
            'sopirList' => $this->sopirModel->findAll(),
        ];
        return view('kendaraan/tambah_kendaraan', $data);
    }

    public function simpan()
    {
        // upload foto kendaraan
        $file = $this->request->getFile('foto');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/kendaraan', $newName);
            $fotoPath = $newName;
        } else {
            $fotoPath = null;
        }

        $data = [
            'nopol' => $this->request->getPost('nopol'),
            'id_sopir' => $this->request->getPost('sopir'),
            'jenis_kendaraan' => $this->request->getPost('jenis'),
            'merk' => $this->request->getPost('merk'),
            'tipe' => $this->request->getPost('tipe'),
            'tahun_pembuatan' => $this->request->getPost('tahun'),
            'no_rangka' => $this->request->getPost('no_rangka'),
            'no_mesin' => $this->request->getPost('no_mesin'),
            'foto_kendaraan' => $fotoPath,
            'status' => $this->request->getPost('status'),
            'source' => session()->get('role') == 'admin' ? 'operator_pemeliharaan' : session()->get('role')
        ];

        $this->kendaraanModel->insert($data);
        return redirect()->to(base_url('kendaraan'))->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    public function edit($enc_id)
    {
        $id = decode_id($enc_id);
        if ($id === false) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'ID tidak valid.');
        }

        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        $data = [
            'kendaraan' => $kendaraan,
            'enc_id' => $enc_id,
            'title' => 'Edit Data Kendaraan',
            'sopirList' => $this->sopirModel->findAll(),
        ];

        return view('kendaraan/edit_kendaraan', $data);
    }

    public function update($enc_id)
    {
        $id = decode_id($enc_id);

        if ($id === false) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'ID tidak valid.');
        }

        $post = $this->request->getPost();
        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/kendaraan', $newName);
            $kendaraan['foto'] = 'uploads/kendaraan/' . $newName;
            $fotoPath = $newName;
        }

        if (isset($post['sopir'])) {
            $post['id_sopir'] = $post['sopir'];
        } else {
            $post['id_sopir'] = null;
        }

        $this->kendaraanModel->update($id, [
            'nopol'    => strtoupper($post['nopol']),
            'id_sopir'       => $post['id_sopir'],
            'jenis_kendaraan' => $post['jenis'],
            'merk'            => $post['merk'],
            'tipe'            => $post['tipe'],
            'tahun_pembuatan' => $post['tahun'],
            'no_rangka'      => $post['no_rangka'],
            'no_mesin'       => $post['no_mesin'],
            'foto_kendaraan'  => isset($fotoPath) ? $fotoPath : $this->request->getPost('existing_foto'),
            'status'          => $post['status'],
            'source' => session()->get('role') == 'admin' ? 'operator_pemeliharaan' : session()->get('role')

        ]);

        return redirect()->to(base_url('kendaraan'))->with('success', 'Data kendaraan berhasil diperbarui.');
    }

    public function hapus($enc_id)
    {
        $id = decode_id($enc_id);
        if ($id === false) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'ID tidak valid.');
        }

        $kendaraan = $this->kendaraanModel->find($id);
        if (!$kendaraan) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'Data kendaraan tidak ditemukan.');
        }

        // cek apakah kendaraan sudah terpakai di pemeliharaan
        $pemeliharaan = $this->pemeliharaanModel->getPemeliharaanByKendaraan($id);
        $pajak = $this->pajakModel->where('id_kendaraan', $id)->first();
        if ($pemeliharaan || $pajak) {
            return redirect()->to(base_url('kendaraan'))->with('error', 'Data kendaraan sudah terpakai di pemeliharaan atau pajak.');
        } else {
            $this->kendaraanModel->delete($id);
        }

        return redirect()->to(base_url('kendaraan'))->with('success', 'Data kendaraan berhasil dihapus.');
    }

    public function detail($enc_id)
    {
        $id = decode_id($enc_id);

        $kendaraan = $this->kendaraanModel->getKendaraanDetail($id);

        if (!$kendaraan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Data kendaraan tidak ditemukan.');
        }

        return view('kendaraan/detail_kendaraan', [
            'kendaraan' => $kendaraan,
            'title' => 'Detail Data Kendaraan'
        ]);
    }
}
