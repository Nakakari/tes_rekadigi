<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKomentar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_parent')->unsigned()->nullable();
            $table->integer('id_kegiatan')->nullable();
            $table->integer('id_berita')->nullable();
            $table->string('komentar');
            $table->integer('is_aktif')->nullable();
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
        Schema::dropIfExists('tb_komentar');
    }
}
