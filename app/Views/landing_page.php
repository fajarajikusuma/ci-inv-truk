<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>V-MARS | Monitoring Armada DLH</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBg: '#0f172a',
                        darkCard: '#1e293b',
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: background-color 0.3s ease;
        }

        .glass {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        /* Style untuk link yang aktif */
        .nav-link-active {
            color: #16a34a !important;
            font-weight: 700;
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-darkBg text-slate-900 dark:text-slate-100 transition-colors duration-300">

    <nav class="sticky top-0 z-50 bg-white/70 dark:bg-darkBg/70 glass border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <div class="p-2 bg-green-600 rounded-lg shrink-0">
                        <i class="fas fa-truck-pickup text-white text-xl"></i>
                    </div>
                    <div class="flex flex-col min-w-0">
                        <span
                            class="text-lg font-bold tracking-tight text-slate-800 dark:text-white leading-none">V-MARS</span>
                        <span
                            class="text-[9px] text-green-600 dark:text-green-400 font-bold uppercase tracking-widest leading-tight break-words whitespace-normal mt-1">
                            Vehicle Maintenance and Recording System
                        </span>
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-6">
                    <div class="hidden md:flex space-x-8 text-sm font-semibold mr-4">
                        <a href="#home" class="nav-link transition dark:text-slate-300">Dashboard</a>
                        <a href="#about" class="nav-link transition dark:text-slate-300">Tentang Kami</a>
                        <a href="#contact" class="nav-link transition dark:text-slate-300">Kontak</a>
                    </div>

                    <button id="theme-toggle"
                        class="p-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-yellow-400 hover:ring-2 ring-green-500 transition-all">
                        <i id="theme-toggle-dark-icon" class="hidden fas fa-moon"></i>
                        <i id="theme-toggle-light-icon" class="hidden fas fa-sun"></i>
                    </button>

                    <?php if (!session()->get('id_user')): ?>
                        <a href="<?= base_url('login') ?>"
                            class="hidden md:block bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-green-200 dark:shadow-none transition">
                            Login
                        </a>
                    <?php else: ?>
                        <a href="<?= base_url('dashboard') ?>"
                            class="hidden md:block bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-green-200 dark:shadow-none transition">
                            Dashboard
                        </a>
                    <?php endif; ?>

                    <button id="mobile-menu-button"
                        class="md:hidden p-2.5 rounded-xl bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden md:hidden bg-white dark:bg-darkCard border-b border-slate-200 dark:border-slate-800 transition-all duration-300">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#home"
                    class="nav-link mobile-link block px-4 py-3 mt-5 rounded-xl bg-green-50 dark:bg-green-900/20 text-green-600 font-bold">Dashboard</a>
                <a href="#about"
                    class="nav-link mobile-link block px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 font-medium transition text-slate-600 dark:text-slate-300">Tentang
                    Kami</a>
                <a href="#contact"
                    class="nav-link mobile-link block px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 font-medium transition text-slate-600 dark:text-slate-300">Kontak</a>
                <hr class="border-slate-100 dark:border-slate-800 my-2">
                <?php if (!session()->get('id_user')): ?>
                    <a href="<?= base_url('login') ?>"
                        class="block px-4 py-3 rounded-xl bg-green-600 text-white font-bold text-center">Login</a>
                <?php else: ?>
                    <a href="<?= base_url('dashboard') ?>"
                        class="block px-4 py-3 rounded-xl bg-green-600 text-white font-bold text-center">Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <header id="home" class="pt-20 pb-8 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold mb-4 tracking-tight">
                Monitoring <span class="text-green-600">Real-Time</span> Armada
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-sm md:text-base">
                Sistem pengelolaan kendaraan operasional Dinas Lingkungan Hidup Kota Pekalongan. Pantau pajak,
                pemeliharaan, dan efisiensi driver dalam satu pintu.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 pb-5">
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 md:gap-6 mb-10">
            <?= renderStats('Total Kendaraan', $total_kendaraan, '', 'primary') ?>
            <?= renderStats('Total Supir', $total_supir, '', 'success') ?>
            <?= renderStats('Total User', $total_user, '', 'warning') ?>
            <?= renderStats('Jatuh Tempo Pajak', $jatuh_tempo, '', 'danger') ?>

            <div
                class="col-span-2 lg:col-span-1 bg-white dark:bg-darkCard p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-md transition flex flex-col items-center text-center">
                <div
                    class="w-12 h-12 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center mb-4">
                    <i class="fas fa-eye text-xl"></i>
                </div>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mb-1">Total Pengunjung</p>
                <h2 class="text-3xl font-black not-italic text-slate-800 dark:text-white">
                    <?= number_format($total_view, 0, ',', '.') ?>
                    <span class="text-xs font-normal opacity-50 not-italic ml-1">Orang</span>
                </h2>
                <div class="mt-3 flex items-center gap-2">
                    <span class="relative flex h-2 w-2 text-amber-500"><span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span><span
                            class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span></span>
                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tighter">Live Traffic</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6 mb-20">
            <div class="lg:col-span-2 bg-white dark:bg-darkCard p-4 md:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-lg">Intensitas Pemeliharaan <?= $tahun_pilih ?></h3>
                    <form action="" method="get">
                        <select name="tahun" onchange="this.form.submit()"
                            class="bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-xs font-bold p-2 outline-none ring-1 ring-slate-200 dark:ring-slate-700">
                            <?php for ($i = date('Y'); $i >= 2024; $i--): ?>
                                <option value="<?= $i ?>" <?= $tahun_pilih == $i ? 'selected' : '' ?>><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </form>
                </div>

                <div class="relative w-full h-[300px] md:h-[400px]">
                    <canvas id="chartPemeliharaanVertical"></canvas>
                </div>
            </div>

            <a href="<?= base_url('login') ?>"
                class="group bg-green-600 dark:bg-green-700 p-8 rounded-[2.5rem] text-white relative overflow-hidden shadow-xl shadow-green-200 dark:shadow-none transition-all hover:scale-[1.02] active:scale-95 flex flex-col min-h-[400px] lg:min-h-[450px]">
                <i class="fas fa-leaf absolute -right-10 -bottom-10 text-9xl opacity-20 rotate-12 transition-transform group-hover:rotate-45 duration-700"></i>

                <div class="relative z-10">
                    <h3 class="font-bold text-2xl mb-4">Status Pajak</h3>
                    <p class="text-green-100 text-sm md:text-base leading-relaxed mb-8 opacity-90">
                        Monitoring realisasi pembayaran pajak armada operasional Dinas Lingkungan Hidup Kota Pekalongan.
                    </p>
                </div>

                <div class="relative z-10 bg-white/10 p-6 md:p-8 rounded-3xl border border-white/20 backdrop-blur-md mb-8 flex-grow flex flex-col justify-center">
                    <div class="text-[10px] uppercase font-bold opacity-80 mb-2 tracking-[0.2em]">Sudah Terbayar</div>
                    <div class="flex items-baseline gap-2">
                        <span class="text-5xl md:text-6xl font-black tracking-tighter"><?= $sudah_bayar_pajak ?></span>
                        <span class="text-lg md:text-xl font-medium opacity-80 uppercase tracking-widest">Armada</span>
                    </div>
                </div>

                <div class="relative z-10 mt-auto">
                    <div class="w-full bg-white text-center text-green-700 font-extrabold py-4 rounded-2xl group-hover:bg-slate-50 transition-colors shadow-lg flex items-center justify-center gap-3">
                        <span>Detail Dokumen</span>
                        <i class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
                    </div>
                </div>
            </a>
        </div>

        <hr class="border-slate-200 dark:border-slate-800 mb-20">

        <section id="about" class="mb-24 py-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="<?= base_url('/assets/kendaraan_default/hero-truk.jpg') ?>"
                        class="w-full h-auto rounded-[2.5rem] lg:rounded-[2.5rem] shadow-2xl shadow-green-100 dark:shadow-none" alt="Waste Management">
                </div>
                <div class="order-1 lg:order-2">
                    <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                        <span class="w-2 h-10 bg-green-600 rounded-full"></span>
                        Tentang V-MARS
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6 italic">
                        "Mewujudkan Kota Pekalongan yang bersih melalui manajemen armada yang terintegrasi."
                    </p>
                    <p class="text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                        V-MARS (Vehicle Maintenance and Recording System) dikembangkan untuk mengoptimalkan operasional
                        Dinas Lingkungan Hidup dalam memelihara sarana kebersihan kota. Kami percaya transparansi data
                        adalah kunci efisiensi kerja lapangan.
                    </p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 text-sm font-medium"><i
                                class="fas fa-check-circle text-green-600"></i> Monitoring Perawatan Rutin Kendaraan
                        </li>
                        <li class="flex items-center gap-3 text-sm font-medium"><i
                                class="fas fa-check-circle text-green-600"></i> Pengawasan Pajak & STNK Tepat Waktu</li>
                        <li class="flex items-center gap-3 text-sm font-medium"><i
                                class="fas fa-check-circle text-green-600"></i> Efisiensi Manajemen Supir Lapangan</li>
                    </ul>
                </div>
            </div>
        </section>

        <hr class="border-slate-200 dark:border-slate-800 mb-20">

        <section id="contact" class="mb-20 py-10">
            <div
                class="bg-white dark:bg-darkCard rounded-[2.5rem] p-8 md:p-12 border border-slate-200 dark:border-slate-800 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-green-500/5 rounded-full -mr-32 -mt-32"></div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 relative z-10">

                    <div class="lg:col-span-1">
                        <h2 class="text-2xl font-bold mb-4 not-italic text-green-600">Hubungi Kami</h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-8">
                            Membutuhkan bantuan teknis atau informasi lebih lanjut? Silahkan hubungi kantor pusat kami.
                        </p>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4 text-sm">
                                <i class="fas fa-map-marker-alt mt-1 text-green-600"></i>
                                <span>Jl. Tentara Pelajar No.1, Kota Pekalongan, Jawa Tengah 51149</span>
                            </div>
                            <div class="flex items-center gap-4 text-sm">
                                <i class="fas fa-phone-alt text-green-600"></i>
                                <span>(0285) 421370</span>
                            </div>
                            <div class="flex items-center gap-4 text-sm">
                                <i class="fas fa-envelope text-green-600"></i>
                                <span class="break-all">dlhkotapekalongan@gmail.com</span>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-2">
                        <div
                            class="w-full h-[300px] lg:h-full min-h-[300px] rounded-3xl overflow-hidden border border-slate-200 dark:border-slate-700">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.56933873905714!2d109.67118587755013!3d-6.877492253077167!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7025c6a99b72d1%3A0xf4eae3bc16a73ec1!2sKantor%20Dinas%20Lingkungan%20Hidup!5e0!3m2!1sid!2sid!4v1767600305794!5m2!1sid!2sid"
                                class="w-full h-full border-0 dark:invert-[1] dark:hue-rotate-180" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="flex justify-center mt-2 mb-10">
            <button onclick="backToPortal()"
                class="group flex items-center gap-2 px-6 py-3 rounded-2xl bg-white dark:bg-darkCard border border-slate-200 dark:border-slate-800 text-slate-600 dark:text-slate-300 font-semibold text-sm transition-all hover:shadow-lg hover:shadow-green-500/10 hover:border-green-500 dark:hover:border-green-500">
                <i class="fas fa-arrow-left text-xs transition-transform group-hover:-translate-x-1"></i>
                <span>Kembali ke Portal Utama</span>
            </button>
        </div>
    </main>

    <!-- Floating Manual Book Button -->
    <!-- Floating Manual Book Button -->
    <button onclick="openManualModal()"
        id="manual-fab"
        class="fixed bottom-6 left-6 z-50 flex items-center justify-center
               bg-slate-800 dark:bg-slate-700
               text-white rounded-full shadow-2xl shadow-slate-400/30 dark:shadow-black/40
               cursor-pointer select-none"
        style="width: 3.5rem; height: 3.5rem; overflow: hidden; transition: width 0.4s cubic-bezier(0.4,0,0.2,1), background-color 0.3s ease, box-shadow 0.3s ease;"
        onmouseenter="expandManualBtn(this)"
        onmouseleave="collapseManualBtn(this)">
        <i class="fas fa-book-open text-lg shrink-0" style="min-width:1.25rem; margin-left: 0; transition: margin 0.4s cubic-bezier(0.4,0,0.2,1);"></i>
        <span id="manual-fab-label"
              class="whitespace-nowrap text-sm font-bold"
              style="opacity:0; max-width:0; overflow:hidden; margin-left:0; transition: opacity 0.25s ease 0.15s, max-width 0.4s cubic-bezier(0.4,0,0.2,1), margin-left 0.4s cubic-bezier(0.4,0,0.2,1);">
            Manual Book
        </span>
        <span id="manual-fab-dot" class="absolute -top-1 -right-1 w-4 h-4 bg-sky-400 rounded-full border-2 border-white dark:border-slate-700"
              style="transition: opacity 0.2s ease;"></span>
    </button>

    <!-- Modal Manual Book -->
    <div id="manual-modal"
         class="fixed inset-0 z-[999] flex items-center justify-center p-4 sm:p-6"
         style="opacity:0; pointer-events:none; transition: opacity 0.3s ease;">

        <!-- Backdrop -->
        <div id="manual-backdrop"
             onclick="closeManualModal()"
             class="absolute inset-0 bg-slate-900/70 dark:bg-black/80"
             style="backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px);"></div>

        <!-- Modal Container -->
        <div id="manual-modal-box"
             class="relative z-10 w-full flex flex-col bg-white dark:bg-darkCard rounded-[2rem] shadow-2xl shadow-black/30 overflow-hidden"
             style="max-width: 900px; max-height: calc(100vh - 3rem); transform: scale(0.95) translateY(16px); transition: transform 0.35s cubic-bezier(0.34,1.56,0.64,1);">

            <!-- Modal Header -->
            <div class="relative bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-700/50 px-6 py-5 flex items-center gap-4 shrink-0">
                <div class="absolute -top-8 -left-8 w-32 h-32 bg-green-500/5 dark:bg-white/5 rounded-full pointer-events-none"></div>
                <div class="absolute -bottom-6 right-16 w-24 h-24 bg-sky-500/5 dark:bg-sky-500/10 rounded-full pointer-events-none"></div>

                <div class="relative z-10 w-11 h-11 bg-sky-100 dark:bg-sky-500/20 border border-sky-200 dark:border-sky-400/30 rounded-2xl flex items-center justify-center shrink-0">
                    <i class="fas fa-book-open text-sky-600 dark:text-sky-400 text-base"></i>
                </div>

                <div class="relative z-10 flex-1 min-w-0">
                    <p class="text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-[0.2em]">Dokumentasi</p>
                    <h3 class="text-slate-900 dark:text-white font-black text-base leading-tight truncate">Manual Book V-MARS</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">Vehicle Maintenance and Recording System</p>
                </div>

                <div class="relative z-10 flex items-center gap-2 shrink-0">
                    <a href="https://dlh.pekalongankota.go.id//upload/file/file_20260519111201.pdf"
                       target="_blank"
                       title="Buka di tab baru"
                       class="w-9 h-9 bg-slate-100 dark:bg-white/10 hover:bg-sky-100 dark:hover:bg-sky-500/30 border border-slate-200 dark:border-white/10 hover:border-sky-300 dark:hover:border-sky-400/40 rounded-xl flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-sky-600 dark:hover:text-sky-300 transition-all duration-200">
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                    <a href="https://dlh.pekalongankota.go.id//upload/file/file_20260519111201.pdf"
                       download
                       title="Unduh PDF"
                       class="w-9 h-9 bg-slate-100 dark:bg-white/10 hover:bg-emerald-100 dark:hover:bg-emerald-500/30 border border-slate-200 dark:border-white/10 hover:border-emerald-300 dark:hover:border-emerald-400/40 rounded-xl flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-emerald-600 dark:hover:text-emerald-300 transition-all duration-200">
                        <i class="fas fa-download text-xs"></i>
                    </a>
                    <button onclick="closeManualModal()"
                            title="Tutup"
                            class="w-9 h-9 bg-slate-100 dark:bg-white/10 hover:bg-red-100 dark:hover:bg-red-500/30 border border-slate-200 dark:border-white/10 hover:border-red-300 dark:hover:border-red-400/40 rounded-xl flex items-center justify-center text-slate-500 dark:text-slate-300 hover:text-red-600 dark:hover:text-red-300 transition-all duration-200">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
            </div>

            <!-- PDF Viewer -->
            <div class="relative flex-1 bg-slate-100 dark:bg-slate-900 overflow-hidden" style="min-height: 0;">
                <div id="pdf-loader" class="absolute inset-0 flex flex-col items-center justify-center gap-4 bg-slate-100 dark:bg-slate-900 z-10">
                    <div class="w-12 h-12 rounded-full border-4 border-slate-200 dark:border-slate-700 border-t-sky-500 animate-spin"></div>
                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">Memuat dokumen...</p>
                </div>
                <iframe id="pdf-iframe"
                        src=""
                        class="w-full h-full border-0"
                        style="min-height: 65vh;">
                </iframe>
            </div>

            <!-- Modal Footer -->
            <div class="shrink-0 px-6 py-3 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-200 dark:border-slate-700/50 flex items-center justify-between gap-4">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500">DLH Kota Pekalongan &mdash; Dokumen Resmi</span>
                </div>
                <button onclick="closeManualModal()"
                        class="flex items-center gap-2 px-4 py-2 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-xl transition-colors">
                    <i class="fas fa-times text-xs"></i> Tutup
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Contact Button -->
    <button id="contact-fab"
        onclick="toggleContactCard()"
        class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-600 hover:bg-green-700 text-white rounded-full shadow-2xl shadow-green-400/40 dark:shadow-green-900/60 flex items-center justify-center transition-all duration-300 hover:scale-110 active:scale-95 group">
        <i id="fab-icon" class="fas fa-headset text-xl transition-transform duration-300"></i>
        <span class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-400 rounded-full border-2 border-white dark:border-darkBg animate-pulse"></span>
    </button>

    <!-- Contact Person Card -->
    <div id="contact-card"
        class="fixed bottom-20 right-4 sm:right-6 z-50 w-[calc(100vw-2rem)] max-w-sm opacity-0 pointer-events-none translate-y-4 transition-all duration-300 ease-out"
        style="max-height: calc(100vh - 6rem);">
        <div class="bg-white dark:bg-darkCard rounded-3xl shadow-2xl shadow-slate-300/50 dark:shadow-black/40 border border-slate-100 dark:border-slate-800 overflow-hidden flex flex-col" style="max-height: inherit;">

            <!-- Card Header -->
            <div class="relative bg-gradient-to-br from-green-600 to-emerald-700 p-5 pb-12 shrink-0">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-32 h-32 bg-white/10 rounded-full"></div>
                    <div class="absolute -bottom-8 -left-4 w-24 h-24 bg-white/5 rounded-full"></div>
                </div>
                <div class="relative z-10 flex justify-between items-start">
                    <div>
                        <p class="text-green-100 text-[10px] font-bold uppercase tracking-[0.2em] mb-1">Contact Person</p>
                        <h3 class="text-white font-black text-base leading-tight">M. Ayub Najeb, S.Kom.</h3>
                        <p class="text-green-200 text-xs mt-0.5 font-medium">DLH Kota Pekalongan</p>
                    </div>
                    <button onclick="toggleContactCard()"
                        class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-xl flex items-center justify-center text-white transition-colors shrink-0">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </div>
                <!-- Avatar -->
                <div class="absolute -bottom-7 left-6 w-14 h-14 bg-gradient-to-br from-emerald-400 to-green-600 rounded-2xl shadow-lg shadow-green-700/40 flex items-center justify-center border-4 border-white dark:border-darkCard">
                    <i class="fas fa-user-tie text-white text-xl"></i>
                </div>
            </div>

            <!-- Card Body -->
            <div class="pt-10 px-5 pb-5 space-y-3 overflow-y-auto">

                <!-- Phone -->
                <a href="tel:+6285183113370"
                    class="group flex items-center gap-4 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 hover:bg-green-50 dark:hover:bg-green-900/20 border border-transparent hover:border-green-200 dark:hover:border-green-800 transition-all duration-200">
                    <div class="w-10 h-10 bg-green-100 dark:bg-green-900/40 text-green-600 dark:text-green-400 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-green-600 group-hover:text-white transition-colors duration-200">
                        <i class="fas fa-phone-alt text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Nomor HP</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate">0851 8311 3370</p>
                    </div>
                    <i class="fas fa-chevron-right text-xs text-slate-300 dark:text-slate-600 ml-auto group-hover:text-green-500 transition-colors"></i>
                </a>

                <!-- Email -->
                <a href="mailto:dlhkotapekalongan@gmail.com"
                    class="group flex items-center gap-4 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 hover:bg-green-50 dark:hover:bg-green-900/20 border border-transparent hover:border-green-200 dark:hover:border-green-800 transition-all duration-200">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl flex items-center justify-center shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-200">
                        <i class="fas fa-envelope text-sm"></i>
                    </div>
                    <div class="min-w-0">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Email</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-white truncate">dlhkotapekalongan@gmail.com</p>
                    </div>
                    <i class="fas fa-chevron-right text-xs text-slate-300 dark:text-slate-600 ml-auto group-hover:text-blue-500 transition-colors"></i>
                </a>

                <!-- Address -->
                <a href="https://www.google.com/maps?ll=-6.877427,109.67131&z=20&t=m&hl=id&gl=ID&mapclient=embed&cid=17648168486778126017" target="_blank"
                    class="group flex items-start gap-4 p-3.5 rounded-2xl bg-slate-50 dark:bg-slate-800/60 hover:bg-amber-50 dark:hover:bg-amber-900/20 border border-transparent hover:border-amber-200 dark:hover:border-amber-800 transition-all duration-200">
                    <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-200">
                        <i class="fas fa-map-marker-alt text-sm"></i>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500 mb-0.5">Alamat</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-white leading-snug">Jl. Tentara Pelajar No. 1<br>Kota Pekalongan</p>
                    </div>
                    <i class="fas fa-chevron-right text-xs text-slate-300 dark:text-slate-600 ml-auto mt-3 group-hover:text-amber-500 transition-colors"></i>
                </a>

                <!-- WhatsApp CTA -->
                <a href="https://wa.me/6285183113370" target="_blank"
                    class="flex items-center justify-center gap-2.5 w-full py-3.5 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold text-sm rounded-2xl shadow-lg shadow-green-500/30 transition-all duration-200 hover:shadow-green-500/50 hover:-translate-y-0.5 active:translate-y-0">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span>Chat via WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-white dark:bg-darkCard border-t border-slate-200 dark:border-slate-800 py-5 mt-auto">
        <div
            class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div class="text-sm text-slate-500 dark:text-slate-400">
                &copy; 2026 <strong>DLH Kota Pekalongan</strong>. All rights reserved.
            </div>
            <div class="flex items-center gap-2 text-sm">
                <span class="text-slate-400">Created by</span>
                <span class="font-bold text-slate-800 dark:text-white border-b-2 border-green-500"><a
                        href="https://fajarajikusuma.vercel.app" target="_blank">Fajar Aji Kusuma,
                        S.Kom.</a></span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // --- 1. LOGIC HAMBURGER MENU ---
        const mobileMenuBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = mobileMenuBtn.querySelector('i');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        const toggleMenu = () => {
            mobileMenu.classList.toggle('hidden');
            const isHidden = mobileMenu.classList.contains('hidden');
            menuIcon.className = isHidden ? 'fas fa-bars text-xl' : 'fas fa-times text-xl';
        };

        mobileMenuBtn.addEventListener('click', toggleMenu);
        mobileLinks.forEach(link => link.addEventListener('click', toggleMenu));


        // --- 2. LOGIC DARK MODE ---
        const themeBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            if (lightIcon) lightIcon.classList.remove('hidden');
        } else {
            if (darkIcon) darkIcon.classList.remove('hidden');
        }

        themeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });


        // --- 3. LOGIC RESPONSIVE CHART ---
        const ctx = document.getElementById('chartPemeliharaanVertical').getContext('2d');
        const isMobileDevice = () => window.innerWidth < 768;

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($grafik_pemeliharaan as $row): ?> "<?= getNopolById($row['id_kendaraan']) ?>", <?php endforeach; ?>],
                datasets: [{
                    label: 'Perbaikan',
                    data: [<?php foreach ($grafik_pemeliharaan as $row): ?><?= $row['total'] ?>, <?php endforeach; ?>],
                    backgroundColor: '#10b981',
                    borderRadius: 8,
                    barThickness: isMobileDevice() ? 12 : 25
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: true,
                        external: function(context) {
                            // Mencegah error jika context tidak lengkap
                            if (!context) return;
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                size: isMobileDevice() ? 9 : 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            autoSkip: false,
                            maxRotation: 45,
                            minRotation: 45,
                            font: {
                                size: isMobileDevice() ? 7 : 10,
                                weight: '600'
                            }
                        }
                    }
                }
            }
        });

        window.addEventListener('resize', () => {
            myChart.options.scales.x.ticks.font.size = isMobileDevice() ? 7 : 10;
            if (myChart.data.datasets && myChart.data.datasets[0]) {
                myChart.data.datasets[0].barThickness = isMobileDevice() ? 12 : 25;
            }
            myChart.update();
        });


        // --- 4. LOGIC BACK TO PORTAL ---
        function backToPortal() {
            window.location.href = window.location.origin;
        }


        // --- 5. LOGIC MANUAL BOOK BUTTON ---
        function expandManualBtn(el) {
            const label = document.getElementById('manual-fab-label');
            const dot   = document.getElementById('manual-fab-dot');
            const icon  = el.querySelector('i');
            el.style.width = '10.5rem';
            el.style.justifyContent = 'flex-start';
            el.style.paddingLeft = '1.25rem';
            el.style.paddingRight = '1.25rem';
            el.style.backgroundColor = '#1e40af';
            el.style.boxShadow = '0 20px 40px rgba(30,64,175,0.35)';
            label.style.opacity = '1';
            label.style.maxWidth = '8rem';
            label.style.marginLeft = '0.625rem';
            dot.style.opacity = '0';
        }

        function collapseManualBtn(el) {
            const label = document.getElementById('manual-fab-label');
            const dot   = document.getElementById('manual-fab-dot');
            el.style.width = '3.5rem';
            el.style.justifyContent = 'center';
            el.style.paddingLeft = '0';
            el.style.paddingRight = '0';
            el.style.backgroundColor = '';
            el.style.boxShadow = '';
            label.style.opacity = '0';
            label.style.maxWidth = '0';
            label.style.marginLeft = '0';
            dot.style.opacity = '1';
        }

        const PDF_URL = 'https://dlh.pekalongankota.go.id//upload/file/file_20260519111201.pdf';

        function hidePdfLoader() {
            const loader = document.getElementById('pdf-loader');
            if (loader) loader.style.display = 'none';
        }

        function openManualModal() {
            const modal   = document.getElementById('manual-modal');
            const box     = document.getElementById('manual-modal-box');
            const iframe  = document.getElementById('pdf-iframe');
            const loader  = document.getElementById('pdf-loader');

            // Lazy-load iframe src
            if (!iframe.src || iframe.src === window.location.href) {
                loader.style.display = 'flex';
                iframe.addEventListener('load', hidePdfLoader, { once: true });
                iframe.src = PDF_URL;
            }

            document.body.style.overflow = 'hidden';
            modal.style.opacity = '1';
            modal.style.pointerEvents = 'auto';
            box.style.transform = 'scale(1) translateY(0)';
        }

        function closeManualModal() {
            const modal = document.getElementById('manual-modal');
            const box   = document.getElementById('manual-modal-box');

            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
            box.style.transform = 'scale(0.95) translateY(16px)';
            document.body.style.overflow = '';
        }

        // Tutup modal dengan tombol Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeManualModal();
        });


        // --- 6. LOGIC FLOATING CONTACT CARD ---
        let isContactOpen = false;

        function toggleContactCard() {
            const card = document.getElementById('contact-card');
            const icon = document.getElementById('fab-icon');
            isContactOpen = !isContactOpen;

            if (isContactOpen) {
                card.classList.remove('opacity-0', 'pointer-events-none', 'translate-y-4');
                card.classList.add('opacity-100', 'pointer-events-auto', 'translate-y-0');
                icon.className = 'fas fa-times text-xl transition-transform duration-300';
            } else {
                card.classList.add('opacity-0', 'pointer-events-none', 'translate-y-4');
                card.classList.remove('opacity-100', 'pointer-events-auto', 'translate-y-0');
                icon.className = 'fas fa-headset text-xl transition-transform duration-300';
            }
        }

        // Tutup card jika klik di luar area
        document.addEventListener('click', function(e) {
            const card = document.getElementById('contact-card');
            const fab  = document.getElementById('contact-fab');
            if (isContactOpen && !card.contains(e.target) && !fab.contains(e.target)) {
                toggleContactCard();
            }
        });


        // --- 5. LOGIC SCROLL SPY (NAVBAR ACTIVE) ---
        const sections = document.querySelectorAll('header[id], section[id]');
        const navLinks = document.querySelectorAll('.nav-link');
        const mLinks = document.querySelectorAll('.mobile-link');

        const updateActiveMenu = () => {
            let current = '';
            const scrollPos = window.pageYOffset || document.documentElement.scrollTop;

            // 1. Cek apakah ada Hash di URL (misal: #contact) saat pertama muat
            const hash = window.location.hash;

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                // Offset 150px agar lebih responsif saat perpindahan
                if (scrollPos >= (sectionTop - 150)) {
                    current = section.getAttribute('id');
                }
            });

            // Jika posisi di paling atas sekali, paksa ke 'home'
            if (scrollPos < 100) {
                current = 'home';
            }

            // Update Desktop Navbar
            navLinks.forEach(link => {
                link.classList.remove('nav-link-active', 'text-green-600');
                const href = link.getAttribute('href').replace('#', '');
                if (href === current) {
                    link.classList.add('nav-link-active', 'text-green-600');
                }
            });

            // Update Mobile Navbar
            mLinks.forEach(link => {
                link.classList.remove('bg-green-50', 'dark:bg-green-900/20', 'text-green-600', 'font-bold');
                const href = link.getAttribute('href').replace('#', '');
                if (href === current) {
                    link.classList.add('bg-green-50', 'dark:bg-green-900/20', 'text-green-600', 'font-bold');
                }
            });
        };

        // Jalankan saat scroll
        window.addEventListener('scroll', updateActiveMenu);

        // Jalankan saat pertama kali halaman dimuat (PENTING!)
        window.addEventListener('load', updateActiveMenu);

        // Jalankan saat hash URL berubah (misal klik link menu)
        window.addEventListener('hashchange', updateActiveMenu);
    </script>

</body>

</html>