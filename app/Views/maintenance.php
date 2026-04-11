<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance | V-MARS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #f8fafc, #e2e8f0);
            background-attachment: fixed;
            overflow-x: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        /* Watermark Style */
        .countdown-watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 12vw;
            /* Sangat besar */
            font-weight: 900;
            color: rgba(79, 70, 229, 0.04);
            /* Sangat transparan */
            white-space: nowrap;
            z-index: -1;
            user-select: none;
            pointer-events: none;
            font-variant-numeric: tabular-nums;
        }

        .shimmer {
            background: linear-gradient(90deg, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.6) 50%, rgba(255, 255, 255, 0) 100%);
            background-size: 200% 100%;
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 md:p-8">

    <div id="watermark" class="countdown-watermark">00:00:00</div>

    <div class="fixed top-[-10%] right-[-10%] w-64 md:w-96 h-64 md:h-96 bg-blue-100 rounded-full blur-3xl opacity-60"></div>
    <div class="fixed bottom-[-10%] left-[-10%] w-64 md:w-96 h-64 md:h-96 bg-indigo-100 rounded-full blur-3xl opacity-60"></div>

    <div class="w-full max-w-2xl relative z-10 py-10">
        <div class="text-center">

            <div class="relative inline-block mb-8">
                <div class="absolute inset-0 bg-indigo-500 blur-2xl opacity-20 floating"></div>
                <div class="relative glass-card p-6 md:p-8 rounded-[2rem] shadow-xl floating">
                    <i class="fas fa-tools text-indigo-600 text-4xl md:text-5xl"></i>
                </div>
            </div>

            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-4 px-2 tracking-tight leading-tight">
                V-MARS <br class="md:hidden">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Maintenance</span>
            </h1>

            <p class="text-slate-600 text-base md:text-xl mb-10 leading-relaxed max-w-md md:max-w-lg mx-auto px-4">
                Mohon maaf, kami sedang melakukan pemeliharaan rutin. Kami akan segera kembali dengan layanan yang lebih optimal.
            </p>

            <div class="glass-card rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-10 shadow-2xl overflow-hidden relative group mx-2 transition-all">
                <div class="absolute top-0 left-0 w-full h-1.5 shimmer"></div>

                <div class="flex flex-col md:flex-row gap-6 md:gap-0 items-center justify-between">
                    <div class="text-center md:text-left md:w-1/2 md:border-r border-slate-200 md:pr-8 w-full border-b md:border-b-0 pb-6 md:pb-0">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2 block">Sisa Waktu</span>
                        <p id="main-timer" class="text-slate-800 font-bold text-xl md:text-2xl tabular-nums tracking-tighter">00:00:00</p>
                    </div>

                    <div class="text-center md:text-left md:w-1/2 md:pl-8 w-full">
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-indigo-500 mb-2 block">Hubungi Kami</span>
                        <a href="https://wa.me/6285183113370" class="inline-flex items-center text-slate-800 font-bold text-base md:text-lg hover:text-indigo-600 transition-all active:scale-95">
                            <i class="fab fa-whatsapp mr-2 text-green-500 text-xl"></i>
                            0851-8311-3370
                        </a>
                    </div>
                </div>
            </div>

            <footer class="mt-12 md:mt-16 px-4">
                <div class="flex items-center justify-center gap-3 mb-3">
                    <div class="h-[1px] w-6 md:w-8 bg-slate-300"></div>
                    <p class="text-[10px] md:text-xs font-bold text-slate-400 uppercase tracking-[0.3em]">DLH KOTA PEKALONGAN</p>
                    <div class="h-[1px] w-6 md:w-8 bg-slate-300"></div>
                </div>
                <p class="text-[10px] text-slate-400 leading-relaxed">
                    &copy; 2026 Integrated Environmental Management System <br class="md:hidden"> Pekalongan City
                </p>
            </footer>

        </div>
    </div>

    <script>
        // Ambil tanggal dari PHP dan pastikan ada isinya
        const targetPHP = "<?= $targetDate ?? '' ?>";

        // Jika target kosong, berikan tanggal jauh di depan agar tidak 00:00:00
        const finalTarget = targetPHP ? targetPHP.replace(/-/g, "/") : "";

        const countDownDate = new Date(finalTarget).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            // Jika distance hasilnya NaN atau kurang dari 0
            if (isNaN(distance) || distance < 0) {
                document.getElementById("main-timer").innerHTML = "SISTEM SEGERA AKTIF";
                document.getElementById("watermark").innerHTML = "V-MARS";
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const timeString = days + ":" +
                (hours < 10 ? "0" + hours : hours) + ":" +
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);

            const mainDisplay = `<span class="text-indigo-600 font-bold">${days}</span> Hari ${hours}j ${minutes}m ${seconds}s`;

            document.getElementById("main-timer").innerHTML = mainDisplay;
            document.getElementById("watermark").innerHTML = timeString;
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>

</html>