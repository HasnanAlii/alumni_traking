<x-app-layout>
    {{-- LOAD FEATHER ICONS --}}
    <script src="https://unpkg.com/feather-icons"></script>

    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                <i data-feather="edit-3" class="text-blue-600"></i>
                {{ __('Edit Data Alumni') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.alumni.index') }}" class="hover:text-blue-600 cursor-pointer transition">Alumni</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Edit</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">

                {{-- Header Form --}}
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Formulir Pembaruan Data</h3>
                    <p class="text-sm text-slate-500">Silakan perbarui informasi akun dan biodata alumni di bawah ini.</p>
                </div>

                <div class="p-8 md:p-10">
                    <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST" class="space-y-8">
                        @csrf
                        @method('PUT')

               
                        <div>
                            <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-100">
                                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                    <i data-feather="lock" class="w-4 h-4"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-700 uppercase tracking-wide">Informasi Akun (Login)</h4>
                            </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- EMAIL --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="mail" class="w-4 h-4"></i>
                                    </div>
                                    <input type="email" name="email"
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50
                                                focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all"
                                        value="{{ old('email', $alumni->user->email) }}" required>
                                </div>
                            </div>

                            {{-- PASSWORD --}}
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-2">
                                    Password Baru <span class="text-slate-400 font-normal text-xs">(Opsional)</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                        <i data-feather="key" class="w-4 h-4"></i>
                                    </div>
                                    <input type="password" name="password"
                                        class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50
                                                focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all"
                                        placeholder="Kosongkan jika tidak diganti">
                                </div>
                            </div>
                        </div>

                        </div>

                        {{-- =========================
                             SECTION 2: BIODATA
                        ========================= --}}
                        <div>
                            <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-100">
                                <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                                    <i data-feather="user" class="w-4 h-4"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-700 uppercase tracking-wide">Biodata Alumni</h4>
                            </div>

                            <div class="space-y-6">
                                {{-- NAMA --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="type" class="w-4 h-4"></i>
                                        </div>
                                        <input type="text" name="nama"
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all"
                                               value="{{ old('nama', $alumni->nama) }}" required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- TAHUN LULUS --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Lulus</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="award" class="w-4 h-4"></i>
                                            </div>
                                            <input type="number" name="tahun_lulus"
                                                   class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all"
                                                   value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}">
                                        </div>
                                    </div>

                                    {{-- TELEPON --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">No. Telepon / WA</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="phone" class="w-4 h-4"></i>
                                            </div>
                                            <input type="text" name="telp"
                                                   class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all"
                                                   value="{{ old('telp', $alumni->telp) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- STATUS BEKERJA --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Status Saat Ini</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="briefcase" class="w-4 h-4"></i>
                                            </div>
                                            <select name="status_bekerja" class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all appearance-none">
                                                <option value="bekerja" {{ $alumni->status_bekerja=='bekerja'?'selected':'' }}>Bekerja</option>
                                                <option value="belum_bekerja" {{ $alumni->status_bekerja=='belum_bekerja'?'selected':'' }}>Belum Bekerja</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="chevron-down" class="w-4 h-4"></i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- JENIS KELAMIN --}}
                                    <div>
                                        <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="users" class="w-4 h-4"></i>
                                            </div>
                                            <select name="jenis_kelamin" class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all appearance-none">
                                                <option value="L" {{ $alumni->jenis_kelamin=='L'?'selected':'' }}>Laki-Laki</option>
                                                <option value="P" {{ $alumni->jenis_kelamin=='P'?'selected':'' }}>Perempuan</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="chevron-down" class="w-4 h-4"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- TANGGAL LAHIR --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Lahir</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="calendar" class="w-4 h-4"></i>
                                        </div>
                                        <input type="date" name="tanggal_lahir"
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all"
                                               value="{{ old('tanggal_lahir', $alumni->tanggal_lahir) }}">
                                    </div>
                                </div>

                                {{-- ALAMAT --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 pointer-events-none text-slate-400">
                                            <i data-feather="map-pin" class="w-4 h-4"></i>
                                        </div>
                                        <textarea name="alamat" rows="3"
                                                  class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all">{{ old('alamat', $alumni->alamat) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- FOOTER BUTTONS --}}
                        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <a href="{{ route('admin.alumni.index') }}" 
                               class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center items-center gap-2 px-6 py-3 border border-transparent shadow-lg shadow-amber-500/30 text-sm font-bold rounded-xl text-white bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all transform hover:-translate-y-0.5">
                                <i data-feather="save" class="w-4 h-4"></i>
                                Update Data Alumni
                            </button>
                        </div>

                    </form>
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