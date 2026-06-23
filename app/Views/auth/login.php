<!DOCTYPE html>
<html lang="id" class="">
<head>
    <base href="<?= base_url() ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title><?= esc($title) ?></title>
    <link rel="shortcut icon" href="dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script>
        (function(){
            var s=localStorage.getItem('theme'),d=window.matchMedia('(prefers-color-scheme:dark)').matches;
            if(s==='dark'||(!s&&d))document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config={
            darkMode:'class',
            theme:{
                extend:{
                    fontFamily:{sans:['Inter','sans-serif']},
                    colors:{
                        brand:{50:'#eef2ff',100:'#e0e7ff',200:'#c7d2fe',300:'#a5b4fc',400:'#818cf8',500:'#6366f1',600:'#4f46e5',700:'#4338ca',800:'#3730a3',900:'#312e81',950:'#1e1b4b'}
                    },
                    animation:{
                        'gradient':'gradientShift 12s ease infinite',
                        'float-a':'floatA 7s ease-in-out infinite',
                        'float-b':'floatB 9s ease-in-out infinite',
                        'float-c':'floatC 11s ease-in-out infinite',
                        'spin-slow':'spin 18s linear infinite',
                        'pulse-slow':'pulse 4s cubic-bezier(0.4,0,0.6,1) infinite',
                        'shimmer':'shimmer 2.5s linear infinite',
                        'orb':'orb 8s ease-in-out infinite',
                    },
                    keyframes:{
                        gradientShift:{'0%,100%':{backgroundPosition:'0% 50%'},'50%':{backgroundPosition:'100% 50%'}},
                        floatA:{'0%,100%':{transform:'translateY(0) rotate(0deg)'},'33%':{transform:'translateY(-18px) rotate(1deg)'},'66%':{transform:'translateY(-8px) rotate(-1deg)'}},
                        floatB:{'0%,100%':{transform:'translateY(0) rotate(0deg)'},'50%':{transform:'translateY(-22px) rotate(2deg)'}},
                        floatC:{'0%,100%':{transform:'translateY(0)'},'40%':{transform:'translateY(-12px)'},'80%':{transform:'translateY(-6px)'}},
                        shimmer:{'0%':{backgroundPosition:'-200% center'},'100%':{backgroundPosition:'200% center'}},
                        orb:{'0%,100%':{transform:'translate(0,0) scale(1)'},'33%':{transform:'translate(30px,-20px) scale(1.05)'},'66%':{transform:'translate(-20px,15px) scale(0.97)'}},
                    }
                }
            }
        }
    </script>
    <style>
        *{box-sizing:border-box}
        html{height:100%;background:#f8fafc}
        html.dark{background:#0c0f1d}
        body{min-height:100%;margin:0;font-family:'Inter',sans-serif;overflow-x:hidden;background:inherit}

        /* ── Page ── */
        .page{
            min-height:100vh;min-height:100dvh;
            display:flex;flex-direction:column;
            background:inherit;
        }
        @media(min-width:1024px){.page{flex-direction:row}}

        /* ── Left Panel ── */
        .lp{
            position:relative;
            width:100%;
            display:flex;flex-direction:column;
            background:#f8fafc;
            z-index:10;
            flex:1;
        }
        .dark .lp{background:#0c0f1d}
        @media(min-width:1024px){.lp{width:33.3333%;flex:none;min-height:100vh}}
        /* inner wrapper selalu full height */
        .lp > .lp-inner{flex:1;display:flex;flex-direction:column}
        @media(min-width:1024px){.lp > .lp-inner{min-height:100vh}}

        /* subtle noise texture on lp */
        .lp::after{
            content:'';position:absolute;inset:0;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events:none;z-index:0;opacity:0.4;
        }

        /* ── Right Panel ── */
        .rp{
            display:none;
            position:relative;overflow:hidden;
            background:linear-gradient(135deg,#0f0c29,#302b63,#24243e,#1a1a4e,#0f0c29);
            background-size:400% 400%;
            animation:gradientShift 12s ease infinite;
        }
        @media(min-width:1024px){.rp{display:flex;flex-direction:column;justify-content:center;align-items:center;width:66.6667%}}

        /* mesh gradient orbs */
        .orb{position:absolute;border-radius:50%;filter:blur(80px);pointer-events:none;animation:orb 8s ease-in-out infinite}

        /* glass morphism */
        .glass{
            background:rgba(255,255,255,0.06);
            backdrop-filter:blur(24px);-webkit-backdrop-filter:blur(24px);
            border:1px solid rgba(255,255,255,0.12);
        }
        .glass-strong{
            background:rgba(255,255,255,0.09);
            backdrop-filter:blur(32px);-webkit-backdrop-filter:blur(32px);
            border:1px solid rgba(255,255,255,0.16);
            box-shadow:0 32px 64px rgba(0,0,0,0.35),0 0 0 1px rgba(255,255,255,0.04) inset;
        }

        /* ── Input ── */
        .inp{
            width:100%;border-radius:14px;padding:13px 44px 13px 42px;
            font-size:14px;font-weight:500;
            background:#f1f5f9;
            border:1.5px solid #e2e8f0;
            color:#0f172a;
            transition:all 0.2s;outline:none;
        }
        .inp::placeholder{color:#94a3b8}
        .inp:focus{background:#fff;border-color:#6366f1;box-shadow:0 0 0 4px rgba(99,102,241,0.12)}
        .dark .inp{background:rgba(255,255,255,0.05);border-color:rgba(255,255,255,0.1);color:#f1f5f9}
        .dark .inp::placeholder{color:rgba(148,163,184,0.6)}
        .dark .inp:focus{background:rgba(255,255,255,0.08);border-color:rgba(99,102,241,0.7);box-shadow:0 0 0 4px rgba(99,102,241,0.15)}
        .dark .inp:-webkit-autofill,.dark .inp:-webkit-autofill:focus{
            -webkit-box-shadow:0 0 0 1000px #151c35 inset !important;
            -webkit-text-fill-color:#f1f5f9 !important;caret-color:#f1f5f9
        }
        .inp.err{border-color:#ef4444;box-shadow:0 0 0 4px rgba(239,68,68,0.12)}

        /* ── Button shimmer ── */
        .btn-primary{
            width:100%;padding:14px;border-radius:14px;border:none;
            background:linear-gradient(90deg,#4f46e5,#6366f1,#818cf8,#6366f1,#4f46e5);
            background-size:200% auto;
            animation:shimmer 2.5s linear infinite;
            color:#fff;font-weight:700;font-size:14px;letter-spacing:0.02em;
            cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
            box-shadow:0 8px 24px rgba(99,102,241,0.35);
            transition:transform 0.15s,box-shadow 0.2s,opacity 0.2s;
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 14px 36px rgba(99,102,241,0.5)}
        .btn-primary:active{transform:scale(0.98)}
        .btn-primary:disabled{opacity:0.7;cursor:not-allowed;transform:none}

        .btn-secondary{
            width:100%;padding:13px;border-radius:14px;
            background:transparent;
            border:1.5px solid #e2e8f0;
            color:#475569;font-weight:600;font-size:14px;
            cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;
            transition:all 0.2s;text-decoration:none;
        }
        .btn-secondary:hover{background:#f1f5f9;border-color:#c7d2fe;color:#4338ca}
        .dark .btn-secondary{border-color:rgba(255,255,255,0.1);color:rgba(203,213,225,0.85)}
        .dark .btn-secondary:hover{background:rgba(255,255,255,0.07);border-color:rgba(99,102,241,0.5);color:#a5b4fc}

        /* ── Label ── */
        .lbl{display:block;font-size:11px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#94a3b8;margin-bottom:8px}
        .dark .lbl{color:rgba(148,163,184,0.7)}

        /* ── Divider line ── */
        .divider{height:1px;background:linear-gradient(90deg,transparent,#e2e8f0,transparent)}
        .dark .divider{background:linear-gradient(90deg,transparent,rgba(255,255,255,0.08),transparent)}

        /* ── Badge pill ── */
        .pill{
            display:inline-flex;align-items:center;gap:6px;
            padding:6px 14px;border-radius:999px;
            font-size:10px;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;
            background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.14);
            color:rgba(255,255,255,0.8);backdrop-filter:blur(12px);
        }

        /* ── Shake ── */
        @keyframes shake{0%,100%{transform:translateX(0)}20%{transform:translateX(-6px)}40%{transform:translateX(6px)}60%{transform:translateX(-4px)}80%{transform:translateX(4px)}}
        .shake{animation:shake 0.4s ease}

        /* ── Fade in ── */
        .fi{opacity:0;transform:translateY(16px)}

        /* ── Theme toggle ── */
        .theme-btn{transition:background 0.2s,transform 0.15s}
        .theme-btn:hover{transform:rotate(15deg) scale(1.1)}

        /* ── Stat card ── */
        .stat-card{
            flex:1;text-align:center;padding:20px 12px;
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:16px;
        }

        /* ── Feature row ── */
        .feat{
            display:flex;align-items:center;gap:14px;
            padding:14px 16px;border-radius:14px;
            background:rgba(255,255,255,0.04);
            border:1px solid rgba(255,255,255,0.07);
            transition:background 0.2s;
        }
        .feat:hover{background:rgba(255,255,255,0.07)}

        /* right panel grid pattern */
        .rp-grid{
            position:absolute;inset:0;pointer-events:none;
            background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);
            background-size:48px 48px;
        }
        /* right panel radial vignette */
        .rp-vignette{
            position:absolute;inset:0;pointer-events:none;
            background:radial-gradient(ellipse at center,transparent 30%,rgba(0,0,0,0.4) 100%);
        }

        /* ── Scrollbar ── */
        ::-webkit-scrollbar{width:4px}
        ::-webkit-scrollbar-track{background:transparent}
        ::-webkit-scrollbar-thumb{background:#c7d2fe;border-radius:4px}
        .dark ::-webkit-scrollbar-thumb{background:#3730a3}

        /* Mobile hero banner */
        .mobile-banner{
            background:linear-gradient(135deg,#312e81,#1d4ed8,#1e40af);
            padding:32px 24px 28px;
            display:flex;flex-direction:column;align-items:center;
            text-align:center;gap:10px;
        }
        @media(min-width:1024px){.mobile-banner{display:none}}
    </style>
</head>

<body>
<div class="page">

    <!-- ════════════════════════════════════════════
         MOBILE BANNER — visible only on sm/md
    ════════════════════════════════════════════ -->
    <div class="mobile-banner">
        <div style="width:52px;height:52px;background:rgba(255,255,255,0.15);border-radius:16px;display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.2)">
            <i class="bi bi-car-front-fill" style="font-size:24px;color:#fff"></i>
        </div>
        <div>
            <h1 style="font-size:20px;font-weight:900;color:#fff;margin:0;letter-spacing:-0.02em">V-MARS</h1>
            <p style="font-size:10px;font-weight:600;color:rgba(165,180,252,0.85);margin:4px 0 0;letter-spacing:0.15em;text-transform:uppercase">Vehicle Maintenance &amp; Recording System</p>
        </div>
    </div>

    <!-- ════════════════════════════════════════════
         LEFT PANEL — 1/3 — Login Form
    ════════════════════════════════════════════ -->
    <div class="lp">
        <div class="lp-inner" style="position:relative;z-index:1;display:flex;flex-direction:column;padding:28px 28px 24px;max-width:420px;width:100%;margin:0 auto">
            <!-- ── Top bar ── -->
            <div class="fi" id="el-topbar" style="display:flex;align-items:center;justify-content:space-between;padding-bottom:0;flex-shrink:0">
                <!-- Logo (hidden on mobile since banner covers it) -->
                <div style="display:flex;align-items:center;gap:12px">
                    <div style="width:40px;height:40px;background:linear-gradient(135deg,#6366f1,#4f46e5);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 6px 20px rgba(99,102,241,0.4);flex-shrink:0">
                        <i class="bi bi-car-front-fill" style="font-size:18px;color:#fff"></i>
                    </div>
                    <div class="hidden-mobile-logo">
                        <p style="font-size:16px;font-weight:900;color:#1e293b;margin:0;line-height:1;letter-spacing:-0.01em" class="dark-text-logo">V-MARS</p>
                        <p style="font-size:9px;font-weight:600;color:#94a3b8;margin:3px 0 0;letter-spacing:0.14em;text-transform:uppercase">Vehicle Maintenance & Recording System</p>
                    </div>
                </div>
                <!-- Theme toggle -->
                <button id="theme-toggle" type="button" aria-label="Toggle tema"
                    class="theme-btn"
                    style="width:40px;height:40px;border-radius:12px;border:1.5px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0">
                    <i id="theme-icon" style="font-size:15px"></i>
                </button>
            </div>

            <!-- ── Form section — centered ── -->
            <div style="flex:1;display:flex;flex-direction:column;justify-content:center;padding:28px 0">

                <!-- Heading -->
                <div class="fi" id="el-heading" style="margin-bottom:28px">
                    <span style="display:inline-block;font-size:10px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#6366f1;margin-bottom:8px">Selamat Datang Kembali</span>
                    <h2 id="heading-title" style="font-size:26px;font-weight:900;margin:0 0 8px;line-height:1.2;letter-spacing:-0.02em">Silahkan Login</h2>
                    <p id="heading-sub" style="font-size:13px;margin:0;line-height:1.6">Kelola armada kendaraan Anda dengan cerdas dan efisien.</p>
                </div>

                <!-- Flash error -->
                <?php if (session()->getFlashdata('error')): ?>
                <div class="fi" id="el-error" style="background:#fef2f2;border:1.5px solid #fecaca;border-radius:14px;padding:14px 16px;margin-bottom:20px;display:flex;align-items:flex-start;gap:12px">
                    <div style="width:32px;height:32px;background:#fee2e2;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                        <i class="bi bi-exclamation-triangle-fill" style="font-size:13px;color:#ef4444"></i>
                    </div>
                    <div>
                        <p style="font-size:13px;font-weight:700;color:#b91c1c;margin:0">Login Gagal</p>
                        <p style="font-size:12px;color:#dc2626;margin:3px 0 0"><?= esc(session()->getFlashdata('error')) ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Form -->
                <form action="<?= base_url('auth/login') ?>" method="post" autocomplete="off" novalidate id="el-form" class="fi">
                    <?= csrf_field() ?>
                    <div style="position:absolute;left:-9999px;top:-9999px;visibility:hidden" aria-hidden="true">
                        <input type="text" name="website" tabindex="-1" autocomplete="off" value="">
                    </div>

                    <!-- Username field -->
                    <div style="margin-bottom:16px">
                        <label for="username" class="lbl">Username</label>
                        <div style="position:relative">
                            <span id="ico-user" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:15px;pointer-events:none;transition:color 0.2s">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" id="username" name="username" required
                                maxlength="50" autocomplete="username" spellcheck="false"
                                class="inp" placeholder="Masukkan username">
                        </div>
                        <p id="error-username" style="display:none;margin:6px 0 0;font-size:11px;color:#ef4444;display:none;align-items:center;gap:5px">
                            <i class="bi bi-exclamation-circle-fill"></i> Username tidak boleh kosong
                        </p>
                    </div>

                    <!-- Password field -->
                    <div style="margin-bottom:20px">
                        <label for="password" class="lbl">Password</label>
                        <div style="position:relative">
                            <span id="ico-lock" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:15px;pointer-events:none;transition:color 0.2s">
                                <i class="bi bi-shield-lock-fill"></i>
                            </span>
                            <input type="password" id="password" name="password" required
                                maxlength="100" autocomplete="current-password"
                                class="inp" placeholder="••••••••"
                                style="padding-right:46px">
                            <button type="button" id="toggle-pw"
                                style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;padding:4px;cursor:pointer;color:#94a3b8;transition:color 0.2s;display:flex;align-items:center"
                                aria-label="Tampilkan password">
                                <i class="bi bi-eye-fill" id="eye-icon" style="font-size:15px"></i>
                            </button>
                        </div>
                        <p id="error-password" style="display:none;margin:6px 0 0;font-size:11px;color:#ef4444;align-items:center;gap:5px">
                            <i class="bi bi-exclamation-circle-fill"></i> Password tidak boleh kosong
                        </p>
                    </div>

                    <p style="font-size:11px;color:#94a3b8;margin:0 0 20px;line-height:1.7">
                        Dengan masuk, Anda menyetujui <a href="#" style="color:#6366f1;font-weight:600;text-decoration:none">Syarat Layanan</a> yang berlaku.
                    </p>

                    <!-- Buttons -->
                    <div style="display:flex;flex-direction:column;gap:10px">
                        <button type="submit" id="submit-btn" class="btn-primary">
                            <span id="btn-text">Login</span>
                            <i class="bi bi-arrow-right" id="btn-icon"></i>
                            <svg id="btn-spinner" class="hidden animate-spin" style="width:16px;height:16px;display:none" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </button>
                        <a href="<?= base_url() ?>" class="btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>

            <!-- ── Footer ── -->
            <div class="fi" id="el-footer" style="padding-top:20px;flex-shrink:0">
                <div class="divider" style="margin-bottom:16px"></div>
                <div style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;gap:6px">
                    <p style="font-size:11px;color:#94a3b8;margin:0">2026 &copy; <span id="footer-brand" style="font-weight:700;color:#475569">V-MARS</span></p>
                    <p style="font-size:11px;color:#94a3b8;margin:0">by <a href="https://fajarajikusuma.vercel.app" target="_blank" rel="noopener noreferrer" style="color:#6366f1;font-weight:600;text-decoration:none">Fajar Aji Kusuma, S.Kom.</a></p>
                </div>
            </div>

        </div>
    </div><!-- /lp -->

    <!-- ════════════════════════════════════════════
         RIGHT PANEL — 2/3 — Visual Info
    ════════════════════════════════════════════ -->
    <div class="rp">
        <!-- Grid & vignette overlays -->
        <div class="rp-grid"></div>
        <div class="rp-vignette"></div>

        <!-- Animated orbs -->
        <div class="orb" style="width:600px;height:600px;background:radial-gradient(circle,rgba(99,102,241,0.25),transparent 70%);top:-100px;right:-100px;animation-delay:0s"></div>
        <div class="orb" style="width:500px;height:500px;background:radial-gradient(circle,rgba(79,70,229,0.2),transparent 70%);bottom:-80px;left:-80px;animation-delay:3s"></div>
        <div class="orb" style="width:350px;height:350px;background:radial-gradient(circle,rgba(147,51,234,0.18),transparent 70%);top:40%;left:40%;animation-delay:6s"></div>
        <div class="orb" style="width:250px;height:250px;background:radial-gradient(circle,rgba(59,130,246,0.2),transparent 70%);top:20%;left:20%;animation-delay:2s"></div>

        <!-- Floating particles -->
        <div style="position:absolute;width:6px;height:6px;border-radius:50%;background:rgba(255,255,255,0.3);top:12%;left:18%;animation:floatA 7s ease-in-out infinite;pointer-events:none"></div>
        <div style="position:absolute;width:4px;height:4px;border-radius:50%;background:rgba(165,180,252,0.4);top:30%;left:72%;animation:floatB 9s ease-in-out infinite 1s;pointer-events:none"></div>
        <div style="position:absolute;width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,0.15);top:60%;left:25%;animation:floatC 11s ease-in-out infinite 2s;pointer-events:none"></div>
        <div style="position:absolute;width:5px;height:5px;border-radius:50%;background:rgba(196,181,253,0.35);top:75%;left:65%;animation:floatA 8s ease-in-out infinite 0.5s;pointer-events:none"></div>
        <div style="position:absolute;width:3px;height:3px;border-radius:50%;background:rgba(255,255,255,0.25);top:45%;left:82%;animation:floatB 6s ease-in-out infinite 1.5s;pointer-events:none"></div>
        <div style="position:absolute;width:6px;height:6px;border-radius:50%;background:rgba(129,140,248,0.3);top:88%;left:40%;animation:floatC 10s ease-in-out infinite 3s;pointer-events:none"></div>

        <!-- ── Main content ── -->
        <div style="position:relative;z-index:1;width:100%;max-width:640px;padding:48px 48px;margin:auto;color:#fff">

            <!-- Brand mark -->
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:44px">
                <div class="animate-float-a" style="width:60px;height:60px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.18);border-radius:20px;display:flex;align-items:center;justify-content:center">
                    <i class="bi bi-speedometer2" style="font-size:28px;color:#a5b4fc"></i>
                </div>
                <div>
                    <h2 style="font-size:28px;font-weight:900;color:#fff;margin:0;line-height:1;letter-spacing:-0.02em">V-MARS</h2>
                    <p style="font-size:11px;font-weight:600;color:rgba(165,180,252,0.8);margin:5px 0 0;letter-spacing:0.14em;text-transform:uppercase">Vehicle Maintenance &amp; Recording System</p>
                </div>
            </div>

            <!-- Headline -->
            <div style="margin-bottom:36px">
                <h3 style="font-size:38px;font-weight:900;color:#fff;margin:0 0 14px;line-height:1.15;letter-spacing:-0.025em">
                    Efficient Fleet <span style="background:linear-gradient(90deg,#a5b4fc,#c4b5fd,#93c5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">Management</span>
                </h3>
                <p style="font-size:15px;color:rgba(199,210,254,0.8);margin:0;line-height:1.75;max-width:460px">
                    Optimalkan pemeliharaan kendaraan Anda dengan sistem pencatatan yang cerdas, terintegrasi, dan real-time. Satu platform untuk semua kebutuhan armada.
                </p>
            </div>

            <!-- Feature list -->
            <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:36px">
                <div class="feat">
                    <div style="width:38px;height:38px;flex-shrink:0;background:rgba(99,102,241,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-wrench-adjustable-circle-fill" style="font-size:17px;color:#a5b4fc"></i>
                    </div>
                    <div>
                        <p style="font-size:13px;font-weight:700;color:#fff;margin:0">Scheduled Maintenance</p>
                        <p style="font-size:12px;color:rgba(165,180,252,0.7);margin:3px 0 0">Penjadwalan servis & pemeliharaan otomatis</p>
                    </div>
                </div>
                <div class="feat">
                    <div style="width:38px;height:38px;flex-shrink:0;background:rgba(59,130,246,0.25);border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-journal-richtext" style="font-size:17px;color:#93c5fd"></i>
                    </div>
                    <div>
                        <p style="font-size:13px;font-weight:700;color:#fff;margin:0">Smart Recording</p>
                        <p style="font-size:12px;color:rgba(165,180,252,0.7);margin:3px 0 0">Catatan kendaraan, sopir &amp; pajak terpadu</p>
                    </div>
                </div>
                <div class="feat">
                    <div style="width:38px;height:38px;flex-shrink:0;background:rgba(16,185,129,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center">
                        <i class="bi bi-shield-check" style="font-size:17px;color:#6ee7b7"></i>
                    </div>
                    <div>
                        <p style="font-size:13px;font-weight:700;color:#fff;margin:0">Secure &amp; Real-time</p>
                        <p style="font-size:12px;color:rgba(165,180,252,0.7);margin:3px 0 0">Data aman, akses real-time 24/7</p>
                    </div>
                </div>
            </div>

            <!-- Stats row -->
            <div style="display:flex;gap:12px">
                <div class="stat-card">
                    <p style="font-size:28px;font-weight:900;color:#fff;margin:0;line-height:1">100<span style="font-size:16px;color:#a5b4fc">%</span></p>
                    <p style="font-size:10px;font-weight:600;color:rgba(165,180,252,0.7);margin:6px 0 0;letter-spacing:0.1em;text-transform:uppercase">Akurat</p>
                </div>
                <div class="stat-card">
                    <p style="font-size:28px;font-weight:900;color:#fff;margin:0;line-height:1">24<span style="font-size:16px;color:#a5b4fc">/7</span></p>
                    <p style="font-size:10px;font-weight:600;color:rgba(165,180,252,0.7);margin:6px 0 0;letter-spacing:0.1em;text-transform:uppercase">Tersedia</p>
                </div>
                <div class="stat-card">
                    <p style="font-size:28px;font-weight:900;color:#fff;margin:0;line-height:1">&#x1F6E1;</p>
                    <p style="font-size:10px;font-weight:600;color:rgba(165,180,252,0.7);margin:6px 0 0;letter-spacing:0.1em;text-transform:uppercase">Terlindungi</p>
                </div>
            </div>

            <!-- Status badges -->
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-top:28px">
                <div class="glass" style="display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px">
                    <span style="width:8px;height:8px;background:#34d399;border-radius:50%;display:inline-block;box-shadow:0 0 8px rgba(52,211,153,0.6)"></span>
                    <span style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.8)">Sistem Aktif</span>
                </div>
                <div class="glass" style="display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px">
                    <i class="bi bi-bell-fill" style="font-size:12px;color:#fbbf24"></i>
                    <span style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.8)">Notifikasi Aktif</span>
                </div>
                <div class="glass" style="display:inline-flex;align-items:center;gap:8px;padding:8px 16px;border-radius:12px">
                    <i class="bi bi-lock-fill" style="font-size:12px;color:#a78bfa"></i>
                    <span style="font-size:12px;font-weight:600;color:rgba(255,255,255,0.8)">SSL Secured</span>
                </div>
            </div>

        </div>
    </div><!-- /rp -->

</div><!-- /page -->

<style>
    /* Dark mode overrides for left panel elements */
    .dark .lp{background:#0c0f1d}
    .dark #heading-title{color:#f1f5f9}
    .dark #heading-sub{color:#94a3b8}
    #heading-title{color:#0f172a}
    #heading-sub{color:#64748b}
    .dark #footer-brand{color:#cbd5e1}
    .dark .lbl{color:rgba(148,163,184,0.65)}
    .dark #el-topbar .theme-btn{background:rgba(255,255,255,0.07);border-color:rgba(255,255,255,0.1)}
    .dark #el-topbar .dark-text-logo{color:#f1f5f9 !important}
    .dark .divider{background:linear-gradient(90deg,transparent,rgba(255,255,255,0.07),transparent)}
    .dark #el-error{background:rgba(239,68,68,0.12);border-color:rgba(239,68,68,0.3)}
    .dark #el-error p:first-child{color:#fca5a5}
    .dark #el-error p:last-child{color:#f87171}
    .dark .btn-secondary{color:rgba(203,213,225,0.85);border-color:rgba(255,255,255,0.1)}
    .dark .btn-secondary:hover{background:rgba(255,255,255,0.07);border-color:rgba(99,102,241,0.5);color:#a5b4fc}
    .dark #el-footer p{color:rgba(148,163,184,0.6)}
    .dark #footer-brand{color:#94a3b8}

    /* Hide logo text on mobile (banner handles it) */
    @media(max-width:1023px){
        .hidden-mobile-logo{display:none}
    }
    @media(min-width:1024px){
        .mobile-banner{display:none !important}
    }

    /* Responsive right panel padding */
    @media(min-width:1024px) and (max-width:1279px){
        .rp > div[style*="max-width:640px"]{padding:36px 36px !important}
        .rp h3{font-size:30px !important}
    }
    @media(min-width:1280px){
        .rp > div[style*="max-width:640px"]{padding:56px 60px !important}
    }
</style>

<script>
    /* ── Theme ── */
    const html=document.documentElement;
    const themeBtn=document.getElementById('theme-toggle');
    const themeIcon=document.getElementById('theme-icon');
    const isDark=()=>html.classList.contains('dark');

    function syncIcon(){
        themeIcon.className=isDark()
            ?'bi bi-moon-stars-fill'
            :'bi bi-sun-fill';
        themeIcon.style.color=isDark()?'#a5b4fc':'#f59e0b';
        themeBtn.style.background=isDark()?'rgba(255,255,255,0.07)':'#f8fafc';
        themeBtn.style.borderColor=isDark()?'rgba(255,255,255,0.1)':'#e2e8f0';
    }
    function applyTheme(dark){
        dark?html.classList.add('dark'):html.classList.remove('dark');
        localStorage.setItem('theme',dark?'dark':'light');
        syncIcon();
    }
    syncIcon();
    themeBtn.addEventListener('click',()=>applyTheme(!isDark()));
    window.matchMedia('(prefers-color-scheme:dark)').addEventListener('change',e=>{
        if(!localStorage.getItem('theme'))applyTheme(e.matches);
    });

    /* ── Entrance animations ── */
    const entries=[
        ['el-topbar',0],['el-heading',100],['el-error',60],['el-form',200],['el-footer',320]
    ];
    entries.forEach(([id,delay])=>{
        const el=document.getElementById(id);
        if(!el)return;
        el.style.transition=`opacity 0.6s ease ${delay}ms, transform 0.6s ease ${delay}ms`;
        requestAnimationFrame(()=>setTimeout(()=>{
            el.style.opacity='1';
            el.style.transform='translateY(0)';
        },20));
    });

    /* ── Input icon color on focus ── */
    document.getElementById('username').addEventListener('focus',()=>document.getElementById('ico-user').style.color='#6366f1');
    document.getElementById('username').addEventListener('blur',()=>document.getElementById('ico-user').style.color='#94a3b8');
    document.getElementById('password').addEventListener('focus',()=>document.getElementById('ico-lock').style.color='#6366f1');
    document.getElementById('password').addEventListener('blur',()=>document.getElementById('ico-lock').style.color='#94a3b8');

    /* ── Password toggle ── */
    const pwInput=document.getElementById('password');
    const eyeIcon=document.getElementById('eye-icon');
    document.getElementById('toggle-pw').addEventListener('click',()=>{
        const show=pwInput.type==='password';
        pwInput.type=show?'text':'password';
        eyeIcon.className=show?'bi bi-eye-slash-fill':'bi bi-eye-fill';
    });
    document.getElementById('toggle-pw').addEventListener('mouseenter',()=>document.getElementById('toggle-pw').style.color='#6366f1');
    document.getElementById('toggle-pw').addEventListener('mouseleave',()=>document.getElementById('toggle-pw').style.color='#94a3b8');

    /* ── Validation helpers ── */
    function showError(inputId,errId,show){
        const inp=document.getElementById(inputId);
        const err=document.getElementById(errId);
        if(show){
            inp.classList.add('err');
            err.style.display='flex';
            inp.classList.remove('shake');
            void inp.offsetWidth;
            inp.classList.add('shake');
        } else {
            inp.classList.remove('err','shake');
            err.style.display='none';
        }
    }
    document.getElementById('username').addEventListener('input',function(){if(this.value.trim())showError('username','error-username',false);});
    document.getElementById('password').addEventListener('input',function(){if(this.value)showError('password','error-password',false);});

    /* ── Form submit ── */
    const form=document.getElementById('el-form');
    const submitBtn=document.getElementById('submit-btn');
    const btnText=document.getElementById('btn-text');
    const btnIcon=document.getElementById('btn-icon');
    const btnSpinner=document.getElementById('btn-spinner');

    form.addEventListener('submit',function(e){
        const hp=this.querySelector('input[name="website"]');
        if(hp&&hp.value){e.preventDefault();return;}
        const u=document.getElementById('username').value.trim();
        const p=document.getElementById('password').value;
        let hasErr=false;
        if(!u){showError('username','error-username',true);hasErr=true;}
        if(!p){showError('password','error-password',true);hasErr=true;}
        if(hasErr){
            e.preventDefault();
            (!u?document.getElementById('username'):document.getElementById('password')).focus();
            return;
        }
        submitBtn.disabled=true;
        btnText.textContent='Memproses...';
        btnIcon.style.display='none';
        btnSpinner.style.display='block';
    });
</script>
</body>
</html>
