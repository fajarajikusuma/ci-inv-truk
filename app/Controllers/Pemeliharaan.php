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
        $this->sopirModel = new \App\Models\SopirModel();
        helper(['id_helper', 'barcode', 'qrcode']);
    }
    public function index()
    {
        $data['title'] = 'Data Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaan();
        $data['tahun'] = null;
        $data['bulan'] = null;

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        foreach ($data['pemeliharaan'] as &$p) {
            $sopir = null;
            if (!empty($p['id_sopir'])) {
                $sopir = $this->sopirModel->find($p['id_sopir']);
            }
            $sopir_nonaktif = (!$sopir || empty($sopir['status_sopir'])) ? true : false;
            $p['sopir_nonaktif'] = $sopir_nonaktif;
        }
        unset($p);

        return view('pemeliharaan/pemeliharaan', $data);
    }

    public function detail($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);

        $tahun_filter = $this->request->getPost('tahun_filter') ?? date('Y');
        // dd($tahun_filter);
        if ($tahun_filter == 'all') {
            // tampilkan semua data pemeliharaan
            $pemeliharaan = $this->pemeliharaanModel->getPemeliharaanByKendaraan($id_kendaraan);
        } else {
            // tampilkan data pemeliharaan berdasarkan tahun
            $pemeliharaan = $this->pemeliharaanModel->getPemeliharaanByKendaraanFilter($id_kendaraan, $tahun_filter);
        }

        $data = [
            'title' => 'Detail Pemeliharaan Kendaraan',
            'pemeliharaan' => $pemeliharaan,
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'enc_id' => $enc_id,
            'tahun' => $tahun_filter,
        ];

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id_pemeliharaan'] = encode_id($p['id_pemeliharaan']);
        }

        // Generate QR Code berdasarkan nomor polisi + ID kendaraan
        $qrText = base_url('cek_riwayat_kendaraan/' . $enc_id);

        $data['qrcode'] = generateQRCode($qrText);

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
        //handle foto nota
        $file = $this->request->getFile('nota');
        if ($file && $file->getError() == 0) {
            $nama_nota = $file->getRandomName();
            $file->move('assets/img/nota', $nama_nota);
            $nota = $nama_nota;
        } else {
            $nota = null;
        }

        $data = [
            'id_kendaraan' => $id_kendaraan,
            'id_sopir' => $this->request->getPost('id_sopir'),
            'tanggal_keluhan' => $this->request->getPost('tanggal_keluhan'),
            'tindakan_perbaikan' => $this->request->getPost('tindakan_perbaikan'),
            'bengkel' => $this->request->getPost('bengkel'),
            'biaya' => $this->request->getPost('biaya'),
            'dibuat_oleh' => $this->request->getPost('id_user'),
            'nota' => $nota,
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

        //handle foto nota
        $nota = $this->request->getFile('nota');
        if ($nota && $nota->getError() == 0) {
            $nama_nota = $nota->getRandomName();
            // delete old nota
            $nota_lama = $this->request->getPost('nota_lama');
            if ($nota_lama && file_exists('assets/img/nota/' . $nota_lama)) {
                unlink('assets/img/nota/' . $nota_lama);
            }
            $nota->move('assets/img/nota', $nama_nota);
            $nota = $nama_nota;
        } else {
            $nota = $this->request->getPost('nota_lama');
        }

        $data = [
            'id_kendaraan' => $id_kendaraan,
            'id_sopir' => $this->request->getPost('id_sopir'),
            'tanggal_keluhan' => $this->request->getPost('tanggal_keluhan'),
            'tindakan_perbaikan' => $this->request->getPost('tindakan_perbaikan'),
            'bengkel' => $this->request->getPost('bengkel'),
            'biaya' => $this->request->getPost('biaya'),
            'dibuat_oleh' => $this->request->getPost('dibuat_oleh'),
            'nota' => $nota,
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

    public function cetak_qrcode($enc_id)
    {
        $id_kendaraan = decode_id($enc_id);

        $data = [
            'kendaraan' => $this->kendaraanModel->getKendaraanDetail($id_kendaraan),
            'qrcode' => generateQRCode(base_url('cek_riwayat_kendaraan/' . $enc_id)),
        ];

        return view('pemeliharaan/cetak_qrcode', $data);
    }

    public function filter()
    {
        $tahun = $this->request->getGet('tahun');
        $bulan = $this->request->getGet('bulan');

        if (!$tahun || !$bulan) {
            return redirect()->to(base_url('pemeliharaan'))->with('error', 'Mohon pilih tahun dan bulan');
        }

        $data['title'] = 'Data Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaanByTahunBulan($tahun, $bulan);
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        foreach ($data['pemeliharaan'] as &$p) {
            $sopir = null;
            if (!empty($p['id_sopir'])) {
                $sopir = $this->sopirModel->find($p['id_sopir']);
            }
            $sopir_nonaktif = (!$sopir || empty($sopir['status_sopir'])) ? true : false;
            $p['sopir_nonaktif'] = $sopir_nonaktif;
        }
        unset($p);

        return view('pemeliharaan/pemeliharaan', $data);
    }
}
