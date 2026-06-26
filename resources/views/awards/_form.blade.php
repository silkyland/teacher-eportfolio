@php
    $award = $award ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <x-input-label for="title" value="ชื่อรางวัล *" />
        <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $award?->title)" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="awarding_organization" value="หน่วยงานที่มอบ" />
        <x-text-input id="awarding_organization" name="awarding_organization" class="mt-1 block w-full" :value="old('awarding_organization', $award?->awarding_organization)" />
        <x-input-error :messages="$errors->get('awarding_organization')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="level" value="ระดับรางวัล *" />
        <select id="level" name="level" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500" required>
            <option value="">-- เลือกระดับ --</option>
            @foreach ($levels as $value => $label)
                <option value="{{ $value }}" @selected(old('level', $award?->level?->value) == $value)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('level')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="award_date" value="วันที่ได้รับรางวัล" />
        <x-text-input id="award_date" name="award_date" type="date" class="mt-1 block w-full" :value="old('award_date', $award?->award_date?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('award_date')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="description" value="รายละเอียด" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">{{ old('description', $award?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="file" value="ไฟล์แนบ (PDF/JPG/PNG สูงสุด 5MB)" />
        <input id="file" name="file" type="file" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-slate-600" />
        @if($award?->file_path)
            <p class="mt-2 text-sm text-slate-600">
                ไฟล์ปัจจุบัน: <a href="{{ $award->file_url }}" target="_blank" class="text-sky-600 hover:underline">เปิดดู</a>
            </p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_file" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                ลบไฟล์เดิม
            </label>
        @endif
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
    </div>
</div>
