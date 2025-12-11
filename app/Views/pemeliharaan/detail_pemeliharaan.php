<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<style>
    .header-responsive {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Mobile: ubah jadi vertikal */
    @media (max-width: 768px) {
        .header-responsive {
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .header-actions {
            flex-direction: column !important;
            align-items: center !important;
            width: 100%;
            gap: 10px;
        }
    }
</style>

<div class="page-heading mb-3">
    <div class="d-flex justify-content-between">
        <h3>Detail Riwayat Pemeliharaan Kendaraan</h3>
        <a href="<?= base_url('pemeliharaan'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </a>
    </div>
</div>

<section class="section">
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">Data Kendaraan</h5>
        </div>
        <div class="card-body p-4">
            <div class="row">
                <!-- Kolom Tabel -->
                <div class="col-lg-8 col-md-7 col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered mt-3">
                            <tr>
                                <th width="200">Nomor Polisi</th>
                                <td><?= esc($kendaraan['nopol']); ?></td>
                            </tr>
                            <tr>
                                <th>Merk</th>
                                <td><?= esc($kendaraan['merk']); ?></td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <td><?= esc($kendaraan['tipe']); ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kendaraan</th>
                                <td><?= esc($kendaraan['jenis_kendaraan']); ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Pembuatan</th>
                                <td><?= esc($kendaraan['tahun_pembuatan']); ?></td>
                            </tr>
                            <tr>
                                <th>No. Mesin</th>
                                <td><?= esc($kendaraan['no_mesin']); ?></td>
                            </tr>
                            <tr>
                                <th>No. Rangka</th>
                                <td><?= esc($kendaraan['no_rangka']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Kolom QR Code -->
                <div class="col-lg-4 col-md-5 col-12 mt-3">
                    <div class="card mt-3 mt-md-0 text-center">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">QR Code Kendaraan</h5>
                        </div>
                        <div class="card-body border border-secondary rounded-bottom-4 d-flex justify-content-center align-items-center p-3" style="min-height: 200px;">
                            <img src="<?= $qrcode ?>" alt="QR Code Kendaraan" class="img-fluid" style="max-width: 150px;">
                        </div>
                    </div>
                </div>
            </div>
            <!-- cetak qr code -->
            <a href="<?= base_url('pemeliharaan/cetak_qrcode/' . $enc_id); ?>" class="btn btn-primary btn-sm mt-3">
                <i class="bi bi-printer"></i> Cetak QR Code
            </a>
        </div>
    </div>


    <div class="card mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Data Sopir</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered mt-4">
                <tr>
                    <th width="200">Nama Sopir</th>
                    <td><?= esc($kendaraan['nama_sopir']); ?></td>
                </tr>
                <tr>
                    <th>No. Telepon</th>
                    <td><?= esc($kendaraan['no_hp']); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= esc($kendaraan['status_sopir']); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-light header-responsive mb-4">

            <h5 class="mb-0">Riwayat Pemeliharaan</h5>

            <div class="d-flex align-items-center gap-2 header-actions" style="overflow-x: auto;">
                <form action="<?= base_url('pemeliharaan/detail/' . $enc_id); ?>" method="post">
                    <div class="input-group">
                        <button class="btn btn-primary" disabled>Filter</button>
                        <select name="tahun_filter" id="tahun" class="form-select" onchange="this.form.submit()">
                            <?php for ($i = date('Y'); $i >= date('Y') - 5; $i--) : ?>
                                <option value="<?= $i; ?>" <?= $tahun == $i ? 'selected' : ''; ?>><?= $i; ?></option>
                            <?php endfor; ?>
                            <option value="all" <?= $tahun == 'all' ? 'selected' : ''; ?>>Semua Tahun</option>
                        </select>
                    </div>
                </form>

                <a href="<?= base_url('pemeliharaan/tambah/' . $enc_id); ?>" class="btn btn-success">
                    <i class="bi bi-plus-circle"></i> Tambah Pemeliharaan
                </a>
            </div>

        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped" id="table-riwayat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Keluhan</th>
                        <th>Tindakan Perbaikan</th>
                        <th>Bengkel</th>
                        <th>Biaya</th>
                        <th>Nama Sopir</th>
                        <th>Nota</th>
                        <th>Dibuat Oleh</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pemeliharaan)) : ?>
                        <?php $no = 1;
                        foreach ($pemeliharaan as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_keluhan'])); ?></td>
                                <td><?= esc($row['tindakan_perbaikan']); ?></td>
                                <td><?= esc($row['bengkel']); ?></td>
                                <td>Rp <?= number_format($row['biaya'], 0, ',', '.'); ?></td>
                                <td><?= esc($row['nama_sopir']); ?></td>
                                <td>
                                    <?php if (!empty($row['nota'])) : ?>
                                        <a href="<?= base_url('assets/img/nota/' . $row['nota']); ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i> Lihat
                                        </a>
                                    <?php else : ?>
                                        <span class="text-danger">Tidak Ada Nota</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= esc($row['nama_user']); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <a href="<?= base_url('pemeliharaan/edit/' . $row['enc_id_pemeliharaan']); ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <a href="<?= base_url('pemeliharaan/hapus/' . $row['enc_id_pemeliharaan']); ?>"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>