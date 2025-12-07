<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AlumniSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role alumni ada
        Role::firstOrCreate(['name' => 'alumni']);

        $data = [
            [
                'nama' => 'Budi Setiawan',
                'tahun_lulus' => '2019',
                'telp' => '081234567890',
                'status_bekerja' => 'bekerja',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2001-05-12',
                'alamat' => 'Cianjur',
            ],
            [
                'nama' => 'Siti Aminah',
                'tahun_lulus' => '2020',
                'telp' => '081345678901',
                'status_bekerja' => 'belum_bekerja',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2002-08-22',
                'alamat' => 'Cibeber',
            ],
            [
                'nama' => 'Rizky Maulana',
                'tahun_lulus' => '2018',
                'telp' => '081223344556',
                'status_bekerja' => 'bekerja',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2000-02-10',
                'alamat' => 'Cugenang',
            ],
            [
                'nama' => 'Dewi Lestari',
                'tahun_lulus' => '2021',
                'telp' => '082112233445',
                'status_bekerja' => 'bekerja',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2003-11-05',
                'alamat' => 'Ciranjang',
            ],
            [
                'nama' => 'Andi Pratama',
                'tahun_lulus' => '2017',
                'telp' => '081998877665',
                'status_bekerja' => 'bekerja',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '1999-07-17',
                'alamat' => 'Pacet',
            ],
        ];

        foreach ($data as $item) {

            // 1. Buatkan user untuk alumni
            $user = User::create([
                'name' => $item['nama'],
                'email' => strtolower(str_replace(' ', '', $item['nama'])) . '@example.com',
                'password' => Hash::make('password'),
            ]);

            // Assign role alumni
            $user->assignRole('alumni');

            // 2. Insert alumni dengan id_user
            Alumni::create([
                'nama' => $item['nama'],
                'tahun_lulus' => $item['tahun_lulus'],
                'telp' => $item['telp'],
                'status_bekerja' => $item['status_bekerja'],
                'jenis_kelamin' => $item['jenis_kelamin'],
                'tanggal_lahir' => $item['tanggal_lahir'],
                'alamat' => $item['alamat'],
                'id_user' => $user->id, // hubungkan alumni ke user
            ]);
        }
    }
}
