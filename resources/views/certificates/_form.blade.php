@php
    $certificate = $certificate ?? null;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <x-input-label for="title" value="ชื่อหลักสูตร/การอบรม *" />
        <x-text-input id="title" name="title" class="mt-1 block w-full" :value="old('title', $certificate?->title)" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="organizer" value="หน่วยงานที่จัด" />
        <x-text-input id="organizer" name="organizer" class="mt-1 block w-full" :value="old('organizer', $certificate?->organizer)" />
        <x-input-error :messages="$errors->get('organizer')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category_id" value="หมวดหมู่" />
        <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
            <option value="">-- เลือกหมวดหมู่ --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $certificate?->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="training_hours" value="จำนวนชั่วโมง" />
        <x-text-input id="training_hours" name="training_hours" type="number" min="0" class="mt-1 block w-full" :value="old('training_hours', $certificate?->training_hours ?? 0)" />
        <x-input-error :messages="$errors->get('training_hours')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="format" value="รูปแบบ" />
        <select id="format" name="format" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">
            <option value="">-- เลือกรูปแบบ --</option>
            <option value="ออนไลน์" @selected(old('format', $certificate?->format) === 'ออนไลน์')>ออนไลน์</option>
            <option value="ในสถานที่" @selected(old('format', $certificate?->format) === 'ในสถานที่')>ในสถานที่</option>
        </select>
        <x-input-error :messages="$errors->get('format')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="start_date" value="วันเริ่มอบรม" />
        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" :value="old('start_date', $certificate?->start_date?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="end_date" value="วันสิ้นสุดอบรม" />
        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" :value="old('end_date', $certificate?->end_date?->format('Y-m-d'))" />
        <x-input-error :messages="$errors->get('end_date')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="description" value="รายละเอียด" />
        <textarea id="description" name="description" rows="4" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-sky-500 focus:ring-sky-500">{{ old('description', $certificate?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="md:col-span-2">
        <x-input-label for="file" value="ไฟล์แนบ (PDF/JPG/PNG สูงสุด 5MB)" />
        <input id="file" name="file" type="file" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-slate-600" />
        @if($certificate?->file_path)
            <p class="mt-2 text-sm text-slate-600">
                ไฟล์ปัจจุบัน: <a href="{{ $certificate->file_url }}" target="_blank" class="text-sky-600 hover:underline">เปิดดู</a>
            </p>
            <label class="mt-2 inline-flex items-center gap-2 text-sm text-red-600">
                <input type="checkbox" name="remove_file" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500">
                ลบไฟล์เดิม
            </label>
        @endif
        <x-input-error :messages="$errors->get('file')" class="mt-2" />
    </div>
</div>
