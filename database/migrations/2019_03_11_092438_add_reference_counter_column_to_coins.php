<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceCounterColumnToCoins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
             $table->string('star_reference_counter',255)->nullable()->after('address');        
             $table->string('port_reference_counter',255)->nullable()->after('star_reference_counter');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->dropColumn('star_reference_counter');
            $table->dropColumn('port_reference_counter');
        });
    }
}
