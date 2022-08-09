<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIbuHamilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id('id_ibu_hamil');
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->string('nama');
            $table->bigInteger('nik')->length(20);
            $table->bigInteger('no_kk')->length(20);
            $table->string('no_telepon')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->date('HPHT')->nullable();
            $table->date('HPL')->nullable();
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
        Schema::dropIfExists('ibu_hamil');
    }
}
