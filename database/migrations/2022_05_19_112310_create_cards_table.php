<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('type');
            $table->string('provider');
            $table->integer('providerId')->nullable();  //A prendre en compte apres le taff de l'admin
            $table->integer('numberCard');
            $table->string('dateExp');
            $table->string('cvv');

            $table->string('nameCard');
            $table->string('password');
            $table->integer('statut');

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
        Schema::dropIfExists('cards');
    }
}
