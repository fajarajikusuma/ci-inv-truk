<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pajak extends BaseController
{
    protected $pemeliharaanModel;

    public function __construct()
    {
        $this->pajakModel = new \App\Models\PajakModel();
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        helper(['id_helper']);
    }

    public function index()
    {
        session();
        // updateStatusOtomatisPajakKendaraan();
        $this->pajakModel->updateStatusPajakOtomatis();
        $tahun = $this->request->getVar('tahun') ?? date('Y');

        // Ambil data pajak kendaraan pada tahun tersebut
        $data_pajak = $this->pajakModel->getDataPajakByTahun($tahun);

        // Daftar bulan
        $nama_bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        // Siapkan array bulanan (default total = 0)
        $data_bulanan = [];
        foreach ($nama_bulan as $key => $nama) {
            $data_bulanan[$key] = [
                'nama_bulan' => $nama,
                'total' => 0,
                'data' => [],
            ];
        }

        foreach ($data_pajak as $p) {

            // lewati jika sudah terbayar
            // if ($p['status_pajak'] == 'Sudah Terbayar') {
            //     continue;
            // }

            $tgl_stnk  = $p['tanggal_stnk'];
            $tgl_tnkb  = $p['tanggal_tnkb'];

            $bulan_stnk = date('m', strtotime($tgl_stnk));
            $tahun_stnk = date('Y', strtotime($tgl_stnk));

            $bulan_tnkb = date('m', strtotime($tgl_tnkb));
            $tahun_tnkb = date('Y', strtotime($tgl_tnkb));

            $today   = date('Y-m-d');
            $minus_30 = date('Y-m-d', strtotime('-30 days', strtotime($tgl_tnkb)));

            // 🔹 JIKA STNK == TNKB → HITUNG STNK SAJA
            if ($tgl_stnk == $tgl_tnkb) {

                if ($tahun_stnk == $tahun) {
                    $data_bulanan[$bulan_stnk]['total']++;
                    $data_bulanan[$bulan_stnk]['data'][] = $p;
                }
            }
            // 🔹 JIKA BERBEDA
            else {

                // STNK
                if ($tahun_stnk == $tahun) {
                    $data_bulanan[$bulan_stnk]['total']++;
                    $data_bulanan[$bulan_stnk]['data'][] = $p;
                }

                // TNKB (tahun sama ATAU mendekati 30 hari)
                if ($tahun_tnkb == $tahun || $today >= $minus_30) {
                    $data_bulanan[$bulan_tnkb]['total']++;
                    $data_bulanan[$bulan_tnkb]['data'][] = $p;
                }
            }
        }


        // Hitung total kendaraan yang harus bayar pajak pada tahun tersebut
        $total_kendaraan = 0;
        foreach ($data_bulanan as $bulan_data) {
            $total_kendaraan += $bulan_data['total'];
        }

        $data = [
            'title' => 'Data Pajak Kendaraan',
            'tahun' => $tahun,
            'data_bulanan' => $data_bulanan,
            'total_kendaraan' => $total_kendaraan,
            'pajak' => $this->pajakModel->getKendaraanWithDataPajak(),
        ];
        // dd($data);
        // enc_id untuk setiap kendaraan
        foreach ($data['pajak'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        return view('pajak/pajak', $data);
    }

    public function tambah($enc_id)
    {
        session()->set('page', 'tambah_pajak');
        $id = decode_id($enc_id);

        $data = [
            'title' => 'Tambah Data Pajak Kendaraan',
            'kendaraan' => $this->kendaraanModel->where('id_kendaraan', $id)->first(),
            'enc_id_pajak' => $enc_id,
            'pajak' => $this->pajakModel->where('id_kendaraan', $id)->first(),
        ];

        return view('pajak/edit_pajak', $data);
    }

    public function simpan($enc_id)
    {
        $id = decode_id($enc_id);

        $tanggal_stnk = $this->request->getVar('tanggal_stnk');
        $tanggal_tnkb = $this->request->getVar('tanggal_tnkb');

        $today = date('Y-m-d');
        $currentYear = date('Y');

        $status = '';

        // Jika salah satu tanggal < hari ini => sudah lewat jatuh tempo
        if (
            $tanggal_stnk < $today ||
            $tanggal_tnkb < $today
        ) {
            $status = 'Sudah Melewati Jatuh Tempo';

            // Jika salah satu tanggal = hari ini
        } elseif (
            $tanggal_stnk == $today ||
            $tanggal_tnkb == $today
        ) {
            $status = 'Jatuh Tempo';

            // Jika tahun tanggal pajak lebih kecil dari tahun sekarang → dianggap sudah bayar
        } elseif (
            date('Y', strtotime($tanggal_stnk)) < $currentYear ||
            date('Y', strtotime($tanggal_tnkb)) < $currentYear
        ) {
            $status = 'Sudah Terbayar';
        } else {
            // Cek 1 bulan sebelum jatuh tempo
            $stnk_minus_1_month = date('Y-m-d', strtotime('-1 month', strtotime($tanggal_stnk)));
            $tnkb_minus_1_month = date('Y-m-d', strtotime('-1 month', strtotime($tanggal_tnkb)));

            if (
                $today >= $stnk_minus_1_month ||
                $today >= $tnkb_minus_1_month
            ) {
                $status = 'Akan Jatuh Tempo';
            }
        }

        // simpan
        $data = [
            'id_kendaraan' => $id,
            'tanggal_stnk' => $tanggal_stnk,
            'tanggal_tnkb' => $tanggal_tnkb,
            'status_pajak' => $status,
            'keterangan_pajak' => $this->request->getVar('keterangan'),
        ];

        $this->pajakModel->insert($data);

        return redirect()->to(base_url('pajak_kendaraan'))->with('success', 'Data pajak kendaraan berhasil ditambahkan');
    }

    public function edit($enc_id)
    {
        session()->set('page', 'edit_pajak');
        $id = decode_id($enc_id);

        $id_pajak = $this->pajakModel->where('id_kendaraan', $id)->first()['id_pajak'];
        $enc_id_pajak = encode_id($id_pajak);

        $data = [
            'title' => 'Edit Data Pajak Kendaraan',
            'pajak' => $this->pajakModel->where('id_kendaraan', $id)->first(),
            'enc_id_pajak' => $enc_id_pajak,
            'kendaraan' => $this->kendaraanModel->where('id_kendaraan', $id)->first(),
        ];

        return view('pajak/edit_pajak', $data);
    }

    public function update($enc_id)
    {
        $id = decode_id($enc_id);

        $tanggal_stnk = $this->request->getVar('tanggal_stnk');
        $tanggal_tnkb = $this->request->getVar('tanggal_tnkb');

        $today = date('Y-m-d');
        $currentYear = date('Y');

        $status = 'Sudah Terbayar';

        // Jika salah satu tanggal < hari ini => sudah lewat jatuh tempo
        if (
            $tanggal_stnk < $today ||
            $tanggal_tnkb < $today
        ) {
            $status = 'Sudah Melewati Jatuh Tempo';

            // Jika salah satu tanggal = hari ini
        } elseif (
            $tanggal_stnk == $today ||
            $tanggal_tnkb == $today
        ) {
            $status = 'Jatuh Tempo';

            // Jika tahun tanggal pajak lebih kecil dari tahun sekarang → dianggap sudah bayar
        } elseif (
            date('Y', strtotime($tanggal_stnk)) < $currentYear ||
            date('Y', strtotime($tanggal_tnkb)) < $currentYear
        ) {
            $status = 'Sudah Terbayar';
        } else {
            // Cek 1 bulan sebelum jatuh tempo
            $stnk_minus_1_month = date('Y-m-d', strtotime('-1 month', strtotime($tanggal_stnk)));
            $tnkb_minus_1_month = date('Y-m-d', strtotime('-1 month', strtotime($tanggal_tnkb)));

            if (
                $today >= $stnk_minus_1_month ||
                $today >= $tnkb_minus_1_month
            ) {
                $status = 'Akan Jatuh Tempo';
            }
        }

        // simpan
        $data = [
            'id_kendaraan' => $this->request->getVar('id_kendaraan'),
            'tanggal_stnk' => $tanggal_stnk,
            'tanggal_tnkb' => $tanggal_tnkb,
            'status_pajak' => $status,
            'keterangan_pajak' => $this->request->getVar('keterangan'),
        ];

        $this->pajakModel->update($id, $data);

        return redirect()->to(base_url('pajak_kendaraan'))->with('success', 'Data pajak kendaraan berhasil diupdate');
    }

    public function ajaxDetailPajak()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $data = $this->pajakModel->getKendaraanWithDataPajak();

        $hasil = [];

        foreach ($data as $row) {

            $tgl_stnk = $row['tanggal_stnk'];
            $tgl_tnkb = $row['tanggal_tnkb'];

            $bulan_stnk = date('m', strtotime($tgl_stnk));
            $tahun_stnk = date('Y', strtotime($tgl_stnk));

            $bulan_tnkb = date('m', strtotime($tgl_tnkb));
            $tahun_tnkb = date('Y', strtotime($tgl_tnkb));

            // 🔹 JIKA TANGGAL STNK == TNKB → CEK STNK SAJA
            if ($tgl_stnk == $tgl_tnkb) {
                if ($bulan_stnk == $bulan && $tahun_stnk == $tahun) {
                    $hasil[] = $row;
                }
            }
            // 🔹 JIKA BERBEDA → CEK KEDUANYA (TAPI TIDAK DOBEL)
            else {
                if ($bulan_stnk == $bulan && $tahun_stnk == $tahun) {
                    $hasil[] = $row;
                } else if ($bulan_tnkb == $bulan && $tahun_tnkb == $tahun) {
                    $hasil[] = $row;
                }
            }
        }

        return view('pajak/ajax_detail_pajak', [
            'data' => $hasil,
            'nama_bulan' => $bulan
        ]);
    }
}
