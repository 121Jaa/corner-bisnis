@if (session('success'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="flex items-start gap-3 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 text-green-800 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm mb-4">
    <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
    <span class="flex-1">{{ session('success') }}</span>
    <button @click="show = false" class="text-green-500 hover:text-green-700">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

@if (session('error'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="flex items-start gap-3 bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 text-red-800 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm mb-4">
    <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
    <span class="flex-1">{{ session('error') }}</span>
    <button @click="show = false" class="text-red-500 hover:text-red-700">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

@if (session('warning'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="flex items-start gap-3 bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 text-yellow-800 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm mb-4">
    <i class="fas fa-exclamation-triangle text-yellow-500 mt-0.5"></i>
    <span class="flex-1">{{ session('warning') }}</span>
    <button @click="show = false" class="text-yellow-500 hover:text-yellow-700">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif

@if (session('info'))
<div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
    class="flex items-start gap-3 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 text-blue-800 px-4 py-3.5 rounded-2xl text-sm font-medium shadow-sm mb-4">
    <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
    <span class="flex-1">{{ session('info') }}</span>
    <button @click="show = false" class="text-blue-500 hover:text-blue-700">
        <i class="fas fa-times text-xs"></i>
    </button>
</div>
@endif