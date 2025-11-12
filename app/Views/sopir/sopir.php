<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Data Sopir</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tabel Sopir</h4>
            <a href="<?= base_url('sopir/tambah') ?>" class="btn btn-primary btn-sm">
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
                <table class="table table-striped" id="tableSopir">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Sopir</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($sopir)) : ?>
                            <?php $no = 1;
                            foreach ($sopir as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama_sopir']) ?></td>
                                    <td><?= esc($row['no_hp']) ?></td>
                                    <td>
                                        <span class="badge <?= $row['status_sopir'] == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= ucfirst($row['status_sopir']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="<?= base_url('sopir/edit/' . $row['enc_id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= base_url('sopir/hapus/' . $row['enc_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data sopir <?= esc($row['nama_sopir']) ?>?')">
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