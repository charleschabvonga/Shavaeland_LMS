<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad31c4e9fRelationshipsToPurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_orders', function(Blueprint $table) {
            if (!Schema::hasColumn('purchase_orders', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '282933_5c9a52fb5853c')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('purchase_orders', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '282933_5c9a52fb8196c')->references('id')->on('vendor_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('purchase_orders', 'buyer_id')) {
                $table->integer('buyer_id')->unsigned()->nullable();
                $table->foreign('buyer_id', '282933_5c9a52fbadc6f')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('purchase_orders', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '282933_5cd69f1c21b81')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('purchase_orders', function(Blueprint $table) {
            if(Schema::hasColumn('purchase_orders', 'vendor_id')) {
                $table->dropForeign('282933_5c9a52fb5853c');
                $table->dropIndex('282933_5c9a52fb5853c');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('purchase_orders', 'contact_person_id')) {
                $table->dropForeign('282933_5c9a52fb8196c');
                $table->dropIndex('282933_5c9a52fb8196c');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('purchase_orders', 'buyer_id')) {
                $table->dropForeign('282933_5c9a52fbadc6f');
                $table->dropIndex('282933_5c9a52fbadc6f');
                $table->dropColumn('buyer_id');
            }
            if(Schema::hasColumn('purchase_orders', 'currency_id')) {
                $table->dropForeign('282933_5cd69f1c21b81');
                $table->dropIndex('282933_5cd69f1c21b81');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
