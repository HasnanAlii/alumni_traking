<x-app-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                <i data-feather="file-text" class="text-blue-600"></i>
                {{ __('Detail Lowongan') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('loker.index') }}" class="hover:text-blue-600 cursor-pointer transition">Loker</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Detail</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                                    
                    <div class="relative w-full overflow-hidden bg-slate-200 group">

                        {{-- FOTO LOKER --}}
                        @if ($loker->foto)
                            <img src="{{ asset('storage/'.$loker->foto) }}" 
                                alt="{{ $loker->nama }}" 
                                class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-105">
                        @else
                            <img src="https://source.unsplash.com/random/1200x800/?office,job,meeting&sig={{ $loker->id }}" 
                                alt="{{ $loker->nama }}" 
                                class="w-full h-auto object-contain transition-transform duration-700 group-hover:scale-105">
                        @endif

                        {{-- BADGE PEMBUAT --}}
                        <div class="absolute top-6 right-6 bg-white/95 backdrop-blur-md px-4 py-2 rounded-full 
                                    text-sm font-bold text-slate-700 shadow-lg flex items-center gap-2 
                                    border border-slate-100">
                            <div class="p-1 bg-blue-100 rounded-full text-blue-600">
                                <i data-feather="user" class="w-3 h-3"></i>
                            </div>
                            <span>{{ $loker->alumni?->nama ?? 'Admin Sekolah' }}</span>
                        </div>

                        {{-- BADGE TANGGAL --}}
                        <div class="absolute top-6 left-6 bg-slate-900/80 backdrop-blur-sm px-4 py-2 rounded-full 
                                    text-sm font-medium text-white shadow-lg flex items-center gap-2">
                            <i data-feather="calendar" class="w-3 h-3 text-slate-400"></i>
                            {{ $loker->created_at->format('d M Y') }}
                        </div>

                    </div>

                <div class="p-8 md:p-10">
                    
                    {{-- Judul & Meta Data --}}
                    <div class="mb-8 border-b border-slate-100 pb-8">
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 mb-4 leading-tight">
                            {{ $loker->nama }}
                        </h1>
                        
                        <div class="flex flex-wrap items-center gap-4 text-slate-500">

                            {{-- Lokasi --}}
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-lg border border-slate-100">
                                <i data-feather="map-pin" class="w-4 h-4 text-rose-500"></i>
                                <span class="font-medium text-sm">{{ $loker->lokasi }}</span>
                            </div>

                            {{-- Waktu Posting --}}
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-lg border border-slate-100">
                                <i data-feather="clock" class="w-4 h-4 text-amber-500"></i>
                                <span class="font-medium text-sm">{{ $loker->created_at->diffForHumans() }}</span>
                            </div>

                            {{-- Masa Aktif --}}
                            @php
                                $isExpired = $loker->masa_aktif 
                                            ? \Carbon\Carbon::parse($loker->masa_aktif)->isPast() 
                                            : false;

                                $badgeColor = !$loker->masa_aktif
                                    ? 'bg-slate-50 text-slate-600 border-slate-200'
                                    : ($isExpired
                                        ? 'bg-rose-50 text-rose-600 border-rose-200'
                                        : 'bg-emerald-50 text-emerald-600 border-emerald-200');
                            @endphp

                            <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border {{ $badgeColor }}">
                                <i data-feather="calendar" 
                                class="w-4 h-4 
                                        {{ !$loker->masa_aktif 
                                                ? 'text-slate-500' 
                                                : ($isExpired ? 'text-rose-500' : 'text-emerald-600') }}">
                                </i>

                                <span class="font-medium text-sm">
                                    @if (!$loker->masa_aktif)
                                        Tidak ada masa aktif
                                    @elseif ($isExpired)
                                        Kadaluarsa ({{ \Carbon\Carbon::parse($loker->masa_aktif)->translatedFormat('d M Y') }})
                                    @else
                                        Berlaku sampai {{ \Carbon\Carbon::parse($loker->masa_aktif)->translatedFormat('d M Y') }}
                                    @endif
                                </span>
                            </div>

                        </div>

                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                            <div class="p-1.5 bg-blue-100 text-blue-600 rounded-lg">
                                <i data-feather="align-left" class="w-4 h-4"></i>
                            </div>
                            Deskripsi Pekerjaan
                        </h3>
                        
                        <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line bg-slate-50/50 p-6 rounded-2xl border border-slate-100">
                            {{ $loker->deskripsi }}
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-10 pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                        
                        <a href="{{ route('loker.index') }}" 
                           class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 border border-slate-300 text-slate-600 font-bold rounded-xl hover:bg-slate-50 hover:text-blue-600 transition-all">
                            <i data-feather="arrow-left" class="w-4 h-4"></i>
                            Kembali
                        </a>


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