<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad2f7e02eRelationshipsToQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotations', function(Blueprint $table) {
            if (!Schema::hasColumn('quotations', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237090_5c083a5bcf54d')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('quotations', 'contact_person_id')) {
                $table->integer('contact_person_id')->unsigned()->nullable();
                $table->foreign('contact_person_id', '237090_5c083a5be5f68')->references('id')->on('client_contacts')->onDelete('cascade');
                }
                if (!Schema::hasColumn('quotations', 'sales_person_id')) {
                $table->integer('sales_person_id')->unsigned()->nullable();
                $table->foreign('sales_person_id', '237090_5c083a5c00baf')->references('id')->on('employees')->onDelete('cascade');
                }
                if (!Schema::hasColumn('quotations', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237090_5cd69d3d73582')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('quotations', function(Blueprint $table) {
            if(Schema::hasColumn('quotations', 'client_id')) {
                $table->dropForeign('237090_5c083a5bcf54d');
                $table->dropIndex('237090_5c083a5bcf54d');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('quotations', 'contact_person_id')) {
                $table->dropForeign('237090_5c083a5be5f68');
                $table->dropIndex('237090_5c083a5be5f68');
                $table->dropColumn('contact_person_id');
            }
            if(Schema::hasColumn('quotations', 'sales_person_id')) {
                $table->dropForeign('237090_5c083a5c00baf');
                $table->dropIndex('237090_5c083a5c00baf');
                $table->dropColumn('sales_person_id');
            }
            if(Schema::hasColumn('quotations', 'currency_id')) {
                $table->dropForeign('237090_5cd69d3d73582');
                $table->dropIndex('237090_5cd69d3d73582');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
