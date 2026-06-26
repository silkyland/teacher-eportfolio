<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-800 leading-tight">แดชบอร์ดสรุปผล</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <p class="text-sm text-slate-500">จำนวนเกียรติบัตร</p>
            <p class="text-3xl font-bold text-sky-700 mt-2">{{ number_format($certificateCount) }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <p class="text-sm text-slate-500">ชั่วโมงอบรมรวม</p>
            <p class="text-3xl font-bold text-sky-700 mt-2">{{ number_format($totalHours) }} <span class="text-base font-normal">ชม.</span></p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <p class="text-sm text-slate-500">จำนวนรางวัล</p>
            <p class="text-3xl font-bold text-orange-500 mt-2">{{ number_format($awardCount) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <h3 class="font-semibold text-sky-800 mb-4">รางวัลแยกตามระดับ</h3>
            <canvas id="awardsChart" height="200"></canvas>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <h3 class="font-semibold text-sky-800 mb-4">ชั่วโมงอบรมรายปี</h3>
            <canvas id="hoursChart" height="200"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-sky-800">เกียรติบัตรล่าสุด</h3>
                <a href="{{ route('certificates.index') }}" class="text-sm text-sky-600 hover:text-sky-800">ดูทั้งหมด</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse ($recentCertificates as $certificate)
                    <li class="py-3">
                        <a href="{{ route('certificates.show', $certificate) }}" class="font-medium text-slate-800 hover:text-sky-700">{{ $certificate->title }}</a>
                        <p class="text-sm text-slate-500">{{ $certificate->organizer ?? '-' }} · {{ $certificate->training_hours }} ชม.</p>
                    </li>
                @empty
                    <li class="py-3 text-slate-500 text-sm">ยังไม่มีข้อมูล</li>
                @endforelse
            </ul>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-sky-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-sky-800">รางวัลล่าสุด</h3>
                <a href="{{ route('awards.index') }}" class="text-sm text-sky-600 hover:text-sky-800">ดูทั้งหมด</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse ($recentAwards as $award)
                    <li class="py-3">
                        <a href="{{ route('awards.show', $award) }}" class="font-medium text-slate-800 hover:text-sky-700">{{ $award->title }}</a>
                        <p class="text-sm text-slate-500">{{ $award->level_label }} · {{ $award->award_date?->format('d/m/Y') ?? '-' }}</p>
                    </li>
                @empty
                    <li class="py-3 text-slate-500 text-sm">ยังไม่มีข้อมูล</li>
                @endforelse
            </ul>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const awardLabels = @json($awardsByLevel->keys()->values());
            const awardData = @json($awardsByLevel->values());
            const hourLabels = @json($hoursByYear->keys()->values());
            const hourData = @json($hoursByYear->values());

            if (awardLabels.length) {
                new Chart(document.getElementById('awardsChart'), {
                    type: 'doughnut',
                    data: {
                        labels: awardLabels,
                        datasets: [{
                            data: awardData,
                            backgroundColor: ['#0ea5e9', '#38bdf8', '#f97316', '#0284c7', '#7dd3fc', '#fb923c'],
                        }]
                    },
                    options: { plugins: { legend: { position: 'bottom' } } }
                });
            }

            if (hourLabels.length) {
                new Chart(document.getElementById('hoursChart'), {
                    type: 'bar',
                    data: {
                        labels: hourLabels,
                        datasets: [{
                            label: 'ชั่วโมง',
                            data: hourData,
                            backgroundColor: '#0ea5e9',
                            borderRadius: 6,
                        }]
                    },
                    options: {
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }
        </script>
    @endpush
</x-app-layout>
