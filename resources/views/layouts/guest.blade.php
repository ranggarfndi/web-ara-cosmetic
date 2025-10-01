<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        {{-- Tambahkan px-4 untuk padding kiri-kanan di layar kecil --}}
        <div class="min-h-screen flex flex-col justify-center items-center py-6 bg-gray-100 dark:bg-gray-900 bg-gradient-to-br from-primary-100 to-violet-200 dark:from-primary-950 dark:to-violet-900 px-4">
            
            <div>
                <a href="/">
                    <h1 class="text-4xl font-bold text-primary-600 dark:text-white tracking-wider">
                        ARA COSMETIC
                    </h1>
                    <h1 class="text-4xl font-bold text-primary-900 dark:text-white tracking-wider text-center">
                        MEMBER
                    </h1>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/50 dark:bg-gray-800/50 backdrop-blur-xl shadow-2xl overflow-hidden rounded-2xl border border-white/30 dark:border-gray-700/50">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>