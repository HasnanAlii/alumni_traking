<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight flex items-center gap-2">
                <i data-feather="user-plus" class="text-blue-600"></i>
                {{ __('Tambah Alumni Baru') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <a href="{{ route('admin.alumni.index') }}" class="hover:text-blue-600 cursor-pointer transition">Alumni</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Tambah</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="max-w-5xl mx-auto">

            <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">

                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-800">Formulir Registrasi Alumni</h3>
                    <p class="text-sm text-slate-500">Masukkan data akun dan biodata alumni baru.</p>
                </div>

                <div class="p-8 md:p-10">
                    <form action="{{ route('admin.alumni.store') }}" method="POST" class="space-y-8">
                        @csrf

                        <div>
                            <div class="flex items-center gap-2 mb-6 pb-2 border-b border-slate-100">
                                <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                                    <i data-feather="lock" class="w-4 h-4"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-700 uppercase tracking-wide">Informasi Akun (Login)</h4>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- EMAIL --}}
                                   <div><label class="block text-sm font-bold text-slate-700 mb-2">
                                            Email Aktif <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="mail" class="w-4 h-4"></i>
                                        </div>
                                        <input type="email" name="email" 
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all placeholder-slate-400"
                                               placeholder="Masukan Email" required>
                                    </div>
                                </div>

                                {{-- PASSWORD --}}
                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Password <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="key" class="w-4 h-4"></i>
                                        </div>
                                        <input type="password" name="password"
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-3 transition-all placeholder-slate-400"
                                               placeholder="Minimal 8 karakter" required>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    <label class="block text-sm font-bold text-slate-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>

                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <i data-feather="type" class="w-4 h-4"></i>
                                        </div>
                                        <input type="text" name="nama"
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all placeholder-slate-400"
                                               placeholder="Masukkan nama lengkap " required>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- TAHUN LULUS --}}
                                    <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Tahun Lulus<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="award" class="w-4 h-4"></i>
                                            </div>
                                            <input type="number" name="tahun_lulus"
                                                   class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all placeholder-slate-400"
                                                   placeholder="Masukan Tahun" required>
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
                                                   class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all placeholder-slate-400"
                                                   placeholder="Masukan No Telepon">
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- STATUS BEKERJA --}}
                                    <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Status Saat Ini<span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="briefcase" class="w-4 h-4"></i>
                                            </div>
                                            <select required name="status_bekerja" class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all appearance-none text-slate-600">
                                                <option value="">- Pilih Status -</option>
                                                <option value="bekerja">Bekerja</option>
                                                <option value="belum_bekerja">Belum Bekerja</option>
                                            </select>
                                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="chevron-down" class="w-4 h-4"></i>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- JENIS KELAMIN --}}
                                    <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kelamin<span class="text-red-500">*</span></label>

                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                                <i data-feather="users" class="w-4 h-4"></i>
                                            </div>
                                            <select required name="jenis_kelamin" class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all appearance-none text-slate-600">
                                                <option value="">- Pilih Gender -</option>
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
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
                                               class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all text-slate-600">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 pointer-events-none text-slate-400">
                                            <i data-feather="map-pin" class="w-4 h-4"></i>
                                        </div>
                                        <textarea name="alamat" rows="3"
                                                  class="pl-10 w-full rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-emerald-500 focus:ring-emerald-500 py-3 transition-all placeholder-slate-400"
                                                  placeholder="Jalan, No Rumah, Kelurahan, Kecamatan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <a href="{{ route('admin.alumni.index') }}" 
                               class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-bold rounded-xl text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                                Batal
                            </a>
                            <button type="submit" 
                                class="inline-flex justify-center items-center gap-2 px-6 py-3 border border-transparent shadow-lg shadow-blue-500/30 text-sm font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                                <i data-feather="save" class="w-4 h-4"></i>
                                Simpan Data Alumni
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>