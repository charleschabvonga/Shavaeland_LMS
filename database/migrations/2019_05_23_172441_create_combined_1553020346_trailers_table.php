<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1553020346TrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('trailers')) {
            Schema::create('trailers', function (Blueprint $table) {
                $table->increments('id');
                $table->string('trailer_description')->nullable();
                $table->string('make')->nullable();
                $table->string('model')->nullable();
                $table->enum('availability', array('Yes', 'No(Road Freight)', 'N0(Workshop)'))->nullable();
                $table->enum('service_status', array('Scheduled', 'Caution', 'Due', 'Done'))->nullable();
                $table->string('chasis_number')->nullable();
                $table->date('purchase_date')->nullable();
                $table->decimal('purchase_price', 15, 2)->nullable();
                $table->decimal('salvage_value', 15, 2)->nullable();
                $table->decimal('investment', 15, 2)->nullable();
                $table->decimal('depreciation', 15, 2)->nullable();
                $table->decimal('maintenance', 15, 2)->nullable();
                $table->decimal('tyre', 15, 2)->nullable();
                
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
        Schema::dropIfExists('trailers');
    }
}
