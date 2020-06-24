<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043017VehicleScsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('vehicle_scs')) {
            Schema::create('vehicle_scs', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('vehicle_type', array('Truck', 'Trailer', 'Bukkie', 'Horse', 'Light', 'Twin Cab'))->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->string('registration_number')->nullable();
                $table->string('certificate_of_registration')->nullable();
                $table->string('certificate_of_fitness_number')->nullable();
                $table->string('certificate_of_fitness')->nullable();
                $table->string('tracker_pin_details')->nullable();
                $table->string('tracker_password')->nullable();
                $table->date('expiration_date')->nullable();
                $table->string('service_history_reports')->nullable();
                $table->enum('status', array('Up to date', 'COF expired'))->nullable();
                
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
        Schema::dropIfExists('vehicle_scs');
    }
}
