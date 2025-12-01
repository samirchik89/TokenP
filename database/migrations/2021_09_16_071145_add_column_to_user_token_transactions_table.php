<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToUserTokenTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE user_token_transactions MODIFY payment_amount DOUBLE(15,8);');
        DB::statement('ALTER TABLE user_token_transactions MODIFY token_price DOUBLE(15,8);');

        Schema::table('user_token_transactions', function (Blueprint $table) {
            $table->string('txn_hash',191)->nullable();
            $table->string('token_txn_hash',191)->nullable();
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
            $table->dropColumn('txn_hash');
            $table->dropColumn('token_txn_hash');
        });
    }
}
