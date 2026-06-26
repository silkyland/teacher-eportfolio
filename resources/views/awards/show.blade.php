<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-sky-800">รายละเอียดรางวัล</h2>
            <a href="{{ route('awards.edit', $award) }}" class="text-sm text-orange-600 hover:underline">แก้ไข</a>
        </div>
    </x-slot>

    <x-card>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><dt class="text-slate-500">ชื่อรางวัล</dt><dd class="font-medium text-lg mt-1">{{ $award->title }}</dd></div>
            <div><dt class="text-slate-500">หน่วยงาน</dt><dd class="mt-1">{{ $award->awarding_organization ?? '-' }}</dd></div>
            <div><dt class="text-slate-500">ระดับ</dt><dd class="mt-1"><span class="inline-flex px-2 py-1 rounded-full bg-orange-50 text-orange-700">{{ $award->level_label }}</span></dd></div>
            <div><dt class="text-slate-500">วันที่ได้รับ</dt><dd class="mt-1">{{ $award->award_date?->format('d/m/Y') ?? '-' }}</dd></div>
            <div class="md:col-span-2"><dt class="text-slate-500">รายละเอียด</dt><dd class="mt-1 whitespace-pre-line">{{ $award->description ?? '-' }}</dd></div>
            <x-attachment-preview :item="$award" :edit-url="route('awards.edit', $award)" />
        </dl>
        <div class="mt-6"><a href="{{ route('awards.index') }}" class="text-sky-600 hover:underline text-sm">← กลับรายการ</a></div>
    </x-card>
</x-app-layout>
