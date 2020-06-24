<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2d317f6RelationshipsToDrugTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drug_tests', function(Blueprint $table) {
            if (!Schema::hasColumn('drug_tests', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '237079_5c0839ed65678')->references('id')->on('employees')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drug_tests', function(Blueprint $table) {
            if(Schema::hasColumn('drug_tests', 'employee_name_id')) {
                $table->dropForeign('237079_5c0839ed65678');
                $table->dropIndex('237079_5c0839ed65678');
                $table->dropColumn('employee_name_id');
            }
            
        });
    }
}
