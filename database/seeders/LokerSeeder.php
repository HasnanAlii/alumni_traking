<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loker;

class LokerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'nama' => 'Staff Admin',
                'lokasi' => 'Jakarta',
                'deskripsi' => 'Dibutuhkan segera staff admin untuk perusahaan swasta.',
                'id_alumni' => 1,
                               'foto' => 'loker/525xS99HlcvLZq6rRgiov0WXY5QxkB7Vt8vPGi9i.jpg',

            ],
            [
                'nama' => 'Operator Produksi',
                'lokasi' => 'Bekasi',
                'deskripsi' => 'Operator produksi untuk pabrik otomotif.',
                'id_alumni' => 2,
                                'foto' => 'loker/525xS99HlcvLZq6rRgiov0WXY5QxkB7Vt8vPGi9i.jpg',

            ],
            [
                'nama' => 'Graphic Designer',
                'lokasi' => 'Bandung',
                'deskripsi' => 'Posisi desainer grafis untuk agensi kreatif.',
                'id_alumni' => 3,
                'foto' => 'loker/525xS99HlcvLZq6rRgiov0WXY5QxkB7Vt8vPGi9i.jpg',
            ],
            [
                'nama' => 'IT Support',
                'lokasi' => 'Cianjur',
                'deskripsi' => 'Membantu troubleshooting jaringan dan komputer.',
                'id_alumni' => 4,
                              'foto' => 'loker/525xS99HlcvLZq6rRgiov0WXY5QxkB7Vt8vPGi9i.jpg',

            ],
            [
                'nama' => 'Marketing',
                'lokasi' => 'Sukabumi',
                'deskripsi' => 'Mencari karyawan bagian marketing lapangan.',
                'id_alumni' => 5,
                                'foto' => 'loker/525xS99HlcvLZq6rRgiov0WXY5QxkB7Vt8vPGi9i.jpg',

            ],
        ];

        foreach ($data as $item) {
            Loker::create($item);
        }
    }
}
