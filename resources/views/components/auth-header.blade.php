@props([
    'title',
    'description',
])

<div class="flex w-full flex-col text-left mb-7">
    <div class="inline-flex items-center gap-2 mb-3">
        <span class="w-6 h-px bg-gradient-to-r from-[#7A384D] to-transparent"></span>
        <p class="text-[10px] uppercase tracking-[0.35em] text-[#7A384D] font-bold">Akun</p>
    </div>
    <h1 class="font-serif text-3xl lg:text-[2.25rem] font-bold text-[#4a1e2b] leading-tight">{{ $title }}</h1>
    <p class="text-sm text-gray-500 mt-3 leading-relaxed">{{ $description }}</p>
</div>