<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#F8F4F0] min-h-screen flex items-center justify-center p-6">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 text-center">
        <div class="w-20 h-20 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-lock text-3xl text-red-500"></i>
        </div>

        <h1 class="font-serif text-6xl font-bold text-[#4a1e2b]">403</h1>
        <h2 class="font-serif text-2xl font-bold text-gray-900 mt-2">Akses Ditolak</h2>

        <p class="text-gray-600 mt-4">
            {{ $exception->getMessage() ?: 'Kamu tidak punya akses ke halaman ini.' }}
        </p>

        <div class="mt-8 flex flex-col gap-3">
            <a href="{{ auth()->check() && auth()->user()->isAdmin() ? route('dashboard') : route('user.dashboard') }}"
               class="inline-block bg-gradient-to-r from-[#4a1e2b] to-[#7A384D] text-white py-3 px-6 rounded-xl font-bold hover:opacity-90 transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
            <a href="/" class="text-gray-500 text-sm hover:text-gray-900 transition">
                Atau kembali ke Halaman Utama
            </a>
        </div>
    </div>

</body>
</html>