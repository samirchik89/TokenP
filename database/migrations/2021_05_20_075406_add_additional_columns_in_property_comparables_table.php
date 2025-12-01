<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnsInPropertyComparablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_comparables', function (Blueprint $table) {
            $table->string('map')->nullable();
            $table->string('comparable_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_comparables', function (Blueprint $table) {
            $table->dropColumn('map');
            $table->dropColumn('comparable_details');
        });
    }
}
