<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $table = 'alumnis'; 

    protected $fillable = [
        'nama',
        'tahun_lulus',
        'telp',
        'status_bekerja',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'id_user',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke Loker (satu alumni bisa membuat banyak loker)
     */
    public function lokers()
    {
        return $this->hasMany(Loker::class, 'id_alumni');
    }
}
