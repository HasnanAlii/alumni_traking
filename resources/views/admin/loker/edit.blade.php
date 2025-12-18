<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                <i data-feather="edit-2" class="text-blue-600"></i>
                {{ __('Edit Lowongan Kerja') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('loker.index') }}" class="hover:text-blue-600 transition">Loker</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Edit</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                
                <div class="p-8 md:p-10">
                    <div class="mb-8 border-b border-slate-100 pb-4">
                        <h3 class="text-lg font-bold text-slate-800">Formulir Edit Loker</h3>
                        <p class="text-sm text-slate-500">Perbarui informasi lowongan kerja di bawah ini.</p>
                    </div>

                    <form action="{{ route('loker.update', $loker->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Diposting Oleh
                            </label>
                            
                            <input type="hidden" name="id_alumni" value="{{ $loker->id_alumni ?? '' }}">

                            <div class="flex items-center gap-3 px-4 py-3 bg-slate-100 rounded-xl border border-slate-200">
                                <i data-feather="user" class="w-5 h-5 text-blue-600"></i>
                                <span class="text-slate-700 font-semibold">
                                    @if ($loker->alumni)
                                        {{ $loker->alumni->nama }} (Alumni)
                                    @else
                                        Admin Sekolah
                                    @endif
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">*Pembuat postingan tidak dapat diubah.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label for="nama" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Nama Posisi / Loker <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="briefcase" class="w-5 h-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="nama" id="nama" 
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                        value="{{ old('nama', $loker->nama) }}" required>
                                </div>
                                @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="lokasi" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Lokasi Penempatan
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i data-feather="map-pin" class="w-5 h-5 text-slate-400"></i>
                                    </div>
                                    <input type="text" name="lokasi" id="lokasi" 
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                        value="{{ old('lokasi', $loker->lokasi) }}">
                                </div>
                                @error('lokasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
              
                        <div>
                            <label for="masa_aktif"
                                class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Masa Aktif Lowongan <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i data-feather="calendar" class="w-5 h-5 text-slate-400"></i>
                                </div>

                                <input type="date"
                                    name="masa_aktif"
                                    id="masa_aktif"
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50
                                            focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all"
                                    value="{{ old('masa_aktif', optional($loker->masa_aktif)->format('Y-m-d')) }}"
                                    required>
                            </div>

                            @error('masa_aktif')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>


                        <div>
                            <label for="deskripsi" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Deskripsi Pekerjaan
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 pointer-events-none">
                                    <i data-feather="align-left" class="w-5 h-5 text-slate-400"></i>
                                </div>
                                <textarea name="deskripsi" id="deskripsi" rows="5"
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                    placeholder="Tuliskan detail pekerjaan, kualifikasi, dan cara melamar...">{{ old('deskripsi', $loker->deskripsi) }}</textarea>
                            </div>
                             @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Banner / Foto Loker
                            </label>
                            
                           <div class="mt-1 relative group w-full border-2 border-slate-300 border-dashed rounded-xl overflow-hidden hover:bg-slate-50 transition-colors bg-white">

                                <div id="upload-placeholder" 
                                    class="{{ $loker->foto ? 'hidden' : 'flex' }} 
                                        w-full h-64 absolute inset-0 flex-col items-center justify-center pointer-events-none">
                                    <i data-feather="image" class="w-12 h-12 text-slate-400"></i>
                                    <div class="flex text-sm text-slate-600 justify-center mt-2">
                                        <span class="font-medium text-blue-600">Upload file gambar</span>
                                        <p class="pl-1">atau drag and drop</p>
                                    </div>
                                </div>

                                <img id="current-image"
                                    src="{{ $loker->foto ? asset('storage/'.$loker->foto) : '#' }}"
                                    class="{{ $loker->foto ? 'block' : 'hidden' }} 
                                            w-full object-contain bg-white">

                                <img id="preview-image-new"
                                    src="#"
                                    class="hidden w-full object-contain bg-white z-20">

                                <input id="foto" name="foto" type="file"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-30"
                                    onchange="previewFile()">

                                <div id="change-overlay"
                                    class="{{ $loker->foto ? 'flex' : 'hidden' }} 
                                            absolute inset-0 bg-black/40 items-center justify-center z-20 pointer-events-none 
                                            group-hover:flex">
                                    <span class="bg-white/90 px-4 py-2 rounded-full text-sm font-bold text-slate-700 shadow-sm flex items-center gap-2">
                                        <i data-feather="refresh-cw" class="w-4 h-4"></i>
                                        Klik untuk ganti gambar
                                    </span>
                                </div>
                            </div>

                             @error('foto') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <a href="{{ route('loker.index') }}" 
                               class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center items-center gap-2 px-6 py-3 border border-transparent shadow-lg shadow-blue-500/30 text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                <i data-feather="save" class="w-4 h-4"></i>
                                Simpan Perubahan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            const previewNew = document.getElementById('preview-image-new');
            const currentImage = document.getElementById('current-image');
            const placeholder = document.getElementById('upload-placeholder');
            const overlay = document.getElementById('change-overlay');
            const fileInput = document.getElementById('foto');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewNew.src = e.target.result;
                    previewNew.classList.remove('hidden');
                    
                    currentImage.classList.add('hidden');
                    placeholder.classList.add('hidden');
                    
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                }

                reader.readAsDataURL(file);
            }
        }

   
    </script>
</x-app-layout>