{{-- Icon --}}
<div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-500/20 border-2 border-blue-400/30 mb-8">
    <i class="fas fa-clock text-blue-400 text-4xl"></i>
</div>

{{-- Angka --}}
<h1 class="font-serif text-8xl lg:text-9xl font-bold text-blue-400 mb-2">419</h1>

{{-- Title --}}
<h2 class="font-serif text-3xl lg:text-4xl font-bold text-white mb-4">
    Sesi Udah Kadaluarsa
</h2>

{{-- Description --}}
<p class="text-white/60 mb-8 leading-relaxed">
    Sesi kamu udah expired karena kelamaan idle. Coba login ulang ya.
</p>

{{-- Button --}}
<a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-yellow-400 to-yellow-600 text-[#2B0F1A] font-bold px-6 py-3 rounded-full hover:opacity-90 transition shadow-lg">
    <i class="fas fa-sign-in-alt"></i>
    <span>Login Ulang</span>
</a>