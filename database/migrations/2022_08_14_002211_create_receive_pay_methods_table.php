<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivePayMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_pay_methods', function (Blueprint $table) {
            $table->id();
            //
            $table->bigInteger('method_id')->unsigned();
            $table->foreign('method_id')->references('id')->on('transfer_methods');
            //bank
            $table->string('bank_name',200)->nullable();
            $table->string('account_name',200)->nullable();
            $table->string('account_number',200)->nullable();
            $table->string('rib',200)->nullable();
            //interact
            $table->text('interact')->nullable();
            //mobile
            $table->string('phone_number',50)->nullable();
            $table->string('phone_name',100)->nullable();
            //cash
            $table->string('cash_name_fname',200)->nullable();
            $table->string('cash_cni',200)->nullable();
            //
            $table->boolean("is_active")->default(true);
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
        Schema::dropIfExists('receive_pay_methods');
    }
}
