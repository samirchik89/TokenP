<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStableCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        // --- Update blockchain_stablecoins table ---
        Schema::table('blockchain_stablecoins', function (Blueprint $table) {
            if (Schema::hasColumn('blockchain_stablecoins', 'address_testnet')) {
                $table->dropColumn('address_testnet');
            }
            if (Schema::hasColumn('blockchain_stablecoins', 'address_mainnet')) {
                $table->dropColumn('address_mainnet');
            }

            if (!Schema::hasColumn('blockchain_stablecoins', 'address')) {
                $table->string('address')->nullable()->after('id'); // adjust 'after' as needed
            }

            if (!Schema::hasColumn('blockchain_stablecoins', 'decimals')) {
                $table->unsignedInteger('decimals')->default(18)->after('address');
            }
        });

        // --- Update stablecoins table ---
        Schema::table('stablecoins', function (Blueprint $table) {
            if (Schema::hasColumn('stablecoins', 'token_address')) {
                $table->dropColumn('token_address');
            }
            if (Schema::hasColumn('stablecoins', 'decimals')) {
                $table->dropColumn('decimals');
            }
        });

        // --- Update issuer_stablecoin_wallet_addresses table ---
        Schema::table('issuer_stablecoin_wallet_addresses', function (Blueprint $table) {
            if (Schema::hasColumn('issuer_stablecoin_wallet_addresses', 'blockchain_id')) {
                $table->dropColumn('blockchain_id');
            }
            if (Schema::hasColumn('issuer_stablecoin_wallet_addresses', 'stablecoin_id')) {
                $table->dropColumn('stablecoin_id');
            }

            if (!Schema::hasColumn('issuer_stablecoin_wallet_addresses', 'blockchain_stablecoin_id')) {
                $table->unsignedBigInteger('blockchain_stablecoin_id')->after('issuer_id')->nullable();

                
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
       // --- Revert blockchain_stablecoins table ---
       Schema::table('blockchain_stablecoins', function (Blueprint $table) {
        if (Schema::hasColumn('blockchain_stablecoins', 'address')) {
            $table->dropColumn('address');
        }
        if (Schema::hasColumn('blockchain_stablecoins', 'decimals')) {
            $table->dropColumn('decimals');
        }

        $table->string('address_testnet')->nullable();
        $table->string('address_mainnet')->nullable();
    });

    // --- Revert stablecoins table ---
    Schema::table('stablecoins', function (Blueprint $table) {
        $table->string('token_address')->after('title')->nullable();
        $table->unsignedInteger('decimals')->default(18)->after('token_address');
    });

    // --- Revert issuer_stablecoin_wallet_addresses table ---
    Schema::table('issuer_stablecoin_wallet_addresses', function (Blueprint $table) {
        if (Schema::hasColumn('issuer_stablecoin_wallet_addresses', 'blockchain_stablecoin_id')) {
            $table->dropColumn('blockchain_stablecoin_id');
        }

        $table->unsignedBigInteger('blockchain_id')->nullable();
        $table->unsignedBigInteger('stablecoin_id')->nullable();
    });
    }
}
