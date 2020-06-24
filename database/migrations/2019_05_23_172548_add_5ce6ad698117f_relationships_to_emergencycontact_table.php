<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad698117fRelationshipsToEmergencyContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('emergency_contacts', function(Blueprint $table) {
            if (!Schema::hasColumn('emergency_contacts', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '237057_5c083a988f045')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('emergency_contacts', function(Blueprint $table) {
            if(Schema::hasColumn('emergency_contacts', 'employee_name_id')) {
                $table->dropForeign('237057_5c083a988f045');
                $table->dropIndex('237057_5c083a988f045');
                $table->dropColumn('employee_name_id');
            }
            
        });
    }
}
