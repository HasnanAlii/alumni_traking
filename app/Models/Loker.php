<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loker extends Model
{
    use HasFactory;

    protected $table = 'lokers';

    protected $fillable = [
        'nama',
        'lokasi',
        'deskripsi',
        'id_alumni',
        'foto',
        'masa_aktif'

    ];
    
    protected $casts = [
    'masa_aktif' => 'date',
    ];


    /**
     * Relasi ke Alumni
     */
    public function alumni()
    {
        return $this->belongsTo(Alumni::class, 'id_alumni');
    }
}
