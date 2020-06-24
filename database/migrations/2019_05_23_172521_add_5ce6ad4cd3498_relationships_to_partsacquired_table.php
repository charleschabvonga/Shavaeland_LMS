<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4cd3498RelationshipsToPartsAcquiredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts_acquireds', function(Blueprint $table) {
            if (!Schema::hasColumn('parts_acquireds', 'repair_center_id')) {
                $table->integer('repair_center_id')->unsigned()->nullable();
                $table->foreign('repair_center_id', '237101_5c083a286e241')->references('id')->on('workshops')->onDelete('cascade');
                }
                if (!Schema::hasColumn('parts_acquireds', 'received_by_id')) {
                $table->integer('received_by_id')->unsigned()->nullable();
                $table->foreign('received_by_id', '237101_5c92221eb57c0')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('parts_acquireds', 'dispatched_by_id')) {
                $table->integer('dispatched_by_id')->unsigned()->nullable();
                $table->foreign('dispatched_by_id', '237101_5c92221ece7e7')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('parts_acquireds', 'part_id')) {
                $table->integer('part_id')->unsigned()->nullable();
                $table->foreign('part_id', '237101_5c083a287f5bc')->references('id')->on('parts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('parts_acquireds', 'unit_id')) {
                $table->integer('unit_id')->unsigned()->nullable();
                $table->foreign('unit_id', '237101_5ce696a6034ff')->references('id')->on('unit_measurements')->onDelete('cascade');
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
        Schema::table('parts_acquireds', function(Blueprint $table) {
            if(Schema::hasColumn('parts_acquireds', 'repair_center_id')) {
                $table->dropForeign('237101_5c083a286e241');
                $table->dropIndex('237101_5c083a286e241');
                $table->dropColumn('repair_center_id');
            }
            if(Schema::hasColumn('parts_acquireds', 'received_by_id')) {
                $table->dropForeign('237101_5c92221eb57c0');
                $table->dropIndex('237101_5c92221eb57c0');
                $table->dropColumn('received_by_id');
            }
            if(Schema::hasColumn('parts_acquireds', 'dispatched_by_id')) {
                $table->dropForeign('237101_5c92221ece7e7');
                $table->dropIndex('237101_5c92221ece7e7');
                $table->dropColumn('dispatched_by_id');
            }
            if(Schema::hasColumn('parts_acquireds', 'part_id')) {
                $table->dropForeign('237101_5c083a287f5bc');
                $table->dropIndex('237101_5c083a287f5bc');
                $table->dropColumn('part_id');
            }
            if(Schema::hasColumn('parts_acquireds', 'unit_id')) {
                $table->dropForeign('237101_5ce696a6034ff');
                $table->dropIndex('237101_5ce696a6034ff');
                $table->dropColumn('unit_id');
            }
            
        });
    }
}
