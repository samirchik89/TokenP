<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContractIdInIssuerBanksTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('issuer_bank_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_contract_id')->after('id'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('issuer_bank_accounts', function (Blueprint $table) {
            $table->dropColumn('user_contract_id');
        });
    }
}
