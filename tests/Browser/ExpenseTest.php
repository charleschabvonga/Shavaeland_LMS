<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ExpenseTest extends DuskTestCase
{

    public function testCreateExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->clickLink('Add new')
                ->type("entry_date", $expense->entry_date)
                ->select("payment_type", $expense->payment_type)
                ->select("withdrawal_transaction_number_id", $expense->withdrawal_transaction_number_id)
                ->type("prepared_by", $expense->prepared_by)
                ->type("payment_number", $expense->payment_number)
                ->select("vendor_credit_note_number_id", $expense->vendor_credit_note_number_id)
                ->select("debit_note_number_id", $expense->debit_note_number_id)
                ->select("vendor_id", $expense->vendor_id)
                ->select("client_credit_note_number_id", $expense->client_credit_note_number_id)
                ->select("client_id", $expense->client_id)
                ->select("operation_type_id", $expense->operation_type_id)
                ->select("transaction_type_id", $expense->transaction_type_id)
                ->select("transaction_number_id", $expense->transaction_number_id)
                ->type("expense_category", $expense->expense_category)
                ->type("amount", $expense->amount)
                ->press('Save')
                ->assertRouteIs('admin.expenses.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $expense->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $expense->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $expense->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $expense->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_credit_note_number']", $expense->vendor_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $expense->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $expense->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='client_credit_note_number']", $expense->client_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $expense->client->name)
                ->assertSeeIn("tr:last-child td[field-key='operation_type']", $expense->operation_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $expense->transaction_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $expense->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='expense_category']", $expense->expense_category)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $expense->amount)
                ->logout();
        });
    }

    public function testEditExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->create();
        $expense2 = factory('App\Expense')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $expense, $expense2) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->click('tr[data-entry-id="' . $expense->id . '"] .btn-info')
                ->type("entry_date", $expense2->entry_date)
                ->select("payment_type", $expense2->payment_type)
                ->select("withdrawal_transaction_number_id", $expense2->withdrawal_transaction_number_id)
                ->type("prepared_by", $expense2->prepared_by)
                ->type("payment_number", $expense2->payment_number)
                ->select("vendor_credit_note_number_id", $expense2->vendor_credit_note_number_id)
                ->select("debit_note_number_id", $expense2->debit_note_number_id)
                ->select("vendor_id", $expense2->vendor_id)
                ->select("client_credit_note_number_id", $expense2->client_credit_note_number_id)
                ->select("client_id", $expense2->client_id)
                ->select("operation_type_id", $expense2->operation_type_id)
                ->select("transaction_type_id", $expense2->transaction_type_id)
                ->select("transaction_number_id", $expense2->transaction_number_id)
                ->type("expense_category", $expense2->expense_category)
                ->type("amount", $expense2->amount)
                ->press('Update')
                ->assertRouteIs('admin.expenses.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $expense2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $expense2->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $expense2->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $expense2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $expense2->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_credit_note_number']", $expense2->vendor_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $expense2->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $expense2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='client_credit_note_number']", $expense2->client_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $expense2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='operation_type']", $expense2->operation_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $expense2->transaction_type->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $expense2->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='expense_category']", $expense2->expense_category)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $expense2->amount)
                ->logout();
        });
    }

    public function testShowExpense()
    {
        $admin = \App\User::find(1);
        $expense = factory('App\Expense')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $expense) {
            $browser->loginAs($admin)
                ->visit(route('admin.expenses.index'))
                ->click('tr[data-entry-id="' . $expense->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='entry_date']", $expense->entry_date)
                ->assertSeeIn("td[field-key='payment_type']", $expense->payment_type)
                ->assertSeeIn("td[field-key='withdrawal_transaction_number']", $expense->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("td[field-key='prepared_by']", $expense->prepared_by)
                ->assertSeeIn("td[field-key='payment_number']", $expense->payment_number)
                ->assertSeeIn("td[field-key='vendor_credit_note_number']", $expense->vendor_credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='debit_note_number']", $expense->debit_note_number->debit_note_number)
                ->assertSeeIn("td[field-key='vendor']", $expense->vendor->name)
                ->assertSeeIn("td[field-key='client_credit_note_number']", $expense->client_credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='client']", $expense->client->name)
                ->assertSeeIn("td[field-key='operation_type']", $expense->operation_type->name)
                ->assertSeeIn("td[field-key='transaction_type']", $expense->transaction_type->name)
                ->assertSeeIn("td[field-key='transaction_number']", $expense->transaction_number->operation_number)
                ->assertSeeIn("td[field-key='expense_category']", $expense->expense_category)
                ->assertSeeIn("td[field-key='amount']", $expense->amount)
                ->logout();
        });
    }

}
