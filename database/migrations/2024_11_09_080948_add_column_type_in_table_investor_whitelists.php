<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTypeInTableInvestorWhitelists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_whitelists', function (Blueprint $table) {
            $table->string('issuer');
            $table->enum('type', ['withdraw','purchase']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('investor_whitelists', function (Blueprint $table) {
            $table->dropColumn('issuer');
            $table->dropColumn('type');
        });
    }
}
