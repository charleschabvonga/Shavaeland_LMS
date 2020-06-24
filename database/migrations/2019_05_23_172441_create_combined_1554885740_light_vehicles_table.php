<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1554885740LightVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('light_vehicles')) {
            Schema::create('light_vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('vehicle_type', array('Truck', 'Bukkie', 'Twin cab', 'Light passenger'))->nullable();
                $table->string('vehicle_description')->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->date('purchase_date')->nullable();
                $table->decimal('purchase_price', 15, 2)->nullable();
                $table->string('chasis_number')->nullable();
                $table->string('engine_number')->nullable();
                $table->double('starting_mileage', 15, 2)->nullable();
                $table->double('next_service_mileage', 15, 2)->nullable();
                $table->date('next_service_date')->nullable();
                $table->enum('service_status', array('Scheduled', 'Caution', 'Due', 'Done'))->nullable();
                $table->enum('availability', array('Yes', 'No(Road Freight)', 'N0(Workshop)'))->nullable();
                $table->decimal('salvage_value', 15, 2)->nullable();
                $table->decimal('investment', 15, 2)->nullable();
                $table->decimal('depreciation', 15, 2)->nullable();
                $table->decimal('maintenance', 15, 2)->nullable();
                $table->decimal('tyre', 15, 2)->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('light_vehicles');
    }
}
