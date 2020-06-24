<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad63dd5c9RelationshipsToMachineryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machinery_types', function(Blueprint $table) {
            if (!Schema::hasColumn('machinery_types', 'attachment_id')) {
                $table->integer('attachment_id')->unsigned()->nullable();
                $table->foreign('attachment_id', '237051_5c0839f9c80a0')->references('id')->on('truck_attachment_statuses')->onDelete('cascade');
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
        Schema::table('machinery_types', function(Blueprint $table) {
            if(Schema::hasColumn('machinery_types', 'attachment_id')) {
                $table->dropForeign('237051_5c0839f9c80a0');
                $table->dropIndex('237051_5c0839f9c80a0');
                $table->dropColumn('attachment_id');
            }
            
        });
    }
}
