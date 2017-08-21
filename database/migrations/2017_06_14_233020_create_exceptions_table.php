<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateExceptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exceptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor');
            $table->date('tanggal');
            $table->string('nomor_permohonan');
            $table->text('keterangan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exceptions');
    }
}
