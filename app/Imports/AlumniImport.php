<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Alumni;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumniImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $user = User::create([
            'name'     => $row['nama'],
            'email'    => $row['email'],
            'password' => Hash::make($row['password']),
        ]);

        $user->assignRole('alumni');

        return new Alumni([
            'id_user'        => $user->id,
            'nama'           => $row['nama'],
            'tahun_lulus'    => $row['tahun_lulus'],
            'telp'           => $row['telp'] ?? null,
            'status_bekerja' => $row['status_bekerja'],
            'jenis_kelamin'  => $row['jenis_kelamin'],
            'tanggal_lahir'  => $row['tanggal_lahir'] ?? null,
            'alamat'         => $row['alamat'] ?? null,
        ]);
    }
}
