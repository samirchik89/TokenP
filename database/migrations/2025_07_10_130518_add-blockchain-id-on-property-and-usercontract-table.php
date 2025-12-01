<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBlockchainIdOnPropertyAndUsercontractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('properties', 'blockchain_id')) {
            Schema::table('properties', function (Blueprint $table) {
                $table->unsignedBigInteger('blockchain_id')->nullable()->after('id');
            });
        }
        
        if (!Schema::hasColumn('usercontract', 'blockchain_id')) {
            Schema::table('usercontract', function (Blueprint $table) {
                $table->unsignedBigInteger('blockchain_id')->nullable()->after('id');
            });
        }
        
        // Add unique constraints to blockchains table
        Schema::table('blockchains', function (Blueprint $table) {
            if (!Schema::hasColumn('blockchains', 'blockchain_name')) {
                $table->string('blockchain_name')->unique(); // add the column + unique if missing
            } else {
                $table->unique('blockchain_name');
            }
        
            if (!Schema::hasColumn('blockchains', 'abbreviation')) {
                $table->string('abbreviation')->unique(); // add the column + unique if missing
            } else {
                $table->unique('abbreviation');
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
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('blockchain_id');
        });

        Schema::table('usercontract', function (Blueprint $table) {
            $table->dropColumn('blockchain_id');
        });

        Schema::table('blockchains', function (Blueprint $table) {
            $table->dropUnique(['blockchain_name']);
            $table->dropUnique(['abbreviation']);
        });
    }
}
