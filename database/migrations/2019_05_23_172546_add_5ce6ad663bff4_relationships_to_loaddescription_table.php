<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad663bff4RelationshipsToLoadDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('load_descriptions', function(Blueprint $table) {
            if (!Schema::hasColumn('load_descriptions', 'loading_instruction_number_id')) {
                $table->integer('loading_instruction_number_id')->unsigned()->nullable();
                $table->foreign('loading_instruction_number_id', '237065_5c083a7a6eb75')->references('id')->on('loading_instructions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('load_descriptions', 'delivery_instruction_number_id')) {
                $table->integer('delivery_instruction_number_id')->unsigned()->nullable();
                $table->foreign('delivery_instruction_number_id', '237065_5c083a7a8c646')->references('id')->on('delivery_instructions')->onDelete('cascade');
                }
                if (!Schema::hasColumn('load_descriptions', 'air_freight_number_id')) {
                $table->integer('air_freight_number_id')->unsigned()->nullable();
                $table->foreign('air_freight_number_id', '237065_5c083a7aa9088')->references('id')->on('air_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('load_descriptions', 'rail_freight_number_id')) {
                $table->integer('rail_freight_number_id')->unsigned()->nullable();
                $table->foreign('rail_freight_number_id', '237065_5c083a7ac6c18')->references('id')->on('rail_freights')->onDelete('cascade');
                }
                if (!Schema::hasColumn('load_descriptions', 'sea_freight_number_id')) {
                $table->integer('sea_freight_number_id')->unsigned()->nullable();
                $table->foreign('sea_freight_number_id', '237065_5c083a7ae5f0d')->references('id')->on('sea_freights')->onDelete('cascade');
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
        Schema::table('load_descriptions', function(Blueprint $table) {
            if(Schema::hasColumn('load_descriptions', 'loading_instruction_number_id')) {
                $table->dropForeign('237065_5c083a7a6eb75');
                $table->dropIndex('237065_5c083a7a6eb75');
                $table->dropColumn('loading_instruction_number_id');
            }
            if(Schema::hasColumn('load_descriptions', 'delivery_instruction_number_id')) {
                $table->dropForeign('237065_5c083a7a8c646');
                $table->dropIndex('237065_5c083a7a8c646');
                $table->dropColumn('delivery_instruction_number_id');
            }
            if(Schema::hasColumn('load_descriptions', 'air_freight_number_id')) {
                $table->dropForeign('237065_5c083a7aa9088');
                $table->dropIndex('237065_5c083a7aa9088');
                $table->dropColumn('air_freight_number_id');
            }
            if(Schema::hasColumn('load_descriptions', 'rail_freight_number_id')) {
                $table->dropForeign('237065_5c083a7ac6c18');
                $table->dropIndex('237065_5c083a7ac6c18');
                $table->dropColumn('rail_freight_number_id');
            }
            if(Schema::hasColumn('load_descriptions', 'sea_freight_number_id')) {
                $table->dropForeign('237065_5c083a7ae5f0d');
                $table->dropIndex('237065_5c083a7ae5f0d');
                $table->dropColumn('sea_freight_number_id');
            }
            
        });
    }
}
