<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Tambah Data Sopir</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Sopir</h4>
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
            <form action="<?= base_url('sopir/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label for="nama_sopir" class="form-label">Nama Sopir</label>
                        <input type="text" class="form-control" id="nama_sopir" name="nama_sopir" placeholder="Masukkan nama sopir" required value="<?= old('nama_sopir') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" required value="<?= old('no_hp') ?>" minlength="10" maxlength="15">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" <?= old('status_sopir') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= old('status_sopir') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                    <!-- <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto Sopir (Opsional)</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" value="">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="preview_foto" class="form-label">Preview Foto</label>
                        <img id="preview_foto" src="" alt="Preview Foto" class="img-thumbnail form-control" style="max-width: 200px; height: auto;">
                    </div> -->

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('sopir') ?>" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Kapitalisasi otomatis untuk nama sopir ---
        const namaInput = document.getElementById('nama_sopir');
        if (namaInput) {
            namaInput.addEventListener('input', function(e) {
                let words = e.target.value.toLowerCase().split(' ');
                for (let i = 0; i < words.length; i++) {
                    if (words[i].length > 0) {
                        words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                    }
                }
                e.target.value = words.join(' ');
            });
        }

        // --- Validasi nomor HP hanya angka ---
        const hpInput = document.getElementById('no_hp');
        if (hpInput) {
            hpInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        }
    });
</script>


<?= $this->endSection() ?>