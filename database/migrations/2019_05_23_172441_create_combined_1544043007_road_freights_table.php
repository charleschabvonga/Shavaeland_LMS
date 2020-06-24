<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043007RoadFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('road_freights')) {
            Schema::create('road_freights', function (Blueprint $table) {
                $table->increments('id');
                $table->string('road_freight_number')->nullable();
                $table->enum('freight_contract_type', array('Shavaeland', 'Subcontractor'))->nullable();
                $table->decimal('road_freight_income', 15, 2)->nullable();
                $table->decimal('road_freight_expenses', 15, 2)->nullable();
                $table->decimal('machinery_costs', 15, 2)->nullable();
                $table->decimal('breakdown', 15, 2)->nullable();
                $table->decimal('total_expenses', 15, 2)->nullable();
                $table->decimal('net_income', 15, 2)->nullable();
                
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
        Schema::dropIfExists('road_freights');
    }
}
