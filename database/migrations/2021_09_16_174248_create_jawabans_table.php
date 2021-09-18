<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jawabans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diagnosa_id');
            $table->foreign('diagnosa_id')->references('id')->on('diagnosas')->onDelete('cascade');
            $table->unsignedBigInteger('tanya_id');
            $table->foreign('tanya_id')->references('id')->on('tanyas')->onDelete('cascade');
            $table->unsignedBigInteger('jawab_id');
            $table->foreign('jawab_id')->references('id')->on('jawabs')->onDelete('cascade');
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
        Schema::dropIfExists('jawabans');
    }
}
