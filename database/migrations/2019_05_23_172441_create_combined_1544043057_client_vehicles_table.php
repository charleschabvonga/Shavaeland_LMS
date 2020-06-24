<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043057ClientVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('client_vehicles')) {
            Schema::create('client_vehicles', function (Blueprint $table) {
                $table->increments('id');
                $table->string('registration_number')->nullable();
                $table->enum('vehicle_type', array('Truck', 'Trailer', 'Bukkie', 'Horse', 'Light', 'Twin Cab', 'Single Differential: with dropsides', 'Double Differential: with dropsides', 'Double Differential: horse only', 'Single Differential with semi-trailer', '6x4 Truck with timber trailer', '6x4 Truck with sugar cane single spiller trailer'))->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->double('starting_mileage', 15, 2)->nullable();
                $table->double('next_service_mileage', 15, 2)->nullable();
                $table->date('next_service_date')->nullable();
                $table->enum('status', array('Scheduled', 'Caution', 'Due', 'Done'))->nullable();
                
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
        Schema::dropIfExists('client_vehicles');
    }
}
