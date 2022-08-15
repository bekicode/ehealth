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
            $table->float('berat_badan')->length(20)->nullable();
            $table->float('tinggi_badan')->length(20)->nullable();
            $table->float('lingkar_perut')->length(20)->nullable();
            $table->string('gula_darah')->length(20)->nullable();
            $table->string('imt')->length(20)->nullable();
            $table->string('tensi')->length(20)->nullable();
            $table->string('kolesterol')->length(20)->nullable();
            $table->string('asam_urat')->length(20)->nullable();
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
