<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeviseArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devise_archives', function (Blueprint $table) {
            $table->id();
            $table->timestamps();


            $table->string('intitule');
            $table->string('symbole')->nullable();
            $table->string('abbreviation');
            $table->boolean('is_active')->default(false);//devise active si les frais sont renseignés
            $table->float('rate');//taux de change par rapport au F CFA (XOF)

            $table->timestamp("was_created_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devise_archives');
    }
}
