<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanLansia extends Model
{
    use HasFactory;

    protected $table = "pemeriksaan_lansia";
    protected $primaryKey = "id_pemeriksaan_lansia";
    protected $fillable = [
        'id_pemeriksaan_lansia', 
        'id_lansia', 
        'id_posyandu', 
        'id_user_petugas',
        'berat_badan',
        'tinggi_badan',
        'lingkar_kepala',
        'gula_darah',
        'imt',
        'tensi',
        'lingkar_perut',
        'kolesterol',
        'asam_urat',
        'is_deleted',
    ];
}
