<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Kendaraan - V-MARS</title>

    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="dist/assets/compiled/css/iconly.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bs-body-bg);
        }

        /* Header Adaptif dengan Glassmorphism */
        .header-top {
            background: var(--bs-body-bg) !important;
            opacity: 0.95;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--bs-border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .brand-title {
            font-weight: 800;
            letter-spacing: -1px;
            color: #435ebe;
        }

        /* Card yang menyesuaikan warna border & shadow berdasarkan tema */
        .card {
            border: 1px solid var(--bs-border-color);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background-color: var(--bs-card-bg);
        }

        /* Label Info menggunakan warna muted yang adaptif */
        .info-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: var(--bs-secondary-color);
            font-weight: 700;
            margin-bottom: 2px;
            letter-spacing: 0.5px;
        }

        .info-value {
            font-size: 1rem;
            color: var(--bs-body-color);
            font-weight: 600;
            margin-bottom: 1.2rem;
        }

        /* Merapikan Search Box DataTables agar tidak nabrak di Dark Mode */
        .dataTables_filter input {
            background-color: var(--bs-body-bg) !important;
            color: var(--bs-body-color) !important;
            border: 1px solid var(--bs-border-color) !important;
            border-radius: 6px;
            padding: 4px 10px;
        }

        /* Styling Tombol Export */
        .dt-buttons {
            margin-bottom: 1rem;
        }

        .buttons-pdf {
            background-color: #eb3b5a !important;
            color: #fff !important;
            border: none !important;
            border-radius: 6px !important;
        }

        .buttons-excel {
            background-color: #20bf6b !important;
            color: #fff !important;
            border: none !important;
            border-radius: 6px !important;
        }

        /* Memastikan baris tabel kontras */
        .table {
            color: var(--bs-body-color) !important;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: rgba(var(--bs-primary-rgb), 0.05) !important;
        }
    </style>
</head>

