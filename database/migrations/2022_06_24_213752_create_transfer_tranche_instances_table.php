<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferTrancheInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_tranche_instances', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('transfer_tranche_id')->unsigned();
            $table->foreign("transfer_tranche_id")->references("id")->on("transfer_tranches");
            $table->bigInteger('transfer_method_id')->unsigned();
            $table->foreign("transfer_method_id")->references("id")->on("transfer_methods");
            $table->text("informations");
            $table->float("amount",20);//dans le devise initiale
            $table->bigInteger("devise_id")->unsigned();
            $table->foreign("devise_id")->references("id")->on("devises");
            $table->smallInteger("id_reception",false,true);
            //$table->float("fee",20);//dans la devise initale
            $table->float("receive_amount",20);// devise actuelle, apres avoir preleve les
            // solde envoi
            $table->float("solde",20);
            //solde reception
            $table->float("solde_envoi",20);
            //
            $table->string("type",25);//envoi ou reception
            //
            $table->dateTime("pay_date")->nullable();
            // confirmation reception
            $table->boolean('valid')->default(0);
            $table->dateTime('valid_date')->nullable();// date actuelle sys
            $table->dateTime('valid_date_ok')->nullable();// date par l'admin
            $table->string('valid_message',100)->nullable();
            //
            $table->bigInteger('recipient_id')->unsigned()->nullable();//pour les réceptions
            $table->foreign('recipient_id')->references('id')->on("recipients");
            //conserver les informations de réceptions au cas ou
            // le client supprime ou modifie les infos de réception
            //pour ce bénéfificiaire
            $table->text("info_recepient_reception")
                    ->nullable()
                    ->comment("Conserver pour la tracabiblité");
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
        Schema::dropIfExists('transfer_tranche_instances');
    }
}
