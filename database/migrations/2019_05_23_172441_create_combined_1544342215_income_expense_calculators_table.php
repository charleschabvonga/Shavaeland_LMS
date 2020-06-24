<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544342215IncomeExpenseCalculatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('income_expense_calculators')) {
            Schema::create('income_expense_calculators', function (Blueprint $table) {
                $table->increments('id');
                $table->double('distance', 15, 2)->nullable();
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
                $table->decimal('tyre_price', 15, 2)->nullable();
                $table->double('number_of_tyres', 15, 2)->nullable();
                $table->decimal('tyre', 15, 2)->nullable();
                $table->decimal('repair_maintenance', 15, 2)->nullable();
                $table->decimal('contigency_factor', 15, 2)->nullable();
                $table->decimal('trip_income', 15, 2)->nullable();
                $table->decimal('other_costs', 15, 2)->nullable();
                $table->decimal('total_costs', 15, 2)->nullable();
                $table->decimal('balance', 15, 2)->nullable();
                
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
        Schema::dropIfExists('income_expense_calculators');
    }
}
