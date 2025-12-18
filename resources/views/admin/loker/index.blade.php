<x-app-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                {{ __('Lowongan Kerja') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Lowongan Kerja</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen px-4 sm:px-10">
        <div class="mx-auto max-w-4xl space-y-8">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <i data-feather="check-circle" class="w-5 h-5"></i>
                        <span class="font-medium text-sm">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600">
                        <i data-feather="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                
                <div class="flex items-center gap-4 w-full md:w-auto">
                    <div class="hidden md:flex w-12 h-12 shrink-0 rounded-full bg-blue-100 items-center justify-center text-blue-600">
                        <i data-feather="edit-3" class="w-6 h-6"></i>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-bold text-slate-800 leading-tight">Buat Postingan Lowongan</h3>
                        <p class="text-sm text-slate-500 mt-1">Bagikan informasi lowongan kerja baru di sini.</p>
                    </div>
                </div>
                
                <a href="{{ route('loker.create') }}" 
                class="group w-full md:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-blue-600 text-white text-sm font-bold rounded-xl md:rounded-full shadow-lg shadow-blue-500/20 hover:bg-blue-700 hover:shadow-blue-600/30 transition-all duration-300 transform hover:-translate-y-0.5">
                    <i data-feather="plus" class="w-5 h-5 transition-transform group-hover:rotate-90"></i>
                    <span>Tambah Lowongan</span>
                </a>

            </div>
            {{-- FILTER BAR --}}
            <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-3">

                <a href="{{ route('loker.index') }}"
                    class="px-4 py-2 rounded-full text-sm font-bold 
                    {{ request('filter') == null ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Semua Lowongan
                </a>
                @hasrole('admin')
                <a href="{{ route('loker.index', ['filter' => 'expired']) }}"
                    class="px-4 py-2 rounded-full text-sm font-bold 
                    {{ request('filter') == 'expired' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    Kadaluarsa
                </a>
                @endhasrole
                @if(auth()->check() && auth()->user()->alumni)
                    <a href="{{ route('loker.index', ['filter' => 'mine']) }}"
                        class="px-4 py-2 rounded-full text-sm font-bold 
                        {{ request('filter') == 'mine' ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        Pekerjaan Saya
                    </a>
                @endif

            </div>


            <div class="space-y-8">
                
                @forelse ($lokers as $l)
                    <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">
                        
                        <div class="p-5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center overflow-hidden border border-slate-200">
                                    @if($l->alumni && $l->alumni->user && $l->alumni->user->foto)
                                        <img src="{{ asset('storage/'.$l->alumni->user->foto) }}" alt="Avatar" class="w-full h-full object-cover">
                                    @else
                                        <i data-feather="user" class="w-5 h-5 text-slate-400"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-slate-800 leading-tight">
                                        {{ $l->alumni?->nama ?? 'Admin Sekolah' }}
                                    </h4>
                                    <p class="text-xs text-slate-500 flex items-center gap-1">
                                        <i data-feather="clock" class="w-3 h-3"></i>
                                        Diposting {{ $l->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>

                            {{-- Options Dropdown (Optional - Placeholder for now) --}}
                            {{-- <button class="text-slate-400 hover:text-slate-600 p-2 rounded-full hover:bg-slate-100 transition-colors">
                                <i data-feather="more-horizontal" class="w-5 h-5"></i>
                            </button> --}}
                        </div>

                        <div class="px-5 pb-5">
                            <h3 class="text-xl font-extrabold text-slate-900 mb-3 leading-tight">
                                {{ $l->nama }}
                            </h3>
                            
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-sm font-medium mb-2">
                                <i data-feather="map-pin" class="w-4 h-4"></i>
                                {{ $l->lokasi }}
                            </div>

                            @php
                                $isExpired = $l->masa_aktif && \Carbon\Carbon::parse($l->masa_aktif)->isPast();
                            @endphp

                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-sm font-medium mb-4
                                {{ $isExpired ? 'bg-rose-50 text-rose-600' : 'bg-emerald-50 text-emerald-700' }}">
                                
                                <i data-feather="clock" class="w-4 h-4"></i>

                                @if ($l->masa_aktif)
                                    {{ $isExpired ? 'Kadaluarsa ' : 'Berlaku hingga ' }}
                                    {{ \Carbon\Carbon::parse($l->masa_aktif)->translatedFormat('d M Y') }}
                                @else
                                    Tidak ada masa aktif
                                @endif
                            </div>

                        </div>

                        <div class="relative w-full bg-slate-200 overflow-hidden">
                            @if ($l->foto)
                                <img src="{{ asset('storage/'.$l->foto) }}" 
                                    alt="{{ $l->nama }}" 
                                    class="w-full h-auto  object-cover">
                            @else
                                <img src="https://source.unsplash.com/random/1200x600/?office,job,career&sig={{ $l->id }}" 
                                    alt="{{ $l->nama }}" 
                                    class="w-full h-auto  object-cover">
                            @endif
                        </div>
                        
                        <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                            <div class="flex items-center justify-between">
                                
                                <a href="{{ route('loker.show', $l->id) }}" 
                                   class="flex-1 inline-flex justify-center items-center gap-2 px-4 py-3 bg-white border border-slate-200 rounded-xl text-slate-700 font-bold hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 transition-all shadow-sm">
                                    <span>Lihat Detail</span>
                                    <i data-feather="arrow-right" class="w-4 h-4"></i>
                                </a>

                                @hasrole('admin')
                                <div class="flex items-center gap-3 ml-4">
                                    <a href="{{ route('loker.edit', $l->id) }}" 
                                        class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="Edit">
                                        <i data-feather="edit-2" class="w-5 h-5"></i>
                                    </a>
                                    
                                    <form action="{{ route('loker.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus loker ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all shadow-sm" title="Hapus">
                                            <i data-feather="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                                @endhasrole

                                @hasrole('alumni')
                                @if (auth()->check() && $l->id_alumni == auth()->user()->alumni->id)
                                <div class="flex items-center gap-3 ml-4">
                                    <a href="{{ route('loker.edit', $l->id) }}" 
                                        class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-amber-600 hover:bg-amber-50 hover:border-amber-200 transition-all shadow-sm" title="Edit">
                                        <i data-feather="edit-2" class="w-5 h-5"></i>
                                    </a>
                                    
                                    <form action="{{ route('loker.destroy', $l->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus loker ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-3 bg-white border border-slate-200 text-slate-500 rounded-xl hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all shadow-sm" title="Hapus">
                                            <i data-feather="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                                @endif
                                @endhasrole

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-2xl p-12 text-center shadow-md border border-slate-100">
                        <div class="inline-flex bg-slate-100 p-6 rounded-full mb-6 text-slate-400">
                            <i data-feather="inbox" class="w-16 h-16"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800">Belum Ada Lowongan</h3>
                        <p class="text-slate-500 mt-2 max-w-md mx-auto">Saat ini belum ada lowongan kerja yang dibagikan. Jadilah yang pertama memposting!</p>
                        <a href="{{ route('loker.create') }}" class="mt-6 inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-full font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all">
                            <i data-feather="plus" class="w-5 h-5"></i>
                            Buat Postingan Baru
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8 flex justify-center">
                @if(method_exists($lokers, 'links'))
                    {{ $lokers->links() }}
                @endif
            </div>

        </div>
    </div>
</x-app-layout>