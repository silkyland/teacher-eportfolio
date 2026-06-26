<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-800">แก้ไขรางวัล</h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('awards.update', $award) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            @include('awards._form', ['award' => $award])
            <div class="flex gap-3">
                <x-primary-button class="!bg-sky-600 hover:!bg-sky-700">อัปเดต</x-primary-button>
                <a href="{{ route('awards.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-md text-sm">ยกเลิก</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
