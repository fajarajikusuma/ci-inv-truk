<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading">
    <h3><?= $title; ?></h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('laporan/filter') ?>" method="get" onchange="submitForm()">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group mb-0">
                            <label for="tahun">Tahun</label>
                            <!-- select tahun -->
                            <select class="form-control" id="tahun" name="tahun">
                                <option value="" selected disabled>Pilih Tahun</option>
                                <?php for ($i = date('Y'); $i >= 2020; $i--) : ?>
                                    <option value="<?= $i; ?>" <?= $i == $tahun ? 'selected' : ''; ?>>
                                        <?= $i; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3 mt-md-0">
                        <div class="form-group mb-0">
                            <label for="bulan">Bulan</label>
                            <select class="form-control" id="bulan" name="bulan">
                                <option value="" selected disabled>Pilih Bulan</option>
                                <?php for ($i = 1; $i <= 12; $i++) : ?>
                                    <option value="<?= $i; ?>" <?= $i == $bulan ? 'selected' : ''; ?>>
                                        <?= $i; ?>
                                    </option>
                                <?php endfor; ?>
                                <option value="all" <?= $bulan == 'all' ? 'selected' : ''; ?>>
                                    Semua Bulan
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-end mt-3 mt-md-0 gap-2">
                        <?php
                        $request = \Config\Services::request();
                        $tahun = $request->getGet('tahun');
                        $bulan = $request->getGet('bulan');
                        ?>
                        <a href="<?= base_url('laporan/export?tahun=' . $tahun . '&bulan=' . $bulan); ?>" class="btn btn-warning w-100 mt-3">
                            Export
                        </a>
                        <a href="<?= base_url('laporan'); ?>" class="btn btn-success w-100 mt-3">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- alert -->
    <div class="mb-4">
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
                        <th>Nama Sopir</th>
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
                                <td><?= esc($row['nama_sopir']); ?></td>
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

<script>
    function submitForm() {
        if (document.getElementById('tahun').value !== '' && document.getElementById('bulan').value !== '') {
            document.forms[0].submit();
        }
    }
</script>
<?= $this->endSection(); ?>