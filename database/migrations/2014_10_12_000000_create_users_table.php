<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('pseudo');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();

            $table->integer('role'); //1 Pour admin // 2 Pour les users
            $table->integer('type_compte'); //1 admin; 2 individuel ; 3 professionnel
            $table->float('solde');

            //role by admin
            $table->string('role_by_admin',25)->nullable();

            $table->string('dateAnnif')->nullable();
            $table->string('adresse')->nullable();
            $table->string('photo')->nullable();
            $table->string('telephoneUser')->nullable();

            $table->string('nameSociete')->nullable();
            $table->string('adresseSociete')->nullable();
            $table->string('telephoneSociete')->nullable();
            $table->string('serviceSociete')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->boolean('is_active');
            $table->boolean('admin_can_active_account')->nullable();
            $table->string('desactivated_by')->nullable();
            $table->string('desactivated_at')->nullable();

            $table->integer('language_id');
            $table->integer('currency_id');
            $table->bigInteger('quiz1_id')->nullable();
            $table->string('answer1')->nullable();
            $table->bigInteger('quiz2_id')->nullable();
            $table->string('answer2')->nullable();
            $table->bigInteger('quiz3_id')->nullable();
            $table->string('answer3')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
