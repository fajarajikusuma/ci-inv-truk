<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading mb-3">
    <h3>Edit Data Pemeliharaan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Pemeliharaan Kendaraan</h5>
        </div>
        <?php if (session()->has('errors')): ?>
            <div class="m-3">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan!</strong><br>
                    <?php foreach (session('errors') as $error): ?>
                        - <?= esc($error) ?><br>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <form action="<?= base_url('pemeliharaan/update/' . $enc_id_pemeliharaan); ?>" method="post">
                <?= csrf_field(); ?>

                <div class="row">
                    <!-- Nomor Polisi -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control" value="<?= esc($kendaraan['nopol']); ?>" disabled>
                        <input type="hidden" name="id_kendaraan" value="<?= esc($kendaraan['id_kendaraan']); ?>">
                    </div>

                    <!-- Nama Sopir -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sopir</label>
                        <input type="text" class="form-control" value="<?= esc($kendaraan['nama_sopir']); ?>" disabled>
                        <input type="hidden" name="id_sopir" value="<?= esc($kendaraan['id_sopir']); ?>">
                    </div>
                </div>

                <div class="row">
                    <!-- Tanggal Keluhan -->
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_keluhan" class="form-label">Tanggal Keluhan</label>
                        <input
                            type="date"
                            name="tanggal_keluhan"
                            id="tanggal_keluhan"
                            class="form-control"
                            required
                            value="<?= esc($pemeliharaan['tanggal_keluhan']); ?>">
                    </div>

                    <!-- Bengkel -->
                    <div class="col-md-6 mb-3">
                        <label for="bengkel" class="form-label">Nama Bengkel</label>
                        <input
                            type="text"
                            name="bengkel"
                            id="bengkel"
                            class="form-control"
                            placeholder="Masukkan nama bengkel"
                            value="<?= esc($pemeliharaan['bengkel']); ?>"
                            required>
                    </div>
                </div>

                <!-- Tindakan Perbaikan -->
                <div class="mb-3">
                    <label for="tindakan_perbaikan" class="form-label">Tindakan Perbaikan</label>
                    <textarea
                        name="tindakan_perbaikan"
                        id="tindakan_perbaikan"
                        class="form-control"
                        rows="3"
                        placeholder="Deskripsikan tindakan perbaikan yang dilakukan"
                        required><?= esc($pemeliharaan['tindakan_perbaikan']); ?></textarea>
                </div>

                <!-- Biaya -->
                <div class="mb-3">
                    <label for="biaya" class="form-label">Biaya (Rp)</label>
                    <input
                        type="text"
                        name="biaya"
                        id="biaya"
                        class="form-control"
                        placeholder="Contoh: 150000"
                        required
                        value="<?= number_format($pemeliharaan['biaya'], 0, ',', '.'); ?>">
                </div>

                <!-- Dibuat Oleh -->
                <div class="mb-3">
                    <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
                    <input type="text" class="form-control" value="<?= esc($user['nama']); ?>" disabled>
                    <input type="hidden" name="dibuat_oleh" value="<?= esc($user['id_user']); ?>">
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="<?= base_url('pemeliharaan/detail/' . $enc_id_kendaraan); ?>" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Script agar input biaya hanya angka -->
<script>
    document.getElementById('biaya').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
    });
</script>

<?= $this->endSection(); ?>