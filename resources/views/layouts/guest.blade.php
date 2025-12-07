<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Tracer Alumni') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="https://unpkg.com/feather-icons"></script>
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4">
            
            {{-- 
                LOGO:
                Saya menyembunyikan logo di sini karena di halaman Login & Register 
                yang baru, logo/ikon sudah dimasukkan di dalam desain card masing-masing.
            --}}
            {{-- <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-slate-500" />
                </a>
            </div> --}}

            {{-- 
                WRAPPER SLOT:
                Class 'bg-white shadow-md' dan 'max-w-md' DIHAPUS dari sini.
                Styling tersebut sekarang ditangani langsung oleh file:
                1. auth/login.blade.php (untuk card kecil)
                2. auth/register.blade.php (untuk card lebar/multi-column)
            --}}
            <div class="w-full mt-6">
                {{ $slot }}
            </div>
        </div>
        
        <script>
            feather.replace();
        </script>
    </body>
</html>