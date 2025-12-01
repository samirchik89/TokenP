<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColsLengthInPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE properties MODIFY COLUMN propertyName VARCHAR(320) NULL, MODIFY COLUMN propertyLocation VARCHAR(320) NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       DB::statement("ALTER TABLE properties MODIFY COLUMN propertyName VARCHAR(191) NULL, MODIFY COLUMN propertyLocation VARCHAR(191) NULL");
    }
}
