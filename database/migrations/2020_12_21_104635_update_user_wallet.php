<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserWallet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->double('BTC')->default(0)->after('password');
            $table->double('ETH')->default(0)->after('password');
            $table->double('XRP')->default(0)->after('password');
            $table->double('USD')->default(0)->after('password');
            $table->string('btc_address')->nullable()->after('password');
            $table->string('eth_address')->nullable()->after('password');
            $table->string('bch_address')->nullable()->after('password');
            $table->string('ltc_address')->nullable()->after('password');
            $table->timestamp('last_login_at')->nullable()->after('remember_token');
            $table->string('dest_tag')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
