<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEnumForCoinType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE deposit_histories MODIFY COLUMN type ENUM('BTC', 'ETH', 'USD', 'LTC', 'BNB', 'MATIC', 'USDC','USDT','DIE') NOT NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE deposit_histories MODIFY COLUMN type ENUM('BTC', 'ETH', 'USD', 'LTC', 'BCH') NOT NULL");
    }
}
