<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544043046PartsAcquiredsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('parts_acquireds')) {
            Schema::create('parts_acquireds', function (Blueprint $table) {
                $table->increments('id');
                $table->string('order_number')->nullable();
                $table->string('prepared_by')->nullable();
                $table->date('date')->nullable();
                $table->enum('transaction_type', array('Procurement', 'Request'))->nullable();
                $table->double('qty', 15, 2)->nullable();
                $table->decimal('unit_price', 15, 2)->nullable();
                $table->decimal('total', 15, 2)->nullable();
                
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
        Schema::dropIfExists('parts_acquireds');
    }
}
