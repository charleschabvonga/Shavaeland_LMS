<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042987DrugTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('drug_tests')) {
            Schema::create('drug_tests', function (Blueprint $table) {
                $table->increments('id');
                $table->string('drug_test_number')->nullable();
                $table->date('last_annual_drug_test')->nullable();
                $table->string('last_random_drug_test')->nullable();
                $table->date('last_physical_exam_date')->nullable();
                $table->text('description')->nullable();
                
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
        Schema::dropIfExists('drug_tests');
    }
}
