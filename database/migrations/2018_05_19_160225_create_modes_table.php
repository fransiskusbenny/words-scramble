<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->text('description')->nullable();
            $table->unsignedInteger('duration')->default(0);
            $table->timestamps();
        });

        Schema::table('words', function (Blueprint $table) {
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('cascade')->onUpdate('restrict');
        });

        Schema::table('games', function (Blueprint $table) {
            $table->foreign('mode_id')->references('id')->on('modes')->onDelete('cascade')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modes');
    }
}
