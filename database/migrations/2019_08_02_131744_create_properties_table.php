<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('propertyName')->nullable();
            $table->string('propertyLocation')->nullable();
            $table->string('propertyType')->nullable();
            $table->string('totalDealSize')->nullable();      
            $table->double('dividend')->default(0);      
            $table->string('expectedIrr')->nullable();
            $table->string('initialInvestment')->nullable();            
            $table->string('propertyEquityMultiple')->nullable();
            $table->string('holdingPeriod')->nullable();    
            $table->string('total_sft')->nullable();             
            $table->text('propertyOverview')->nullable(); 
            $table->text('propertyHighlights')->nullable();    
            $table->text('propertyLocationOverview')->nullable();  
            $table->text('propertyConnectivityOverview')->nullable();                                    
            $table->text('locality')->nullable();
            $table->string('yearOfConstruction')->nullable();
            $table->string('storeys')->nullable();   
            $table->string('propertyParking')->nullable();
            $table->string('floorforSale')->nullable();
            $table->string('propertyParkingRatio')->nullable();
            $table->string('typicalFloorArea')->nullable();     
            $table->string('propertyFitouts')->nullable();
            $table->string('propertyTotalBuildingArea')->nullable();  
            $table->string('propertyPowerBackup')->nullable();  
            $table->string('propertyForsaleCarpetArea')->nullable();  
            $table->string('propertyAirConditioning')->nullable();   
            $table->text('propertyDetailsOverview')->nullable();
            $table->text('propertyDetailsHighlights')->nullable();
            $table->text('propertyFloorPlan')->nullable();
            $table->string('propertyLogo')->nullable();
            $table->string('floorplan')->nullable();
            $table->string('investor')->nullable();
            $table->string('titlereport')->nullable();
            $table->string('valuationreport')->nullable();
            $table->string('termsheet')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
