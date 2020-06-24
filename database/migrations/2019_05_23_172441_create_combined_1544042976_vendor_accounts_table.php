<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCombined1544042976VendorAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('vendor_accounts')) {
            Schema::create('vendor_accounts', function (Blueprint $table) {
                $table->increments('id');
                $table->string('account_number')->nullable();
                $table->enum('status', array('Not active', 'Payment due', 'Up to date', 'Paid off', 'Credit available', 'Refund pymt due', 'Closed'))->nullable();
                
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
        Schema::dropIfExists('vendor_accounts');
    }
}
