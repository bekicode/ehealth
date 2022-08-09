<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = "ibu_hamil";
    protected $primaryKey = "id_ibu_hamil";
    protected $fillable = [
        'id_ibu_hamil', 
        'id_posyandu', 
        'nama', 
        'nik', 
        'no_kk', 
        'no_telepon', 
        'alamat', 
        'nama_ibu',
        'nama_ayah',
        'HPHT',
        'HPL',
        'is_deleted',
    ];
}
