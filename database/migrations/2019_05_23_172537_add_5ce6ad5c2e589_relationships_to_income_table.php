<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad5c2e589RelationshipsToIncomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes', function(Blueprint $table) {
            if (!Schema::hasColumn('incomes', 'deposit_transaction_number_id')) {
                $table->integer('deposit_transaction_number_id')->unsigned()->nullable();
                $table->foreign('deposit_transaction_number_id', '237033_5c0a17d943191')->references('id')->on('bank_payments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'invoice_number_id')) {
                $table->integer('invoice_number_id')->unsigned()->nullable();
                $table->foreign('invoice_number_id', '237033_5c0a0c4182e7e')->references('id')->on('income_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'sales_credit_note_number_id')) {
                $table->integer('sales_credit_note_number_id')->unsigned()->nullable();
                $table->foreign('sales_credit_note_number_id', '237033_5c430d76394ba')->references('id')->on('credit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237033_5c0a17d90ac0e')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'debit_note_number_id')) {
                $table->integer('debit_note_number_id')->unsigned()->nullable();
                $table->foreign('debit_note_number_id', '237033_5c10a17fdde5e')->references('id')->on('debit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237033_5c0a17d91d10d')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'operation_type_id')) {
                $table->integer('operation_type_id')->unsigned()->nullable();
                $table->foreign('operation_type_id', '237033_5c21bf2362f7b')->references('id')->on('operation_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'project_type_id')) {
                $table->integer('project_type_id')->unsigned()->nullable();
                $table->foreign('project_type_id', '237033_5c0a17d956b10')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'project_number_id')) {
                $table->integer('project_number_id')->unsigned()->nullable();
                $table->foreign('project_number_id', '237033_5c0a17d96936c')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('incomes', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237033_5cdef47aac63d')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('incomes', function(Blueprint $table) {
            if(Schema::hasColumn('incomes', 'deposit_transaction_number_id')) {
                $table->dropForeign('237033_5c0a17d943191');
                $table->dropIndex('237033_5c0a17d943191');
                $table->dropColumn('deposit_transaction_number_id');
            }
            if(Schema::hasColumn('incomes', 'invoice_number_id')) {
                $table->dropForeign('237033_5c0a0c4182e7e');
                $table->dropIndex('237033_5c0a0c4182e7e');
                $table->dropColumn('invoice_number_id');
            }
            if(Schema::hasColumn('incomes', 'sales_credit_note_number_id')) {
                $table->dropForeign('237033_5c430d76394ba');
                $table->dropIndex('237033_5c430d76394ba');
                $table->dropColumn('sales_credit_note_number_id');
            }
            if(Schema::hasColumn('incomes', 'client_id')) {
                $table->dropForeign('237033_5c0a17d90ac0e');
                $table->dropIndex('237033_5c0a17d90ac0e');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('incomes', 'debit_note_number_id')) {
                $table->dropForeign('237033_5c10a17fdde5e');
                $table->dropIndex('237033_5c10a17fdde5e');
                $table->dropColumn('debit_note_number_id');
            }
            if(Schema::hasColumn('incomes', 'vendor_id')) {
                $table->dropForeign('237033_5c0a17d91d10d');
                $table->dropIndex('237033_5c0a17d91d10d');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('incomes', 'operation_type_id')) {
                $table->dropForeign('237033_5c21bf2362f7b');
                $table->dropIndex('237033_5c21bf2362f7b');
                $table->dropColumn('operation_type_id');
            }
            if(Schema::hasColumn('incomes', 'project_type_id')) {
                $table->dropForeign('237033_5c0a17d956b10');
                $table->dropIndex('237033_5c0a17d956b10');
                $table->dropColumn('project_type_id');
            }
            if(Schema::hasColumn('incomes', 'project_number_id')) {
                $table->dropForeign('237033_5c0a17d96936c');
                $table->dropIndex('237033_5c0a17d96936c');
                $table->dropColumn('project_number_id');
            }
            if(Schema::hasColumn('incomes', 'currency_id')) {
                $table->dropForeign('237033_5cdef47aac63d');
                $table->dropIndex('237033_5cdef47aac63d');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
