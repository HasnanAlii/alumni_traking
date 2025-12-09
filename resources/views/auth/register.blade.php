<x-guest-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <div class="sm:max-w-2xl w-full mx-auto">
        
        {{-- HEADER --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center  bg-green-600 text-white rounded-2xl shadow-lg shadow-blue-500/30 mb-4">
                <img src="/images/logo.png" alt="Logo" class="w-28 h-28 object-contain">
            </div>
            <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">Pendaftaran Alumni</h2>
            <p class="text-sm text-slate-500 mt-2">Isi data di bawah ini untuk bergabung dengan komunitas.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf

            {{-- SECTION 1: INFORMASI AKUN (USER) --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-100">
                    <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                        <i data-feather="lock" class="w-4 h-4"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-700 uppercase tracking-wide">Informasi Akun Login</h4>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">
                            Username / Nama Panggilan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="user" class="w-5 h-5"></i>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Username ">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">
                            Email Aktif <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="mail" class="w-5 h-5"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Masukan Email Aktif">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">
                                Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="key" class="w-5 h-5"></i>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                    placeholder="Minimal 8 karakter">
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">
                                Konfirmasi Password <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="check-circle" class="w-5 h-5"></i>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-blue-500 focus:border-blue-500 py-3 transition-all placeholder-slate-400"
                                    placeholder="Ulangi password">
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION 2: BIODATA ALUMNI --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-100">
                    <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                        <i data-feather="file-text" class="w-4 h-4"></i>
                    </div>
                    <h4 class="text-base font-bold text-slate-700 uppercase tracking-wide">Biodata Alumni</h4>
                </div>

                <div class="space-y-5">
                    
                    {{-- Nama Lengkap --}}
                    <div>
                        <label for="nama" class="block text-sm font-bold text-slate-700 mb-2">
                            Nama Lengkap (Sesuai Ijazah) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="type" class="w-5 h-5"></i>
                            </div>
                            <input id="nama" type="text" name="nama" value="{{ old('nama') }}" required
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Nama lengkap Anda">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Tahun Lulus --}}
                        <div>
                            <label for="tahun_lulus" class="block text-sm font-bold text-slate-700 mb-2">
                                Tahun Lulus <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="award" class="w-5 h-5"></i>
                                </div>
                                <input id="tahun_lulus" type="number" name="tahun_lulus" value="{{ old('tahun_lulus') }}" required
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all placeholder-slate-400"
                                    placeholder="Masukan Tahun Lulus">
                            </div>
                        </div>

                        {{-- No WhatsApp --}}
                        <div>
                            <label for="telp" class="block text-sm font-bold text-slate-700 mb-2">
                                No. WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="phone" class="w-5 h-5"></i>
                                </div>
                                <input id="telp" type="text" name="telp" value="{{ old('telp') }}" required
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all placeholder-slate-400"
                                    placeholder="Masukan Nomor">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Status Bekerja --}}
                        <div>
                            <label for="status_bekerja" class="block text-sm font-bold text-slate-700 mb-2">
                                Status Bekerja Saat Ini <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="briefcase" class="w-5 h-5"></i>
                                </div>
                                <select id="status_bekerja" name="status_bekerja" required
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all appearance-none text-slate-600">
                                    <option value="">- Pilih Status -</option>
                                    <option value="bekerja">Bekerja</option>
                                    <option value="belum_bekerja">Belum Bekerja</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-bold text-slate-700 mb-2">
                                Jenis Kelamin <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="users" class="w-5 h-5"></i>
                                </div>
                                <select id="jenis_kelamin" name="jenis_kelamin" required
                                    class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all appearance-none text-slate-600">
                                    <option value="">- Pilih -</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                    <i data-feather="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-bold text-slate-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i data-feather="calendar" class="w-5 h-5"></i>
                            </div>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all text-slate-600">
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div>
                        <label for="alamat" class="block text-sm font-bold text-slate-700 mb-2">
                            Alamat Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 left-3 pointer-events-none text-slate-400">
                                <i data-feather="map-pin" class="w-5 h-5"></i>
                            </div>
                            <textarea id="alamat" name="alamat" rows="3" required
                                class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 py-3 transition-all placeholder-slate-400"
                                placeholder="Jalan, RT/RW, Kecamatan, Kota...">{{ old('alamat') }}</textarea>
                        </div>
                    </div>

                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm font-bold text-slate-500 hover:text-blue-600 transition" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>

                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 transition-all transform hover:-translate-y-0.5">
                    <i data-feather="check-square" class="w-4 h-4"></i>
                    {{ __('Daftar Sekarang') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        feather.replace();
    </script>
</x-guest-layout>
