<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading">
    <h3>Data Pemeliharaan Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tabel Pemeliharaan Kendaraan</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped" id="table-pemeliharaan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Polisi</th>
                        <th>Jenis Kendaraan</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Tahun Pembuatan</th>
                        <th>Total Biaya Pemeliharaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pemeliharaan)) : ?>
                        <?php $no = 1;
                        foreach ($pemeliharaan as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($row['nopol']); ?></td>
                                <td><?= esc($row['jenis_kendaraan']); ?></td>
                                <td><?= esc($row['merk']); ?></td>
                                <td><?= esc($row['tipe']); ?></td>
                                <td><?= esc($row['tahun_pembuatan']); ?></td>
                                <td>Rp <?= number_format($row['total_biaya'], 0, ',', '.'); ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <?php if ($row['sopir_nonaktif']) : ?>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#danger"><i class="bi bi-x-circle"></i> Nonaktif</button>
                                        <?php else : ?>
                                            <a href="<?= base_url('pemeliharaan/detail/' . $row['enc_id']); ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-search"></i> Detail
                                            </a>
                                        <?php endif; ?>
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

<!-- modal nonaktif -->
<?php foreach ($pemeliharaan as $row) : ?>
    <div class="modal-danger me-1 mb-1 d-inline-block">
        <!--Danger theme Modal -->
        <div class="modal fade text-left" id="danger" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel120" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title white" id="myModalLabel120">
                            Konfirmasi Status Sopir
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Kendaraan dengan no. polisi <b><?= esc($row['nopol']); ?></b> tidak memiliki sopir aktif. Pastikan status sopir sudah diaktifkan / mengubah data sopir pada kendaraan agar dapat menambah data pemeliharaan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary"
                            data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>