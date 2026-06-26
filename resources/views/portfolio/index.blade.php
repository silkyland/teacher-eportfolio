<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-sky-800">แฟ้มผลงาน (e-Portfolio)</h2>
            <a href="{{ route('portfolio.pdf') }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition">
                ส่งออก PDF
            </a>
        </div>
    </x-slot>

    <div class="bg-gradient-to-br from-sky-700 to-blue-800 rounded-2xl text-white p-8 mb-8 shadow-lg">
        <p class="text-sky-200 text-sm mb-1">แฟ้มสะสมผลงาน</p>
        <h1 class="text-3xl font-bold mb-4">{{ $user->name }}</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-sm text-sky-100">
            <p><span class="text-sky-300">ตำแหน่ง:</span> {{ $user->position ?? '-' }}</p>
            <p><span class="text-sky-300">สถานศึกษา:</span> {{ $user->school ?? '-' }}</p>
            <p><span class="text-sky-300">กลุ่มสาระ:</span> {{ $user->subject_group ?? '-' }}</p>
            <p><span class="text-sky-300">วิทยฐานะ:</span> {{ $user->academic_standing ?? '-' }}</p>
            <p><span class="text-sky-300">อีเมล:</span> {{ $user->email }}</p>
            <p><span class="text-sky-300">โทรศัพท์:</span> {{ $user->phone ?? '-' }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <x-card title="เกียรติบัตรการอบรม ({{ $certificates->count() }})">
            <div class="space-y-4">
                @forelse ($certificates as $certificate)
                    <div class="border border-sky-50 rounded-lg p-4 hover:border-sky-200 transition">
                        <h4 class="font-semibold text-sky-900">{{ $certificate->title }}</h4>
                        <p class="text-sm text-slate-600 mt-1">{{ $certificate->organizer ?? '-' }}</p>
                        <div class="flex flex-wrap gap-2 mt-2 text-xs">
                            @if($certificate->category)
                                <span class="px-2 py-1 bg-sky-50 text-sky-700 rounded">{{ $certificate->category->name }}</span>
                            @endif
                            <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded">{{ $certificate->training_hours }} ชม.</span>
                            @if($certificate->format)
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded">{{ $certificate->format }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">ยังไม่มีเกียรติบัตร</p>
                @endforelse
            </div>
        </x-card>

        <x-card title="รางวัล ({{ $awards->count() }})">
            <div class="space-y-4">
                @forelse ($awards as $award)
                    <div class="border border-orange-50 rounded-lg p-4 hover:border-orange-200 transition">
                        <h4 class="font-semibold text-sky-900">{{ $award->title }}</h4>
                        <p class="text-sm text-slate-600 mt-1">{{ $award->awarding_organization ?? '-' }}</p>
                        <div class="flex flex-wrap gap-2 mt-2 text-xs">
                            <span class="px-2 py-1 bg-orange-50 text-orange-700 rounded">{{ $award->level_label }}</span>
                            @if($award->award_date)
                                <span class="px-2 py-1 bg-slate-100 text-slate-700 rounded">{{ $award->award_date->format('d/m/Y') }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm">ยังไม่มีรางวัล</p>
                @endforelse
            </div>
        </x-card>
    </div>
</x-app-layout>
