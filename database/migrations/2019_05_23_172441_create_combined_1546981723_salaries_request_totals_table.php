<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1546981723SalariesRequestTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('salaries_request_totals')) {
            Schema::create('salaries_request_totals', function (Blueprint $table) {
                $table->increments('id');
                $table->string('batch_number')->nullable();
                $table->date('starting_pay_date')->nullable();
                $table->date('ending_pay_date')->nullable();
                $table->enum('status', array('In progress', 'Partially paid', 'Paid', 'Payment due'))->nullable();
                
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
        Schema::dropIfExists('salaries_request_totals');
    }
}
