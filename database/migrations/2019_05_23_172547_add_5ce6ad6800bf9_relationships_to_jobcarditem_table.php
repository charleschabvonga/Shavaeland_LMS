<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6800bf9RelationshipsToJobCardItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_card_items', function(Blueprint $table) {
            if (!Schema::hasColumn('job_card_items', 'job_card_items_id')) {
                $table->integer('job_card_items_id')->unsigned()->nullable();
                $table->foreign('job_card_items_id', '237062_5c083a86d6317')->references('id')->on('inhouse_job_cards')->onDelete('cascade');
                }
                if (!Schema::hasColumn('job_card_items', 'client_job_card_number_id')) {
                $table->integer('client_job_card_number_id')->unsigned()->nullable();
                $table->foreign('client_job_card_number_id', '237062_5c083a8702c47')->references('id')->on('client_job_cards')->onDelete('cascade');
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
        Schema::table('job_card_items', function(Blueprint $table) {
            if(Schema::hasColumn('job_card_items', 'job_card_items_id')) {
                $table->dropForeign('237062_5c083a86d6317');
                $table->dropIndex('237062_5c083a86d6317');
                $table->dropColumn('job_card_items_id');
            }
            if(Schema::hasColumn('job_card_items', 'client_job_card_number_id')) {
                $table->dropForeign('237062_5c083a8702c47');
                $table->dropIndex('237062_5c083a8702c47');
                $table->dropColumn('client_job_card_number_id');
            }
            
        });
    }
}
