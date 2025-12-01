<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChainIdColumnToBlockchainTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blockchains', function (Blueprint $table) {
            $table->unsignedBigInteger('chain_id')->nullable()->after('blockchain_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blockchains', function (Blueprint $table) {
            $table->dropColumn('chain_id');
        });
    }
}
