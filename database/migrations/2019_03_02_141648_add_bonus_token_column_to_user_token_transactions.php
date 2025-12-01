<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBonusTokenColumnToUserTokenTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_token_transactions', function (Blueprint $table) {
            $table->double('bonus_value',8,2)->after('token_price')->default(0);
            $table->double('bonus_token',15,8)->after('bonus_value')->default(0);
            $table->double('total_token',15,8)->after('number_of_token')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_token_transactions', function (Blueprint $table) {
            $table->dropColumn('bonus_value');
            $table->dropColumn('bonus_token');
            $table->dropColumn('total_token');
        });
    }
}
