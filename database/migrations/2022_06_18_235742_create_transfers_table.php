<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on("users");

            $table->float('amount',20);
            $table->float('receive_amount',20);
            $table->float('fee');
            $table->float('fee_amount',20);
            $table->float('from_rate',20);
            $table->float('recipient_rate',20);

            $table->text('description')->nullable();
            $table->bigInteger('recipient_id')->unsigned();
            $table->foreign('recipient_id')->references('id')->on("recipients");
            $table->string('statut',40)->default('pending');//reject,pending, waiting_validation,validate
            $table->bigInteger('country_from_id')->unsigned();
            $table->foreign('country_from_id')->references('id')->on('countries');
            $table->string("id_transaction",6)->unique();
            $table->date('validate_at')->nullable();
            $table->boolean('reject')->default(false);
            $table->date('reject_at')->nullable();
            $table->string('reject_raison')->nullable();

            $table->string('method',15);
            $table->bigInteger('transfer_method_id')->unsigned();
            $table->foreign('transfer_method_id')->references('id')->on('transfer_methods');
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
            $table->boolean("has_tranche")->default(0);
            $table->bigInteger("tranche_id")->unsigned()->nullable();
            $table->foreign('tranche_id')->references('id')->on('transfer_tranches');
            //
            $table->boolean("archive")->default(0);
            $table->dateTime("archive_date")->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
