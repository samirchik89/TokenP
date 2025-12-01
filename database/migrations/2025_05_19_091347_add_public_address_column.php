<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublicAddressColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('keystore', function (Blueprint $table) {
            $table->string('public_address')->nullable()->after('id'); // Add after 'id' or adjust as needed
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keystore', function (Blueprint $table) {
            $table->dropColumn('public_address');
        });
    }
}
