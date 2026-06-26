@props(['title' => ''])

<div class="bg-white rounded-xl shadow-sm border border-sky-100 overflow-hidden">
    @if($title)
        <div class="px-6 py-4 border-b border-sky-50 bg-sky-50/50">
            <h3 class="font-semibold text-sky-800">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>
