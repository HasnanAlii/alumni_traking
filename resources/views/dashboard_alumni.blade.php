<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                {{ __('Beranda Alumni') }}
            </h2>
        <div class="relative" x-data="notificationComponent()">
                <button 
                    @click="toggleNotif()" 
                    class="relative p-2.5 rounded-xl bg-white border border-slate-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-100 shadow-sm"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>

                    <template x-if="unreadCount > 0">
                        <span class="absolute top-2 right-2 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                        </span>
                    </template>
                </button>

                {{-- DROPDOWN --}}
                <div x-show="openNotif"
                    @click.outside="openNotif = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                    x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                    style="display: none;"
                    class="absolute right-0 mt-4 w-80 md:w-96 bg-white shadow-2xl shadow-slate-200/50 rounded-2xl border border-slate-100 z-50 overflow-hidden ring-1 ring-black/5 origin-top-right"
                >
                    <div class="px-5 py-4 border-b border-slate-50 flex items-center justify-between bg-slate-50/50">
                        <span class="font-bold text-slate-800 text-sm">Notifikasi</span>
                        <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">
                            Terbaru
                        </span>
                    </div>

                    <div class="max-h-[350px] overflow-y-auto custom-scrollbar">
                        <template x-if="notifications.length === 0">
                            <div class="px-6 py-12 text-center flex flex-col items-center justify-center text-slate-400">
                                <div class="bg-slate-50 p-3 rounded-full mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">Belum ada notifikasi baru</span>
                            </div>
                        </template>

                        <template x-for="notif in notifications" :key="notif.id">
                            <div class="group px-5 py-4 hover:bg-slate-50 transition-colors duration-200 border-b border-slate-50 last:border-0 cursor-pointer relative">
                                <div class="absolute left-0 top-0 bottom-0 w-[3px] bg-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                                <div class="flex justify-between items-start gap-3">
                                    <div class="flex-1">
                                        <p class="text-sm font-semibold text-slate-700 group-hover:text-blue-700 transition-colors" 
                                        x-text="notif.aktivitas"></p>
                                        <div class="flex items-center gap-1.5 mt-1.5">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-xs text-slate-500 font-medium" x-text="timeAgo(notif.waktu)"></p>
                                        </div>
                                    </div>
                                    <div class="mt-1.5 h-2 w-2 rounded-full bg-blue-500 shadow-sm" x-show="!notif.read_at"></div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>

    <div class="py-8 bg-slate-50 min-h-screen px-4 sm:px-8">
        <div class="max-w-7xl mx-auto space-y-8">

            {{-- SECTION 1: WELCOME BANNER & PROFILE STATUS --}}
            <div class="relative bg-white rounded-3xl p-8 shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
                {{-- Background Decoration --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full -mr-16 -mt-16 blur-3xl opacity-60"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-8">
                    
                    {{-- Foto Profil --}}
                    <div class="shrink-0 relative">
                        <img src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=EBF4FF&color=3B82F6&size=128' }}" 
                             alt="{{ $user->name }}" 
                             class="w-24 h-24 md:w-32 md:h-32 rounded-full object-cover border-4 border-white shadow-lg">
                        
                        {{-- Status Badge --}}
                        @if($alumni)
                            <div class="absolute bottom-1 right-1 bg-emerald-500 border-2 border-white w-6 h-6 rounded-full flex items-center justify-center" title="Biodata Lengkap">
                                <i data-feather="check" class="w-3 h-3 text-white"></i>
                            </div>
                        @else
                             <div class="absolute bottom-1 right-1 bg-amber-500 border-2 border-white w-6 h-6 rounded-full flex items-center justify-center animate-pulse" title="Lengkapi Data">
                                <i data-feather="alert-circle" class="w-3 h-3 text-white"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Teks Sambutan --}}
                    <div class="text-center md:text-left flex-1">
                        <h3 class="text-2xl md:text-3xl font-extrabold text-slate-800 mb-2">
                            Halo, {{ explode(' ', $user->name)[0] }}! 👋
                        </h3>
                        
                        @if($alumni)
                            <p class="text-slate-500 text-lg">
                                Senang melihat Anda kembali. Ada <span class="font-bold text-blue-600">{{ $total_loker }} lowongan baru</span> yang mungkin cocok untuk Anda hari ini.
                            </p>
                        @else
                            <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl mt-2 inline-block text-left">
                                <div class="flex items-start gap-2">
                                    <i data-feather="alert-triangle" class="w-5 h-5 mt-0.5"></i>
                                    <div>
                                        <span class="font-bold">Profil Belum Lengkap!</span>
                                        <p class="text-sm mt-1">Anda belum mengisi biodata alumni. Silakan lengkapi data agar terdata di sistem sekolah.</p>
                                        <a href="{{ route('profile.edit') }}" class="text-sm font-bold underline mt-1 hover:text-amber-600">Lengkapi Sekarang &rarr;</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Action Button --}}
                    <div class="shrink-0">
                        <a href="{{ route('loker.create') }}" class="group flex flex-col items-center justify-center w-full md:w-auto bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all transform hover:-translate-y-1">
                            <i data-feather="plus-circle" class="w-6 h-6 mb-1"></i>
                            <span>Post Loker</span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: GRID CONTENT --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT COLUMN: LOKER TERBARU (Feed) --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="flex items-center justify-between px-2">
                        <h3 class="font-bold text-xl text-slate-800 flex items-center gap-2">
                            <i data-feather="briefcase" class="w-5 h-5 text-blue-600"></i>
                            Lowongan Terbaru
                        </h3>
                        <a href="{{ route('loker.index') }}" class="text-sm font-bold text-blue-600 hover:underline">Lihat Semua</a>
                    </div>

                    @forelse($latest_loker as $loker)
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all group relative overflow-hidden">
                            <div class="flex gap-5 items-start">
                                {{-- Thumbnail Kecil --}}
                                <div class="shrink-0 w-20 h-20 bg-slate-100 rounded-xl overflow-hidden">
                                    @if($loker->foto)
                                        <img src="{{ asset('storage/'.$loker->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://source.unsplash.com/random/200x200/?office,logo&sig={{ $loker->id }}" class="w-full h-full object-cover">
                                    @endif
                                </div>

                                {{-- Konten --}}
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold text-lg text-slate-800 group-hover:text-blue-600 transition-colors line-clamp-1">
                                                {{ $loker->nama }}
                                            </h4>
                                            <p class="text-xs text-slate-400 mt-1 flex items-center gap-1">
                                                <i data-feather="map-pin" class="w-3 h-3"></i> {{ $loker->lokasi }}
                                                <span class="mx-1">•</span>
                                                {{ $loker->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                        <a href="{{ route('loker.show', $loker->id) }}" class="p-2 bg-slate-50 rounded-lg text-slate-400 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                            <i data-feather="arrow-right" class="w-5 h-5"></i>
                                        </a>
                                    </div>
                                    
                                    <p class="text-sm text-slate-500 mt-3 line-clamp-2">
                                        {{ Str::limit($loker->deskripsi, 100) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-8 rounded-2xl text-center border border-slate-100 border-dashed">
                            <i data-feather="inbox" class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>
                            <p class="text-slate-500">Belum ada lowongan kerja tersedia saat ini.</p>
                        </div>
                    @endforelse
                </div>

                {{-- RIGHT COLUMN: MY PROFILE CARD --}}
                <div class="space-y-6">
                    
                    {{-- Card Biodata --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
                            <h4 class="font-bold text-white flex items-center gap-2">
                                <i data-feather="user" class="w-4 h-4"></i>
                                Biodata Saya
                            </h4>
                        </div>
                        <div class="p-6">
                            @if($alumni)
                                <div class="space-y-4">
                                    <div class="flex justify-between items-center border-b border-slate-50 pb-2">
                                        <span class="text-sm text-slate-500">Tahun Lulus</span>
                                        <span class="font-bold text-slate-800">{{ $alumni->tahun_lulus }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-slate-50 pb-2">
                                        <span class="text-sm text-slate-500">Status</span>
                                        <span class="px-2 py-1 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-md capitalize">
                                            {{ $alumni->status_bekerja }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-slate-50 pb-2">
                                        <span class="text-sm text-slate-500">Telepon</span>
                                        <span class="font-bold text-slate-800 text-sm">{{ $alumni->telp ?? '-' }}</span>
                                    </div>
                                    
                                    <a href="{{ route('profile.edit') }}" class="block w-full text-center py-2 border border-slate-200 rounded-xl text-sm font-bold text-slate-600 hover:bg-slate-50 transition-colors">
                                        Edit Biodata
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <p class="text-sm text-slate-500 mb-4">Data belum tersedia.</p>
                                    <a href="{{ route('profile.edit') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-xl text-sm font-bold">
                                        Isi Biodata
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Quick Links --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                        <h4 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wide">Menu Cepat</h4>
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('loker.index') }}" class="flex flex-col items-center justify-center p-3 bg-slate-50 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-feather="search" class="w-5 h-5 mb-1"></i>
                                <span class="text-xs font-bold">Cari Kerja</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-3 bg-slate-50 rounded-xl text-slate-600 hover:bg-blue-50 hover:text-blue-600 transition-all">
                                <i data-feather="settings" class="w-5 h-5 mb-1"></i>
                                <span class="text-xs font-bold">Akun</span>
                            </a>
                        </div>
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