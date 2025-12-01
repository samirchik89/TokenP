<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlockchainIdInIssuerTokenRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issuer_token_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('issuer_token_requests', 'blockchain_id')) {
                $table->unsignedBigInteger('blockchain_id')->nullable()->after('id');
                
                // Optional: Add a foreign key constraint if Blockchain model/table exists
                // $table->foreign('blockchain_id')->references('id')->on('blockchains')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issuer_token_requests', function (Blueprint $table) {
            if (Schema::hasColumn('issuer_token_requests', 'blockchain_id')) {
                // $table->dropForeign(['blockchain_id']); // If you added FK
                $table->dropColumn('blockchain_id');
            }
        });
    }
}
