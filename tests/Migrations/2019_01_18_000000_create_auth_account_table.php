<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('auth')->create('account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('sha_pass_hash', 40);
            $table->string('sessionkey', 80)->nullable();
            $table->string('v', 64)->nullable();
            $table->string('s', 64)->nullable();
            $table->string('token_key')->nullable();
            $table->string('email');
            $table->string('reg_mail');
            $table->timestamp('joindate')->useCurrent();
            $table->string('last_ip', 15)->default('127.0.0.1');
            $table->string('last_attempt_ip', 15)->default('127.0.0.1');
            $table->integer('failed_logins')->default(0);
            $table->boolean('locked')->default(false);
            $table->string('lock_country', 2)->default(00);
            $table->timestamp('last_login')->nullable();
            $table->boolean('online')->default(false);
            $table->boolean('expansion')->default(2); // Wotlk
            $table->bigInteger('mutetime')->default(0);
            $table->string('mutereason')->nullable();
            $table->string('muteby')->nullable();
            $table->tinyInteger('locale')->unsigned()->default(0);
            $table->string('os', 3)->nullable();
            $table->integer('recruiter')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('auth')->dropIfExists('account');
    }
}
