<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3>Tambah Data Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Tambah Kendaraan</h4>
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
            <form action="<?= base_url('kendaraan/simpan') ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nopol" class="form-label">Nomor Polisi</label>
                        <input type="text" class="form-control" id="nopol" name="nopol" placeholder="Contoh: G 1234 AB" required value="<?= old('nopol') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="jenis" class="form-label">Jenis Kendaraan</label>
                        <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Contoh: Dump Truk, Amp Roll, dll" required value="<?= old('jenis') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="merk" class="form-label">Merk</label>
                        <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: Hino, Isuzu, Mitsubishi" required value="<?= old('merk') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tipe" class="form-label">Tipe</label>
                        <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Contoh: Ranger 130 PS, ELF NKR, dll" required value="<?= old('tipe') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tahun" class="form-label">Tahun Pembuatan</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2020" min="1990" max="<?= date('Y') ?>" required value="<?= old('tahun') ?>">
                    </div>

                    <!-- no rangka dan no mesin -->
                    <div class="col-md-6 mb-3">
                        <label for="nomor_rangka" class="form-label">Nomor Rangka</label>
                        <input type="text" class="form-control" id="nomor_rangka" name="no_rangka" placeholder="Masukkan Nomor Rangka" required value="<?= old('no_rangka') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="nomor_mesin" class="form-label">Nomor Mesin</label>
                        <input type="text" class="form-control" id="nomor_mesin" name="no_mesin" placeholder="Masukkan Nomor Mesin" required value="<?= old('no_mesin') ?>">
                    </div>

                    <!-- sopir -->
                    <div class="col-md-6 mb-3">
                        <label for="sopir" class="form-label">Sopir</label>
                        <select name="sopir" id="sopir" class="form-select" required>
                            <option value="">-- Pilih Sopir --</option>
                            <?php foreach ($sopirList as $sopir): ?>
                                <?php if ($sopir['status_sopir'] == 'aktif') : ?>
                                    <option value="<?= $sopir['id_sopir'] ?>" <?= old('sopir', $data['id_sopir'] ?? '') == $sopir['id_sopir'] ? 'selected' : '' ?>>
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
                            <option value="aktif" <?= old('status', $data['status'] ?? '') == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="tidak aktif" <?= old('status', $data['status'] ?? '') == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </div>

                    <!-- foto kendaraan dan preview js -->
                    <div class="col-md-6 mb-3">
                        <label for="foto" class="form-label">Foto Kendaraan</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" value="<?= old('foto') ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="preview_foto" class="form-label">Preview Foto</label>
                        <img id="preview_foto" src="" alt="Preview Foto" class="img-thumbnail form-control" style="max-width: 200px; height: auto;">
                    </div>

                </div>


                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('kendaraan') ?>" class="btn btn-secondary me-2">
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
    // --- Format otomatis plat nomor ---
    document.addEventListener('DOMContentLoaded', function() {
        const nopolInput = document.getElementById('nopol');

        nopolInput.addEventListener('input', function(e) {
            let val = e.target.value.toUpperCase(); // ubah huruf besar semua
            val = val.replace(/[^A-Z0-9]/g, ''); // hilangkan karakter selain huruf & angka

            // Format umum: huruf - spasi - angka - spasi - huruf/huruf
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

    // setiap menulis di semua inputan huruf pertama akan otomatis menjadi kapital dan setiap kata dipisah spasi langsung kapital
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[type="text"]');

        inputs.forEach(function(input) {
            input.addEventListener('input', function(e) {
                let val = e.target.value;
                val = val.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
                e.target.value = val;
            });
        });
    });

    // preview foto kendaraan sebelum diupload
    document.getElementById('foto').addEventListener('change', function(event) {
        const preview = document.getElementById('preview_foto');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
        }
    });
</script>

<?= $this->endSection() ?>