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
            $table->Integer('id_surat');
            $table->Integer('id_klasifikasi');
            $table->Integer('id_status');
            $table->text('ringkasan');
            $table->Integer('disposisi')->nullable();
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
