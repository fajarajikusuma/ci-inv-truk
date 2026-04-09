<!DOCTYPE html>
<html lang="en">

<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        /* Menghilangkan scrollbar horizontal jika ada overflow kecil */
        body,
        html {
            overflow-x: hidden;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">
    <div class="min-h-screen flex flex-col lg:flex-row">

        <div
            class="flex flex-col min-h-screen w-full lg:w-[35%] xl:w-[30%] bg-white shadow-2xl z-10 transition-all duration-300">

            <div class="flex flex-col flex-grow p-8 md:p-12 lg:p-10 xl:p-16">

                <div class="mb-10 lg:mb-12">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white shadow-lg shadow-blue-200 flex-shrink-0">
                            <i class="bi bi-car-front-fill text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold tracking-tight text-slate-800 leading-none">V-MARS</h1>
                            <p class="text-[10px] text-slate-500 font-medium uppercase tracking-widest mt-1">Vehicle
                                Maintenance and Recording System</p>
                        </div>
                    </div>
                </div>

                <div class="flex-grow flex flex-col justify-center max-w-md w-full mx-auto lg:mx-0">
                    <h2 class="text-3xl font-bold text-slate-800 mb-2">Selamat Datang</h2>
                    <p class="text-slate-500 mb-8">Silahkan login untuk mengelola sistem pemeliharaan kendaraan Anda.
                    </p>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded shadow-sm flex items-center gap-3">
                            <i class="bi bi-exclamation-circle-fill text-red-500"></i>
                            <p class="text-red-700 text-sm font-medium"><?= session()->getFlashdata('error') ?></p>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/login') ?>" method="post" class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <i class="bi bi-person"></i>
                                </div>
                                <input type="text" name="username" required
                                    class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                    placeholder="Masukkan username">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                            <div class="relative group">
                                <div
                                    class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <i class="bi bi-shield-lock"></i>
                                </div>
                                <input type="password" name="password" required
                                    class="block w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder:text-slate-400"
                                    placeholder="••••••••">
                            </div>
                        </div>

                        <div class="text-xs text-slate-500 leading-relaxed">
                            Dengan masuk, Anda menyetujui <a href="#"
                                class="text-blue-600 hover:underline font-medium">Syarat Layanan</a>.
                        </div>

                        <div class="pt-2 space-y-3">
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98]">
                                Masuk ke Dashboard
                            </button>

                            <a id="back-home-btn" href="<?= base_url() ?>"
                                class="w-full flex items-center justify-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold py-3.5 px-4 rounded-xl transition-all cursor-pointer">
                                <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </form>
                </div>

                <div class="mt-auto pt-6 border-t border-slate-100">
                    <div
                        class="flex flex-col lg:flex-row justify-between items-center gap-2 text-xs md:text-sm text-slate-400">

                        <div class="text-center lg:text-left">
                            <p class="font-medium">
                                2026 &copy; <span class="text-slate-600 font-bold">V-MARS</span>
                            </p>
                        </div>

                        <div class="text-center lg:text-right">
                            <p>
                                Created by
                                <a href="https://fajarajikusuma.vercel.app"
                                    class="text-blue-600 hover:underline font-semibold">
                                    Fajar Aji Kusuma, S.Kom.
                                </a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <div class="hidden lg:block lg:flex-grow relative overflow-hidden bg-blue-600">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800"></div>

            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-black/10 rounded-full blur-3xl"></div>

            <div class="relative h-full flex flex-col items-center justify-center text-white p-12 text-center">
                <div class="bg-white/10 backdrop-blur-md p-10 rounded-3xl border border-white/20 max-w-lg shadow-2xl">
                    <div class="mb-6 inline-block p-4 bg-white/20 rounded-2xl shadow-inner">
                        <i class="bi bi-speedometer2 text-6xl"></i>
                    </div>
                    <h2 class="text-4xl font-bold mb-4 tracking-tight">Efficient Fleet Management</h2>
                    <p class="text-blue-100 text-lg leading-relaxed mb-8">
                        "Optimalkan pemeliharaan kendaraan Anda dengan sistem pencatatan yang cerdas dan terintegrasi."
                    </p>
                    <div class="flex flex-wrap justify-center gap-3">
                        <span
                            class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/10">Maintenance</span>
                        <span
                            class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/10">Recording</span>
                        <span
                            class="px-4 py-1.5 bg-white/10 rounded-full text-[10px] font-bold uppercase tracking-[0.2em] border border-white/10">Real-time</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>