<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad6abd263RelationshipsToVendorContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_contacts', function(Blueprint $table) {
            if (!Schema::hasColumn('vendor_contacts', 'company_name_id')) {
                $table->integer('company_name_id')->unsigned()->nullable();
                $table->foreign('company_name_id', '237054_5c0839df19a44')->references('id')->on('vendors')->onDelete('cascade');
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
        Schema::table('vendor_contacts', function(Blueprint $table) {
            if(Schema::hasColumn('vendor_contacts', 'company_name_id')) {
                $table->dropForeign('237054_5c0839df19a44');
                $table->dropIndex('237054_5c0839df19a44');
                $table->dropColumn('company_name_id');
            }
            
        });
    }
}
