@props([
    'name' => 'file',
    'label' => 'ไฟล์แนบ (PDF/JPG/PNG สูงสุด 10MB)',
    'currentUrl' => null,
    'currentName' => null,
    'showRemove' => false,
])

<div>
    <x-input-label :for="$name" :value="$label" />
    <div class="mt-1 flex items-center justify-center w-full">
        <label for="{{ $name }}" class="flex flex-col items-center justify-center w-full h-32 border-2 border-sky-200 border-dashed rounded-xl cursor-pointer bg-sky-50/50 hover:bg-sky-50 transition">
            <div class="flex flex-col items-center justify-center pt-5 pb-6 px-4 text-center">
                <svg class="w-8 h-8 mb-2 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                </svg>
                <p class="text-sm text-slate-600"><span class="font-semibold text-sky-700">คลิกเพื่อเลือกไฟล์</span> หรือลากไฟล์มาวาง</p>
                <p class="text-xs text-slate-500 mt-1">PDF, JPG, PNG (สูงสุด 10MB)</p>
            </div>
            <input id="{{ $name }}" name="{{ $name }}" type="file" accept=".pdf,.jpg,.jpeg,.png" class="hidden" />
        </label>
    </div>

    @if($currentUrl)
        <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
            <span class="text-slate-500">ไฟล์ปัจจุบัน:</span>
            <a href="{{ $currentUrl }}" target="_blank" class="inline-flex items-center gap-1 text-sky-600 hover:text-sky-800 font-medium">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-6.586 6.586a6 6 0 108.486 8.486L20.5 13"/></svg>
                {{ $currentName ?? 'เปิดดูไฟล์' }}
            </a>
            @if($showRemove)
                <label class="inline-flex items-center gap-2 text-red-600">
                    <input type="checkbox" name="remove_file" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                    ลบไฟล์เดิม
                </label>
            @endif
        </div>
    @endif

    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
