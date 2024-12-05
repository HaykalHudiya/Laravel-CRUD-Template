<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mhs extends Model
{
    use HasFactory;
    protected $table = 'mahasiswas';
    protected $casts = [
        'tanggal_lahir' => 'datetime',
    ];
    protected $fillable = ['nama', 'nim', 'jurusan', 'tempat', 'tanggal_lahir', 'hobi', 'alamat', 'foto'];
}
