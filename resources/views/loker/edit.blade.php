<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.alumni.update', $alumni->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Nama</label>
                        <input type="text" name="nama" class="w-full border rounded p-2"
                               value="{{ $alumni->nama }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" class="w-full border rounded p-2"
                               value="{{ $alumni->tahun_lulus }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Telp</label>
                        <input type="text" name="telp" class="w-full border rounded p-2"
                               value="{{ $alumni->telp }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Status Bekerja</label>
                        <select name="status_bekerja" class="w-full border rounded p-2">
                            <option value="bekerja" {{ $alumni->status_bekerja=='bekerja'?'selected':'' }}>Bekerja</option>
                            <option value="belum_bekerja" {{ $alumni->status_bekerja=='belum_bekerja'?'selected':'' }}>Belum Bekerja</option>
                            <option value="wirausaha" {{ $alumni->status_bekerja=='wirausaha'?'selected':'' }}>Wirausaha</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Jenis Kelamin</label>
                        <select nam
