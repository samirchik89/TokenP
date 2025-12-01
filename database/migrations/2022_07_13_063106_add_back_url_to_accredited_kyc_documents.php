<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBackUrlToAccreditedKycDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accredited_kyc_documents', function (Blueprint $table) {
            $table->longText('back_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accredited_kyc_documents', function (Blueprint $table) {
            $table->dropColumn('back_url');
        });
    }
}
