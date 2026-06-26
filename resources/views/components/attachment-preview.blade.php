@props(['item', 'editUrl'])

<div class="md:col-span-2">
    <dt class="text-slate-500">ไฟล์แนบ</dt>
    <dd class="mt-2">
        @if($item->hasAttachment())
            <div class="space-y-3">
                <x-attachment-link :url="$item->file_url" :name="$item->display_name" size="md" />
                @if($item->isImage())
                    <img src="{{ $item->file_url }}" alt="{{ $item->display_name }}" class="max-h-64 rounded-lg border border-slate-200 shadow-sm">
                @endif
            </div>
        @else
            <span class="text-slate-500">ยังไม่มีไฟล์แนบ — <a href="{{ $editUrl }}" class="text-sky-600 hover:underline">เพิ่มไฟล์</a></span>
        @endif
    </dd>
</div>
