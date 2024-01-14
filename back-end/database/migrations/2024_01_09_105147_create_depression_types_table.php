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
        Schema::create('depression_types', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('scoreRangeStart'); 
            $table->integer('scoreRangeEnd');
<<<<<<< HEAD
=======
            $table->string('message');
>>>>>>> origin/master
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
        Schema::dropIfExists('depression_types');
    }
};
