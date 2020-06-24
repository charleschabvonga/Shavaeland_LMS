<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2ee265eRelationshipsToTrailerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trailers', function(Blueprint $table) {
            if (!Schema::hasColumn('trailers', 'trailer_type_id')) {
                $table->integer('trailer_type_id')->unsigned()->nullable();
                $table->foreign('trailer_type_id', '280017_5c9135bf0fe59')->references('id')->on('machinery_types')->onDelete('cascade');
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
        Schema::table('trailers', function(Blueprint $table) {
            if(Schema::hasColumn('trailers', 'trailer_type_id')) {
                $table->dropForeign('280017_5c9135bf0fe59');
                $table->dropIndex('280017_5c9135bf0fe59');
                $table->dropColumn('trailer_type_id');
            }
            
        });
    }
}
