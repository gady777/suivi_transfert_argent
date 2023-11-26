<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_tranches', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("admin_id")->unsigned();
            $table->foreign("admin_id")->references("id")->on("users");
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->float("amount",20);
            $table->bigInteger("devise_id")->unsigned();
            $table->foreign("devise_id")->references("id")->on("devises");
            $table->boolean("complete")->default(false);
            $table->boolean("complete_envoi")->default(false);
            //
            $table->string("id_transaction",6)->unique();// à générer
            $table->float("solde",20);
            $table->float("solde_envoi",20);
            //
            $table->float("amount_cfa",20);
            //
            $table->boolean("archive")->default(0);
            $table->dateTime("archive_date")->nullable();
            //
            $table->bigInteger("transfer_id")->unsigned()->nullable();
            $table->foreign("transfer_id")->references("id")->on("transfers");
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
        Schema::dropIfExists('transfer_tranches');
    }
}
