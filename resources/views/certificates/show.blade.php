<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-sky-800">รายละเอียดเกียรติบัตร</h2>
            <a href="{{ route('certificates.edit', $certificate) }}" class="text-sm text-orange-600 hover:underline">แก้ไข</a>
        </div>
    </x-slot>

    <x-card>
        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
            <div><dt class="text-slate-500">ชื่อหลักสูตร</dt><dd class="font-medium text-lg mt-1">{{ $certificate->title }}</dd></div>
            <div><dt class="text-slate-500">หน่วยงาน</dt><dd class="mt-1">{{ $certificate->organizer ?? '-' }}</dd></div>
            <div><dt class="text-slate-500">หมวดหมู่</dt><dd class="mt-1">{{ $certificate->category?->name ?? '-' }}</dd></div>
            <div><dt class="text-slate-500">ชั่วโมงอบรม</dt><dd class="mt-1">{{ $certificate->training_hours }} ชั่วโมง</dd></div>
            <div><dt class="text-slate-500">รูปแบบ</dt><dd class="mt-1">{{ $certificate->format ?? '-' }}</dd></div>
            <div><dt class="text-slate-500">ช่วงวันที่</dt><dd class="mt-1">
                @if($certificate->start_date)
                    {{ $certificate->start_date->format('d/m/Y') }}
                    @if($certificate->end_date) - {{ $certificate->end_date->format('d/m/Y') }} @endif
                @else - @endif
            </dd></div>
            <div class="md:col-span-2"><dt class="text-slate-500">รายละเอียด</dt><dd class="mt-1 whitespace-pre-line">{{ $certificate->description ?? '-' }}</dd></div>
            <div class="md:col-span-2">
                <dt class="text-slate-500">ไฟล์แนบ</dt>
                <dd class="mt-1">
                    @if($certificate->file_path)
                        <a href="{{ $certificate->file_url }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-sky-50 text-sky-700 rounded-lg hover:bg-sky-100">เปิดดูไฟล์</a>
                    @else
                        -
                    @endif
                </dd>
            </div>
        </dl>
        <div class="mt-6">
            <a href="{{ route('certificates.index') }}" class="text-sky-600 hover:underline text-sm">← กลับรายการ</a>
        </div>
    </x-card>
</x-app-layout>
