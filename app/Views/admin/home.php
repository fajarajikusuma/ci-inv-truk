<?= $this->extend('dashboard/main') ?>
<?= $this->section('content') ?>

<div class="page-heading">
    <h3><?= $title ?></h3>
</div>

<section class="section">

    <!-- =======================
         CARD STATISTIK
    ======================== -->
    <div class="row">
        <?= cardStats('Total Kendaraan', $total_kendaraan, 'bi bi-truck', 'primary') ?>
        <?= cardStats('Total Supir', $total_supir, 'bi bi-people', 'success') ?>
        <?= cardStats('Total User', $total_user, 'bi bi-person-badge', 'warning') ?>
        <?= cardStats('Jatuh Tempo Pajak', $jatuh_tempo, 'bi bi-exclamation-circle', 'danger') ?>
    </div>

    <div class="row mt-4">
        <!-- =======================
             Grafik Pemeliharaan
        ======================== -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Kendaraan Sering Pemeliharaan (TOP 10)</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafikPemeliharaan"></canvas>
                </div>
            </div>
        </div>

        <!-- =======================
             Grafik Pajak Terbayar
        ======================== -->
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    <h5>Kendaraan Sudah Terbayar Pajak</h5>
                </div>
                <div class="card-body">
                    <canvas id="grafikPajak"></canvas>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- =======================
     SCRIPT CHART.JS
======================= -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const pemeliharaanLabels = [
        <?php foreach ($grafik_pemeliharaan as $row): ?> "<?= getNopolById($row['id_kendaraan']) ?>",
        <?php endforeach; ?>
    ];

    const pemeliharaanData = [
        <?php foreach ($grafik_pemeliharaan as $row): ?>
            <?= $row['total'] ?>,
        <?php endforeach; ?>
    ];

    new Chart(document.getElementById('grafikPemeliharaan'), {
        type: 'bar',
        data: {
            labels: pemeliharaanLabels,
            datasets: [{
                label: 'Jumlah Pemeliharaan',
                data: pemeliharaanData,
                backgroundColor: 'rgba(54, 162, 235)',
            }]
        }
    });
</script>

<script>
    const pajakLabels = [
        <?php foreach ($grafik_pajak as $row): ?> "<?= namaBulan($row['bulan']) ?>",
        <?php endforeach; ?>
    ];

    const pajakData = [
        <?php foreach ($grafik_pajak as $row): ?>
            <?= $row['total'] ?>,
        <?php endforeach; ?>
    ];

    new Chart(document.getElementById('grafikPajak'), {
        type: 'line',
        data: {
            labels: pajakLabels,
            datasets: [{
                label: 'Pajak Sudah Terbayar',
                data: pajakData,
                fill: false,
                borderColor: 'rgba(255, 99, 132)',
                tension: 0.3
            }]
        }
    });
</script>

<?= $this->endSection() ?>