<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRealmlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('auth')->create('realmlist', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('address')->default('127.0.0.1');
            $table->string('localAddress')->default('127.0.0.1');
            $table->string('localSubnetMask')->default('255.255.255.0');
            $table->smallInteger('port')->default(8085);
            $table->tinyInteger('icon')->default(0);
            $table->tinyInteger('flag')->default(2);
            $table->tinyInteger('timezone')->default(0);
            $table->tinyInteger('allowedSecurityLevel')->default(0);
            $table->float('population')->unsigned()->default(0);
            $table->integer('gamebuild')->default(12340); // WoTLK 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('auth')->dropIfExists('realmlist');
    }
}
