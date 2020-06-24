<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad4c461a0RelationshipsToPartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('parts', function(Blueprint $table) {
            if (!Schema::hasColumn('parts', 'repair_center_id')) {
                $table->integer('repair_center_id')->unsigned()->nullable();
                $table->foreign('repair_center_id', '237094_5c083a251097a')->references('id')->on('workshops')->onDelete('cascade');
                }
                if (!Schema::hasColumn('parts', 'unit_id')) {
                $table->integer('unit_id')->unsigned()->nullable();
                $table->foreign('unit_id', '237094_5ce68e8a92f1d')->references('id')->on('unit_measurements')->onDelete('cascade');
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
        Schema::table('parts', function(Blueprint $table) {
            if(Schema::hasColumn('parts', 'repair_center_id')) {
                $table->dropForeign('237094_5c083a251097a');
                $table->dropIndex('237094_5c083a251097a');
                $table->dropColumn('repair_center_id');
            }
            if(Schema::hasColumn('parts', 'unit_id')) {
                $table->dropForeign('237094_5ce68e8a92f1d');
                $table->dropIndex('237094_5ce68e8a92f1d');
                $table->dropColumn('unit_id');
            }
            
        });
    }
}
