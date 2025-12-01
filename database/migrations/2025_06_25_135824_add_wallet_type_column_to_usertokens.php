<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWalletTypeColumnToUsertokens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->enum('wallet_type', ['internal', 'external'])->default('internal')->after('id');
            $table->unsignedBigInteger('wallet_id')->nullable()->after('wallet_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_tokens', function (Blueprint $table) {
            $table->dropColumn('wallet_type');
            $table->dropColumn('wallet_id');
        });
    }
}
