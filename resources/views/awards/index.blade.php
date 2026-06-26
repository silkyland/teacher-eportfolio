<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-semibold text-xl text-sky-800">รางวัล</h2>
            <a href="{{ route('awards.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium rounded-lg transition">
                + เพิ่มรางวัล
            </a>
        </div>
    </x-slot>

    <x-card>
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div>
                <x-input-label value="ค้นหา" />
                <x-text-input name="search" class="mt-1 block w-full" :value="request('search')" placeholder="ชื่อรางวัล, หน่วยงาน..." />
            </div>
            <div>
                <x-input-label value="ปี" />
                <select name="year" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    <option value="">ทั้งหมด</option>
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected(request('year') == $year)>{{ $year }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-input-label value="ระดับรางวัล" />
                <select name="level" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
                    <option value="">ทั้งหมด</option>
                    @foreach ($levels as $value => $label)
                        <option value="{{ $value }}" @selected(request('level') == $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg text-sm">กรอง</button>
                <a href="{{ route('awards.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm">ล้าง</a>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-sky-50">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">ชื่อรางวัล</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">หน่วยงาน</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">ระดับ</th>
                        <th class="px-4 py-3 text-left font-semibold text-sky-900">วันที่ได้รับ</th>
                        <th class="px-4 py-3 text-right font-semibold text-sky-900">จัดการ</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($awards as $award)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-medium">{{ $award->title }}</td>
                            <td class="px-4 py-3">{{ $award->awarding_organization ?? '-' }}</td>
                            <td class="px-4 py-3"><span class="inline-flex px-2 py-1 rounded-full bg-orange-50 text-orange-700 text-xs">{{ $award->level_label }}</span></td>
                            <td class="px-4 py-3">{{ $award->award_date?->format('d/m/Y') ?? '-' }}</td>
                            <td class="px-4 py-3 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('awards.show', $award) }}" class="text-sky-600 hover:underline">ดู</a>
                                <a href="{{ route('awards.edit', $award) }}" class="text-orange-600 hover:underline">แก้ไข</a>
                                <form action="{{ route('awards.destroy', $award) }}" method="POST" class="inline" onsubmit="return confirm('ยืนยันการลบ?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">ยังไม่มีรางวัล</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">{{ $awards->links() }}</div>
    </x-card>
</x-app-layout>
