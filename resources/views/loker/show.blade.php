<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-xl font-semibold mb-4">{{ $alumni->nama }}</h3>

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <p><strong>Tahun Lulus:</strong> {{ $alumni->tahun_lulus }}</p>
                        <p><strong>Telp:</strong> {{ $alumni->telp }}</p>
                        <p><strong>Status Bekerja:</strong> {{ $alumni->status_bekerja }}</p>
                    </div>

                    <div>
                        <p><strong>Jenis Kelamin:</strong> {{ $alumni->jenis_kelamin }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $alumni->tanggal_lahir }}</p>
                        <p><strong>Alamat:</strong> {{ $alumni->alamat }}</p>
                    </div>

                </div>

                <div class="mt-6">
                    <a href="{{ route('admin.alumni.index') }}"
                       class="text-blue-600 underline">Kembali</a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
