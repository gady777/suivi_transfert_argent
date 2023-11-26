<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string("author_name",50)->nullable();
            $table->string("image")->nullable();
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
            $table->string("message")->nullable();
            $table->string("state")->nullable();
            $table->boolean("confirm")->default(false);
            $table->date("confirm_at")->nullable();
            $table->string("raison")->nullable();
            $table->boolean('reject')->default(false);
            $table->date("reject_at")->nullable();
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
        Schema::dropIfExists('payments');
    }
}
