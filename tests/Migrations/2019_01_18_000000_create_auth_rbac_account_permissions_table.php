<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthRbacAccountPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('auth')->create('rbac_account_permissions', function (Blueprint $table) {
            $table->integer('accountId')->unsigned()->index();
            $table->integer('permissionId')->unsigned()->index();
            $table->boolean('granted')->default(true);
            $table->integer('realmId', 11)->unsigned()->default(-1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('auth')->dropIfExists('rbac_account_permissions');
    }
}
