<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnWalletAddressInInvestorWhitelists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_whitelists', function (Blueprint $table) {
            $table->string('wallet_address');
            $table->string('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investor_whitelists', function (Blueprint $table) {
            $table->dropColumn('wallet_address');
            $table->dropColumn('amount');
        });
    }
}
