<x-guest-layout>
    <h1 class="text-2xl font-bold text-sky-800 mb-2">สมัครสมาชิก</h1>
    <p class="text-sm text-slate-600 mb-6">สร้างบัญชีสำหรับจัดเก็บผลงานของคุณ</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="ชื่อ-นามสกุล" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="อีเมล" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="รหัสผ่าน" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="ยืนยันรหัสผ่าน" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="text-sm text-sky-600 hover:text-sky-800" href="{{ route('login') }}">มีบัญชีแล้ว? เข้าสู่ระบบ</a>
            <x-primary-button class="!bg-orange-500 hover:!bg-orange-600">สมัครสมาชิก</x-primary-button>
        </div>
    </form>
</x-guest-layout>
