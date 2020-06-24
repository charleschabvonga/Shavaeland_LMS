<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5ce6ad60b2361RelationshipsToExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenses', function(Blueprint $table) {
            if (!Schema::hasColumn('expenses', 'withdrawal_transaction_number_id')) {
                $table->integer('withdrawal_transaction_number_id')->unsigned()->nullable();
                $table->foreign('withdrawal_transaction_number_id', '237034_5c0a28c9c0fc7')->references('id')->on('vendor_bank_payments')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'vendor_credit_note_number_id')) {
                $table->integer('vendor_credit_note_number_id')->unsigned()->nullable();
                $table->foreign('vendor_credit_note_number_id', '237034_5c0a28c98e0b6')->references('id')->on('expense_categories')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'debit_note_number_id')) {
                $table->integer('debit_note_number_id')->unsigned()->nullable();
                $table->foreign('debit_note_number_id', '237034_5c4313f9b8619')->references('id')->on('debit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'vendor_id')) {
                $table->integer('vendor_id')->unsigned()->nullable();
                $table->foreign('vendor_id', '237034_5c0a28c96699a')->references('id')->on('vendors')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'client_credit_note_number_id')) {
                $table->integer('client_credit_note_number_id')->unsigned()->nullable();
                $table->foreign('client_credit_note_number_id', '237034_5c0a28c9a5c2c')->references('id')->on('credit_notes')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'client_id')) {
                $table->integer('client_id')->unsigned()->nullable();
                $table->foreign('client_id', '237034_5c0a28c9799d5')->references('id')->on('time_projects')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'operation_type_id')) {
                $table->integer('operation_type_id')->unsigned()->nullable();
                $table->foreign('operation_type_id', '237034_5c21c1853f0a6')->references('id')->on('operation_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'transaction_type_id')) {
                $table->integer('transaction_type_id')->unsigned()->nullable();
                $table->foreign('transaction_type_id', '237034_5c0a28c9d9591')->references('id')->on('time_work_types')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'transaction_number_id')) {
                $table->integer('transaction_number_id')->unsigned()->nullable();
                $table->foreign('transaction_number_id', '237034_5c0a28c9f17cb')->references('id')->on('time_entries')->onDelete('cascade');
                }
                if (!Schema::hasColumn('expenses', 'currency_id')) {
                $table->integer('currency_id')->unsigned()->nullable();
                $table->foreign('currency_id', '237034_5cdefcb7778e0')->references('id')->on('currencies')->onDelete('cascade');
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
        Schema::table('expenses', function(Blueprint $table) {
            if(Schema::hasColumn('expenses', 'withdrawal_transaction_number_id')) {
                $table->dropForeign('237034_5c0a28c9c0fc7');
                $table->dropIndex('237034_5c0a28c9c0fc7');
                $table->dropColumn('withdrawal_transaction_number_id');
            }
            if(Schema::hasColumn('expenses', 'vendor_credit_note_number_id')) {
                $table->dropForeign('237034_5c0a28c98e0b6');
                $table->dropIndex('237034_5c0a28c98e0b6');
                $table->dropColumn('vendor_credit_note_number_id');
            }
            if(Schema::hasColumn('expenses', 'debit_note_number_id')) {
                $table->dropForeign('237034_5c4313f9b8619');
                $table->dropIndex('237034_5c4313f9b8619');
                $table->dropColumn('debit_note_number_id');
            }
            if(Schema::hasColumn('expenses', 'vendor_id')) {
                $table->dropForeign('237034_5c0a28c96699a');
                $table->dropIndex('237034_5c0a28c96699a');
                $table->dropColumn('vendor_id');
            }
            if(Schema::hasColumn('expenses', 'client_credit_note_number_id')) {
                $table->dropForeign('237034_5c0a28c9a5c2c');
                $table->dropIndex('237034_5c0a28c9a5c2c');
                $table->dropColumn('client_credit_note_number_id');
            }
            if(Schema::hasColumn('expenses', 'client_id')) {
                $table->dropForeign('237034_5c0a28c9799d5');
                $table->dropIndex('237034_5c0a28c9799d5');
                $table->dropColumn('client_id');
            }
            if(Schema::hasColumn('expenses', 'operation_type_id')) {
                $table->dropForeign('237034_5c21c1853f0a6');
                $table->dropIndex('237034_5c21c1853f0a6');
                $table->dropColumn('operation_type_id');
            }
            if(Schema::hasColumn('expenses', 'transaction_type_id')) {
                $table->dropForeign('237034_5c0a28c9d9591');
                $table->dropIndex('237034_5c0a28c9d9591');
                $table->dropColumn('transaction_type_id');
            }
            if(Schema::hasColumn('expenses', 'transaction_number_id')) {
                $table->dropForeign('237034_5c0a28c9f17cb');
                $table->dropIndex('237034_5c0a28c9f17cb');
                $table->dropColumn('transaction_number_id');
            }
            if(Schema::hasColumn('expenses', 'currency_id')) {
                $table->dropForeign('237034_5cdefcb7778e0');
                $table->dropIndex('237034_5cdefcb7778e0');
                $table->dropColumn('currency_id');
            }
            
        });
    }
}
