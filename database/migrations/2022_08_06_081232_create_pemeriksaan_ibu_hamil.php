<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanIbuHamil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_ibu_hamil', function (Blueprint $table) {
            $table->id('id_pemeriksaan_ibu_hamil');
            $table->bigInteger('id_ibu_hamil')->length(20)->unsigned();
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->bigInteger('id_user_petugas')->length(20)->unsigned();
            $table->float('tensi')->nullable();
            $table->float('gula_darah')->nullable();
            $table->date('HPHT')->nullable();
            $table->date('HPL')->nullable();
            $table->string('hasil_lab')->nullable();
            $table->string('USG')->nullable();
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
        Schema::dropIfExists('pemeriksaan_ibu_hamil');
    }
}
