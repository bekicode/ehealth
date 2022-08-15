<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLansiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lansia', function (Blueprint $table) {
            $table->id('id_lansia');
            $table->bigInteger('id_posyandu')->length(20)->unsigned();
            $table->string('nama');
            $table->bigInteger('nik')->length(20)->unsigned()->unique();
            $table->bigInteger('no_kk')->length(20)->unsigned();
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin')->length(20);
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
        Schema::dropIfExists('lansia');
    }
}
