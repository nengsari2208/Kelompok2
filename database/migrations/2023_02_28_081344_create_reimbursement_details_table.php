<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReimbursementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reimbursement_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_reimbursement');
            $table->date('tanggal');
            $table->string('deskripsi');
            $table->integer('pengeluaran');
            $table->timestamps();

            $table->foreign('id_reimbursement')->references('id')->on('reimbursements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reimbursement_details');
    }
}
