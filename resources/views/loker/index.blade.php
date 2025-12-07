<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <a href="{{ route('admin.alumni.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
                    + Tambah Alumni
                </a>

                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 border">Nama</th>
                                <th class="p-3 border">Tahun Lulus</th>
                                <th class="p-3 border">Status</th>
                                <th class="p-3 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alumni as $a)
                                <tr>
                                    <td class="p-3 border">{{ $a->nama }}</td>
                                    <td class="p-3 border">{{ $a->tahun_lulus }}</td>
                                    <td class="p-3 border capitalize">{{ $a->status_bekerja }}</td>
                                    <td class="p-3 border flex gap-3">
                                        <a href="{{ route('admin.alumni.show', $a->id) }}"
                                           class="text-blue-600">Detail</a>
                                        <a href="{{ route('admin.alumni.edit', $a->id) }}"
                                           class="text-yellow-600">Edit</a>

                                        <form action="{{ route('admin.alumni.destroy', $a->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">
                                        Tidak ada data alumni
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
