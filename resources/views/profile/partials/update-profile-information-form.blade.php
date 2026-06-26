<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-sky-800">ข้อมูลส่วนตัว</h2>
        <p class="mt-1 text-sm text-slate-600">แก้ไขข้อมูลโปรไฟล์สำหรับแสดงในแฟ้มผลงาน</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" value="ชื่อ-นามสกุล *" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" value="อีเมล *" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="position" value="ตำแหน่ง" />
                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full" :value="old('position', $user->position)" />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>

            <div>
                <x-input-label for="school" value="สถานศึกษา/โรงเรียน" />
                <x-text-input id="school" name="school" type="text" class="mt-1 block w-full" :value="old('school', $user->school)" />
                <x-input-error class="mt-2" :messages="$errors->get('school')" />
            </div>

            <div>
                <x-input-label for="subject_group" value="กลุ่มสาระ/วิชาที่สอน" />
                <x-text-input id="subject_group" name="subject_group" type="text" class="mt-1 block w-full" :value="old('subject_group', $user->subject_group)" />
                <x-input-error class="mt-2" :messages="$errors->get('subject_group')" />
            </div>

            <div>
                <x-input-label for="academic_standing" value="วิทยฐานะ" />
                <x-text-input id="academic_standing" name="academic_standing" type="text" class="mt-1 block w-full" :value="old('academic_standing', $user->academic_standing)" />
                <x-input-error class="mt-2" :messages="$errors->get('academic_standing')" />
            </div>

            <div>
                <x-input-label for="phone" value="เบอร์ติดต่อ" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button class="!bg-sky-600 hover:!bg-sky-700">บันทึก</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p class="text-sm text-emerald-600">บันทึกเรียบร้อยแล้ว</p>
            @endif
        </div>
    </form>
</section>
