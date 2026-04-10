<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Halaman Tidak Ditemukan | V-MARS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            background-attachment: fixed;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .floating {
            animation: floating 4s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        .text-glow {
            text-shadow: 0 0 20px rgba(79, 70, 229, 0.2);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 md:p-8 overflow-x-hidden">
    <div class="fixed top-[-10%] right-[-10%] w-64 md:w-96 h-64 md:h-96 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
    <div class="fixed bottom-[-10%] left-[-10%] w-64 md:w-96 h-64 md:h-96 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>

    <div class="w-full max-w-2xl relative z-10 py-10 text-center">

        <div class="absolute inset-0 flex items-center justify-center -z-10 select-none opacity-[0.03]">
            <h1 class="text-[15rem] md:text-[25rem] font-black">404</h1>
        </div>

        <div class="relative inline-block mb-8">
            <div class="absolute inset-0 bg-indigo-500 blur-2xl opacity-20 floating"></div>
            <div class="relative glass-card p-8 rounded-[2.5rem] shadow-xl floating">
                <i class="fas fa-compass text-indigo-600 text-5xl md:text-6xl"></i>
            </div>
        </div>

        <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 mb-4 tracking-tight leading-tight">
            Oops! <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500 text-glow">Tersesat?</span>
        </h1>

        <p class="text-slate-600 text-base md:text-xl mb-10 leading-relaxed max-w-md mx-auto px-4 font-light">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                Halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan ke dimensi lain.
            <?php endif ?>
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center px-4">
            <a href="<?= base_url(); ?>" class="w-full sm:w-auto px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold shadow-lg hover:bg-indigo-600 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center">
                <i class="fas fa-home mr-2"></i> Kembali ke Beranda
            </a>
            <a href="javascript:history.back()" class="w-full sm:w-auto px-8 py-4 glass-card text-slate-700 rounded-2xl font-bold hover:bg-white transition-all flex items-center justify-center border border-slate-200">
                <i class="fas fa-arrow-left mr-2"></i> Halaman Sebelumnya
            </a>
        </div>

        <footer class="mt-16 opacity-60">
            <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-2">V-MARS SYSTEM</p>
            <div class="h-[1px] w-12 bg-slate-300 mx-auto"></div>
        </footer>
    </div>
</body>

</html>