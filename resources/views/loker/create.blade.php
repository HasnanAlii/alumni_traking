<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Alumni') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.alumni.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Nama</label>
                        <input type="text" name="nama" class="w-full border rounded p-2"
                               required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Telp</label>
                        <input type="text" name="telp" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Status Bekerja</label>
                        <select name="status_bekerja" class="w-full border rounded p-2">
                            <option value="">- PILIH -</option>
                            <option value="bekerja">Bekerja</option>
                            <option value="belum_bekerja">Belum Bekerja</option>
                            <option value="wirausaha">Wirausaha</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border rounded p-2">
                            <option value="">- PILIH -</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-bold mb-2">Alamat</label>
                        <textarea name="alamat" class="w-full border rounded p-2"></textarea>
                    </div>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
