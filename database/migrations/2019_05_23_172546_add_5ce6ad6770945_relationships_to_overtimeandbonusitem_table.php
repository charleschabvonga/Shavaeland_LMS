<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6770945RelationshipsToOvertimeAndBonusItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('overtime_and_bonus_items', function(Blueprint $table) {
            if (!Schema::hasColumn('overtime_and_bonus_items', 'item_number_id')) {
                $table->integer('item_number_id')->unsigned()->nullable();
                $table->foreign('item_number_id', '237064_5c083a7f4f5cf')->references('id')->on('payslips')->onDelete('cascade');
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
        Schema::table('overtime_and_bonus_items', function(Blueprint $table) {
            if(Schema::hasColumn('overtime_and_bonus_items', 'item_number_id')) {
                $table->dropForeign('237064_5c083a7f4f5cf');
                $table->dropIndex('237064_5c083a7f4f5cf');
                $table->dropColumn('item_number_id');
            }
            
        });
    }
}
