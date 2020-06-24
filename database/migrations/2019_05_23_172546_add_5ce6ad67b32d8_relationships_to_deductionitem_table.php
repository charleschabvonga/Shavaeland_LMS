<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad67b32d8RelationshipsToDeductionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deduction_items', function(Blueprint $table) {
            if (!Schema::hasColumn('deduction_items', 'item_number_id')) {
                $table->integer('item_number_id')->unsigned()->nullable();
                $table->foreign('item_number_id', '237063_5c083a829e5df')->references('id')->on('payslips')->onDelete('cascade');
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
        Schema::table('deduction_items', function(Blueprint $table) {
            if(Schema::hasColumn('deduction_items', 'item_number_id')) {
                $table->dropForeign('237063_5c083a829e5df');
                $table->dropIndex('237063_5c083a829e5df');
                $table->dropColumn('item_number_id');
            }
            
        });
    }
}
