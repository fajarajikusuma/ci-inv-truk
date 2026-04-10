<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex">
    <title><?= lang('Errors.whoops') ?> | V-MARS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #0f172a;
            /* Slate 900 */
        }

        .glass-dark {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .pulse-red {
            animation: pulse-red 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse-red {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: .7;
                transform: scale(1.05);
            }
        }

        .gradient-text {
            background: linear-gradient(to right, #818cf8, #c084fc);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-6 overflow-x-hidden">
    <div class="fixed top-[-10%] left-[-10%] w-[500px] h-[500px] bg-indigo-900/20 rounded-full blur-[120px]"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-purple-900/20 rounded-full blur-[120px]"></div>

    <div class="w-full max-w-xl relative z-10 text-center">

        <div class="relative inline-block mb-10">
            <div class="absolute inset-0 bg-red-500 blur-3xl opacity-20 pulse-red"></div>
            <div class="relative bg-slate-800/50 border border-slate-700 p-8 rounded-[2.5rem] shadow-2xl">
                <i class="fas fa-shield-virus text-red-400 text-5xl"></i>
            </div>
        </div>

        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6 tracking-tight">
            <?= lang('Errors.whoops') ?>
        </h1>

        <div class="glass-dark rounded-3xl p-8 mb-10 shadow-2xl border border-slate-800">
            <p class="text-slate-300 text-lg leading-relaxed font-light italic">
                "<?= lang('Errors.weHitASnag') ?>"
            </p>
            <div class="mt-6 flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-red-500 pulse-red"></span>
                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Technical Glitch Detected</span>
            </div>
        </div>

        <div class="space-y-8">
            <a href="javascript:location.reload()" class="inline-flex items-center px-8 py-3 bg-white text-slate-900 rounded-full font-bold hover:bg-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95 shadow-xl">
                <i class="fas fa-sync-alt mr-2 text-sm"></i> Segarkan Halaman
            </a>

            <footer class="pt-10 border-t border-slate-800/50">
                <div class="flex flex-col items-center gap-4">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.4em]">Internal Server Error</p>
                    <div class="flex items-center gap-3">
                        <div class="h-[1px] w-8 bg-slate-800"></div>
                        <span class="text-xs text-slate-600 font-medium">V-MARS PROTECTION SYSTEM</span>
                        <div class="h-[1px] w-8 bg-slate-800"></div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>