<!DOCTYPE html>
<html lang="id" class="">

<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= esc($title) ?></title>
    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <script>
        // Apply theme before page renders to avoid flash
        // Gunakan key 'theme' yang sama dengan landing page
        (function () {
            const saved = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (saved === 'dark' || (!saved && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 2s infinite',
                        'float-slow': 'float 8s ease-in-out 1s infinite',
                        'gradient': 'gradientShift 8s ease infinite',
                        'fade-in-up': 'fadeInUp 0.6s ease forwards',
                        'fade-in-up-delay': 'fadeInUp 0.6s ease 0.15s forwards',
                        'fade-in-up-delay2': 'fadeInUp 0.6s ease 0.3s forwards',
                        'pulse-ring': 'pulseRing 2s ease-in-out infinite',
                        'shimmer': 'shimmer 2.5s linear infinite',
                        'spin-slow': 'spin 8s linear infinite',
                        'bounce-soft': 'bounceSoft 2s ease-in-out infinite',
                        'particle': 'particle 4s ease-in-out infinite',
                    },
                    keyframes: {
                        float: { '0%,100%': { transform: 'translateY(0px) rotate(0deg)' }, '50%': { transform: 'translateY(-20px) rotate(3deg)' } },
                        gradientShift: { '0%,100%': { backgroundPosition: '0% 50%' }, '50%': { backgroundPosition: '100% 50%' } },
                        fadeInUp: { from: { opacity: '0', transform: 'translateY(24px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
                        pulseRing: { '0%': { boxShadow: '0 0 0 0 rgba(99,102,241,0.4)' }, '70%': { boxShadow: '0 0 0 12px rgba(99,102,241,0)' }, '100%': { boxShadow: '0 0 0 0 rgba(99,102,241,0)' } },
                        shimmer: { '0%': { backgroundPosition: '-200% center' }, '100%': { backgroundPosition: '200% center' } },
                        bounceSoft: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-6px)' } },
                        particle: { '0%,100%': { transform: 'translateY(0) scale(1)', opacity: '0.6' }, '50%': { transform: 'translateY(-30px) scale(1.1)', opacity: '1' } },
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        html, body { overflow-x: hidden; }

        /* Gradient animated background (right panel) */
        .bg-animated {
            background: linear-gradient(135deg, #1e1b4b, #312e81, #1e40af, #1d4ed8, #312e81);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }

        /* Left panel – light mode */
        .left-panel {
            background: #ffffff;
        }

        /* Left panel – dark mode: deep navy, bukan hitam */
        .dark .left-panel {
            background: linear-gradient(160deg, #0f0f1a 0%, #111827 50%, #0d1117 100%);
        }

        /* Subtle dot grid overlay for dark panel */
        .dark .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(99,102,241,0.08) 1px, transparent 1px);
            background-size: 28px 28px;
            pointer-events: none;
            z-index: 0;
        }

        /* Glow accent top-left corner in dark */
        .dark .left-panel::after {
            content: '';
            position: absolute;
            top: -80px;
            left: -80px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(99,102,241,0.12) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
        }

        /* Glass morphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        /* Shimmer button effect */
        .btn-shimmer {
            background: linear-gradient(90deg, #4f46e5, #6366f1, #818cf8, #6366f1, #4f46e5);
            background-size: 200% auto;
            animation: shimmer 2.5s linear infinite;
            transition: transform 0.15s, box-shadow 0.2s;
        }
        .btn-shimmer:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.5);
        }
        .btn-shimmer:active { transform: scale(0.97); }

        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.25);
            border-color: #6366f1 !important;
        }

        /* Floating particles */
        .particle { position: absolute; border-radius: 50%; pointer-events: none; }

        /* Opacity 0 on load for animation */
        .fade-init { opacity: 0; }

        /* Theme toggle pill */
        .theme-toggle { transition: all 0.3s ease; }

        /* Fix browser autofill background di dark mode */
        .dark input:-webkit-autofill,
        .dark input:-webkit-autofill:hover,
        .dark input:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0px 1000px #1a1f2e inset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
            border-color: rgba(255,255,255,0.12) !important;
            caret-color: #e2e8f0;
        }

        /* Dark input focus glow override */
        .dark .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
            border-color: rgba(99, 102, 241, 0.5) !important;
            background-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Input error state */
        .input-error {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important;
            animation: shake 0.4s ease;
        }
        .dark .input-error {
            border-color: rgba(239, 68, 68, 0.7) !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%       { transform: translateX(-6px); }
            40%       { transform: translateX(6px); }
            60%       { transform: translateX(-4px); }
            80%       { transform: translateX(4px); }
        }
    </style>
</head>

<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-white transition-colors duration-500">

    <!-- ===== MAIN LAYOUT ===== -->
    <div class="min-h-screen flex flex-col lg:flex-row">

        <!-- ===== LEFT PANEL – FORM ===== -->
        <div class="left-panel relative flex flex-col min-h-screen w-full lg:w-[42%] xl:w-[36%]
                    shadow-2xl dark:shadow-black/60 z-10
                    border-r border-slate-100 dark:border-indigo-900/30
                    transition-colors duration-500">

            <div class="relative z-10 flex flex-col flex-grow p-8 md:p-12 lg:p-10 xl:p-14">

                <!-- Top bar: Logo + Theme Toggle -->
                <div class="flex items-center justify-between mb-10 lg:mb-14 fade-init" id="el-logo">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 bg-gradient-to-br from-indigo-500 to-blue-600
                                    rounded-xl flex items-center justify-center text-white
                                    shadow-lg shadow-indigo-300 dark:shadow-indigo-900
                                    animate-pulse-ring flex-shrink-0">
                            <i class="bi bi-car-front-fill text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-extrabold tracking-tight text-slate-800 dark:text-slate-100 leading-none">V-MARS</h1>
                            <p class="text-[9px] text-slate-400 dark:text-slate-500 font-semibold uppercase tracking-[0.18em] mt-0.5">
                                Vehicle Maintenance &amp; Recording System
                            </p>
                        </div>
                    </div>

                    <!-- Theme Toggle — tinggi sama dengan logo (h-11 = 44px) -->
                    <button id="theme-toggle" type="button" aria-label="Toggle tema"
                        class="theme-toggle flex-shrink-0 h-11 w-11 rounded-xl
                               bg-slate-100 dark:bg-white/10
                               hover:bg-slate-200 dark:hover:bg-white/20
                               flex items-center justify-center
                               border border-slate-200 dark:border-white/10
                               shadow-sm cursor-pointer select-none transition-all duration-200">
                        <i id="theme-icon" class="text-base"></i>
                    </button>
                </div>

                <!-- Form Section -->
                <div class="flex-grow flex flex-col justify-center max-w-sm w-full mx-auto lg:mx-0">

                    <!-- Heading -->
                    <div class="mb-8 fade-init" id="el-heading">
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-indigo-500 dark:text-indigo-400 mb-2">Selamat Datang Kembali</p>
                        <h2 class="text-3xl font-extrabold text-slate-800 dark:text-slate-50 mb-2 leading-tight">
                            Masuk ke Dashboard
                        </h2>
                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">
                            Kelola armada kendaraan Anda dengan cerdas dan efisien.
                        </p>
                    </div>

                    <!-- Flash Error -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800
                                    p-4 mb-6 rounded-2xl flex items-start gap-3 fade-init" id="el-error">
                            <div class="w-8 h-8 bg-red-100 dark:bg-red-800/50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="bi bi-exclamation-triangle-fill text-red-500 dark:text-red-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-red-700 dark:text-red-300 text-sm font-semibold">Login Gagal</p>
                                <p class="text-red-600 dark:text-red-400 text-xs mt-0.5"><?= esc(session()->getFlashdata('error')) ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- LOGIN FORM -->
                    <form action="<?= base_url('auth/login') ?>" method="post"
                          autocomplete="off" novalidate
                          class="space-y-5 fade-init" id="el-form">

                        <?= csrf_field() ?>

                        <!-- Honeypot anti-bot (hidden) -->
                        <div style="position:absolute;left:-9999px;top:-9999px;visibility:hidden;" aria-hidden="true">
                            <input type="text" name="website" tabindex="-1" autocomplete="off" value="">
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-2 uppercase tracking-wider">
                                Username
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none
                                            text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-500 dark:group-focus-within:text-indigo-400 transition-colors duration-200"
                                     id="icon-username">
                                    <i class="bi bi-person-fill text-base"></i>
                                </div>
                                <input type="text" id="username" name="username" required
                                    maxlength="50"
                                    autocomplete="username"
                                    spellcheck="false"
                                    class="input-glow block w-full pl-11 pr-4 py-3.5
                                           bg-slate-50 dark:bg-white/[0.06]
                                           border border-slate-200 dark:border-white/10
                                           rounded-2xl
                                           text-slate-900 dark:text-slate-100
                                           focus:outline-none transition-all duration-200
                                           placeholder:text-slate-400 dark:placeholder:text-slate-600
                                           text-sm font-medium"
                                    placeholder="Masukkan username">
                            </div>
                            <!-- Error message -->
                            <p id="error-username" style="display:none" class="mt-2 text-xs text-red-500 dark:text-red-400 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>Username tidak boleh kosong</span>
                            </p>
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-600 dark:text-slate-300 mb-2 uppercase tracking-wider">
                                Password
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none
                                            text-slate-400 dark:text-slate-500 group-focus-within:text-indigo-500 dark:group-focus-within:text-indigo-400 transition-colors duration-200"
                                     id="icon-password">
                                    <i class="bi bi-shield-lock-fill text-base"></i>
                                </div>
                                <input type="password" id="password" name="password" required
                                    maxlength="100"
                                    autocomplete="current-password"
                                    class="input-glow block w-full pl-11 pr-12 py-3.5
                                           bg-slate-50 dark:bg-white/[0.06]
                                           border border-slate-200 dark:border-white/10
                                           rounded-2xl
                                           text-slate-900 dark:text-slate-100
                                           focus:outline-none transition-all duration-200
                                           placeholder:text-slate-400 dark:placeholder:text-slate-600
                                           text-sm font-medium"
                                    placeholder="••••••••">
                                <!-- Toggle show/hide password -->
                                <button type="button" id="toggle-password"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center
                                           text-slate-400 dark:text-slate-500
                                           hover:text-indigo-500 dark:hover:text-indigo-400
                                           transition-colors cursor-pointer"
                                    aria-label="Tampilkan password">
                                    <i class="bi bi-eye-fill text-base" id="eye-icon"></i>
                                </button>
                            </div>
                            <!-- Error message -->
                            <p id="error-password" style="display:none" class="mt-2 text-xs text-red-500 dark:text-red-400 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                <span>Password tidak boleh kosong</span>
                            </p>
                        </div>

                        <!-- Terms -->
                        <p class="text-xs text-slate-400 dark:text-slate-500 leading-relaxed">
                            Dengan masuk, Anda menyetujui
                            <a href="#" class="text-indigo-500 dark:text-indigo-400 hover:underline font-semibold">Syarat Layanan</a>
                            yang berlaku.
                        </p>

                        <!-- Buttons -->
                        <div class="pt-1 space-y-3">
                            <button type="submit" id="submit-btn"
                                class="btn-shimmer w-full text-white font-bold py-3.5 px-4
                                       rounded-2xl shadow-lg shadow-indigo-300/50 dark:shadow-indigo-900/60
                                       flex items-center justify-center gap-2 text-sm">
                                <span id="btn-text">Masuk ke Dashboard</span>
                                <i class="bi bi-arrow-right text-base" id="btn-icon"></i>
                                <svg id="btn-spinner" class="hidden animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                </svg>
                            </button>

                            <a href="<?= base_url() ?>"
                                class="w-full flex items-center justify-center gap-2
                                       bg-slate-100 dark:bg-white/[0.06]
                                       hover:bg-slate-200 dark:hover:bg-white/[0.10]
                                       border border-slate-200 dark:border-white/10
                                       text-slate-600 dark:text-slate-300
                                       font-semibold py-3.5 px-4 rounded-2xl
                                       transition-all duration-200 text-sm">
                                <i class="bi bi-arrow-left"></i>
                                Kembali ke Beranda
                            </a>
                        </div>

                    </form>
                </div>

                <!-- Footer -->
                <div class="mt-auto pt-6 border-t border-slate-100 dark:border-white/[0.06] fade-init" id="el-footer">
                    <div class="flex flex-col lg:flex-row justify-between items-center gap-1 text-xs text-slate-400 dark:text-slate-600">
                        <p class="font-medium">2026 &copy; <span class="text-slate-600 dark:text-slate-400 font-bold">V-MARS</span></p>
                        <p>
                            by
                            <a href="https://fajarajikusuma.vercel.app" target="_blank" rel="noopener noreferrer"
                               class="text-indigo-500 dark:text-indigo-400 hover:underline font-semibold">
                                Fajar Aji Kusuma, S.Kom.
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
        <!-- END LEFT PANEL -->

        <!-- ===== RIGHT PANEL – VISUAL ===== -->
        <div class="hidden lg:flex lg:flex-grow relative overflow-hidden bg-animated">

            <!-- Decorative blobs -->
            <div class="absolute top-0 right-0 -mr-24 -mt-24 w-[500px] h-[500px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -ml-24 -mb-24 w-96 h-96 bg-black/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-indigo-400/10 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Floating particles -->
            <div class="particle w-3 h-3 bg-white/30 animate-particle" style="top:15%;left:20%;animation-delay:0s;"></div>
            <div class="particle w-2 h-2 bg-white/20 animate-particle" style="top:35%;left:75%;animation-delay:1s;"></div>
            <div class="particle w-4 h-4 bg-white/15 animate-particle" style="top:65%;left:30%;animation-delay:2s;"></div>
            <div class="particle w-2 h-2 bg-white/25 animate-particle" style="top:80%;left:70%;animation-delay:0.5s;"></div>
            <div class="particle w-3 h-3 bg-indigo-200/30 animate-particle" style="top:50%;left:85%;animation-delay:1.5s;"></div>
            <div class="particle w-2 h-2 bg-blue-200/20 animate-particle" style="top:25%;left:55%;animation-delay:3s;"></div>

            <!-- Grid overlay -->
            <div class="absolute inset-0 opacity-[0.04]"
                 style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            <!-- Center content -->
            <div class="relative w-full h-full flex flex-col items-center justify-center text-white p-12 xl:p-16 text-center">

                <!-- Main glass card -->
                <div class="glass-card rounded-3xl p-10 xl:p-12 max-w-md w-full shadow-2xl">

                    <!-- Icon -->
                    <div class="mb-8 flex justify-center">
                        <div class="relative">
                            <div class="w-24 h-24 bg-white/15 rounded-3xl flex items-center justify-center shadow-inner border border-white/20 animate-bounce-soft">
                                <i class="bi bi-speedometer2 text-5xl text-white"></i>
                            </div>
                            <!-- Orbit ring -->
                            <div class="absolute -inset-3 border-2 border-dashed border-white/20 rounded-full animate-spin-slow"></div>
                        </div>
                    </div>

                    <h2 class="text-3xl xl:text-4xl font-extrabold mb-4 tracking-tight leading-tight">
                        Efficient Fleet<br>Management
                    </h2>
                    <p class="text-blue-100 text-sm xl:text-base leading-relaxed mb-8 opacity-90">
                        Optimalkan pemeliharaan kendaraan Anda dengan sistem pencatatan yang cerdas, terintegrasi, dan real-time.
                    </p>

                    <!-- Feature badges -->
                    <div class="flex flex-wrap justify-center gap-2 mb-8">
                        <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/15 backdrop-blur-sm">
                            <i class="bi bi-wrench-adjustable mr-1"></i>Maintenance
                        </span>
                        <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/15 backdrop-blur-sm">
                            <i class="bi bi-journal-text mr-1"></i>Recording
                        </span>
                        <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/15 backdrop-blur-sm">
                            <i class="bi bi-activity mr-1"></i>Real-time
                        </span>
                        <span class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/15 backdrop-blur-sm">
                            <i class="bi bi-shield-check mr-1"></i>Secure
                        </span>
                    </div>

                    <!-- Stats row -->
                    <div class="grid grid-cols-3 gap-4 border-t border-white/10 pt-6">
                        <div class="text-center">
                            <p class="text-2xl font-extrabold text-white">100%</p>
                            <p class="text-[10px] text-blue-200 uppercase tracking-wider mt-1">Akurat</p>
                        </div>
                        <div class="text-center border-x border-white/10">
                            <p class="text-2xl font-extrabold text-white">24/7</p>
                            <p class="text-[10px] text-blue-200 uppercase tracking-wider mt-1">Tersedia</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-extrabold text-white">Aman</p>
                            <p class="text-[10px] text-blue-200 uppercase tracking-wider mt-1">Terlindungi</p>
                        </div>
                    </div>

                </div>

                <!-- Floating animated cards below -->
                <div class="mt-8 flex gap-4 animate-float">
                    <div class="glass-card rounded-2xl px-5 py-3 flex items-center gap-3 text-sm">
                        <div class="w-8 h-8 bg-emerald-400/20 rounded-lg flex items-center justify-center">
                            <i class="bi bi-check-circle-fill text-emerald-300 text-base"></i>
                        </div>
                        <span class="text-white/80 text-xs font-medium">Sistem Aktif</span>
                    </div>
                    <div class="glass-card rounded-2xl px-5 py-3 flex items-center gap-3 text-sm animate-float-delayed">
                        <div class="w-8 h-8 bg-amber-400/20 rounded-lg flex items-center justify-center">
                            <i class="bi bi-bell-fill text-amber-300 text-base"></i>
                        </div>
                        <span class="text-white/80 text-xs font-medium">Notifikasi On</span>
                    </div>
                </div>

            </div>
        </div>
        <!-- END RIGHT PANEL -->

    </div>

    <!-- ===== JAVASCRIPT ===== -->
    <script>
        // ── Theme Toggle ──────────────────────────────────────────
        const html      = document.documentElement;
        const themeBtn  = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');

        function updateThemeIcon(isDark) {
            if (isDark) {
                themeIcon.className = 'bi bi-moon-stars-fill text-indigo-300 text-base';
            } else {
                themeIcon.className = 'bi bi-sun-fill text-amber-400 text-base';
            }
        }

        function applyTheme(dark) {
            if (dark) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
            updateThemeIcon(dark);
        }

        // Init icon sesuai kondisi sekarang
        updateThemeIcon(html.classList.contains('dark'));

        themeBtn.addEventListener('click', () => {
            applyTheme(!html.classList.contains('dark'));
        });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
            if (!localStorage.getItem('theme')) applyTheme(e.matches);
        });

        // ── Entrance Animations ───────────────────────────────────
        const animEls = [
            { el: document.getElementById('el-logo'),    delay: 0   },
            { el: document.getElementById('el-heading'), delay: 150 },
            { el: document.getElementById('el-form'),    delay: 300 },
            { el: document.getElementById('el-footer'),  delay: 450 },
            { el: document.getElementById('el-error'),   delay: 100 },
        ];
        animEls.forEach(({ el, delay }) => {
            if (!el) return;
            el.style.transition = `opacity 0.6s ease ${delay}ms, transform 0.6s ease ${delay}ms`;
            el.style.transform = 'translateY(20px)';
            requestAnimationFrame(() => {
                setTimeout(() => {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, 50);
            });
        });

        // ── Password Toggle ───────────────────────────────────────
        const toggleBtn = document.getElementById('toggle-password');
        const pwInput   = document.getElementById('password');
        const eyeIcon   = document.getElementById('eye-icon');

        toggleBtn.addEventListener('click', () => {
            const isHidden = pwInput.type === 'password';
            pwInput.type = isHidden ? 'text' : 'password';
            eyeIcon.className = isHidden ? 'bi bi-eye-slash-fill text-base' : 'bi bi-eye-fill text-base';
            toggleBtn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
        });

        // ── Field Validation Helpers ──────────────────────────────
        function setFieldError(inputId, errorId, show) {
            const input = document.getElementById(inputId);
            const error = document.getElementById(errorId);
            if (show) {
                // Pakai inline style agar tidak bergantung pada Tailwind CDN purge
                input.style.borderColor = '#ef4444';
                input.style.boxShadow   = '0 0 0 3px rgba(239,68,68,0.18)';
                error.style.display = 'flex';
                // Trigger shake: remove & re-add class
                input.classList.remove('input-error');
                void input.offsetWidth;
                input.classList.add('input-error');
            } else {
                input.style.borderColor = '';
                input.style.boxShadow   = '';
                error.style.display = 'none';
                input.classList.remove('input-error');
            }
        }

        // Sembunyikan error saat user mulai mengetik
        document.getElementById('username').addEventListener('input', function () {
            if (this.value.trim() !== '') setFieldError('username', 'error-username', false);
        });
        document.getElementById('password').addEventListener('input', function () {
            if (this.value !== '') setFieldError('password', 'error-password', false);
        });

        // ── Form Submit ───────────────────────────────────────────
        const form       = document.querySelector('form');
        const submitBtn  = document.getElementById('submit-btn');
        const btnText    = document.getElementById('btn-text');
        const btnIcon    = document.getElementById('btn-icon');
        const btnSpinner = document.getElementById('btn-spinner');

        form.addEventListener('submit', function (e) {
            // Honeypot check
            const honeypot = this.querySelector('input[name="website"]');
            if (honeypot && honeypot.value !== '') {
                e.preventDefault();
                return false;
            }

            const uVal = document.getElementById('username').value.trim();
            const pVal = document.getElementById('password').value;
            let hasError = false;

            if (uVal === '') {
                setFieldError('username', 'error-username', true);
                hasError = true;
            }
            if (pVal === '') {
                setFieldError('password', 'error-password', true);
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
                // Focus first empty field
                if (uVal === '') document.getElementById('username').focus();
                else document.getElementById('password').focus();
                return false;
            }

            // Loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Memproses...';
            btnIcon.classList.add('hidden');
            btnSpinner.classList.remove('hidden');
        });
    </script>

</body>
</html>
