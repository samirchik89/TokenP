<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumsnWhitelistRequestTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('investor_whitelists', function (Blueprint $table) {
            $table->text('note')->nullable(); 
            $table->boolean('alert_viewed')->default(false)->after('note');
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
            $table->dropColumn(['note', 'alert_viewed']);
        });
    }
}
