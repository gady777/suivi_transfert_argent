<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcessingFee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processing_fees', function (Blueprint $table) {
            $table->id();
            $table->float('withdraw_fee')->nullable();
            $table->float('minim_deposit')->nullable();
            $table->float('minim_paiement')->nullable();
            $table->float('minim_bank_account')->nullable();
            $table->float('minim_tarnsfert_to_paypal')->nullable();
            $table->float('minim_transfert_to_momo')->nullable();
            $table->bigInteger('currency_id')->unsigned();
            $table->index('currency_id');
            $table->foreign('currency_id')->references("id")->on("devises")->onDelete("cascade");
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
        Schema::dropIfExists('processing_fees');
    }
}
