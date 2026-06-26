@props(['url', 'name' => null, 'size' => 'sm'])

@php
$classes = $size === 'sm'
    ? 'inline-flex items-center gap-1 px-2 py-1 rounded-md bg-sky-50 text-sky-700 hover:bg-sky-100 text-xs font-medium'
    : 'inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-sky-50 text-sky-700 hover:bg-sky-100 text-sm font-medium';
@endphp

<a href="{{ $url }}" target="_blank" {{ $attributes->merge(['class' => $classes]) }}>
    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-6.586 6.586a6 6 0 108.486 8.486L20.5 13"/></svg>
    <span class="truncate max-w-[160px]">{{ $name ?? 'ไฟล์แนบ' }}</span>
</a>
