<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Detail Data Kendaraan</h3>
</div>

<section class="section">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0">Informasi Lengkap Kendaraan</h4>
            <a href="<?= base_url('kendaraan') ?>" class="btn btn-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="card-body">
            <div class="row">
                <!-- Foto Kendaraan -->
                <div class="col-md-4 text-center mb-3">
                    <?php if (!empty($kendaraan['foto_kendaraan']) && file_exists('uploads/kendaraan/' . $kendaraan['foto_kendaraan'])) : ?>
                        <img src="<?= base_url('uploads/kendaraan/' . $kendaraan['foto_kendaraan']) ?>" alt="Foto Kendaraan"
                            class="img-fluid rounded shadow-sm border p-2" style="max-height: 250px;">
                    <?php else : ?>
                        <img src="<?= base_url('uploads/kendaraan/default_truck.jpg') ?>" alt="Foto Kendaraan Default"
                            class="img-fluid rounded shadow-sm border" style="max-height: 250px;">
                    <?php endif; ?>
                    <p class="mt-2 text-muted small">Foto Kendaraan</p>
                </div>

                <!-- Detail Informasi -->
                <div class="col-md-8 table-responsive">
                    <table class="table table-borderless table-striped">
                        <tbody>
                            <tr>
                                <th width="35%">Nomor Polisi</th>
                                <td><?= esc($kendaraan['nopol']) ?></td>
                            </tr>
                            <tr>
                                <th>Jenis Kendaraan</th>
                                <td><?= esc($kendaraan['jenis_kendaraan']) ?></td>
                            </tr>
                            <tr>
                                <th>Merk</th>
                                <td><?= esc($kendaraan['merk']) ?></td>
                            </tr>
                            <tr>
                                <th>Tipe</th>
                                <td><?= esc($kendaraan['tipe']) ?></td>
                            </tr>
                            <tr>
                                <th>Tahun Pembuatan</th>
                                <td><?= esc($kendaraan['tahun_pembuatan']) ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Mesin</th>
                                <td><?= esc($kendaraan['no_mesin']) ?></td>
                            </tr>
                            <tr>
                                <th>Nomor Rangka</th>
                                <td><?= esc($kendaraan['no_rangka']) ?></td>
                            </tr>
                            <tr>
                                <th>Sopir</th>
                                <td><?= esc($kendaraan['nama_sopir']) ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <?php if ($kendaraan['status'] == 'aktif') : ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else : ?>
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>