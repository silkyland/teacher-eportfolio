<nav x-data="{ open: false }" class="bg-gradient-to-r from-sky-700 to-blue-800 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white font-bold text-lg">
                        <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-orange-400 text-white text-sm font-bold">EP</span>
                        <span class="hidden sm:inline">แฟ้มผลงานครู</span>
                    </a>
                </div>

                <div class="hidden space-x-1 sm:-my-px sm:ms-8 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">แดชบอร์ด</x-nav-link>
                    <x-nav-link :href="route('certificates.index')" :active="request()->routeIs('certificates.*')">เกียรติบัตร</x-nav-link>
                    <x-nav-link :href="route('awards.index')" :active="request()->routeIs('awards.*')">รางวัล</x-nav-link>
                    <x-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">แฟ้มผลงาน</x-nav-link>
                    <x-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">โปรไฟล์</x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-sky-100 hover:text-white transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ms-1 h-4 w-4 fill-current" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">โปรไฟล์</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                ออกจากระบบ
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-sky-100 hover:text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-900">
        <div class="pt-2 pb-3 space-y-1 px-2">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">แดชบอร์ด</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('certificates.index')" :active="request()->routeIs('certificates.*')">เกียรติบัตร</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('awards.index')" :active="request()->routeIs('awards.*')">รางวัล</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('portfolio.index')" :active="request()->routeIs('portfolio.*')">แฟ้มผลงาน</x-responsive-nav-link>
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.*')">โปรไฟล์</x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-3 border-t border-blue-700 px-4">
            <div class="font-medium text-white">{{ Auth::user()->name }}</div>
            <div class="text-sm text-sky-200">{{ Auth::user()->email }}</div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">ออกจากระบบ</x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>
