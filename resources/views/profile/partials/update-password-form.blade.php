<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-sky-800">เปลี่ยนรหัสผ่าน</h2>
        <p class="mt-1 text-sm text-slate-600">ใช้รหัสผ่านที่ยาวและสุ่มเพื่อความปลอดภัย</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="รหัสผ่านปัจจุบัน" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="รหัสผ่านใหม่" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="ยืนยันรหัสผ่านใหม่" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="!bg-sky-600 hover:!bg-sky-700">บันทึกรหัสผ่าน</x-primary-button>
    </form>
</section>
