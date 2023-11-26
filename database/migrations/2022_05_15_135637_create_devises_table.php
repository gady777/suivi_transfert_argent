<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devises', function (Blueprint $table) {
            $table->id();

            $table->string('intitule');
            $table->string('symbole')->nullable();
            $table->string('abbreviation');
            $table->boolean('is_active')->default(true);
            $table->float('rate');//taux de change par rapport au F CFA (XOF)

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
        Schema::dropIfExists('devises');
    }
}
