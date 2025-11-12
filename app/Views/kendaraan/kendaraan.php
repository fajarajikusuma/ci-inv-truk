<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Data Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tabel Kendaraan</h4>
            <a href="<?= base_url('kendaraan/tambah') ?>" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>

        <!-- alert -->
        <div class="m-3">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('success') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('error') ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" id="tableKendaraan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Polisi</th>
                            <th>Jenis Kendaraan</th>
                            <th>Merk</th>
                            <th>Tipe</th>
                            <th>Tahun Pembuatan</th>
                            <th>Sopir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kendaraan)) : ?>
                            <?php $no = 1;
                            foreach ($kendaraan as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nopol']) ?></td>
                                    <td><?= esc($row['jenis_kendaraan']) ?></td>
                                    <td><?= esc($row['merk']) ?></td>
                                    <td><?= esc($row['tipe']) ?></td>
                                    <td><?= esc($row['tahun_pembuatan']) ?></td>
                                    <td><?= esc($row['nama_sopir']) ?></td>
                                    <td>
                                        <span class="badge <?= $row['status'] == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= ucfirst($row['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <!-- detail button -->
                                            <a href="<?= base_url('kendaraan/detail/' . $row['enc_id']) ?>" class="btn btn-info btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <a href="<?= base_url('kendaraan/edit/' . $row['enc_id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('kendaraan/hapus/' . $row['enc_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data Kendaraan dengan Nopol <?= esc($row['nopol']) ?>?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>