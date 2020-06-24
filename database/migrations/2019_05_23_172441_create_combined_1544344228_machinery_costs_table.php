<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544344228MachineryCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('machinery_costs')) {
            Schema::create('machinery_costs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('distance')->nullable();
                $table->enum('load_status', array('Empty', 'Loaded'))->nullable();
                $table->decimal('purchase_price', 15, 2)->nullable();
                $table->decimal('salvage_value', 15, 2)->nullable();
                $table->decimal('avg_investment', 15, 2)->nullable();
                $table->decimal('depreciation', 15, 2)->nullable();
                $table->decimal('insurance', 15, 2)->nullable();
                $table->decimal('license', 15, 2)->nullable();
                $table->decimal('fuel_price', 15, 2)->nullable();
                $table->double('fuel_usage', 15, 2)->nullable();
                $table->decimal('fuel', 15, 2)->nullable();
                $table->double('fuel_consumption', 15, 2)->nullable();
                $table->decimal('oil_price', 15, 2)->nullable();
                $table->double('oil_usage', 15, 2)->nullable();
                $table->decimal('oil', 15, 2)->nullable();
                $table->double('oil_consumption', 15, 2)->nullable();
                $table->double('number_of_tyres', 15, 2)->nullable();
                $table->decimal('tyre_price', 15, 2)->nullable();
                $table->decimal('tyre', 15, 2)->nullable();
                $table->decimal('repair_maintenance', 15, 2)->nullable();
                $table->decimal('contigency_factor', 15, 2)->nullable();
                $table->decimal('total_costs', 15, 2)->nullable();
                $table->enum('attachment_type', array('Tri axle', 'Link', 'Rigid'))->nullable();
                
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
        Schema::dropIfExists('machinery_costs');
    }
}
