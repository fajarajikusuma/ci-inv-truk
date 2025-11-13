<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Edit Data Sopir</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Sopir</h4>
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
            <form action="<?= base_url('sopir/update/' . $enc_id) ?>" method="post">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_sopir" class="form-label">Nama Sopir</label>
                        <input type="text" name="nama_sopir" id="nama_sopir" class="form-control"
                            value="<?= esc($sopir['nama_sopir']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control"
                            value="<?= esc($sopir['no_hp']) ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="Aktif" <?= $sopir['status_sopir'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Nonaktif" <?= $sopir['status_sopir'] == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('sopir') ?>" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    // --- Kapitalisasi otomatis untuk nama sopir dan hanya huruf pertama kapital ---
    document.addEventListener('DOMContentLoaded', function() {
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
        const noHpInput = document.getElementById('no_hp');
        if (noHpInput) {
            noHpInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/[^0-9]/g, '');
            });
        }
    });
</script>

<?= $this->endSection() ?>