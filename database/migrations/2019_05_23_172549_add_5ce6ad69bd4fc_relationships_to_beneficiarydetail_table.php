<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad69bd4fcRelationshipsToBeneficiaryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beneficiary_details', function(Blueprint $table) {
            if (!Schema::hasColumn('beneficiary_details', 'employee_name_id')) {
                $table->integer('employee_name_id')->unsigned()->nullable();
                $table->foreign('employee_name_id', '288794_5cab0a8fd372c')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::table('beneficiary_details', function(Blueprint $table) {
            if(Schema::hasColumn('beneficiary_details', 'employee_name_id')) {
                $table->dropForeign('288794_5cab0a8fd372c');
                $table->dropIndex('288794_5cab0a8fd372c');
                $table->dropColumn('employee_name_id');
            }
            
        });
    }
}
