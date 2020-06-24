<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6a073b7RelationshipsToIdentificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('identifications', function(Blueprint $table) {
            if (!Schema::hasColumn('identifications', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '237058_5c083a95463ff')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('identifications', function(Blueprint $table) {
            if(Schema::hasColumn('identifications', 'employee_name_id')) {
                $table->dropForeign('237058_5c083a95463ff');
                $table->dropIndex('237058_5c083a95463ff');
                $table->dropColumn('employee_name_id');
            }
            
        });
    }
}
