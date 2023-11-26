<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depots', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on("users");
            $table->bigInteger('method_id')->unsigned();
            $table->foreign('method_id')->references('id')->on("depot_methods");
            $table->float('amount');
            $table->float('receive_amount');
            $table->float('fee');
            $table->bigInteger('devise_id')->unsigned();
            $table->foreign('devise_id')->references('id')->on("devises");
            $table->text('description')->nullable();
            $table->string('statut',30)->default('pending');//reject,pending, waiting_validation,valid
            $table->date('validate_at')->nullable();
            $table->boolean('reject')->default(false);
            $table->date('reject_at')->nullable();
            $table->string('reject_raison')->nullable();

            $table->string('method',15);
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
        Schema::dropIfExists('depots');
    }
}
