<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-sky-800">โปรไฟล์ครู</h2>
    </x-slot>

    <div class="space-y-6">
        <x-card>
            @include('profile.partials.update-profile-information-form')
        </x-card>

        <x-card>
            @include('profile.partials.update-password-form')
        </x-card>

        <x-card>
            @include('profile.partials.delete-user-form')
        </x-card>
    </div>
</x-app-layout>
