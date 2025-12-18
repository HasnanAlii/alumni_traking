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


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lokers()
    {
        return $this->hasMany(Loker::class, 'id_alumni');
    }
}
