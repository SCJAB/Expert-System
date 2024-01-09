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
        // Schema::create('diagnoses', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('takerID');
        //     $table->foreign('takerID')->references('id')->on('takers')->onDelete('cascade');
        //     $table->unsignedBigInteger('questionID');
        //     $table->foreign('questionID')->references('id')->on('questions')->onDelete('cascade');
        //     $table->unsignedBigInteger('answerID');
        //     $table->foreign('answerID')->references('id')->on('options')->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnoses');
    }
};
