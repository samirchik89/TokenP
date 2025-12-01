<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentsColumnsToUserCompanyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_company_details', function (Blueprint $table) {

            $table->string('incorporation_certificate',255)->nullable()->after('social_channels');  
            $table->integer('incorporation_certificate_status')->default(0)->comment('0-Not, 1-Verified')->after('incorporation_certificate');  
            $table->string('partnership_deed',255)->nullable()->after('incorporation_certificate_status');  
            $table->integer('partnership_deed_status')->default(0)->comment('0-Not, 1-Verified')->after('partnership_deed');  
            $table->string('trust_deed',255)->nullable()->after('partnership_deed_status');  
            $table->integer('trust_deed_status')->default(0)->comment('0-Not, 1-Verified')->after('trust_deed');

            $table->string('register_socities',255)->nullable()->after('trust_deed_status');  
            $table->integer('register_socities_status')->default(0)->comment('0-Not, 1-Verified')->after('register_socities');
            
            $table->string('signing_authority',255)->nullable()->after('register_socities_status');  
            $table->integer('signing_authority_status')->default(0)->comment('0-Not, 1-Verified')->after('signing_authority');

            $table->integer('fund_type')->comment('0-others')->after('signing_authority_status')->nullable();  
            $table->string('other_fund_type')->nullable()->after('fund_type');  
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_company_details', function (Blueprint $table) {
            $table->dropColumn('incorporation_certificate');
            $table->dropColumn('incorporation_certificate_status');
            $table->dropColumn('partnership_deed');
            $table->dropColumn('partnership_deed_status');
            $table->dropColumn('trust_deed');
            $table->dropColumn('trust_deed_status');
            $table->dropColumn('register_socities');
            $table->dropColumn('register_socities_status'); 
            $table->dropColumn('signing_authority');
            $table->dropColumn('signing_authority_status');
            $table->dropColumn('fund_type');
            $table->dropColumn('other_fund_type');
        });
    }
}
