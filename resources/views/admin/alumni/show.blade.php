<x-app-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                <i data-feather="user" class="text-blue-600"></i>
                {{ __('Detail Data Alumni') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.alumni.index') }}" class="hover:text-blue-600 cursor-pointer transition">Alumni</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Detail</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">

                {{-- SECTION 1: HEADER PROFIL --}}
                <div class="p-8 md:p-10 bg-slate-50/50 border-b border-slate-100 flex flex-col md:flex-row items-center md:items-start gap-6">
                    
                    {{-- FOTO PROFIL (Mengambil dari relation user jika ada, atau fallback avatar) --}}
                    <div class="relative shrink-0">
                        <img src="{{ $alumni->user && $alumni->user->foto ? asset('storage/'.$alumni->user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($alumni->nama).'&background=EBF4FF&color=3B82F6&size=128' }}" 
                             alt="{{ $alumni->nama }}" 
                             class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        
                        {{-- Badge Gender --}}
                        <div class="absolute bottom-2 right-2 p-1.5 rounded-full text-white shadow-sm {{ $alumni->jenis_kelamin == 'L' ? 'bg-blue-500' : 'bg-pink-500' }}">
                            @if($alumni->jenis_kelamin == 'L')
                                <i data-feather="user" class="w-4 h-4"></i>
                            @else
                                <i data-feather="user" class="w-4 h-4"></i>
                            @endif
                        </div>
                    </div>

                    {{-- NAMA & STATUS --}}
                    <div class="text-center md:text-left flex-1 space-y-2">
                        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $alumni->nama }}</h1>
                        
                        <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-2">
                            {{-- Badge Tahun Lulus --}}
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                                <i data-feather="award" class="w-3 h-3"></i>
                                Angkatan {{ $alumni->tahun_lulus }}
                            </span>

                            {{-- Badge Status Bekerja --}}
                            @php
                                $status = strtolower($alumni->status_bekerja);
                                $color = 'bg-slate-100 text-slate-600';
                                if(str_contains($status, 'kerja')) $color = 'bg-emerald-100 text-emerald-700';
                                if(str_contains($status, 'kuliah')) $color = 'bg-indigo-100 text-indigo-700';
                                if(str_contains($status, 'mencari')) $color = 'bg-amber-100 text-amber-700';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-semibold capitalize {{ $color }}">
                                <i data-feather="briefcase" class="w-3 h-3"></i>
                                {{ $alumni->status_bekerja }}
                            </span>
                        </div>
                    </div>

                    {{-- TOMBOL EDIT DI HEADER (Desktop) --}}
                    <div class="hidden md:block">
                        <a href="{{ route('admin.alumni.edit', $alumni->id) }}" 
                           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-300 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 hover:text-blue-600 transition-all shadow-sm">
                            <i data-feather="edit-2" class="w-4 h-4"></i>
                            Edit Data
                        </a>
                    </div>
                </div>

                {{-- SECTION 2: DETAIL INFORMASI --}}
                <div class="p-8 md:p-10">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">

                        {{-- KOLOM KIRI --}}
                        <div class="space-y-6">
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 pb-2 mb-4">
                                Informasi Pribadi
                            </h4>

                            {{-- Tanggal Lahir --}}
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-slate-50 rounded-lg text-slate-400">
                                    <i data-feather="calendar" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Tanggal Lahir</p>
                                    <p class="text-lg font-bold text-slate-700">
                                        {{ $alumni->tanggal_lahir ? \Carbon\Carbon::parse($alumni->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-slate-50 rounded-lg text-slate-400">
                                    <i data-feather="users" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Jenis Kelamin</p>
                                    <p class="text-lg font-bold text-slate-700">
                                        {{ $alumni->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- KOLOM KANAN --}}
                        <div class="space-y-6">
                            <h4 class="text-sm font-bold text-slate-400 uppercase tracking-wider border-b border-slate-100 pb-2 mb-4">
                                Kontak & Akun
                            </h4>

                            {{-- Email --}}
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-slate-50 rounded-lg text-slate-400">
                                    <i data-feather="mail" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Email Akun</p>
                                    <p class="text-lg font-bold text-slate-700">
                                        {{ $alumni->user->email ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-slate-50 rounded-lg text-slate-400">
                                    <i data-feather="phone" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Nomor Telepon / WA</p>
                                    <p class="text-lg font-bold text-slate-700">
                                        {{ $alumni->telp ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="flex items-start gap-4">
                                <div class="p-2.5 bg-slate-50 rounded-lg text-slate-400">
                                    <i data-feather="map-pin" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-500">Alamat Lengkap</p>
                                    <p class="text-base font-medium text-slate-700 leading-relaxed">
                                        {{ $alumni->alamat ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- SECTION 3: FOOTER ACTIONS --}}
                <div class="bg-slate-50 px-8 py-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                    
                    <a href="{{ route('admin.alumni.index') }}" 
                       class="text-slate-500 hover:text-blue-600 font-bold flex items-center gap-2 transition-colors">
                        <i data-feather="arrow-left" class="w-4 h-4"></i>
                        Kembali ke Daftar
                    </a>

                    <div class="flex gap-3 w-full sm:w-auto">
                        {{-- Tombol Edit (Mobile Only - karena desktop ada di header) --}}
                        <a href="{{ route('admin.alumni.edit', $alumni->id) }}"
                           class="sm:hidden flex-1 inline-flex justify-center items-center gap-2 px-4 py-2.5 bg-white border border-slate-300 rounded-xl font-bold text-slate-700 hover:bg-slate-50 transition-all">
                           <i data-feather="edit-2" class="w-4 h-4"></i>
                           Edit
                        </a>

                        <form action="{{ route('admin.alumni.destroy', $alumni->id) }}"
                              method="POST"
                              class="w-full sm:w-auto"
                              onsubmit="return confirm('Yakin ingin menghapus data alumni ini? Data user terkait juga mungkin akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button class="w-full inline-flex justify-center items-center gap-2 px-6 py-2.5 bg-rose-100 text-rose-700 font-bold rounded-xl hover:bg-rose-200 transition-all">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                Hapus Data
                            </button>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>

    {{-- INITIALIZE FEATHER ICONS --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>
</x-app-layout>