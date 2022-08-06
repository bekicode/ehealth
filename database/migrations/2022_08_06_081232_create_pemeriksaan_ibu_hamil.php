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
            $table->id();
            $table->bigInteger('id_ibu_hamil')->length(20)->unsigned();
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->bigInteger('id_user_petugas')->length(20)->unsigned();
            $table->date('HPHT');
            $table->date('HPL');
            $table->date('HPHT');
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
