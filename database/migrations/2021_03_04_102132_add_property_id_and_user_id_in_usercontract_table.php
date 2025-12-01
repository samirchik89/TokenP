<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyIdAndUserIdInUsercontractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usercontract', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->default(0);
            $table->integer('property_id')->after('id')->default(0);
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
            $table->dropColumn('user_id');
            $table->dropColumn('property_id');
        });
    }
}
