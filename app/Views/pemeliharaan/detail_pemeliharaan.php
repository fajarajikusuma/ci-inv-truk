<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

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
        <div class="card-body table-responsive">
            <table class="table table-bordered mt-4">
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
                    <td><?= esc($kendaraan['status']); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Riwayat Pemeliharaan</h5>
            <a href="<?= base_url('pemeliharaan/tambah/' . $enc_id); ?>" class="btn btn-success btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Pemeliharaan
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped " id="table-riwayat">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Keluhan</th>
                        <th>Tindakan Perbaikan</th>
                        <th>Bengkel</th>
                        <th>Biaya</th>
                        <th>Dibuat Oleh</th>
                        <th>Aksi</th>
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
                                <td><?= esc($row['nama_user']); ?></td>
                                <td>
                                    <a href="<?= base_url('pemeliharaan/edit/' . $row['enc_id_pemeliharaan']); ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= base_url('pemeliharaan/hapus/' . $row['enc_id_pemeliharaan']); ?>"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
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