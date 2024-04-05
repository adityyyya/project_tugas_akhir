<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->Increments('id_surat');
            $table->Integer('id_user');
            $table->enum('tipe_surat',['Masuk','Keluar']);
            $table->String('nomor_surat');
            $table->String('pengirim');
            $table->String('nomor_agenda');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
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
        Schema::dropIfExists('surat');
    }
};
