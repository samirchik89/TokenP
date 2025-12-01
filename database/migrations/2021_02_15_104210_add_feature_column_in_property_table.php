<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeatureColumnInPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('user_id')->after('id')->default(0);
            $table->enum('status', ['pending', 'active', 'live', 'soldout','block'])->after('termsheet')->default('pending');
            $table->boolean('feature')->after('termsheet')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('status');
            $table->dropColumn('feature');
        });
    }
}
