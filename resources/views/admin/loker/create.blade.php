<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight">
                {{ __('Tambah Lowongan Baru') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('loker.index') }}" class="hover:text-blue-600 cursor-pointer transition">Loker</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Tambah</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-4xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                
                <div class="p-8 md:p-10">
                    <div class="mb-8 border-b border-slate-100 pb-4">
                        <h3 class="text-lg font-bold text-slate-800">Formulir Loker</h3>
                        <p class="text-sm text-slate-500">Lengkapi data di bawah ini untuk mempublikasikan lowongan kerja.</p>
                    </div>

                    <form action="{{ route('loker.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        {{-- PEMBUAT --}}
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Diposting Oleh
                            </label>

                            @if (auth()->user()->alumni)
                                <input type="hidden" name="id_alumni" value="{{ auth()->user()->alumni->id }}">
                            @else
                                <input type="hidden" name="id_alumni" value="">
                            @endif

                            <div class="flex items-center gap-3 px-4 py-3 bg-slate-100 rounded-xl border border-slate-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-slate-700 font-semibold">
                                    {{ auth()->user()->name }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400 mt-1">
                                *Pembuat posting otomatis berdasarkan akun yang sedang login.
                            </p>
                        </div>

                        {{-- GRID 2 KOLOM UNTUK NAMA & LOKASI --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            {{-- NAMA LOKER --}}
                            <div>
                                <label for="nama" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Nama Posisi / Loker <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="nama" id="nama" 
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                        placeholder="Masukan Perkerjaan" 
                                        value="{{ old('nama') }}" required>
                                </div>
                                @error('nama') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- LOKASI --}}
                            <div>
                                <label for="lokasi" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Lokasi Penempatan
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input type="text" name="lokasi" id="lokasi" 
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                        placeholder="Masukan Lokasi" 
                                        value="{{ old('lokasi') }}">
                                </div>
                                @error('lokasi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                            {{-- MASA AKTIF --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Masa Aktif Lowongan <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <i data-feather="calendar" class="absolute left-3 top-3 w-5 h-5 text-slate-400"></i>
                                    <input 
                                        type="date" 
                                        name="masa_aktif"
                                        required
                                        value="{{ old('masa_aktif') }}"
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white 
                                            focus:ring-blue-500 focus:border-blue-500 transition">
                                </div>
                                @error('masa_aktif')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        {{-- DESKRIPSI --}}
                        <div>
                            <label for="deskripsi" class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                Deskripsi Pekerjaan
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="5"
                                class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-400" 
                                placeholder="Tuliskan detail pekerjaan, kualifikasi, dan cara melamar...">{{ old('deskripsi') }}</textarea>
                             @error('deskripsi') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- UPLOAD FOTO DENGAN PREVIEW --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2 uppercase tracking-wide">
                                    Banner / Foto Loker
                                </label>
                                
                                {{-- Container Preview --}}
                                <div class="mt-1 relative group w-full border-2 border-slate-300 border-dashed 
                                            rounded-xl overflow-hidden hover:bg-slate-50 transition-colors bg-white">

                                    {{-- 1. Placeholder (Jika belum ada gambar) --}}
                                    <div 
                                        id="upload-placeholder" 
                                        class="flex flex-col items-center justify-center py-12 pointer-events-none">
                                        
                                        <svg class="mx-auto h-12 w-12 text-slate-400 group-hover:text-blue-500 transition-colors" 
                                            stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" 
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        <div class="flex text-sm text-slate-600 justify-center mt-2">
                                            <span class="font-medium text-blue-600">Upload file gambar</span>
                                            <p class="pl-1">atau drag and drop</p>
                                        </div>

                                        <p class="text-xs text-slate-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                                    </div>

                                    {{-- 2. Image Preview --}}
                                    <img id="preview-image" src="#" 
                                        class="hidden w-full object-contain bg-white">

                                    {{-- 3. Input File --}}
                                    <input id="foto" name="foto" type="file"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                        onchange="previewFile()">

                                    {{-- 4. Overlay "Ganti Foto" --}}
                                    <div id="change-overlay" 
                                        class="hidden absolute inset-0 bg-black/40 items-center justify-center z-20 pointer-events-none group-hover:flex">
                                        <span class="bg-white/90 px-4 py-2 rounded-full text-sm font-bold text-slate-700 shadow-sm">
                                            Klik untuk ganti gambar
                                        </span>
                                    </div>
                                </div>
                            </div>

                    <script>
                    function previewFile() {
                        const preview = document.getElementById('preview-image');
                        const placeholder = document.getElementById('upload-placeholder');
                        const overlay = document.getElementById('change-overlay');
                        const file = document.getElementById('foto').files[0];

                        if (file) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                preview.src = e.target.result;
                                preview.classList.remove('hidden');  // tampilkan gambar
                                placeholder.classList.add('hidden'); // sembunyikan placeholder
                                overlay.classList.remove('hidden');   // tampilkan overlay saat hover
                            };
                            reader.readAsDataURL(file);
                        }
                    }
                    </script>


                        {{-- BUTTONS --}}
                        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <a href="{{ route('loker.index') }}" 
                               class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-lg shadow-blue-500/30 text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Lowongan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT SEDERHANA UNTUK PREVIEW --}}
    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const fileInput = document.getElementById('foto');
            const placeholder = document.getElementById('upload-placeholder');
            const overlay = document.getElementById('change-overlay');
            const file = fileInput.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden'); // Tampilkan gambar
                    placeholder.classList.add('hidden'); // Sembunyikan placeholder
                    overlay.classList.remove('hidden'); // Siapkan overlay untuk hover
                }

                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
                overlay.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>