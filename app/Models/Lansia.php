<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lansia extends Model
{
    use HasFactory;

    protected $table = "lansia";
    protected $primaryKey = "id_lansia";
    protected $fillable = [
        'id_lansia',
        'id_posyandu',
        'nama',
        'nik',
        'no_kk',
        'tanggal_lahir',
        'jenis_kelamin',
        'is_deleted',
    ];
}
