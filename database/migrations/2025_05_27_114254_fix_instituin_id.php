<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixInstituinId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plaid_items', function (Blueprint $table) {
            $table->dropColumn('institution_id');
            $table->integer('plaid_institution_id')->nullable();

        });
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plaid_items', function (Blueprint $table) {
            $table->string('institution_id')->nullable();
            $table->dropColumn('plaid_institution_id');
        });
    }
}
