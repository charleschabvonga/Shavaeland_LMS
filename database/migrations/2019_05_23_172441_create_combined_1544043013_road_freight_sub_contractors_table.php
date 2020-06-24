<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043013RoadFreightSubContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('road_freight_sub_contractors')) {
            Schema::create('road_freight_sub_contractors', function (Blueprint $table) {
                $table->increments('id');
                $table->string('subcontractor_number')->nullable();
                $table->string('git_cover_number')->nullable();
                $table->string('git_cover')->nullable();
                $table->enum('status', array('Under process', 'Approved', 'Declined'))->nullable();
                $table->date('git_expiry_date')->nullable();
                $table->enum('git_status', array('Up to date', 'GIT expired'))->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('road_freight_sub_contractors');
    }
}
