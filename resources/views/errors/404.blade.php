<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#2B0F1A] via-[#4A1E2B] to-[#7A384D] flex items-center justify-center p-6 relative overflow-hidden">

    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(circle, #ffffff 1px, transparent 1px); background-size: 24px 24px;"></div>
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-yellow-500/20 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-yellow-500/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 text-center max-w-lg">
        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-yellow-500/20 border-2 border-yellow-400/30 mb-8">
            <i class="fas fa-compass text-yellow-400 text-4xl"></i>
        </div>

        <h1 class="font-serif text-8xl lg:text-9xl font-bold text-yellow-400 mb-2">404</h1>

        <h2 class="font-serif text-3xl lg:text-4xl font-bold text-white mb-4">
            Halaman Tidak Ditemukan
        </h2>

        <p class="text-white/60 mb-8 leading-relaxed">
            Sepertinya halaman yang kamu cari udah pindah, kehapus, atau gak pernah ada. Coba balik ke beranda ya.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="/" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-[#2B0F1A] font-bold px-6 py-3 rounded-full hover:opacity-90 transition shadow-lg">
                <i class="fas fa-home"></i>
                <span>Balik ke Beranda</span>
            </a>
            <button onclick="history.back()" class="inline-flex items-center justify-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white font-bold px-6 py-3 rounded-full hover:bg-white/20 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </button>
        </div>

        <p class="text-xs text-white/30 mt-12">
            &copy; {{ date('Y') }} RT 04 Ngijo · Corner Bisnis
        </p>
    </div>

</body>
</html>