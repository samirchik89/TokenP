<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertyColumnInPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('airport')->nullable();
            $table->string('hospitals')->nullable();
            $table->string('fire_services')->nullable();
            $table->string('slums')->nullable();
            $table->string('industrial')->nullable();
            $table->string('railway_tracks')->nullable();
            $table->string('distance_fm_mainroad')->nullable();
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
            $table->dropColumn('airport');
            $table->dropColumn('hospitals');
            $table->dropColumn('fire_services');
            $table->dropColumn('slums');
            $table->dropColumn('industrial');
            $table->dropColumn('railway_tracks');
            $table->dropColumn('distance_fm_mainroad');
        });
    }
}
