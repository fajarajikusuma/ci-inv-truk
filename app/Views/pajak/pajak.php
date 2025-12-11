<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading mb-0">
    <h3>Data Pajak Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('pajak_kendaraan') ?>" method="GET">
                <div class="row align-items-end">

                    <div class="col-md-8 mt-3 mt-md-0">
                        <div class="form-group mb-0">
                            <label for="tahun">Tahun</label>
                            <input type="text" class="form-control" id="tahun" name="tahun" value="<?= $tahun ?? ''; ?>" placeholder="Masukan Tahun">
                        </div>
                    </div>

                    <div class="col-md-4 d-flex align-items-end mt-3 mt-md-0 gap-2">
                        <button type="submit" class="btn btn-primary w-100 mt-3">
                            Filter
                        </button>
                        <a href="<?= base_url('pajak_kendaraan'); ?>" class="btn btn-success w-100 mt-3">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Alert -->
    <div class="mb-4">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Data Pajak Kendaraan Tahun <?= $tahun ?></h4>
            <span style="font-size: 14px;">Total Kendaraan yang Harus Bayar Pajak Tahun <?= $tahun ?>: <?= $total_kendaraan ?> Kendaraan</span>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th style="width: 200px;">Bulan</th>
                        <th style="width: 150px;">Total</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($data_bulanan as $key => $item): ?>
                        <tr>
                            <td><?= $item['nama_bulan'] ?></td>
                            <td><?= $item['total'] ?></td>
                            <td class="text-center">
                                <?php if ($item['total'] > 0): ?>
                                    <button class="btn btn-primary btn-sm btn-lihat-pajak"
                                        data-bulan="<?= $key ?>"
                                        data-tahun="<?= $tahun == NULL ? date('Y') : $tahun ?>"
                                        data-nama="<?= $item['nama_bulan'] ?>">
                                        Lihat
                                    </button>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Tabel Pajak Kendaraan</h4>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped" id="table-pajak">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Polisi</th>
                        <th>Jenis Kendaraan</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Tahun Pembuatan</th>
                        <th>Tanggal STNK</th>
                        <th>Tanggal TNKB</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pajak)) : ?>
                        <?php $no = 1;
                        foreach ($pajak as $row) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= esc($row['nopol']); ?></td>
                                <td><?= esc($row['jenis_kendaraan']); ?></td>
                                <td><?= esc($row['merk']); ?></td>
                                <td><?= esc($row['tipe']); ?></td>
                                <td><?= esc($row['tahun_pembuatan']); ?></td>
                                <td><?= esc($row['tanggal_stnk']) ? date('d-m-Y', strtotime($row['tanggal_stnk'])) : '-'; ?></td>
                                <td><?= esc($row['tanggal_tnkb']) ? date('d-m-Y', strtotime($row['tanggal_tnkb'])) : '-'; ?></td>
                                <td><?= esc($row['keterangan']) ?: '-'; ?></td>
                                <td><?= esc($row['status']) ?: '-'; ?></td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        <?php if (esc($row['tanggal_stnk']) == '' && esc($row['tanggal_tnkb']) == '') : ?>
                                            <a href="<?= base_url('pajak_kendaraan/tambah/' . $row['enc_id']); ?>" class="btn btn-sm btn-primary">
                                                <i class="bi bi-plus-square"></i> Tambah
                                            </a>
                                        <?php else : ?>
                                            <a href="<?= base_url('pajak_kendaraan/edit/' . $row['enc_id']); ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-square"></i> Edit
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

<!-- Modal Pajak -->
<div class="modal fade" id="modalPajak" tabindex="-1" aria-labelledby="modalPajakLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPajakLabel">Detail Pajak Kendaraan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div id="modal-content-pajak">Memuat data...</div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.btn-lihat-pajak', function() {

        const bulan = $(this).data('bulan');
        const tahun = $(this).data('tahun');
        const nama_bulan = $(this).data('nama');

        $('#modalPajakLabel').text('Detail Pajak Kendaraan Bulan ' + nama_bulan + ' Tahun ' + tahun);
        $('#modal-content-pajak').html('Memuat data...');

        $.ajax({
            url: "<?= site_url('pajak_kendaraan/ajax_detail_pajak') ?>",
            method: "GET",
            data: {
                bulan,
                tahun
            },
            success: function(response) {
                $('#modal-content-pajak').html(response);
            },
            error: function() {
                $('#modal-content-pajak').html('<p class="text-danger">Gagal memuat data.</p>');
            }
        });

        $('#modalPajak').modal('show');
    });
</script>


<?= $this->endSection(); ?>