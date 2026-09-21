@props([
    'status',
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'flex items-start gap-3 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm']) }}>
        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
        <span>{{ $status }}</span>
    </div>
@endif