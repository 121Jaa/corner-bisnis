<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Login' }} - RT 04 Ngijo</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;0,900;1,400;1,600&family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance

    <style>
        /* ===== CUSTOM ANIMATIONS ===== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -200% center;
            }

            100% {
                background-position: 200% center;
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                opacity: 0.4;
            }

            50% {
                opacity: 0.7;
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .animate-fadeInLeft {
            animation: fadeInLeft 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        /* ===== GLASSMORPHISM ===== */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* ===== SHIMMER BUTTON ===== */
        .btn-shimmer {
            position: relative;
            overflow: hidden;
        }

        .btn-shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg,
                    transparent 0%,
                    rgba(255, 255, 255, 0.3) 50%,
                    transparent 100%);
            background-size: 200% 100%;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-shimmer:hover::after {
            opacity: 1;
            animation: shimmer 1.5s linear infinite;
        }

        /* ===== INPUT FOCUS GLOW ===== */
        .input-glow:focus-within {
            box-shadow: 0 0 0 4px rgba(122, 56, 77, 0.1);
        }
    </style>
</head>

<body class="min-h-screen bg-[#F8F4F0] antialiased overflow-x-hidden">

    <div class="min-h-screen flex flex-col lg:flex-row">

        {{-- ==========================================
             LEFT SIDE: BRANDING & VISUAL
             ========================================== --}}
        <div class="lg:w-1/2 relative overflow-hidden flex items-center justify-center p-8 lg:p-16 order-2 lg:order-1 bg-gradient-to-br from-[#1A0810] via-[#2B0F1A] to-[#4A1E2B]">

            {{-- Animated Background Layer --}}
            <div class="absolute inset-0">
                {{-- Gradient orbs --}}
                <div class="absolute top-0 -left-32 w-[500px] h-[500px] bg-gradient-to-br from-yellow-500/30 to-transparent rounded-full blur-[100px] animate-pulse-glow"></div>
                <div class="absolute bottom-0 -right-32 w-[500px] h-[500px] bg-gradient-to-tl from-[#7A384D]/40 to-transparent rounded-full blur-[100px] animate-pulse-glow" style="animation-delay: 2s;"></div>
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-yellow-400/10 to-transparent rounded-full blur-[120px] animate-float"></div>

                {{-- Dot pattern --}}
                <div class="absolute inset-0 opacity-[0.15]" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 28px 28px;"></div>

                {{-- Grid overlay --}}
                <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 60px 60px;"></div>
            </div>

            {{-- Content --}}
            <div class="relative z-10 text-center lg:text-left max-w-lg w-full">

                {{-- Floating Logo Badge --}}
                <div class="animate-fadeInLeft inline-flex items-center gap-4 mb-10 px-5 py-3 rounded-2xl bg-white/5 backdrop-blur-xl border border-white/10 shadow-2xl">
                    <div class="relative">
                        <div class="absolute inset-0 bg-yellow-400 rounded-xl blur-lg opacity-60"></div>
                        <div class="relative w-12 h-12 rounded-xl bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                            <svg class="w-7 h-7 text-[#2B0F1A]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10v11m18-11v11M9 10V7m3 3V7m3 3V7" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-left">
                        <h1 class="font-serif text-xl lg:text-2xl font-bold text-white tracking-wide">RT 04 NGIJO</h1>
                        <p class="text-[10px] uppercase tracking-[0.35em] text-yellow-400/80 font-semibold">Corner Bisnis</p>
                    </div>
                </div>

                {{-- Headline --}}
                <h2 class="animate-fadeInLeft delay-100 font-serif text-3xl lg:text-6xl font-bold text-white mb-6 leading-[1.1]">
                    Selamat Datang<br>
                    <span class="italic bg-gradient-to-r from-amber-200 via-yellow-300 to-amber-500 bg-clip-text text-transparent">Kembali</span>
                </h2>

                <p class="animate-fadeInLeft delay-200 text-sm lg:text-base text-white/60 leading-relaxed mb-10 max-w-md">
                    Satu platform untuk mengelola semua usaha warga RT 04 Ngijo. Rapi, modern, dan mudah diakses.
                </p>

                {{-- Feature Cards --}}
                <div class="animate-fadeInLeft delay-300 hidden lg:grid grid-cols-1 gap-3 max-w-md">
                    <div class="group flex items-center gap-3 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 hover:border-yellow-400/30 transition-all duration-300">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 border border-yellow-400/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-store text-yellow-400 text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80 font-medium">Kelola data usaha dengan mudah</span>
                    </div>
                    <div class="group flex items-center gap-3 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 hover:border-yellow-400/30 transition-all duration-300">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 border border-yellow-400/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80 font-medium">Promosi produk & testimoni warga</span>
                    </div>
                    <div class="group flex items-center gap-3 p-3 rounded-xl bg-white/5 backdrop-blur-sm border border-white/10 hover:bg-white/10 hover:border-yellow-400/30 transition-all duration-300">
                        <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-yellow-400/20 to-yellow-600/20 border border-yellow-400/30 flex items-center justify-center shrink-0 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chart-line text-yellow-400 text-sm"></i>
                        </div>
                        <span class="text-sm text-white/80 font-medium">Statistik & laporan real-time</span>
                    </div>
                </div>

                {{-- Decorative Element --}}
                <div class="animate-fadeInLeft delay-400 hidden lg:flex items-center gap-3 mt-10 text-white/40 text-xs">
                    <div class="w-12 h-px bg-gradient-to-r from-transparent to-white/30"></div>
                    <span class="uppercase tracking-[0.3em] font-semibold">Est. 2024</span>
                    <div class="w-12 h-px bg-gradient-to-l from-transparent to-white/30"></div>
                </div>
            </div>
        </div>

        {{-- ==========================================
             RIGHT SIDE: FORM
             ========================================== --}}
        <div class="lg:w-1/2 flex items-center justify-center p-5 sm:p-8 lg:p-16 order-1 lg:order-2 relative">

            {{-- Subtle background pattern --}}
            <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle, #4A1E2B 1px, transparent 1px); background-size: 32px 32px;"></div>

            <div class="w-full max-w-md relative">

                {{-- Mobile Logo --}}
                <div class="animate-fadeInUp lg:hidden flex items-center justify-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#4A1E2B] to-[#7A384D] flex items-center justify-center shadow-lg">
                        <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10v11m18-11v11M9 10V7m3 3V7m3 3V7" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-serif text-xl font-bold text-[#4A1E2B]">RT 04 NGIJO</h1>
                        <p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 font-semibold">Corner Bisnis</p>
                    </div>
                </div>

                {{-- Card Form --}}
                <div class="animate-fadeInUp delay-200 glass-card rounded-3xl shadow-[0_25px_60px_-15px_rgba(74,30,43,0.25)] p-7 sm:p-10 border border-white/60 relative overflow-hidden">

                    {{-- Top accent bar --}}
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#4A1E2B] via-yellow-500 to-[#7A384D]"></div>

                    {{-- Decorative corner --}}
                    <div class="absolute -top-12 -right-12 w-32 h-32 bg-gradient-to-br from-yellow-400/10 to-transparent rounded-full blur-2xl"></div>

                    <div class="relative">
                        {{ $slot }}
                    </div>
                </div>

                {{-- Footer --}}
                <div class="animate-fadeInUp delay-400 text-center mt-8">
                    <p class="text-xs text-gray-400 font-medium">
                        &copy; {{ date('Y') }} <span class="font-semibold text-[#4A1E2B]">RT 04 Ngijo</span> · Corner Bisnis
                    </p>
                    <p class="text-[10px] text-gray-300 mt-1 uppercase tracking-[0.2em]">Made with <i class="fas fa-heart text-red-400 mx-0.5"></i> for our community</p>
                </div>
            </div>
        </div>
    </div>

    @fluxScripts
</body>

</html>