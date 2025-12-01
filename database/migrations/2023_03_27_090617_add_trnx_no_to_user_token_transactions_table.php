<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrnxNoToUserTokenTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_token_transactions', function (Blueprint $table) {
            $table->string('reference')->nullable();
            $table->string('access_code')->nullable();
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
            $table->dropColumn('reference');
            $table->dropColumn('access_code');
        });
    }
}
