<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create5ce6ad6e68a83DepartmentEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('department_employee')) {
            Schema::create('department_employee', function (Blueprint $table) {
                $table->integer('department_id')->unsigned()->nullable();
                $table->foreign('department_id', 'fk_p_237084_237083_employ_5ce6ad6e68c76')->references('id')->on('departments')->onDelete('cascade');
                $table->integer('employee_id')->unsigned()->nullable();
                $table->foreign('employee_id', 'fk_p_237083_237084_depart_5ce6ad6e68d35')->references('id')->on('employees')->onDelete('cascade');
                
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
        Schema::dropIfExists('department_employee');
    }
}
