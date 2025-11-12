<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Edit Data Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Edit Kendaraan</h4>
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
            <form action="<?= base_url('kendaraan/update/' . $enc_id) ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nopol" class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control" id="nopol" name="nopol"
                            value="<?= esc($kendaraan['nopol']) ?>" maxlength="10" required>
                        <small class="text-muted">Format otomatis: huruf besar dan spasi sesuai pola (contoh: G 1234 AB)</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="jenis" class="form-label">Jenis Kendaraan</label>
                        <input type="text" class="form-control" id="jenis" name="jenis"
                            value="<?= esc($kendaraan['jenis_kendaraan']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk"
                            value="<?= esc($kendaraan['merk']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <input type="text" class="form-control" id="tipe" name="tipe"
                            value="<?= esc($kendaraan['tipe']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tahun" class="form-label">Tahun Pembuatan</label>
                        <input type="number" class="form-control" id="tahun" name="tahun"
                            value="<?= esc($kendaraan['tahun_pembuatan']) ?>" min="1990" max="<?= date('Y') ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nomor_rangka" class="form-label">Nomor Rangka</label>
                        <input type="text" class="form-control" id="nomor_rangka" name="no_rangka"
                            value="<?= esc($kendaraan['no_rangka']) ?>" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nomor_mesin" class="form-label">Nomor Mesin</label>
                        <input type="text" class="form-control" id="nomor_mesin" name="no_mesin"
                            value="<?= esc($kendaraan['no_mesin']) ?>" required>
                    </div>

                    <!-- sopir -->
                    <div class="col-md-6 mb-3">
                        <label for="sopir" class="form-label">Sopir</label>
                        <select name="sopir" id="sopir" class="form-select" required>
                            <option value="">-- Pilih Sopir --</option>
                            <?php foreach ($sopirList as $sopir): ?>
                                <?php if ($sopir['status_sopir'] == 'aktif') : ?>
                                    <option value="<?= $sopir['id_sopir'] ?>" <?= old('sopir', $kendaraan['id_sopir'] ?? '') == $sopir['id_sopir'] ? 'selected' : '' ?>>
                                        <?= $sopir['nama_sopir'] ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="aktif" <?= ($kendaraan['status'] == 'aktif') ? 'selected' : '' ?>>Aktif</option>
                            <option value="tidak aktif" <?= ($kendaraan['status'] == 'tidak aktif') ? 'selected' : '' ?>>Tidak Aktif</option>
                            <option value="perbaikan" <?= ($kendaraan['status'] == 'perbaikan') ? 'selected' : '' ?>>Perbaikan</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto Kendaraan</label>
                        <input type="file" class="form-control mt-2" id="foto" name="foto">
                        <input type="hidden" name="existing_foto" value="<?= esc($kendaraan['foto_kendaraan']) ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="img-preview" class="form-label">Preview Kendaraan</label>
                        <div>
                            <?php if (!empty($kendaraan['foto_kendaraan']) && file_exists('uploads/kendaraan/' . $kendaraan['foto_kendaraan'])) : ?>
                                <img src="<?= base_url('uploads/kendaraan/' . $kendaraan['foto_kendaraan']) ?>" alt="Foto Kendaraan"
                                    class="img-fluid rounded shadow-sm border form-control mt-2 p-3" style="max-height: 150px; max-width: 200px;">
                            <?php else : ?>
                                <img src="<?= base_url('uploads/kendaraan/default_truck.jpg') ?>" alt="Foto Kendaraan Default"
                                    class="img-fluid rounded shadow-sm border form-control mt-2" style="max-height: 150px; max-width: 200px;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <a href="<?= base_url('kendaraan') ?>" class="btn btn-secondary me-2">
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
    // --- Format otomatis plat nomor (huruf besar dan pola umum) ---
    document.addEventListener('DOMContentLoaded', function() {
        const nopolInput = document.getElementById('nopol');

        nopolInput.addEventListener('input', function(e) {
            let val = e.target.value.toUpperCase(); // ubah semua huruf besar
            val = val.replace(/[^A-Z0-9]/g, ''); // hapus karakter selain huruf & angka

            // Format: huruf - spasi - angka - spasi - huruf/huruf
            if (val.length > 0) {
                let formatted = '';
                const lettersStart = val.match(/^[A-Z]+/);
                const numbers = val.match(/\d+/);
                const lettersEnd = val.slice((lettersStart?.[0]?.length || 0) + (numbers?.[0]?.length || 0));

                if (lettersStart) formatted += lettersStart[0];
                if (numbers) formatted += ' ' + numbers[0];
                if (lettersEnd) formatted += ' ' + lettersEnd;

                e.target.value = formatted.trim();
            }
        });
    });
</script>

<?= $this->endSection() ?>