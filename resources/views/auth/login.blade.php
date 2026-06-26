<x-guest-layout>
    <h1 class="text-2xl font-bold text-sky-800 mb-2">เข้าสู่ระบบ</h1>
    <p class="text-sm text-slate-600 mb-6">จัดเก็บเกียรติบัตรและรางวัลของคุณ</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" value="อีเมล" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="รหัสผ่าน" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-sky-600 shadow-sm focus:ring-sky-500" name="remember">
                <span class="ms-2 text-sm text-slate-600">จดจำการเข้าสู่ระบบ</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('register'))
                <a class="text-sm text-sky-600 hover:text-sky-800" href="{{ route('register') }}">สมัครสมาชิก</a>
            @endif
            <x-primary-button class="!bg-sky-600 hover:!bg-sky-700">เข้าสู่ระบบ</x-primary-button>
        </div>
    </form>
</x-guest-layout>
