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
        Schema::create('surat_detail', function (Blueprint $table) {
            $table->Increments('id_detail');
            $table->unsignedBigInteger('id_surat');
            $table->foreign('id_surat')
            ->references('id_surat')
            ->on('surat')
            ->onDelete('cascade');
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
        Schema::dropIfExists('surat_detail');
    }
};
