<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtensionColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_identities', function (Blueprint $table) {
            $table->string('primary_country_code')->nullable()->after('id');
            $table->string('secondary_country_code')->nullable()->after('primary_country_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_identities', function (Blueprint $table) {
            $table->dropColumn(['primary_country_code', 'secondary_country_code']);
        });
    }
}
