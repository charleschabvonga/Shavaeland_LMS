<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class BankPaymentTest extends DuskTestCase
{

    public function testCreateBankPayment()
    {
        $admin = \App\User::find(1);
        $bank_payment = factory('App\BankPayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bank_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.bank_payments.index'))
                ->clickLink('Add new')
                ->type("entry_date", $bank_payment->entry_date)
                ->select("depositor", $bank_payment->depositor)
                ->select("payment_mode", $bank_payment->payment_mode)
                ->type("prepared_by", $bank_payment->prepared_by)
                ->type("payment_number", $bank_payment->payment_number)
                ->select("client_id", $bank_payment->client_id)
                ->select("account_number_id", $bank_payment->account_number_id)
                ->select("vendor_id", $bank_payment->vendor_id)
                ->select("vendor_account_number_id", $bank_payment->vendor_account_number_id)
                ->select("debit_note_number_id", $bank_payment->debit_note_number_id)
                ->type("amount", $bank_payment->amount)
                ->type("balance", $bank_payment->balance)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.bank_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $bank_payment->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='depositor']", $bank_payment->depositor)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $bank_payment->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $bank_payment->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $bank_payment->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $bank_payment->client->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $bank_payment->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $bank_payment->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_account_number']", $bank_payment->vendor_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $bank_payment->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $bank_payment->amount)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $bank_payment->balance)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\BankPayment::first()->upload_document . "']")
                ->logout();
        });
    }

    public function testEditBankPayment()
    {
        $admin = \App\User::find(1);
        $bank_payment = factory('App\BankPayment')->create();
        $bank_payment2 = factory('App\BankPayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $bank_payment, $bank_payment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.bank_payments.index'))
                ->click('tr[data-entry-id="' . $bank_payment->id . '"] .btn-info')
                ->type("entry_date", $bank_payment2->entry_date)
                ->select("depositor", $bank_payment2->depositor)
                ->select("payment_mode", $bank_payment2->payment_mode)
                ->type("prepared_by", $bank_payment2->prepared_by)
                ->type("payment_number", $bank_payment2->payment_number)
                ->select("client_id", $bank_payment2->client_id)
                ->select("account_number_id", $bank_payment2->account_number_id)
                ->select("vendor_id", $bank_payment2->vendor_id)
                ->select("vendor_account_number_id", $bank_payment2->vendor_account_number_id)
                ->select("debit_note_number_id", $bank_payment2->debit_note_number_id)
                ->type("amount", $bank_payment2->amount)
                ->type("balance", $bank_payment2->balance)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.bank_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $bank_payment2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='depositor']", $bank_payment2->depositor)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $bank_payment2->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $bank_payment2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $bank_payment2->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $bank_payment2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $bank_payment2->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $bank_payment2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_account_number']", $bank_payment2->vendor_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $bank_payment2->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $bank_payment2->amount)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $bank_payment2->balance)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\BankPayment::first()->upload_document . "']")
                ->logout();
        });
    }

    public function testShowBankPayment()
    {
        $admin = \App\User::find(1);
        $bank_payment = factory('App\BankPayment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $bank_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.bank_payments.index'))
                ->click('tr[data-entry-id="' . $bank_payment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='entry_date']", $bank_payment->entry_date)
                ->assertSeeIn("td[field-key='depositor']", $bank_payment->depositor)
                ->assertSeeIn("td[field-key='payment_mode']", $bank_payment->payment_mode)
                ->assertSeeIn("td[field-key='prepared_by']", $bank_payment->prepared_by)
                ->assertSeeIn("td[field-key='payment_number']", $bank_payment->payment_number)
                ->assertSeeIn("td[field-key='client']", $bank_payment->client->name)
                ->assertSeeIn("td[field-key='account_number']", $bank_payment->account_number->account_number)
                ->assertSeeIn("td[field-key='vendor']", $bank_payment->vendor->name)
                ->assertSeeIn("td[field-key='vendor_account_number']", $bank_payment->vendor_account_number->account_number)
                ->assertSeeIn("td[field-key='debit_note_number']", $bank_payment->debit_note_number->debit_note_number)
                ->assertSeeIn("td[field-key='amount']", $bank_payment->amount)
                ->assertSeeIn("td[field-key='balance']", $bank_payment->balance)
                ->logout();
        });
    }

}
