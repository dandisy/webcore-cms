<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBannersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file');
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->integer('order')->nullable();
            $table->string('tag')->nullable();
            $table->string('version')->nullable();
            $table->string('language')->nullable();
            $table->string('status');
            $table->integer('created_by')->nullable();
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
        Schema::drop('banners');
    }
}
