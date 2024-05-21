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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->String('nip')->nullable();
            $table->enum('jenis_kelamin',['Laki-Laki','Perempuan'])->default('Laki-Laki');
            $table->String('telepon')->nullable();
            $table->String('foto')->nullable();
            $table->string('password');
            $table->enum('level',['Admin','Lurah','Sekretaris','Bendahara','Petugas']);
            $table->enum('status',['A','I'])->default('A');
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
        Schema::dropIfExists('users');
    }
};
