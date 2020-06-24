<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042959DepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('departments')) {
            Schema::create('departments', function (Blueprint $table) {
                $table->increments('id');
                $table->string('dept_name')->nullable();
                $table->string('manager')->nullable();
                $table->string('street_address')->nullable();
                $table->string('city')->nullable();
                $table->string('province')->nullable();
                $table->string('country')->nullable();
                $table->string('phone_no')->nullable();
                $table->string('extension')->nullable();
                $table->string('mobile_number')->nullable();
                $table->string('email')->nullable();
                
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
        Schema::dropIfExists('departments');
    }
}
