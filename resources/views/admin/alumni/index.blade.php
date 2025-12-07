<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <h2 class="font-extrabold text-2xl text-gray-800 leading-tight tracking-tight">
                {{ __('Data Alumni') }}
            </h2>
            <nav class="flex text-sm font-medium text-gray-500">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 cursor-pointer transition">Dashboard</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">Alumni</span>
            </nav>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen px-4 sm:px-10">
        <div class="mx-auto max-w-7xl">
            
            <div class="space-y-8">
                
                {{-- SECTION: SUMMARY CARDS (OPSIONAL - CONTOH STATISTIK) --}}
                {{-- Catatan: Anda perlu mengirim variabel $total_alumni, $total_bekerja, dll dari Controller untuk angka dinamis --}}
              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- CARD: Total Alumni --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 shadow-lg shadow-blue-500/30 text-white relative">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-white/20 rounded-xl">
                            <i data-feather="users" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-sm font-bold text-blue-100 uppercase tracking-wider">
                            Total Alumni
                        </div>
                    </div>

                    <div class="text-3xl font-extrabold">
                        {{ $total_alumni }}
                    </div>
                </div>


                {{-- CARD: Bekerja --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl">
                            <i data-feather="briefcase" class="h-6 w-6"></i>
                        </div>
                        <div class="text-sm font-bold text-slate-500 uppercase">Bekerja</div>
                    </div>
                    <div class="text-3xl font-extrabold text-emerald-600">{{ $total_bekerja }}</div>
                </div>

                {{-- CARD: Belum Bekerja --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-red-100 text-red-600 rounded-xl">
                            <i data-feather="slash" class="h-6 w-6"></i>
                        </div>
                        <div class="text-sm font-bold text-slate-500 uppercase">Belum Bekerja</div>
                    </div>
                    <div class="text-3xl font-extrabold text-red-600">{{ $total_belum_bekerja }}</div>
                </div>

            </div>


                {{-- SECTION: MAIN CONTENT --}}
                <div class="bg-white shadow-xl shadow-slate-200/60 rounded-3xl overflow-hidden border border-slate-100">
                    <div class="p-6 lg:p-10">

                        {{-- FLASH MESSAGE --}}
                        @if (session('success'))
                            <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-medium text-sm">{{ session('success') }}</span>
                                </div>
                                <button @click="show = false" class="text-emerald-400 hover:text-emerald-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        @endif

                        {{-- HEADER & ACTIONS --}}
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-6">
                            <div>
                                <h3 class="text-xl font-bold text-slate-800">Daftar Alumni</h3>
                                <p class="text-sm text-slate-500 mt-1">Informasi lengkap mengenai status dan data lulusan.</p>
                            </div>
                            
                            <a href="{{ route('admin.alumni.create') }}" 
                               class="group inline-flex items-center gap-2 px-6 py-3 bg-blue-600 text-white text-sm font-semibold rounded-2xl shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-600/40 transition-all duration-300 transform hover:-translate-y-0.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:rotate-90" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                </svg>
                                Tambah Alumni
                            </a>
                        </div>

                        {{-- TABLE --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-100">
                                    <thead class="bg-slate-50/80">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Nama Alumni</th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Tahun Lulus</th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100 bg-white">
                                        @forelse ($alumni as $a)
                                            <tr class="group hover:bg-blue-50/40 transition-colors duration-200">
                                                {{-- NAMA --}}
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-bold text-slate-700">{{ $a->nama }}</div>
                                                </td>

                                                {{-- TAHUN LULUS --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-slate-600">
                                                    {{ $a->tahun_lulus }}
                                                </td>

                                                {{-- STATUS (BADGE) --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    @php
                                                        $status = strtolower($a->status_bekerja);
                                                        $badgeClass = 'bg-slate-100 text-slate-600 ring-slate-500/20'; // Default
                                                        
                                                        if(str_contains($status, 'kerja') || str_contains($status, 'aktif')) {
                                                            $badgeClass = 'bg-emerald-50 text-emerald-700 ring-emerald-600/20';
                                                        } elseif(str_contains($status, 'kuliah') || str_contains($status, 'studi')) {
                                                            $badgeClass = 'bg-blue-50 text-blue-700 ring-blue-600/20';
                                                        } elseif(str_contains($status, 'mencari') || str_contains($status, 'nganggur')) {
                                                            $badgeClass = 'bg-amber-50 text-amber-700 ring-amber-600/20';
                                                        }
                                                    @endphp
                                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ring-1 ring-inset {{ $badgeClass }} capitalize">
                                                        {{ $a->status_bekerja }}
                                                    </span>
                                                </td>

                                                {{-- AKSI --}}
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <div class="flex justify-center items-center gap-2">
                                                        {{-- DETAIL --}}
                                                        <a href="{{ route('admin.alumni.show', $a->id) }}" 
                                                           class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                                           title="Detail">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                            </svg>
                                                        </a>

                                                        {{-- EDIT --}}
                                                        <a href="{{ route('admin.alumni.edit', $a->id) }}" 
                                                           class="p-2 text-slate-400 hover:text-amber-500 hover:bg-amber-50 rounded-lg transition-all"
                                                           title="Edit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                            </svg>
                                                        </a>

                                                        {{-- DELETE --}}
                                                        <form action="{{ route('admin.alumni.destroy', $a->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data alumni ini?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="group p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-16 text-center">
                                                    <div class="flex flex-col items-center justify-center">
                                                        <div class="bg-slate-50 p-4 rounded-full mb-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                        </div>
                                                        <h3 class="text-lg font-semibold text-slate-700">Belum ada data alumni</h3>
                                                        <p class="text-sm text-slate-500 max-w-xs mx-auto mt-1">Silakan tambahkan data alumni baru untuk menampilkannya di sini.</p>
                                                        <a href="{{ route('admin.alumni.create') }}" class="mt-4 text-sm text-blue-600 hover:text-blue-800 font-medium hover:underline">
                                                            + Tambah Alumni
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-6">
                            @if(method_exists($alumni, 'links'))
                                {{ $alumni->links() }}
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>