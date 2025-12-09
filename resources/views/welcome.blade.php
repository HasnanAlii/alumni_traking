<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Tracer Alumni MA Assaidiyyah Cipanas') }}</title>
    <link rel="icon" type="image/png" href="/images/logo.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/images/logo.png">
    <link rel="shortcut icon" href="/images/logo.png">


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased selection:bg-blue-500 selection:text-white">

    <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
            <div class="flex items-center gap-2 shrink-0">
                <img src="/images/logo.png" alt="Logo MA Assaidiyyah Cipanas" class="w-10 h-10 object-contain rounded-lg" />
                <span class="font-extrabold text-xl tracking-tight text-slate-800">
                    Tracer<span class="text-blue-600">Alumni</span>
                    <span class="hidden sm:inline text-xs font-semibold text-slate-500 ml-1">MA Assaidiyyah Cipanas</span>
                </span>
            </div>

                @if (Route::has('login'))
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-blue-600 transition px-4 py-2">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-bold bg-blue-600 text-white px-5 py-2.5 rounded-full hover:bg-blue-700 transition shadow-lg shadow-blue-500/30">
                                    Daftar Alumni
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif

                <div class="flex items-center md:hidden">
                    <a href="{{ route('login') }}" class="block w-full text-center px-3 rounded-xl text-sm bg-blue-600 text-white font-bold py-3 hover:text-blue-600 transition">
                        Masuk
                    </a>
                </div>
            </div>
        </div>

    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-emerald-100 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 border border-blue-100 text-blue-600 text-xs font-bold uppercase tracking-wide mb-6">
                    <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                    Sistem Tracing Data Alumni MA Assaidiyyah Cipanas
                </div>
                
                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
                    Pantau Jejak Alumni, <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                        Tingkatkan Mutu Madrasah.
                    </span>
                </h1>
                
                <p class="text-lg text-slate-600 mb-10 leading-relaxed">
                    Platform resmi MA Assaidiyyah Cipanas untuk menghimpun dan memantau data alumni, 
                    melacak studi dan karier mereka, serta membangun jejaring yang kuat antara sekolah dan lulusan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition shadow-xl shadow-blue-600/20 transform hover:-translate-y-1">
                            <i data-feather="home" class="w-5 h-5"></i>
                            Masuk Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition shadow-xl shadow-blue-600/20 transform hover:-translate-y-1">
                            <i data-feather="user-plus" class="w-5 h-5"></i>
                            Daftar Alumni MA Assaidiyyah
                        </a>
                        <a href="#fitur" class="inline-flex justify-center items-center gap-2 px-8 py-4 bg-white text-slate-700 border border-slate-200 font-bold rounded-full hover:bg-slate-50 transition shadow-sm hover:border-blue-300">
                            Pelajari Lebih Lanjut
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section id="fitur" class="py-10 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Fitur Unggulan Sistem Alumni</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">
                    Dirancang khusus untuk kebutuhan tracer alumni MA Assaidiyyah Cipanas, agar pengelolaan data lulusan lebih rapi, cepat, dan akurat.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i data-feather="briefcase" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Informasi Bursa Kerja</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Alumni dapat mengakses dan membagikan info lowongan kerja terbaru yang valid dan relevan dengan dunia kerja saat ini.
                    </p>
                </div>

                {{-- Card 2 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center text-emerald-600 mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i data-feather="database" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Update Data Alumni</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Alumni bisa memperbarui biodata, riwayat pendidikan, dan status pekerjaan secara mandiri untuk kebutuhan tracer study madrasah.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i data-feather="users" class="w-7 h-7"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-3">Jejaring Alumni MA</h3>
                    <p class="text-slate-500 leading-relaxed">
                        Menghubungkan kembali antar alumni MA Assaidiyyah Cipanas untuk saling berbagi informasi, peluang, dan kolaborasi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-10 md:p-16 text-center text-white shadow-2xl relative overflow-hidden">
                {{-- Decorative circles --}}
                <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -ml-10 -mt-10 blur-2xl"></div>
                <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/10 rounded-full -mr-10 -mb-10 blur-2xl"></div>

                <h2 class="text-3xl md:text-4xl font-extrabold mb-6 relative z-10">Sudah Menjadi Alumni MA Assaidiyyah?</h2>
                <p class="text-blue-100 text-lg mb-8 max-w-2xl mx-auto relative z-10">
                    Daftarkan akun Anda sekarang untuk berkontribusi dalam pengembangan data alumni dan ikut membangun nama baik MA Assaidiyyah Cipanas.
                </p>
                
                @auth
                    <a href="{{ url('/dashboard') }}" class="inline-block bg-white text-blue-700 px-8 py-4 rounded-full font-bold hover:bg-blue-50 transition shadow-lg relative z-10">
                        Ke Dashboard Saya
                    </a>
                @else
                    <a href="{{ route('register') }}" class="inline-block bg-white text-blue-700 px-8 py-4 rounded-full font-bold hover:bg-blue-50 transition shadow-lg relative z-10">
                        Daftar Akun Alumni
                    </a>
                @endauth
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-slate-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div class=" p-1.5 rounded text-white">
                   <img src="/images/logo.png" alt="Logo MA Assaidiyyah Cipanas" class="w-10 h-10 object-contain rounded-lg" />
                </div>
                <span class="font-bold text-slate-700">MA Assaidiyyah Cipanas</span>
            </div>
            
            <p class="text-slate-400 text-sm">
                &copy; {{ date('Y') }} Sistem Tracing Data Alumni MA Assaidiyyah Cipanas. All rights reserved.
            </p>

            {{-- <div class="flex gap-4">
                <a href="#" class="text-slate-400 hover:text-blue-600 transition"><i data-feather="instagram" class="w-5 h-5"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition"><i data-feather="facebook" class="w-5 h-5"></i></a>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition"><i data-feather="twitter" class="w-5 h-5"></i></a>
            </div> --}}
        </div>
    </footer>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>

</body>
</html>
