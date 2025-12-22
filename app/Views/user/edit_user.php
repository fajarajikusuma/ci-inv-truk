<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Edit Data User</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit User</h4>
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
            <form action="<?= base_url('user/update/' . $enc_id) ?>" method="post">
                <div class="row">

                    <!-- nama -->
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama"
                            placeholder="Masukkan Nama Lengkap" required value="<?= old('nama', $user['nama']) ?>">
                    </div>

                    <!-- username -->
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Masukkan Username" required value="<?= old('username', $user['username']) ?>" readonly>
                        <small class="text-muted">Username tidak dapat diubah.</small>
                    </div>

                    <!-- password -->
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password (opsional)</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah password">
                    </div>

                    <!-- role -->
                    <div class="col-md-6 mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="operator_pemeliharaan" <?= old('role', $user['role']) == 'operator_pemeliharaan' ? 'selected' : '' ?>>Operator Pemeliharaan</option>
                            <option value="operator_pajak" <?= old('role', $user['role']) == 'operator_pajak' ? 'selected' : '' ?>>Operator Pajak</option>
                            <option disabled value="kasubag_umpeg" <?= old('role', $user['role']) == 'kasubag_umpeg' ? 'selected' : '' ?>>Kasubag Umpeg</option>
                            <option disabled value="sekdin" <?= old('role', $user['role']) == 'sekdin' ? 'selected' : '' ?>>Sekdin</option>
                            <option disabled value="kepala_dinas" <?= old('role', $user['role']) == 'kepala_dinas' ? 'selected' : '' ?>>Kepala Dinas</option>
                        </select>
                    </div>

                    <!-- status -->
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" <?= old('status', $user['status']) == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="nonaktif" <?= old('status', $user['status']) == 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>

                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('user') ?>" class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
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
</script>

<?= $this->endSection() ?>