<body>
    <script src="dist/assets/static/js/initTheme.js"></script>

    <div id="app">
        <div id="main" class="layout-horizontal">
            <header>
                <div class="header-top">
                    <div class="container d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="brand-title mb-0">V-MARS</h2>
                            <small class="text-muted fw-bold">Vehicle Maintenance & Recording System</small>
                        </div>
                        <div class="theme-toggle d-flex align-items-center gap-2">
                            <span class="badge bg-light-primary text-primary d-none d-md-inline-block px-3 py-2">Sistem Aktif</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-wrapper container py-4 mt-2">
                <div class="page-heading mb-4">
                    <div class="d-flex align-items-center">
                        <div class="iconly-boldInfo-Square me-3 text-primary" style="font-size: 2rem;"></div>
                        <div>
                            <h3 class="mb-0">Detail Pemeliharaan</h3>
                            <p class="text-muted mb-0">Informasi lengkap aset dan riwayat perbaikan</p>
                        </div>
                    </div>
                </div>

                <section class="section mt-4">
                    <div class="row">
                        <div class="col-lg-8 mb-3">
                            <div class="card mb-4 h-100 shadow-sm" style="border-top: 4px solid #435ebe !important;">
                                <div class="card-header d-flex align-items-center border-bottom py-3">
                                    <h5 class="mb-0"><i class="bi bi-truck me-2 text-primary"></i>Data Kendaraan</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-6 col-md-4">
                                            <div class="info-label">Nomor Polisi</div>
                                            <div class="info-value"><span class="badge bg-dark text-white p-2 px-3 shadow-sm"><?= esc($kendaraan['nopol']); ?></span></div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="info-label">Merk & Tipe</div>
                                            <div class="info-value"><?= esc($kendaraan['merk']); ?> - <?= esc($kendaraan['tipe']); ?></div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="info-label">Jenis</div>
                                            <div class="info-value"><?= esc($kendaraan['jenis_kendaraan']); ?></div>
                                        </div>
                                        <div class="col-6 col-md-4">
                                            <div class="info-label">Tahun</div>
                                            <div class="info-value"><?= esc($kendaraan['tahun_pembuatan']); ?></div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div class="info-label">No. Mesin / Rangka</div>
                                            <div class="info-value text-break text-primary small fw-bold">
                                                <?= esc($kendaraan['no_mesin']); ?> / <?= esc($kendaraan['no_rangka']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="card mb-4 h-100 shadow-sm" style="border-top: 4px solid #435ebe !important;">
                                <div class="card-header border-bottom py-3">
                                    <h5 class="mb-0 text-primary">
                                        <i class="bi bi-person-check me-2"></i>Penanggung Jawab
                                    </h5>
                                </div>
                                <div class="card-body p-4 text-md-start">
                                    <div class="info-label opacity-75">Nama Sopir</div>
                                    <div class="info-value text-primary fw-bold mb-3" style="font-size: 1.25rem;">
                                        <?= esc($kendaraan['nama_sopir']); ?>
                                    </div>

                                    <div class="info-label opacity-75">No. Telepon</div>
                                    <div class="info-value mb-3 text-muted">
                                        <i class="bi bi-telephone me-1"></i> <?= esc($kendaraan['no_hp']); ?>
                                    </div>

                                    <div class="info-label opacity-75">Status Unit</div>
                                    <div class="info-value mb-0">
                                        <span class="badge bg-light-success text-success px-3 py-2 fw-bold rounded-pill">
                                            <i class="bi bi-check2-circle me-1"></i> <?= esc(strtoupper($kendaraan['status_sopir'])); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center flex-wrap border-bottom py-3" style="border-top: 4px solid #435ebe !important;">
                            <h5 class="mb-2 mb-md-0"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Pemeliharaan</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="table-riwayat" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Tanggal</th>
                                            <th>Tindakan Perbaikan</th>
                                            <th>Bengkel</th>
                                            <th>Biaya (Rp)</th>
                                            <th>Petugas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($pemeliharaan)) : ?>
                                            <?php $no = 1;
                                            foreach ($pemeliharaan as $row) : ?>
                                                <tr>
                                                    <td class="text-center fw-bold"><?= $no++; ?></td>
                                                    <td class="text-nowrap"><i class="bi bi-calendar-event me-1 text-primary small"></i> <?= date('d M Y', strtotime($row['tanggal_keluhan'])); ?></td>
                                                    <td><?= esc($row['tindakan_perbaikan']); ?></td>
                                                    <td><span class="badge bg-light-secondary text-dark-50 small"><?= esc($row['bengkel']); ?></span></td>
                                                    <td class="fw-bold">Rp <?= number_format($row['biaya'], 0, ',', '.'); ?></td>
                                                    <td>
                                                        <div class="small fw-bold"><?= esc($row['nama_user']); ?></div>
                                                        <div class="text-muted" style="font-size: 0.7rem;">Sopir: <?= esc($row['nama_sopir']); ?></div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="container py-4">
                    <div class="footer d-flex flex-column flex-md-row align-items-center justify-content-md-between text-muted border-top pt-4 text-center text-md-start">
                        <div class="mb-2 mb-md-0">
                            <p class="mb-0">2026 &copy; <span class="fw-bold text-primary">V-MARS</span></p>
                        </div>
                        <div>
                            <p class="mb-0">Created with <i class="bi bi-heart-fill text-danger small"></i> by <a href="https://fajarajikusuma.vercel.app" class="text-primary fw-bold text-decoration-none">Fajar Aji Kusuma, S.Kom.</a></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/compiled/js/app.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#table-riwayat').DataTable({
                responsive: true,
                dom: '<"d-flex flex-column flex-md-row justify-content-between mb-4"Bf>rt<"d-flex flex-column flex-md-row justify-content-between mt-4"ip>',
                buttons: [{
                        extend: 'pdfHtml5',
                        text: '<i class="bi bi-file-earmark-pdf me-1"></i> Export PDF',
                        className: 'buttons-pdf shadow-sm',
                        title: 'Riwayat_V-MARS_<?= esc($kendaraan['nopol']); ?>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="bi bi-file-earmark-excel me-1"></i> Excel',
                        className: 'buttons-excel shadow-sm',
                        title: 'Riwayat_V-MARS_<?= esc($kendaraan['nopol']); ?>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Cari riwayat perbaikan...",
                }
            });
        });
    </script>
</body>

</html>