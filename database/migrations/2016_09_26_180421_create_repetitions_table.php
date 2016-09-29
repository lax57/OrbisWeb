<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repetitions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('type');
            $table->date('last_repetition');
            $table->date('next_repetition');
            $table->integer('repetition_count');
            $table->integer('user_id');
            $table->integer('excercise_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repetitions');
    }
}
