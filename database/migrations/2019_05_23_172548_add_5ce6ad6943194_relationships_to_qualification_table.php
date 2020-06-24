<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6943194RelationshipsToQualificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('qualifications', function(Blueprint $table) {
            if (!Schema::hasColumn('qualifications', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '237052_5c083a920b5c4')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('qualifications', function(Blueprint $table) {
            if(Schema::hasColumn('qualifications', 'employee_name_id')) {
                $table->dropForeign('237052_5c083a920b5c4');
                $table->dropIndex('237052_5c083a920b5c4');
                $table->dropColumn('employee_name_id');
            }
            
        });
    }
}
