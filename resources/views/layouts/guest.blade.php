<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'แฟ้มผลงานครู') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=noto-sans-thai:400,500,600,700&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-800 antialiased bg-gradient-to-br from-sky-50 to-blue-100">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <a href="/" class="flex items-center gap-3 mb-6">
                <span class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-600 to-blue-700 text-white text-xl font-bold shadow-lg">EP</span>
                <div>
                    <p class="text-xl font-bold text-sky-800">แฟ้มผลงานครู</p>
                    <p class="text-sm text-slate-600">Teacher e-Portfolio System</p>
                </div>
            </a>

            <div class="w-full sm:max-w-md bg-white shadow-xl rounded-2xl border border-sky-100 overflow-hidden">
                <div class="h-1 bg-gradient-to-r from-sky-500 via-sky-400 to-orange-400"></div>
                <div class="px-6 py-8">{{ $slot }}</div>
            </div>
        </div>
    </body>
</html>
