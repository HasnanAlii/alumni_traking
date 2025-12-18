<x-app-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                {{ __('Beranda') }}
            </h2>
            <div class="text-sm font-medium text-slate-500 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100 flex items-center gap-2">
                <i data-feather="calendar" class="w-4 h-4 text-blue-500"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen px-4 sm:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- SECTION 1: WELCOME BANNER --}}
            <div class="relative bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl p-8 text-white overflow-hidden shadow-xl shadow-blue-500/30">
                {{-- Decorative Circles --}}
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div>
                        <h3 class="text-3xl font-extrabold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h3>
                        <p class="text-blue-100 text-lg max-w-xl">
                            Ini adalah panel kontrol utama untuk mengelola data Alumni dan Lowongan Kerja sekolah.
                        </p>
                    </div>
                    {{-- Quick Action Button --}}
                    <div class="shrink-0">
                         <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-xl font-bold backdrop-blur-sm transition-all border border-white/20">
                            <i data-feather="settings" class="w-4 h-4"></i>
                            Pengaturan Akun
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: STATISTIK CARDS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                {{-- Card 1: Total Alumni --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Alumni</p>
                            <h4 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $total_alumni ?? 0 }}</h4>
                        </div>
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <i data-feather="users" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs font-medium text-slate-400 flex items-center gap-1">
                        <i data-feather="trending-up" class="w-3 h-3 text-emerald-500"></i>
                        Data terupdate
                    </div>
                </div>

                {{-- Card 2: Total Loker --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Lowongan Kerja</p>
                            <h4 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $total_loker ?? 0 }}</h4>
                        </div>
                        <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <i data-feather="briefcase" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4 text-xs font-medium text-slate-400 flex items-center gap-1">
                        <span class="text-emerald-600 font-bold">Aktif</span> saat ini
                    </div>
                </div>

                {{-- Card 3: Alumni Bekerja --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Sudah Bekerja</p>
                            <h4 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $alumni_bekerja ?? 0 }}</h4>
                        </div>
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <i data-feather="check-circle" class="w-6 h-6"></i>
                        </div>
                    </div>
                    <div class="mt-4 w-full bg-slate-100 rounded-full h-1.5">
                        <div class="bg-amber-500 h-1.5 rounded-full" style="width: 60%"></div>
                    </div>
                </div>

                {{-- Card 4: Shortcut / Info --}}
                <div class="bg-gradient-to-br from-slate-800 to-slate-900 p-6 rounded-2xl shadow-lg text-white relative overflow-hidden group">
                    <div class="relative z-10">
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Sistem Info</p>
                        <h4 class="text-xl font-bold mt-2">Tracer Alumni</h4>
                        <p class="text-xs text-slate-400 mt-1">Versi 1.0.0</p>
                        <div class="mt-4 pt-4 border-t border-slate-700">
                             <span class="text-xs bg-emerald-500/20 text-emerald-400 px-2 py-1 rounded">System Online</span>
                        </div>
                    </div>
                    <div class="absolute right-0 bottom-0 -mr-4 -mb-4">
                        <i data-feather="server" class="w-24 h-24 text-white/5"></i>
                    </div>
                </div>

            </div>

            {{-- SECTION 3: MAIN CONTENT (SPLIT) --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- LEFT COLUMN: RECENT ALUMNI TABLE --}}
                <div class="lg:col-span-2 bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i data-feather="user-plus" class="w-4 h-4 text-blue-600"></i>
                            Alumni Terbaru
                        </h3>
                        <a href="{{ route('admin.alumni.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800">Lihat Semua &rarr;</a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-slate-600">
                            <thead class="bg-slate-50 text-slate-500 uppercase font-bold text-xs">
                                <tr>
                                    <th class="px-6 py-4">Nama Alumni</th>
                                    <th class="px-6 py-4">Lulusan</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($recent_alumni ?? [] as $ra)
                                    <tr class="hover:bg-slate-50/50 transition-colors">
                                        <td class="px-6 py-4 font-bold text-slate-800">{{ $ra->nama }}</td>
                                        <td class="px-6 py-4">{{ $ra->tahun_lulus }}</td>
                                        <td class="px-6 py-4">
                                            @php
                                                $bg = 'bg-slate-100 text-slate-600';
                                                if($ra->status_bekerja == 'bekerja') $bg = 'bg-emerald-100 text-emerald-700';
                                                if($ra->status_bekerja == 'kuliah') $bg = 'bg-blue-100 text-blue-700';
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-xs font-bold capitalize {{ $bg }}">
                                                {{ $ra->status_bekerja }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('admin.alumni.show', $ra->id) }}" class="text-blue-600 hover:underline">Detail</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data alumni terbaru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- RIGHT COLUMN: QUICK ACTIONS --}}
                <div class="space-y-6">
                    
                    {{-- Quick Menu --}}
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                        <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <i data-feather="zap" class="w-4 h-4 text-amber-500"></i>
                            Menu Cepat
                        </h3>
                        <div class="grid grid-cols-2 gap-4">
                            <a href="{{ route('admin.alumni.create') }}" class="flex flex-col items-center justify-center p-4 bg-blue-50 rounded-2xl text-blue-700 hover:bg-blue-600 hover:text-white transition-all group border border-blue-100">
                                <i data-feather="user-plus" class="w-6 h-6 mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Tambah Alumni</span>
                            </a>
                            
                            <a href="{{ route('loker.create') }}" class="flex flex-col items-center justify-center p-4 bg-emerald-50 rounded-2xl text-emerald-700 hover:bg-emerald-600 hover:text-white transition-all group border border-emerald-100">
                                <i data-feather="briefcase" class="w-6 h-6 mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Tambah Loker</span>
                            </a>

                            <a href="{{ route('admin.alumni.index') }}" class="flex flex-col items-center justify-center p-4 bg-purple-50 rounded-2xl text-purple-700 hover:bg-purple-600 hover:text-white transition-all group border border-purple-100">
                                <i data-feather="list" class="w-6 h-6 mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Data Alumni</span>
                            </a>

                            <a href="{{ route('loker.index') }}" class="flex flex-col items-center justify-center p-4 bg-rose-50 rounded-2xl text-rose-700 hover:bg-rose-600 hover:text-white transition-all group border border-rose-100">
                                <i data-feather="search" class="w-6 h-6 mb-2 group-hover:scale-110 transition-transform"></i>
                                <span class="text-xs font-bold">Lihat Loker</span>
                            </a>
                        </div>
                    </div>

                    {{-- Mini Calendar / Info --}}
                    <div class="bg-slate-800 rounded-3xl shadow-lg border border-slate-700 p-6 text-white">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="p-2 bg-slate-700 rounded-lg">
                                <i data-feather="info" class="w-5 h-5 text-blue-400"></i>
                            </div>
                            <div>
                                <h4 class="font-bold">Tips Admin</h4>
                                <p class="text-xs text-slate-400">Kelola data dengan bijak</p>
                            </div>
                        </div>
                        <p class="text-sm text-slate-300 leading-relaxed">
                            Pastikan untuk selalu memverifikasi data alumni sebelum mempublikasikannya. Hapus postingan loker yang sudah kadaluarsa agar database tetap bersih.
                        </p>
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