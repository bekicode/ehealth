<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanLansiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_lansia', function (Blueprint $table) {
            $table->id('id_pemeriksaan_lansia');
            $table->bigInteger('id_lansia')->length(20)->unsigned();
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->bigInteger('id_user_petugas')->length(20)->unsigned();
            $table->float('berat_badan')->length(20);
            $table->float('tinggi_badan')->length(20);
            $table->float('gula_darah')->length(20);
            $table->float('imt')->length(20);
            $table->float('tensi')->length(20);
            $table->float('lingkar_perut')->length(20);
            $table->tinyInteger('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaan_lansia');
    }
}
