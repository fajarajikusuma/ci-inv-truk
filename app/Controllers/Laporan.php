<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use \PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function __construct()
    {
        $this->pemeliharaanModel = new \App\Models\PemeliharaanModel();
        $this->kendaraanModel = new \App\Models\KendaraanModel();
        $this->sopirModel = new \App\Models\SopirModel();
        helper(['id_helper', 'barcode', 'qrcode']);
    }

    public function index()
    {
        $data['title'] = 'Laporan Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaan();
        $data['tahun'] = null;
        $data['bulan'] = null;

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        $data['pemeliharaan'] = array_filter($data['pemeliharaan'], function ($p) {
            return $p['source'] == 'operator_pemeliharaan';
        });

        return view('laporan/laporan', $data);
    }

    public function filter()
    {
        $tahun = $this->request->getGet('tahun');
        $bulan = $this->request->getGet('bulan');

        if (!$tahun || !$bulan) {
            return redirect()->to(base_url('laporan'))->with('error', 'Mohon pilih tahun dan bulan');
        }

        $data['title'] = 'Laporan Pemeliharaan Kendaraan';
        $data['pemeliharaan'] = $this->pemeliharaanModel->getKendaraanWithTotalPemeliharaanByTahunBulan($tahun, $bulan);
        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;

        foreach ($data['pemeliharaan'] as &$p) {
            $p['enc_id'] = encode_id($p['id_kendaraan']);
        }

        return view('laporan/laporan', $data);
    }

    public function export()
    {
        $tahun = $this->request->getGet('tahun');
        $bulan = $this->request->getGet('bulan');

        if (!$tahun || !$bulan) {
            return redirect()->to(base_url('laporan'))->with('error', 'Mohon pilih tahun dan bulan');
        }

        // jika tidak di temukan data pemeliharaan maka redirect kembali
        $pemeliharaanDataCheck = $this->pemeliharaanModel
            ->getKendaraanWithTotalPemeliharaanByTahunBulan($tahun, $bulan);

        if (empty($pemeliharaanDataCheck)) {
            return redirect()->to(base_url('laporan/filter?tahun=' . $tahun . '&bulan=' . $bulan))->with('error', 'Tidak ada data pemeliharaan untuk bulan ini');
        }

        // Jika bulan = all → ubah ke "Semua Bulan"
        $namaBulan = ($bulan === "all") ? "Semua Bulan" : $bulan;

        $filename = 'Laporan Pemeliharaan Bulan ' . $namaBulan . ' Tahun ' . $tahun . '.xlsx';

        $pemeliharaanData = $this->pemeliharaanModel
            ->getKendaraanWithTotalPemeliharaanByTahunBulan($tahun, $bulan);

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // ============================================
        //              JUDUL & TANGGAL CETAK
        // ============================================

        $sheet->setCellValue('A1', 'LAPORAN PEMELIHARAAN KENDARAAN');
        $sheet->setCellValue('A2', 'Bulan: ' . $namaBulan . ' - Tahun: ' . $tahun);
        $sheet->setCellValue('A3', 'Tanggal Cetak: ' . date('d-m-Y'));

        // Merge judul
        $sheet->mergeCells('A1:H1');
        $sheet->mergeCells('A2:H2');
        $sheet->mergeCells('A3:H3');

        // Style judul
        $sheet->getStyle('A1:A3')->getFont()->setBold(true);
        $sheet->getStyle('A1:A3')->getAlignment()->setHorizontal('center');

        // ============================================
        //                HEADER TABEL
        // ============================================

        $startHeaderRow = 5;

        $headers = [
            'A' => 'No',
            'B' => 'No. Polisi',
            'C' => 'Jenis Kendaraan',
            'D' => 'Merk',
            'E' => 'Tipe',
            'F' => 'Tahun Pembuatan',
            'G' => 'Total Biaya Pemeliharaan',
            'H' => 'Nama Sopir',
        ];

        foreach ($headers as $col => $text) {
            $cell = $col . $startHeaderRow;

            $sheet->setCellValue($cell, $text);
            $sheet->getStyle($cell)->getFont()->setBold(true);
            $sheet->getStyle($cell)->getAlignment()->setHorizontal('center');
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // ============================================
        //                 ISI DATA
        // ============================================

        $rowNum = $startHeaderRow + 1;
        $no = 1;
        $totalKeseluruhan = 0;

        foreach ($pemeliharaanData as $row) {
            $totalKeseluruhan += (float)$row['total_biaya'];

            $sheet->setCellValue('A' . $rowNum, $no++);
            $sheet->setCellValue('B' . $rowNum, $row['nopol']);
            $sheet->setCellValue('C' . $rowNum, $row['jenis_kendaraan']);
            $sheet->setCellValue('D' . $rowNum, $row['merk']);
            $sheet->setCellValue('E' . $rowNum, $row['tipe']);
            $sheet->setCellValue('F' . $rowNum, $row['tahun_pembuatan']);
            $sheet->setCellValue('G' . $rowNum, $row['total_biaya']);
            $sheet->setCellValue('H' . $rowNum, $row['nama_sopir']);

            // Nomor dibuat rata tengah
            $sheet->getStyle('A' . $rowNum)->getAlignment()->setHorizontal('center');

            $rowNum++;
        }

        // ============================================
        //            TOTAL BIAYA KESELURUHAN
        // ============================================

        $sheet->setCellValue('F' . $rowNum, 'TOTAL KESELURUHAN');
        $sheet->setCellValue('G' . $rowNum, $totalKeseluruhan);

        $sheet->getStyle('F' . $rowNum . ':G' . $rowNum)->getFont()->setBold(true);
        $sheet->getStyle('F' . $rowNum)->getAlignment()->setHorizontal('right');

        // ============================================
        //                  BORDER
        // ============================================

        $borderRange = 'A' . $startHeaderRow . ':H' . $rowNum;
        $sheet->getStyle($borderRange)->getBorders()->getAllBorders()->setBorderStyle(
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        );

        // ============================================
        //                EXPORT FILE
        // ============================================

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
