<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042889TimeProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('time_projects')) {
            Schema::create('time_projects', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->enum('client_type', array('Client', 'Department'))->nullable();
                $table->string('street_address')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('postal_code')->nullable();
                $table->string('country')->nullable();
                $table->string('vat_number')->nullable();
                $table->string('website')->nullable();
                $table->string('email')->nullable();
                $table->string('phone_number_1')->nullable();
                $table->string('phone_number_2')->nullable();
                $table->string('fax_number')->nullable();
                
                $table->timestamps();
                
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
        Schema::dropIfExists('time_projects');
    }
}
