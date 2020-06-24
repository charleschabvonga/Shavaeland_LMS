<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CreditNoteTest extends DuskTestCase
{

    public function testCreateCreditNote()
    {
        $admin = \App\User::find(1);
        $credit_note = factory('App\CreditNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $credit_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.credit_notes.index'))
                ->clickLink('Add new')
                ->type("date", $credit_note->date)
                ->select("refund_type", $credit_note->refund_type)
                ->select("invoice_payment_number_id", $credit_note->invoice_payment_number_id)
                ->select("project_number_id", $credit_note->project_number_id)
                ->select("invoice_number_id", $credit_note->invoice_number_id)
                ->select("bank_reference_id", $credit_note->bank_reference_id)
                ->select("client_id", $credit_note->client_id)
                ->select("contact_person_id", $credit_note->contact_person_id)
                ->select("account_manager_id", $credit_note->account_manager_id)
                ->type("prepared_by", $credit_note->prepared_by)
                ->type("credit_note_number", $credit_note->credit_note_number)
                ->select("status", $credit_note->status)
                ->type("terms_and_conditions", $credit_note->terms_and_conditions)
                ->type("subtotal", $credit_note->subtotal)
                ->type("vat", $credit_note->vat)
                ->type("vat_amount", $credit_note->vat_amount)
                ->type("total_amount", $credit_note->total_amount)
                ->type("paid_to_date", $credit_note->paid_to_date)
                ->type("balance", $credit_note->balance)
                ->press('Save')
                ->assertRouteIs('admin.credit_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $credit_note->date)
                ->assertSeeIn("tr:last-child td[field-key='refund_type']", $credit_note->refund_type)
                ->assertSeeIn("tr:last-child td[field-key='invoice_payment_number']", $credit_note->invoice_payment_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $credit_note->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $credit_note->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='bank_reference']", $credit_note->bank_reference->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $credit_note->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $credit_note->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $credit_note->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $credit_note->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $credit_note->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $credit_note->status)
                ->assertSeeIn("tr:last-child td[field-key='terms_and_conditions']", $credit_note->terms_and_conditions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $credit_note->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $credit_note->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $credit_note->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $credit_note->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $credit_note->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $credit_note->balance)
                ->logout();
        });
    }

    public function testEditCreditNote()
    {
        $admin = \App\User::find(1);
        $credit_note = factory('App\CreditNote')->create();
        $credit_note2 = factory('App\CreditNote')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $credit_note, $credit_note2) {
            $browser->loginAs($admin)
                ->visit(route('admin.credit_notes.index'))
                ->click('tr[data-entry-id="' . $credit_note->id . '"] .btn-info')
                ->type("date", $credit_note2->date)
                ->select("refund_type", $credit_note2->refund_type)
                ->select("invoice_payment_number_id", $credit_note2->invoice_payment_number_id)
                ->select("project_number_id", $credit_note2->project_number_id)
                ->select("invoice_number_id", $credit_note2->invoice_number_id)
                ->select("bank_reference_id", $credit_note2->bank_reference_id)
                ->select("client_id", $credit_note2->client_id)
                ->select("contact_person_id", $credit_note2->contact_person_id)
                ->select("account_manager_id", $credit_note2->account_manager_id)
                ->type("prepared_by", $credit_note2->prepared_by)
                ->type("credit_note_number", $credit_note2->credit_note_number)
                ->select("status", $credit_note2->status)
                ->type("terms_and_conditions", $credit_note2->terms_and_conditions)
                ->type("subtotal", $credit_note2->subtotal)
                ->type("vat", $credit_note2->vat)
                ->type("vat_amount", $credit_note2->vat_amount)
                ->type("total_amount", $credit_note2->total_amount)
                ->type("paid_to_date", $credit_note2->paid_to_date)
                ->type("balance", $credit_note2->balance)
                ->press('Update')
                ->assertRouteIs('admin.credit_notes.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $credit_note2->date)
                ->assertSeeIn("tr:last-child td[field-key='refund_type']", $credit_note2->refund_type)
                ->assertSeeIn("tr:last-child td[field-key='invoice_payment_number']", $credit_note2->invoice_payment_number->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $credit_note2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $credit_note2->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='bank_reference']", $credit_note2->bank_reference->payment_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $credit_note2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $credit_note2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='account_manager']", $credit_note2->account_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $credit_note2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $credit_note2->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='status']", $credit_note2->status)
                ->assertSeeIn("tr:last-child td[field-key='terms_and_conditions']", $credit_note2->terms_and_conditions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $credit_note2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $credit_note2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $credit_note2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $credit_note2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='paid_to_date']", $credit_note2->paid_to_date)
                ->assertSeeIn("tr:last-child td[field-key='balance']", $credit_note2->balance)
                ->logout();
        });
    }

    public function testShowCreditNote()
    {
        $admin = \App\User::find(1);
        $credit_note = factory('App\CreditNote')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $credit_note) {
            $browser->loginAs($admin)
                ->visit(route('admin.credit_notes.index'))
                ->click('tr[data-entry-id="' . $credit_note->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $credit_note->date)
                ->assertSeeIn("td[field-key='refund_type']", $credit_note->refund_type)
                ->assertSeeIn("td[field-key='invoice_payment_number']", $credit_note->invoice_payment_number->payment_number)
                ->assertSeeIn("td[field-key='project_number']", $credit_note->project_number->operation_number)
                ->assertSeeIn("td[field-key='invoice_number']", $credit_note->invoice_number->invoice_number)
                ->assertSeeIn("td[field-key='bank_reference']", $credit_note->bank_reference->payment_number)
                ->assertSeeIn("td[field-key='client']", $credit_note->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $credit_note->contact_person->contact_name)
                ->assertSeeIn("td[field-key='account_manager']", $credit_note->account_manager->name)
                ->assertSeeIn("td[field-key='prepared_by']", $credit_note->prepared_by)
                ->assertSeeIn("td[field-key='credit_note_number']", $credit_note->credit_note_number)
                ->assertSeeIn("td[field-key='status']", $credit_note->status)
                ->assertSeeIn("td[field-key='terms_and_conditions']", $credit_note->terms_and_conditions)
                ->assertSeeIn("td[field-key='subtotal']", $credit_note->subtotal)
                ->assertSeeIn("td[field-key='vat']", $credit_note->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $credit_note->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $credit_note->total_amount)
                ->assertSeeIn("td[field-key='paid_to_date']", $credit_note->paid_to_date)
                ->assertSeeIn("td[field-key='balance']", $credit_note->balance)
                ->logout();
        });
    }

}
