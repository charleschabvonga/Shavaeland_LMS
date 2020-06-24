<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad68785edRelationshipsToLoadingRequirementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('loading_requirements', function(Blueprint $table) {
            if (!Schema::hasColumn('loading_requirements', 'loading_instruction_number_id')) {
                $table->integer('loading_instruction_number_id')->unsigned()->nullable();
                $table->foreign('loading_instruction_number_id', '237061_5c083a8ac7a15')->references('id')->on('loading_instructions')->onDelete('cascade');
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
        Schema::table('loading_requirements', function(Blueprint $table) {
            if(Schema::hasColumn('loading_requirements', 'loading_instruction_number_id')) {
                $table->dropForeign('237061_5c083a8ac7a15');
                $table->dropIndex('237061_5c083a8ac7a15');
                $table->dropColumn('loading_instruction_number_id');
            }
            
        });
    }
}
