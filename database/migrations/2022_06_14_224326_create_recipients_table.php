<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipients', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('fname',100);
            $table->string('city',100);
            $table->boolean('is_active')->default(true);
            $table->string('email',255)->nullable();
            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            //
            $table->string('email_old',255)->nullable();//lorque c'est supprimé
            //
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
        Schema::dropIfExists('recipients');
    }
}
