<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042962EmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->enum('position', array('Director', 'Non Executive Director', 'Administrator', 'Manager', 'Supervisor', 'Driver', 'Technician', 'General'))->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->enum('status', array('Full-time', 'Part-time', 'Promoted', 'Transfered', 'Resigned', 'Released', 'Contract Terminated'))->nullable();
                $table->string('street_address')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('country')->nullable();
                $table->string('sa_mobile')->nullable();
                $table->string('int_mobile')->nullable();
                $table->string('email')->nullable();
                $table->string('upload_qualifications')->nullable();
                $table->string('upload_identification_docs')->nullable();
                
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
        Schema::dropIfExists('employees');
    }
}
