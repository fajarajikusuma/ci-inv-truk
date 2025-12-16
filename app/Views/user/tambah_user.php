<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Tambah Data User</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah User</h4>
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
            <form action="<?= base_url('user/simpan') ?>" method="post">
                <div class="row">

                    <!-- nama -->
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama Lengkap" required value="<?= old('nama') ?>">
                    </div>

                    <!-- username -->
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Masukkan Username" required value="<?= old('username') ?>">
                    </div>

                    <!-- password -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan Password" required>
                    </div>

                    <!-- role -->
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" <?= old('role') == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="operator_pemeliharaan" <?= old('role') == 'operator_pemeliharaan' ? 'selected' : '' ?>>Operator Pemeliharaan</option>
                            <option value="operator_pajak" <?= old('role') == 'operator_pajak' ? 'selected' : '' ?>>Operator Pajak</option>
                            <option value="kasubag_umpeg" <?= old('role') == 'kasubag_umpeg' ? 'selected' : '' ?>>Kasubag Umpeg</option>
                            <option value="sekdin" <?= old('role') == 'sekdin' ? 'selected' : '' ?>>Sekdin</option>
                            <option value="kepala_dinas" <?= old('role') == 'kepala_dinas' ? 'selected' : '' ?>>Kepala Dinas</option>
                        </select>
                    </div>

                    <!-- status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" <?= old('status') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= old('status') == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('user') ?>" class="btn btn-secondary me-2">
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
    // --- Kapitalisasi otomatis untuk nama ---
    document.addEventListener('DOMContentLoaded', function() {
        const namaInput = document.getElementById('nama');
        if (namaInput) {
            namaInput.addEventListener('input', function(e) {
                let val = e.target.value;
                val = val.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
                e.target.value = val;
            });
        }
    });

    // --- Hapus spasi otomatis di username ---
    document.addEventListener('DOMContentLoaded', function() {
        const usernameInput = document.getElementById('username');
        if (usernameInput) {
            usernameInput.addEventListener('input', function(e) {
                e.target.value = e.target.value.replace(/\s/g, '').toLowerCase();
            });
        }
    });
</script>

<?= $this->endSection() ?>