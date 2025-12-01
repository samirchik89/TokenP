<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInStablecoinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stablecoins', function (Blueprint $table) {
            $table->string('token_address')->after('title');
            $table->unsignedInteger('decimals')->default(18)->after('token_address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

     public function down()
     {
         Schema::table('stablecoins', function (Blueprint $table) {
             $table->dropColumn(['token_address', 'decimals']);
         });
     }
}
