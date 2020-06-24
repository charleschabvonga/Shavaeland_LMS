<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1554747321JobRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('job_requests')) {
            Schema::create('job_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->text('description')->nullable();
                $table->string('job_request_number')->nullable();
                $table->string('requested_by')->nullable();
                $table->date('date')->nullable();
                $table->enum('vehicle_type', array('Horse', 'Truck', 'Trailer', 'Bukkie', 'Light', 'Twin Cab'))->nullable();
                $table->string('vehicle_registration_number')->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->string('mileage')->nullable();
                $table->double('next_service_mileage', 15, 2)->nullable();
                $table->date('next_service_date')->nullable();
                $table->enum('status', array('Open', 'Closed'))->nullable();
                
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
        Schema::dropIfExists('job_requests');
    }
}
