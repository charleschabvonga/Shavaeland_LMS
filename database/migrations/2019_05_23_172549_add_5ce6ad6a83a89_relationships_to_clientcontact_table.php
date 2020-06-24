<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6a83a89RelationshipsToClientContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_contacts', function(Blueprint $table) {
            if (!Schema::hasColumn('client_contacts', 'company_name_id')) {
                $table->integer('company_name_id')->unsigned()->nullable();
                $table->foreign('company_name_id', '237055_5c0839fd4fe48')->references('id')->on('time_projects')->onDelete('cascade');
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
        Schema::table('client_contacts', function(Blueprint $table) {
            if(Schema::hasColumn('client_contacts', 'company_name_id')) {
                $table->dropForeign('237055_5c0839fd4fe48');
                $table->dropIndex('237055_5c0839fd4fe48');
                $table->dropColumn('company_name_id');
            }
            
        });
    }
}
