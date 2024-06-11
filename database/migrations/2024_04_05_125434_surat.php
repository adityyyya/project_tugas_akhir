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
            $table->bigIncrements('id_surat');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->foreign('id_user')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
            $table->enum('tipe_surat',['Masuk','Keluar']);
            $table->String('nomor_surat');
            $table->String('pengirim');
            $table->date('tanggal_surat');
            $table->date('tanggal_terima');
            $table->unsignedBigInteger('id_klasifikasi')->nullable();
            $table->foreign('id_klasifikasi')
            ->references('id_klasifikasi')
            ->on('klasifikasi_surat')
            ->onDelete('set null');
            $table->unsignedBigInteger('id_status')->nullable();
            $table->foreign('id_status')
            ->references('id_status')
            ->on('status_surat')
            ->onDelete('set null');
            $table->text('ringkasan');
            $table->enum('notifikasi', ['YA', 'TIDAK'])->default('TIDAK');
            $table->unsignedBigInteger('disposisi')->nullable();
            $table->foreign('disposisi')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
            $table->String('lampiran_surat');
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
