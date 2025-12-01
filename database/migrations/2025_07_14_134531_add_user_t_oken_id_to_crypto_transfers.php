<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTOkenIdToCryptoTransfers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('crypto_transfers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_token_id')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('crypto_transfers', function (Blueprint $table) {
            $table->dropColumn('user_token_id');
        });
    }
}
