<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PayeePaymentTest extends DuskTestCase
{

    public function testCreatePayeePayment()
    {
        $admin = \App\User::find(1);
        $payee_payment = factory('App\PayeePayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payee_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_payments.index'))
                ->clickLink('Add new')
                ->type("entry_date", $payee_payment->entry_date)
                ->select("employee_id", $payee_payment->employee_id)
                ->select("payslip_number_id", $payee_payment->payslip_number_id)
                ->select("batch_number_id", $payee_payment->batch_number_id)
                ->select("withdrawal_transaction_number_id", $payee_payment->withdrawal_transaction_number_id)
                ->select("payee_account_number_id", $payee_payment->payee_account_number_id)
                ->type("payee_payment_number", $payee_payment->payee_payment_number)
                ->select("payment_mode", $payee_payment->payment_mode)
                ->type("amount", $payee_payment->amount)
                ->type("prepared_by", $payee_payment->prepared_by)
                ->press('Save')
                ->assertRouteIs('admin.payee_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $payee_payment->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payee_payment->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='payslip_number']", $payee_payment->payslip_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $payee_payment->batch_number->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $payee_payment->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='payee_account_number']", $payee_payment->payee_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='payee_payment_number']", $payee_payment->payee_payment_number)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $payee_payment->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payee_payment->amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $payee_payment->prepared_by)
                ->logout();
        });
    }

    public function testEditPayeePayment()
    {
        $admin = \App\User::find(1);
        $payee_payment = factory('App\PayeePayment')->create();
        $payee_payment2 = factory('App\PayeePayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $payee_payment, $payee_payment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_payments.index'))
                ->click('tr[data-entry-id="' . $payee_payment->id . '"] .btn-info')
                ->type("entry_date", $payee_payment2->entry_date)
                ->select("employee_id", $payee_payment2->employee_id)
                ->select("payslip_number_id", $payee_payment2->payslip_number_id)
                ->select("batch_number_id", $payee_payment2->batch_number_id)
                ->select("withdrawal_transaction_number_id", $payee_payment2->withdrawal_transaction_number_id)
                ->select("payee_account_number_id", $payee_payment2->payee_account_number_id)
                ->type("payee_payment_number", $payee_payment2->payee_payment_number)
                ->select("payment_mode", $payee_payment2->payment_mode)
                ->type("amount", $payee_payment2->amount)
                ->type("prepared_by", $payee_payment2->prepared_by)
                ->press('Update')
                ->assertRouteIs('admin.payee_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $payee_payment2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='employee']", $payee_payment2->employee->name)
                ->assertSeeIn("tr:last-child td[field-key='payslip_number']", $payee_payment2->payslip_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='batch_number']", $payee_payment2->batch_number->batch_number)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $payee_payment2->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='payee_account_number']", $payee_payment2->payee_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='payee_payment_number']", $payee_payment2->payee_payment_number)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $payee_payment2->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $payee_payment2->amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $payee_payment2->prepared_by)
                ->logout();
        });
    }

    public function testShowPayeePayment()
    {
        $admin = \App\User::find(1);
        $payee_payment = factory('App\PayeePayment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $payee_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.payee_payments.index'))
                ->click('tr[data-entry-id="' . $payee_payment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='entry_date']", $payee_payment->entry_date)
                ->assertSeeIn("td[field-key='employee']", $payee_payment->employee->name)
                ->assertSeeIn("td[field-key='payslip_number']", $payee_payment->payslip_number->payslip_number)
                ->assertSeeIn("td[field-key='batch_number']", $payee_payment->batch_number->batch_number)
                ->assertSeeIn("td[field-key='withdrawal_transaction_number']", $payee_payment->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("td[field-key='payee_account_number']", $payee_payment->payee_account_number->account_number)
                ->assertSeeIn("td[field-key='payee_payment_number']", $payee_payment->payee_payment_number)
                ->assertSeeIn("td[field-key='payment_mode']", $payee_payment->payment_mode)
                ->assertSeeIn("td[field-key='amount']", $payee_payment->amount)
                ->assertSeeIn("td[field-key='prepared_by']", $payee_payment->prepared_by)
                ->logout();
        });
    }

}
