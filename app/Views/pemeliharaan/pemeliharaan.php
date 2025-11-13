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
                                    <a href="<?= base_url('pemeliharaan/detail/' . $row['enc_id']); ?>" class="btn btn-sm btn-primary">
                                        <i class="bi bi-search"></i> Detail
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