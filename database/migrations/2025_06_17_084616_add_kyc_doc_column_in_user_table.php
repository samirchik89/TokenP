<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKycDocColumnInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::table('users', function (Blueprint $table) {
            $table->string('issuer_kyc_doc',255)->nullable()->after('kyc');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('issuer_kyc_doc');
        });
    }
}
