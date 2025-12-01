<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChainIdColumnInBlockchainTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blockchains', function (Blueprint $table) {
            $table->unsignedBigInteger('test_chain_id')->nullable()->after('production_link');
            $table->unsignedBigInteger('production_chain_id')->nullable()->after('test_chain_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blockchains', function (Blueprint $table) {
            $table->dropColumn('test_chain_id');
            $table->dropColumn('production_chain_id');
        });
    }
}
