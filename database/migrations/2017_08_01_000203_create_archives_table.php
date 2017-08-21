<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArchivesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul');
            $table->date('tanggal');
            $table->string('jenis_informasi');
            $table->string('asal');
            $table->string('bentuk_informasi');
            $table->text('keterangan');
            $table->string('file');
            $table->string('verified');
            $table->string('verified_by');
            $table->string('created_by');
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
        Schema::drop('archives');
    }
}
