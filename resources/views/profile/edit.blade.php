<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                {{ __('Pengaturan Profil') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Edit Profil</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-4xl mx-auto space-y-8">

            {{-- ALERT SUKSES --}}
            @if (session('status') === 'profile-updated' || session('success'))
                <div x-data="{ show: true }" x-show="show" class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-emerald-100 rounded-full">
                            <i data-feather="check-circle" class="w-5 h-5"></i>
                        </div>
                        <span class="font-medium">Profil berhasil diperbarui.</span>
                    </div>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600">
                        <i data-feather="x" class="w-4 h-4"></i>
                    </button>
                </div>
            @endif

            {{-- ========================== --}}
            {{--   CARD 1: INFORMASI AKUN   --}}
            {{-- ========================== --}}
            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                
                {{-- Card Header --}}
                <div class="px-8 py-6 border-b border-slate-100 flex items-center gap-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                        <i data-feather="settings" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Informasi Akun</h3>
                        <p class="text-sm text-slate-500">Update foto profil dan detail login akun Anda.</p>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            {{-- KOLOM KIRI: FOTO PROFIL --}}
                       <div class="flex flex-col items-center justify-center p-6 bg-slate-50 rounded-2xl border border-slate-200 border-dashed">

                                <div class="relative group">
                                    {{-- PREVIEW GAMBAR --}}
                                    <img id="preview-profile"
                                        src="{{ $user->foto 
                                                ? asset('storage/'.$user->foto) 
                                                : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=EBF4FF&color=3B82F6' }}"
                                        class="h-32 w-32 rounded-full object-cover shadow-md border-4 border-white 
                                                group-hover:scale-105 transition-transform duration-300">

                                    {{-- BUTTON UPLOAD --}}
                                    <label for="foto"
                                        class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer 
                                                hover:bg-blue-700 shadow-lg transition-colors">
                                        <i data-feather="camera" class="w-4 h-4"></i>
                                        <input type="file" id="foto" name="foto" class="hidden" accept="image/*" onchange="previewProfilePhoto()">
                                    </label>
                                </div>

                                <p class="text-xs text-slate-400 mt-4 text-center">
                                    Klik ikon kamera untuk mengganti foto.<br>
                                    Max size: 10MB.
                                </p>

                                <x-input-error :messages="$errors->get('foto')" class="mt-2 text-center" />
                            </div>


                            {{-- KOLOM KANAN: INPUT DATA --}}
                            <div class="space-y-5">
                                {{-- NAMA --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="user" class="w-4 h-4"></i>
                                        </div>
                                        <input type="text" name="name"
                                            class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                                </div>

                                {{-- EMAIL --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="mail" class="w-4 h-4"></i>
                                        </div>
                                        <input type="email" name="email"
                                            class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                                </div>

                                {{-- PASSWORD --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="lock" class="w-4 h-4"></i>
                                        </div>
                                        <input type="password" name="password"
                                            class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all"
                                            placeholder="Biarkan kosong jika tidak ingin mengganti" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-600/40 transition-all transform hover:-translate-y-0.5">
                                <i data-feather="save" class="w-4 h-4"></i>
                                Simpan Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- ========================== --}}
            {{--   CARD 2: BIODATA ALUMNI   --}}
            {{-- ========================== --}}
            @hasrole('alumni')
            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                
                {{-- Card Header --}}
                <div class="px-8 py-6 border-b border-slate-100 flex items-center gap-4 bg-slate-50/50">
                    <div class="p-3 bg-indigo-100 text-indigo-600 rounded-xl">
                        <i data-feather="file-text" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Biodata Lengkap Alumni</h3>
                        <p class="text-sm text-slate-500">Data ini digunakan untuk keperluan tracking alumni.</p>
                    </div>
                </div>

                <div class="p-8">
                    <form method="POST" action="{{ route('profile.update.alumni') }}">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nama Alumni --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap (Sesuai Ijazah)</label>
                                <input type="text" name="nama"
                                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all"
                                    value="{{ old('nama', $alumni->nama) }}" required>
                            </div>

                            {{-- Tahun Lulus --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Lulus</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="calendar" class="w-4 h-4"></i>
                                    </div>
                                    <input type="number" name="tahun_lulus"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all"
                                        value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}">
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">No. WhatsApp / Telepon</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="phone" class="w-4 h-4"></i>
                                    </div>
                                    <input type="text" name="telp"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all"
                                        value="{{ old('telp', $alumni->telp) }}">
                                </div>
                            </div>

                            {{-- Status Bekerja --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Status Saat Ini</label>
                                <div class="relative">
                                    <select name="status_bekerja"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all appearance-none">
                                        <option value="bekerja" {{ $alumni->status_bekerja=='bekerja'?'selected':'' }}>Bekerja</option>
                                        <option value="kuliah" {{ $alumni->status_bekerja=='kuliah'?'selected':'' }}>Kuliah</option>
                                        <option value="mencari_kerja" {{ $alumni->status_bekerja=='mencari_kerja'?'selected':'' }}>Mencari Kerja</option>
                                        <option value="wirausaha" {{ $alumni->status_bekerja=='wirausaha'?'selected':'' }}>Wirausaha</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="briefcase" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin</label>
                                <div class="relative">
                                    <select name="jenis_kelamin"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all appearance-none">
                                        <option value="L" {{ $alumni->jenis_kelamin=='L'?'selected':'' }}>Laki-laki</option>
                                        <option value="P" {{ $alumni->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="users" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                    class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 px-4 transition-all"
                                    value="{{ old('tanggal_lahir', $alumni->tanggal_lahir) }}">
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                                <div class="relative">
                                    <textarea name="alamat" rows="3"
                                        class="w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-indigo-500 focus:ring-indigo-500 py-3 pl-4 pr-10 transition-all">{{ old('alamat', $alumni->alamat) }}</textarea>
                                    <div class="absolute top-3 right-3 pointer-events-none text-slate-400">
                                        <i data-feather="map-pin" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end gap-3">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/30 hover:bg-indigo-700 hover:shadow-indigo-600/40 transition-all transform hover:-translate-y-0.5">
                                <i data-feather="save" class="w-4 h-4"></i>
                                Simpan Biodata
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endhasrole

        </div>
    </div>


<script>
function previewProfilePhoto() {
    const input = document.getElementById('foto');
    const preview = document.getElementById('preview-profile');
    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;  
            preview.classList.remove('hidden');
        }

        reader.readAsDataURL(file);
    }
}
</script>

</x-app-layout>