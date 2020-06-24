<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1558107340ScheduleOfServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('schedule_of_services')) {
            Schema::create('schedule_of_services', function (Blueprint $table) {
                $table->increments('id');
                $table->enum('client_type', array('Customer', 'Department'))->nullable();
                $table->string('description')->nullable();
                $table->double('next_service_mileage', 15, 2)->nullable();
                $table->date('next_service_date')->nullable();
                $table->enum('status', array('Scheduled', 'Caution', 'Due', 'Done'))->nullable();
                $table->string('schedule_number')->nullable();
                
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
        Schema::dropIfExists('schedule_of_services');
    }
}
