<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToWithdrawEthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_eths', function (Blueprint $table) {
            $table->float('amount')->defualt(0)->change();
            $table->enum('status',['pending','success','cancelled','failed'])->default('pending')->after('tx_hash');
            $table->string('reason')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdraw_eths', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('reason');
        });
    }
}
