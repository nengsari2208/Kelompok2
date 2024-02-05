<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('nip', 20)->primary();
            $table->string('nama');
            $table->unsignedBigInteger('id_jabatan');
            $table->unsignedBigInteger('id_departemen');
            $table->string('telepon', 20);
            $table->text('alamat');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        
            $table->foreign('id_jabatan')->references('id')->on('positions');
            $table->foreign('id_departemen')->references('id')->on('departments');
            
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
}
