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
        Schema::create('biodata', function (Blueprint $table) {
            $table->Increments('id_biodata');
            $table->Integer('id_user');
            $table->String('nip')->nullable();
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan'])->default('Laki-Laki');
            $table->String('telepon')->nullable();
            $table->String('foto')->nullable();
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
        Schema::dropIfExists('biodata');
    }
};
