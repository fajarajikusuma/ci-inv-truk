<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Data User</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Tabel User</h4>
            <a href="<?= base_url('user/tambah') ?>" class="btn btn-primary btn-sm">
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
                <table class="table table-striped" id="tableUser">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($user)) : ?>
                            <?php $no = 1;
                            foreach ($user as $row) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= esc($row['nama']) ?></td>
                                    <td><?= esc($row['username']) ?></td>
                                    <td>
                                        <?php
                                        $badgeClass = match ($row['role']) {
                                            'admin' => 'bg-danger',
                                            'operator' => 'bg-primary',
                                            'kasubag_umpeg' => 'bg-warning text-dark',
                                            'sekdin' => 'bg-success',
                                            default => 'bg-secondary'
                                        };
                                        ?>
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= ucfirst(str_replace('_', ' ', $row['role'])) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge <?= $row['status'] == 'aktif' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= ucfirst($row['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-1">
                                            <!-- edit button -->
                                            <a href="<?= base_url('user/edit/' . $row['enc_id']) ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- delete button -->
                                            <a href="<?= base_url('user/hapus/' . $row['enc_id']) ?>" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus user <?= esc($row['nama']) ?>?')">
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