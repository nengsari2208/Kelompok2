<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursements', function (Blueprint $table) {
            $table->id();
            $table->string('id_user',20);
            $table->enum('kategori', ['perjalanan', 'medis', 'operasional']);
            // $table->text('deskripsi');
            // $table->integer('jumlah');
            $table->string('bukti');
            $table->date('from');
            $table->date('to');
            $table->enum('status', ['waiting', 'accepted', 'declined', 'claimed']);
            $table->timestamps();
            
            $table->foreign('id_user')->references('nip')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reimbursements');
    }
}
