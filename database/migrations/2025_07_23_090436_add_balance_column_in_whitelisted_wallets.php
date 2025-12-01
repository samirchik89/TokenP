<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBalanceColumnInWhitelistedWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whitelisted_wallet_addresses', function (Blueprint $table) {
            $table->decimal('balance', 20, 8)->default(0)->after('wallet_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('whitelisted_wallet_addresses', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
}
