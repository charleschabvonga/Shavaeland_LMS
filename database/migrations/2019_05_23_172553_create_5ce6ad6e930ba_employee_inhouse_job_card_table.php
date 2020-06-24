<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e930baEmployeeInhouseJobCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('employee_inhouse_job_card')) {
            Schema::create('employee_inhouse_job_card', function (Blueprint $table) {
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', 'fk_p_237083_305096_inhous_5ce6ad6e93258')->references('id')->on('employees')->onDelete('cascade');
                $table->integer('inhouse_job_card_id')->unsigned()->nullable();
                $table->foreign('inhouse_job_card_id', 'fk_p_305096_237083_employ_5ce6ad6e9336c')->references('id')->on('inhouse_job_cards')->onDelete('cascade');
                
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
        Schema::dropIfExists('employee_inhouse_job_card');
    }
}
