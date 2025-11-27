<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading mb-3">
    <h3>Tambah Data Pemeliharaan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Input Pemeliharaan Kendaraan</h5>
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
            <form action="<?= base_url('pemeliharaan/simpan/' . $enc_id); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="row">
                    <!-- Nomor Polisi (dari link terenkripsi) -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control" value="<?= esc($kendaraan['nopol']); ?>" disabled>
                        <input type="hidden" name="id_kendaraan" value="<?= esc($kendaraan['id_kendaraan']); ?>">
                    </div>

                    <!-- Nama Sopir otomatis dari kendaraan -->
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
                        <input type="date" name="tanggal_keluhan" id="tanggal_keluhan" class="form-control" required>
                    </div>

                    <!-- Bengkel -->
                    <div class="col-md-6 mb-3">
                        <label for="bengkel" class="form-label">Nama Bengkel</label>
                        <input type="text" name="bengkel" id="bengkel" class="form-control" placeholder="Masukkan nama bengkel" required>
                    </div>
                </div>

                <!-- Tindakan Perbaikan -->
                <div class="mb-3">
                    <label for="tindakan_perbaikan" class="form-label">Tindakan Perbaikan</label>
                    <textarea name="tindakan_perbaikan" id="tindakan_perbaikan" class="form-control" rows="3" placeholder="Deskripsikan tindakan perbaikan yang dilakukan" required></textarea>
                </div>

                <!-- Biaya -->
                <div class="mb-3">
                    <label for="biaya" class="form-label">Biaya (Rp)</label>
                    <input type="text" name="biaya" id="biaya" class="form-control" placeholder="Contoh: 150000" required>
                </div>

                <!-- Nota -->
                <div class="mb-3">
                    <label for="nota" class="form-label">Upload Nota (Opsional)</label>
                    <input type="file" name="nota" id="nota" class="form-control">
                </div>

                <!-- Dibuat Oleh -->
                <div class="mb-3">
                    <label for="dibuat_oleh" class="form-label">Dibuat Oleh</label>
                    <input type="text" name="dibuat_oleh" id="dibuat_oleh" value="<?= session()->get('nama'); ?>" class="form-control" disabled>
                    <input type="hidden" name="id_user" value="<?= session()->get('id_user'); ?>">
                </div>

                <div class="d-flex justify-content-end mt-5">
                    <a href="<?= base_url('pemeliharaan/detail/' . $enc_id); ?>" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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

    function toTitleCase(str) {
        return str
            .toLowerCase()
            .replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
    }

    document.getElementById('bengkel').addEventListener('input', function(e) {
        e.target.value = toTitleCase(e.target.value);
    });

    document.getElementById('tindakan_perbaikan').addEventListener('input', function(e) {
        e.target.value = toTitleCase(e.target.value);
    });
</script>

<?= $this->endSection(); ?>