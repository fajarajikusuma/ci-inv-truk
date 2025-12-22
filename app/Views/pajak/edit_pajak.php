<?= $this->extend('dashboard/main'); ?>
<?= $this->section('content'); ?>

<div class="page-heading mb-3">
    <h3>Edit Pajak Kendaraan</h3>
</div>

<section class="section">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Form Edit Pajak Kendaraan</h5>
        </div>

        <?php if (session()->has('errors')): ?>
            <div class="m-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <strong>Terjadi kesalahan:</strong><br>
                    <?php foreach (session('errors') as $error): ?>
                        - <?= esc($error) ?><br>
                    <?php endforeach; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $page = session()->get('page');
        if ($page == 'edit_pajak') {
            $action = base_url('pajak_kendaraan/update/' . $enc_id_pajak);
        } else {
            $action = base_url('pajak_kendaraan/simpan/' . $enc_id_pajak);
        }
        ?>

        <div class="card-body">
            <form action="<?= $action; ?>" method="post">
                <?= csrf_field(); ?>

                <!-- Nomor Polisi -->
                <div class="mb-3">
                    <label class="form-label">Nomor Polisi</label>
                    <input type="hidden" class="form-control" value="<?= esc($kendaraan['id_kendaraan']); ?>" name="id_kendaraan">
                    <input type="text" class="form-control" value="<?= esc($kendaraan['nopol']); ?>" disabled>
                </div>

                <!-- Tanggal STNK -->
                <div class="mb-3">
                    <label class="form-label">Tanggal STNK</label>
                    <input
                        type="date"
                        name="tanggal_stnk"
                        class="form-control"
                        required
                        value="<?= session()->get('page') == 'tambah_pajak' ? old('tanggal_stnk') : $pajak['tanggal_stnk']; ?>">
                </div>

                <!-- Tanggal TNKB -->
                <div class="mb-3">
                    <label class="form-label">Tanggal TNKB</label>
                    <input
                        type="date"
                        name="tanggal_tnkb"
                        class="form-control"
                        required
                        value="<?= session()->get('page') == 'tambah_pajak' ? old('tanggal_tnkb') : $pajak['tanggal_tnkb']; ?>">
                </div>

                <!-- Keterangan -->
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input
                        type="text"
                        name="keterangan"
                        class="form-control"
                        placeholder="Masukan Keterangan"
                        value="<?= session()->get('page') == 'tambah_pajak' ? old('keterangan') : $pajak['keterangan_pajak']; ?>">
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('pajak_kendaraan'); ?>" class="btn btn-secondary me-2">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </div>

            </form>
        </div>
    </div>
</section>

<?= $this->endSection(); ?>