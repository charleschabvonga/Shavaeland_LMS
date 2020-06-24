<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DebitNoteTest extends DuskTestCase
{

    public function testCreateDebitNote()
    {
        $admin = \App\User::find(1);
        $debit_note = factory('App\DebitNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $debit_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.debit_notes.index'))
                ->clickLink('Add new')
                ->select("refund_type", $debit_note->refund_type)
                ->select("vendor_id", $debit_note->vendor_id)
                ->select("contact_person_id", $debit_note->contact_person_id)
                ->select("account_manager_id", $debit_note->account_manager_id)
                ->select("transaction_number_id", $debit_note->transaction_number_id)
                ->select("credit_note_number_id", $debit_note->credit_note_number_id)
                ->select("withdrawal_transaction_number_id", $debit_note->withdrawal_transaction_number_id)
                ->select("credit_note_payment_number_id", $debit_note->credit_note_payment_number_id)
                ->type("debit_note_number", $debit_note->debit_note_number)
                ->type("date", $debit_note->date)
                ->select("payment_status", $debit_note->payment_status)
                ->type("subtotal", $debit_note->subtotal)
                ->type("vat", $debit_note->vat)
                ->type("vat_amount", $debit_note->vat_amount)
                ->type("total_amount", $debit_note->total_amount)
                ->type("paid_to_date", $debit_note->paid_to_date)
                ->type("balance", $debit_note->balance)
                ->type("prepared_by", $debit_note->prepared_by)
                ->press('Save')
                ->assertRouteIs('admin.debit_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='refund_type']", $debit_note->refund_type)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $debit_note->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $debit_note->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $debit_note->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $debit_note->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $debit_note->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $debit_note->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_payment_number']", $debit_note->credit_note_payment_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $debit_note->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $debit_note->date)
                ->assertSeeIn("tr:last-child td[field-key='payment_status']", $debit_note->payment_status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $debit_note->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $debit_note->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $debit_note->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $debit_note->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $debit_note->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $debit_note->balance)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $debit_note->prepared_by)
                ->logout();
        });
    }

    public function testEditDebitNote()
    {
        $admin = \App\User::find(1);
        $debit_note = factory('App\DebitNote')->create();
        $debit_note2 = factory('App\DebitNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $debit_note, $debit_note2) {
            $browser->loginAs($admin)
                ->visit(route('admin.debit_notes.index'))
                ->click('tr[data-entry-id="' . $debit_note->id . '"] .btn-info')
                ->select("refund_type", $debit_note2->refund_type)
                ->select("vendor_id", $debit_note2->vendor_id)
                ->select("contact_person_id", $debit_note2->contact_person_id)
                ->select("account_manager_id", $debit_note2->account_manager_id)
                ->select("transaction_number_id", $debit_note2->transaction_number_id)
                ->select("credit_note_number_id", $debit_note2->credit_note_number_id)
                ->select("withdrawal_transaction_number_id", $debit_note2->withdrawal_transaction_number_id)
                ->select("credit_note_payment_number_id", $debit_note2->credit_note_payment_number_id)
                ->type("debit_note_number", $debit_note2->debit_note_number)
                ->type("date", $debit_note2->date)
                ->select("payment_status", $debit_note2->payment_status)
                ->type("subtotal", $debit_note2->subtotal)
                ->type("vat", $debit_note2->vat)
                ->type("vat_amount", $debit_note2->vat_amount)
                ->type("total_amount", $debit_note2->total_amount)
                ->type("paid_to_date", $debit_note2->paid_to_date)
                ->type("balance", $debit_note2->balance)
                ->type("prepared_by", $debit_note2->prepared_by)
                ->press('Update')
                ->assertRouteIs('admin.debit_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='refund_type']", $debit_note2->refund_type)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $debit_note2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $debit_note2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $debit_note2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='transaction_number']", $debit_note2->transaction_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $debit_note2->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='withdrawal_transaction_number']", $debit_note2->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_payment_number']", $debit_note2->credit_note_payment_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $debit_note2->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $debit_note2->date)
                ->assertSeeIn("tr:last-child td[field-key='payment_status']", $debit_note2->payment_status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $debit_note2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $debit_note2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $debit_note2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $debit_note2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $debit_note2->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $debit_note2->balance)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $debit_note2->prepared_by)
                ->logout();
        });
    }

    public function testShowDebitNote()
    {
        $admin = \App\User::find(1);
        $debit_note = factory('App\DebitNote')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $debit_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.debit_notes.index'))
                ->click('tr[data-entry-id="' . $debit_note->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='refund_type']", $debit_note->refund_type)
                ->assertSeeIn("td[field-key='vendor']", $debit_note->vendor->name)
                ->assertSeeIn("td[field-key='contact_person']", $debit_note->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $debit_note->account_manager->name)
                ->assertSeeIn("td[field-key='transaction_number']", $debit_note->transaction_number->operation_number)
                ->assertSeeIn("td[field-key='credit_note_number']", $debit_note->credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='withdrawal_transaction_number']", $debit_note->withdrawal_transaction_number->payment_number)
                ->assertSeeIn("td[field-key='credit_note_payment_number']", $debit_note->credit_note_payment_number->payment_number)
                ->assertSeeIn("td[field-key='debit_note_number']", $debit_note->debit_note_number)
                ->assertSeeIn("td[field-key='date']", $debit_note->date)
                ->assertSeeIn("td[field-key='payment_status']", $debit_note->payment_status)
                ->assertSeeIn("td[field-key='subtotal']", $debit_note->subtotal)
                ->assertSeeIn("td[field-key='vat']", $debit_note->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $debit_note->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $debit_note->total_amount)
                ->assertSeeIn("td[field-key='paid_to_date']", $debit_note->paid_to_date)
                ->assertSeeIn("td[field-key='balance']", $debit_note->balance)
                ->assertSeeIn("td[field-key='prepared_by']", $debit_note->prepared_by)
                ->logout();
        });
    }

}
