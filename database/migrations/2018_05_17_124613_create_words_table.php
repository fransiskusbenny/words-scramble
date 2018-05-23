<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('channel_id');
            $table->unsignedInteger('mode_id');
            $table->string('text');
            $table->text('hint')->nullable();
            $table->timestamps();

            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::create('scramble_words', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('word_id');
            $table->string('text');
            $table->timestamps();

            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scramble_words');
        Schema::dropIfExists('words');
    }
}
