<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VendorBankPaymentTest extends DuskTestCase
{

    public function testCreateVendorBankPayment()
    {
        $admin = \App\User::find(1);
        $vendor_bank_payment = factory('App\VendorBankPayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_bank_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_bank_payments.index'))
                ->clickLink('Add new')
                ->type("entry_date", $vendor_bank_payment->entry_date)
                ->select("withdrawer", $vendor_bank_payment->withdrawer)
                ->select("payment_mode", $vendor_bank_payment->payment_mode)
                ->type("prepared_by", $vendor_bank_payment->prepared_by)
                ->type("payment_number", $vendor_bank_payment->payment_number)
                ->select("vendor_id", $vendor_bank_payment->vendor_id)
                ->select("account_number_id", $vendor_bank_payment->account_number_id)
                ->select("client_id", $vendor_bank_payment->client_id)
                ->select("client_account_number_id", $vendor_bank_payment->client_account_number_id)
                ->select("credit_note_number_id", $vendor_bank_payment->credit_note_number_id)
                ->type("amount", $vendor_bank_payment->amount)
                ->type("balance", $vendor_bank_payment->balance)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.vendor_bank_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $vendor_bank_payment->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='withdrawer']", $vendor_bank_payment->withdrawer)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $vendor_bank_payment->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $vendor_bank_payment->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $vendor_bank_payment->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vendor_bank_payment->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $vendor_bank_payment->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $vendor_bank_payment->client->name)
                ->assertSeeIn("tr:last-child td[field-key='client_account_number']", $vendor_bank_payment->client_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $vendor_bank_payment->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $vendor_bank_payment->amount)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $vendor_bank_payment->balance)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VendorBankPayment::first()->upload_document . "']")
                ->logout();
        });
    }

    public function testEditVendorBankPayment()
    {
        $admin = \App\User::find(1);
        $vendor_bank_payment = factory('App\VendorBankPayment')->create();
        $vendor_bank_payment2 = factory('App\VendorBankPayment')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor_bank_payment, $vendor_bank_payment2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_bank_payments.index'))
                ->click('tr[data-entry-id="' . $vendor_bank_payment->id . '"] .btn-info')
                ->type("entry_date", $vendor_bank_payment2->entry_date)
                ->select("withdrawer", $vendor_bank_payment2->withdrawer)
                ->select("payment_mode", $vendor_bank_payment2->payment_mode)
                ->type("prepared_by", $vendor_bank_payment2->prepared_by)
                ->type("payment_number", $vendor_bank_payment2->payment_number)
                ->select("vendor_id", $vendor_bank_payment2->vendor_id)
                ->select("account_number_id", $vendor_bank_payment2->account_number_id)
                ->select("client_id", $vendor_bank_payment2->client_id)
                ->select("client_account_number_id", $vendor_bank_payment2->client_account_number_id)
                ->select("credit_note_number_id", $vendor_bank_payment2->credit_note_number_id)
                ->type("amount", $vendor_bank_payment2->amount)
                ->type("balance", $vendor_bank_payment2->balance)
                ->attach("upload_document", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.vendor_bank_payments.index')
                ->assertSeeIn("tr:last-child td[field-key='entry_date']", $vendor_bank_payment2->entry_date)
                ->assertSeeIn("tr:last-child td[field-key='withdrawer']", $vendor_bank_payment2->withdrawer)
                ->assertSeeIn("tr:last-child td[field-key='payment_mode']", $vendor_bank_payment2->payment_mode)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $vendor_bank_payment2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='payment_number']", $vendor_bank_payment2->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $vendor_bank_payment2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='account_number']", $vendor_bank_payment2->account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $vendor_bank_payment2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='client_account_number']", $vendor_bank_payment2->client_account_number->account_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $vendor_bank_payment2->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='amount']", $vendor_bank_payment2->amount)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $vendor_bank_payment2->balance)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\VendorBankPayment::first()->upload_document . "']")
                ->logout();
        });
    }

    public function testShowVendorBankPayment()
    {
        $admin = \App\User::find(1);
        $vendor_bank_payment = factory('App\VendorBankPayment')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vendor_bank_payment) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendor_bank_payments.index'))
                ->click('tr[data-entry-id="' . $vendor_bank_payment->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='entry_date']", $vendor_bank_payment->entry_date)
                ->assertSeeIn("td[field-key='withdrawer']", $vendor_bank_payment->withdrawer)
                ->assertSeeIn("td[field-key='payment_mode']", $vendor_bank_payment->payment_mode)
                ->assertSeeIn("td[field-key='prepared_by']", $vendor_bank_payment->prepared_by)
                ->assertSeeIn("td[field-key='payment_number']", $vendor_bank_payment->payment_number)
                ->assertSeeIn("td[field-key='vendor']", $vendor_bank_payment->vendor->name)
                ->assertSeeIn("td[field-key='account_number']", $vendor_bank_payment->account_number->account_number)
                ->assertSeeIn("td[field-key='client']", $vendor_bank_payment->client->name)
                ->assertSeeIn("td[field-key='client_account_number']", $vendor_bank_payment->client_account_number->account_number)
                ->assertSeeIn("td[field-key='credit_note_number']", $vendor_bank_payment->credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='amount']", $vendor_bank_payment->amount)
                ->assertSeeIn("td[field-key='balance']", $vendor_bank_payment->balance)
                ->logout();
        });
    }

}
