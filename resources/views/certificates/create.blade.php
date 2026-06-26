<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-800">เพิ่มเกียรติบัตร</h2>
    </x-slot>

    <x-card>
        <form method="POST" action="{{ route('certificates.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @include('certificates._form')
            <div class="flex gap-3">
                <x-primary-button class="!bg-sky-600 hover:!bg-sky-700">บันทึก</x-primary-button>
                <a href="{{ route('certificates.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 rounded-md text-sm">ยกเลิก</a>
            </div>
        </form>
    </x-card>
</x-app-layout>
