<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e80d84ClientJobCardEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('client_job_card_employee')) {
            Schema::create('client_job_card_employee', function (Blueprint $table) {
                $table->integer('client_job_card_id')->unsigned()->nullable();
                $table->foreign('client_job_card_id', 'fk_p_289883_237083_employ_5ce6ad6e80f73')->references('id')->on('client_job_cards')->onDelete('cascade');
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', 'fk_p_237083_289883_client_5ce6ad6e81062')->references('id')->on('employees')->onDelete('cascade');
                
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
        Schema::dropIfExists('client_job_card_employee');
    }
}
