<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad388a37eRelationshipsToFuelCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fuel_costs', function(Blueprint $table) {
            if (!Schema::hasColumn('fuel_costs', 'road_freight_number_id')) {
                $table->integer('road_freight_number_id')->unsigned()->nullable();
                $table->foreign('road_freight_number_id', '257589_5c4a17f6912c9')->references('id')->on('road_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('fuel_costs', 'vehicle_id')) {
                $table->integer('vehicle_id')->unsigned()->nullable();
                $table->foreign('vehicle_id', '257589_5c9214dcb65e5')->references('id')->on('vehicles')->onDelete('cascade');
                }
                if (!Schema::hasColumn('fuel_costs', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '257589_5cdee3448cb66')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('fuel_costs', function(Blueprint $table) {
            if(Schema::hasColumn('fuel_costs', 'road_freight_number_id')) {
                $table->dropForeign('257589_5c4a17f6912c9');
                $table->dropIndex('257589_5c4a17f6912c9');
                $table->dropColumn('road_freight_number_id');
            }
            if(Schema::hasColumn('fuel_costs', 'vehicle_id')) {
                $table->dropForeign('257589_5c9214dcb65e5');
                $table->dropIndex('257589_5c9214dcb65e5');
                $table->dropColumn('vehicle_id');
            }
            if(Schema::hasColumn('fuel_costs', 'currency_id')) {
                $table->dropForeign('257589_5cdee3448cb66');
                $table->dropIndex('257589_5cdee3448cb66');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
