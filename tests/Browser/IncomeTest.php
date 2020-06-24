<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IncomeTest extends DuskTestCase
{

    public function testCreateIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->clickLink('Add new')
                ->type("entry_date", $income->entry_date)
                ->select("payment_type", $income->payment_type)
                ->select("deposit_transaction_number_id", $income->deposit_transaction_number_id)
                ->type("prepared_by", $income->prepared_by)
                ->type("payment_number", $income->payment_number)
                ->select("invoice_number_id", $income->invoice_number_id)
                ->select("sales_credit_note_number_id", $income->sales_credit_note_number_id)
                ->select("client_id", $income->client_id)
                ->select("debit_note_number_id", $income->debit_note_number_id)
                ->select("vendor_id", $income->vendor_id)
                ->select("operation_type_id", $income->operation_type_id)
                ->select("project_type_id", $income->project_type_id)
                ->select("project_number_id", $income->project_number_id)
                ->type("income_category", $income->income_category)
                ->type("amount", $income->amount)
                ->press('Save')
                ->assertRouteIs('admin.incomes.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $income->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='deposit_transaction_number']", $income->deposit_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $income->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $income->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $income->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='sales_credit_note_number']", $income->sales_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $income->client->name)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $income->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $income->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='operation_type']", $income->operation_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_type']", $income->project_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $income->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='income_category']", $income->income_category)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $income->amount)
                ->logout();
        });
    }

    public function testEditIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->create();
        $income2 = factory('App\Income')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $income, $income2) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->click('tr[data-entry-id="' . $income->id . '"] .btn-info')
                ->type("entry_date", $income2->entry_date)
                ->select("payment_type", $income2->payment_type)
                ->select("deposit_transaction_number_id", $income2->deposit_transaction_number_id)
                ->type("prepared_by", $income2->prepared_by)
                ->type("payment_number", $income2->payment_number)
                ->select("invoice_number_id", $income2->invoice_number_id)
                ->select("sales_credit_note_number_id", $income2->sales_credit_note_number_id)
                ->select("client_id", $income2->client_id)
                ->select("debit_note_number_id", $income2->debit_note_number_id)
                ->select("vendor_id", $income2->vendor_id)
                ->select("operation_type_id", $income2->operation_type_id)
                ->select("project_type_id", $income2->project_type_id)
                ->select("project_number_id", $income2->project_number_id)
                ->type("income_category", $income2->income_category)
                ->type("amount", $income2->amount)
                ->press('Update')
                ->assertRouteIs('admin.incomes.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $income2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='payment_type']", $income2->payment_type)
                ->assertSeeIn("tr:last-child td[field-key='deposit_transaction_number']", $income2->deposit_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $income2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $income2->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $income2->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='sales_credit_note_number']", $income2->sales_credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $income2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $income2->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $income2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='operation_type']", $income2->operation_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_type']", $income2->project_type->name)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $income2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='income_category']", $income2->income_category)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $income2->amount)
                ->logout();
        });
    }

    public function testShowIncome()
    {
        $admin = \App\User::find(1);
        $income = factory('App\Income')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $income) {
            $browser->loginAs($admin)
                ->visit(route('admin.incomes.index'))
                ->click('tr[data-entry-id="' . $income->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='entry_date']", $income->entry_date)
                ->assertSeeIn("td[field-key='payment_type']", $income->payment_type)
                ->assertSeeIn("td[field-key='deposit_transaction_number']", $income->deposit_transaction_number->payment_number)
                ->assertSeeIn("td[field-key='prepared_by']", $income->prepared_by)
                ->assertSeeIn("td[field-key='payment_number']", $income->payment_number)
                ->assertSeeIn("td[field-key='invoice_number']", $income->invoice_number->invoice_number)
                ->assertSeeIn("td[field-key='sales_credit_note_number']", $income->sales_credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='client']", $income->client->name)
                ->assertSeeIn("td[field-key='debit_note_number']", $income->debit_note_number->debit_note_number)
                ->assertSeeIn("td[field-key='vendor']", $income->vendor->name)
                ->assertSeeIn("td[field-key='operation_type']", $income->operation_type->name)
                ->assertSeeIn("td[field-key='project_type']", $income->project_type->name)
                ->assertSeeIn("td[field-key='project_number']", $income->project_number->operation_number)
                ->assertSeeIn("td[field-key='income_category']", $income->income_category)
                ->assertSeeIn("td[field-key='amount']", $income->amount)
                ->logout();
        });
    }

}
