<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContractIdFieldInIssuerStablecoinWalletAddresses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issuer_stablecoin_wallet_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('user_contract_id')->after('id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issuer_stablecoin_wallet_addresses', function (Blueprint $table) {
            $table->dropColumn('user_contract_id');
        });
    }
}
