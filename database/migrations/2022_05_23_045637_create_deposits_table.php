<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idUser')->unsigned();
            $table->foreign('idUser')->references('id')->on("users");
            $table->float('price')->nullable();
            $table->string('devise')->nullable();
            $table->text('description')->nullable();
            $table->string('paiement_method')->nullable();
            $table->integer('statut')->nullable();
            $table->string('date_operation')->nullable();
            // pour gérer les demandes coté admin
            $table->date('datePay')->nullable();
            $table->float('amount')->nullable();
            $table->string('destinate','15')->nullable();
            $table->boolean('reject')->default(false);
            $table->date('reject_at')->nullable();
            $table->string('reject_raison')->nullable();
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
        Schema::dropIfExists('deposits');
    }
}
