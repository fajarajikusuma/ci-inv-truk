<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
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
                        <a href="#home" class="text-green-600">Dashboard</a>
                        <a href="#about" class="hover:text-green-600 transition dark:text-slate-300">Tentang Kami</a>
                        <a href="#contact" class="hover:text-green-600 transition dark:text-slate-300">Kontak</a>
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
                    class="mobile-link block px-4 py-3 mt-5 rounded-xl bg-green-50 dark:bg-green-900/20 text-green-600 font-bold">Dashboard</a>
                <a href="#about"
                    class="mobile-link block px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 font-medium transition text-slate-600 dark:text-slate-300">Tentang
                    Kami</a>
                <a href="#contact"
                    class="mobile-link block px-4 py-3 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 font-medium transition text-slate-600 dark:text-slate-300">Kontak</a>
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
            <div
                class="lg:col-span-2 bg-white dark:bg-darkCard p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-bold text-lg">Intensitas Pemeliharaan <?= $tahun_pilih ?></h3>
                    <form action="" method="get"><select name="tahun" onchange="this.form.submit()"
                            class="bg-slate-50 dark:bg-slate-800 border-none rounded-lg text-xs font-bold p-2 outline-none ring-1 ring-slate-200 dark:ring-slate-700"><?php for ($i = date('Y'); $i >= 2024; $i--): ?>
                                <option value="<?= $i ?>" <?= $tahun_pilih == $i ? 'selected' : '' ?>><?= $i ?></option>

                            <?php endfor; ?>
                        </select></form>
                </div>
                <div class="relative h-[400px] w-full"><canvas id="chartPemeliharaanVertical"></canvas></div>
            </div>

            <a href="<?= base_url('login') ?>"
                class="group bg-green-600 dark:bg-green-700 p-8 rounded-[2.5rem] text-white relative overflow-hidden shadow-xl shadow-green-200 dark:shadow-none transition-all hover:scale-[1.02] active:scale-95 flex flex-col min-h-[450px]">
                <i
                    class="fas fa-leaf absolute -right-10 -bottom-10 text-9xl opacity-20 rotate-12 transition-transform group-hover:rotate-45 duration-700"></i>
                <div class="relative z-10">
                    <h3 class="font-bold text-2xl mb-4">Status Pajak</h3>
                    <p class="text-green-100 text-base leading-relaxed mb-8 opacity-90">Monitoring realisasi pembayaran
                        pajak armada operasional Dinas Lingkungan Hidup Kota Pekalongan.</p>
                </div>
                <div
                    class="relative z-10 bg-white/10 p-8 rounded-3xl border border-white/20 backdrop-blur-md mb-8 flex-grow flex flex-col justify-center">
                    <div class="text-xs uppercase font-bold opacity-80 mb-2 tracking-[0.2em]">Sudah Terbayar</div>
                    <div class="flex items-baseline gap-2"><span
                            class="text-6xl font-black tracking-tighter"><?= $sudah_bayar_pajak ?></span><span
                            class="text-xl font-medium opacity-80 uppercase tracking-widest">Armada</span></div>
                </div>
                <div class="relative z-10 mt-auto">
                    <div
                        class="w-full bg-white text-center text-green-700 font-extrabold py-4 rounded-2xl group-hover:bg-slate-50 transition-colors shadow-lg flex items-center justify-center gap-3">
                        <span>Detail Dokumen</span><i
                            class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
                    </div>
                </div>
            </a>
        </div>

        <hr class="border-slate-200 dark:border-slate-800 mb-20">

        <section id="about" class="mb-24 py-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <img src="https://u7.uidownload.com/vector/264/324/vector-garbage-truck-vector-set-svg-ai.jpg"
                        class="rounded-[2.5rem] shadow-2xl shadow-green-100 dark:shadow-none" alt="Waste Management">
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
        // Hamburger Menu Logic
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

        // Dark Mode Logic
        const themeBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            darkIcon.classList.remove('hidden');
        }

        themeBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });

        // Chart Logic
        const ctx = document.getElementById('chartPemeliharaanVertical').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($grafik_pemeliharaan as $row): ?>"<?= getNopolById($row['id_kendaraan']) ?>", <?php endforeach; ?>],
                datasets: [{
                    label: 'Perbaikan',
                    data: [<?php foreach ($grafik_pemeliharaan as $row): ?><?= $row['total'] ?>, <?php endforeach; ?>],
                    backgroundColor: '#10b981', borderRadius: 8, barThickness: 25
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, grid: { color: 'rgba(156, 163, 175, 0.1)', drawBorder: false } }, x: { grid: { display: false }, ticks: { font: { size: 10, weight: '600' } } } } }
        });
    </script>
    <script>
        function backToPortal() {
            // Mengambil origin (http://dlh.ruijieddns.com) tanpa path /pemeliharaan/
            const portalUrl = window.location.origin;
            window.location.href = portalUrl;
        }
    </script>
</body>

</html>