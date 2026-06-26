<section>
    <header class="mb-6">
        <h2 class="text-lg font-semibold text-red-700">ลบบัญชี</h2>
        <p class="mt-1 text-sm text-slate-600">เมื่อลบบัญชี ข้อมูลทั้งหมดจะถูกลบถาวร</p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">ลบบัญชี</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-slate-900">ยืนยันการลบบัญชี?</h2>
            <p class="mt-1 text-sm text-slate-600">กรุณากรอกรหัสผ่านเพื่อยืนยัน</p>

            <div class="mt-6">
                <x-input-label for="password" value="รหัสผ่าน" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="รหัสผ่าน" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">ยกเลิก</x-secondary-button>
                <x-danger-button>ลบบัญชี</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
