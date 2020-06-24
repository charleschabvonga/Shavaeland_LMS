<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad64633dcRelationshipsToInvoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function(Blueprint $table) {
            if (!Schema::hasColumn('invoice_items', 'invoice_number_id')) {
                $table->integer('invoice_number_id')->unsigned()->nullable();
                $table->foreign('invoice_number_id', '237066_5c083a75ae47b')->references('id')->on('income_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'bill_number_id')) {
                $table->integer('bill_number_id')->unsigned()->nullable();
                $table->foreign('bill_number_id', '237066_5c083a75bf7e3')->references('id')->on('expense_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'credit_note_number_id')) {
                $table->integer('credit_note_number_id')->unsigned()->nullable();
                $table->foreign('credit_note_number_id', '237066_5c083a75cf7a4')->references('id')->on('credit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'debit_note_number_id')) {
                $table->integer('debit_note_number_id')->unsigned()->nullable();
                $table->foreign('debit_note_number_id', '237066_5c083a75df693')->references('id')->on('debit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'clearance_and_forwarding_number_id')) {
                $table->integer('clearance_and_forwarding_number_id')->unsigned()->nullable();
                $table->foreign('clearance_and_forwarding_number_id', '237066_5c083a76009d7')->references('id')->on('clearance_and_forwardings')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'quotation_number_id')) {
                $table->integer('quotation_number_id')->unsigned()->nullable();
                $table->foreign('quotation_number_id', '237066_5c083a76144da')->references('id')->on('quotations')->onDelete('cascade');
                }
                if (!Schema::hasColumn('invoice_items', 'purchase_order_number_id')) {
                $table->integer('purchase_order_number_id')->unsigned()->nullable();
                $table->foreign('purchase_order_number_id', '237066_5c9a5a200d09d')->references('id')->on('purchase_orders')->onDelete('cascade');
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
        Schema::table('invoice_items', function(Blueprint $table) {
            if(Schema::hasColumn('invoice_items', 'invoice_number_id')) {
                $table->dropForeign('237066_5c083a75ae47b');
                $table->dropIndex('237066_5c083a75ae47b');
                $table->dropColumn('invoice_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'bill_number_id')) {
                $table->dropForeign('237066_5c083a75bf7e3');
                $table->dropIndex('237066_5c083a75bf7e3');
                $table->dropColumn('bill_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'credit_note_number_id')) {
                $table->dropForeign('237066_5c083a75cf7a4');
                $table->dropIndex('237066_5c083a75cf7a4');
                $table->dropColumn('credit_note_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'debit_note_number_id')) {
                $table->dropForeign('237066_5c083a75df693');
                $table->dropIndex('237066_5c083a75df693');
                $table->dropColumn('debit_note_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'clearance_and_forwarding_number_id')) {
                $table->dropForeign('237066_5c083a76009d7');
                $table->dropIndex('237066_5c083a76009d7');
                $table->dropColumn('clearance_and_forwarding_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'quotation_number_id')) {
                $table->dropForeign('237066_5c083a76144da');
                $table->dropIndex('237066_5c083a76144da');
                $table->dropColumn('quotation_number_id');
            }
            if(Schema::hasColumn('invoice_items', 'purchase_order_number_id')) {
                $table->dropForeign('237066_5c9a5a200d09d');
                $table->dropIndex('237066_5c9a5a200d09d');
                $table->dropColumn('purchase_order_number_id');
            }
            
        });
    }
}
