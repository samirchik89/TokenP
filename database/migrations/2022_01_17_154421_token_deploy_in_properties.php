<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TokenDeployInProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issuer_token_requests', function (Blueprint $table) {
            $table->enum('token_deploy_status', [0,1])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issuer_token_requests', function (Blueprint $table) {
            $table->dropColumn('token_deploy_status');
        });
    }
}
