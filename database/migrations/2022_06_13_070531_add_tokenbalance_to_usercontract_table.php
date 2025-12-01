<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokenbalanceToUsercontractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usercontract', function (Blueprint $table) {
            $table->double('tokenbalance', 20, 8)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usercontract', function (Blueprint $table) {
            $table->dropColumn('tokenbalance');
        });
    }
}
