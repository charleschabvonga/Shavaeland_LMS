<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class InvoiceItemTest extends DuskTestCase
{

    public function testCreateInvoiceItem()
    {
        $admin = \App\User::find(1);
        $invoice_item = factory('App\InvoiceItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $invoice_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoice_items.index'))
                ->clickLink('Add new')
                ->select("invoice_number_id", $invoice_item->invoice_number_id)
                ->select("bill_number_id", $invoice_item->bill_number_id)
                ->select("credit_note_number_id", $invoice_item->credit_note_number_id)
                ->select("debit_note_number_id", $invoice_item->debit_note_number_id)
                ->select("clearance_and_forwarding_number_id", $invoice_item->clearance_and_forwarding_number_id)
                ->select("quotation_number_id", $invoice_item->quotation_number_id)
                ->type("item_description", $invoice_item->item_description)
                ->type("unit_price", $invoice_item->unit_price)
                ->type("qty", $invoice_item->qty)
                ->type("total", $invoice_item->total)
                ->press('Save')
                ->assertRouteIs('admin.invoice_items.index')
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $invoice_item->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='bill_number']", $invoice_item->bill_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $invoice_item->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $invoice_item->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='clearance_and_forwarding_number']", $invoice_item->clearance_and_forwarding_number->clearance_and_forwarding_number)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $invoice_item->quotation_number->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $invoice_item->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $invoice_item->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $invoice_item->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $invoice_item->total)
                ->logout();
        });
    }

    public function testEditInvoiceItem()
    {
        $admin = \App\User::find(1);
        $invoice_item = factory('App\InvoiceItem')->create();
        $invoice_item2 = factory('App\InvoiceItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $invoice_item, $invoice_item2) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoice_items.index'))
                ->click('tr[data-entry-id="' . $invoice_item->id . '"] .btn-info')
                ->select("invoice_number_id", $invoice_item2->invoice_number_id)
                ->select("bill_number_id", $invoice_item2->bill_number_id)
                ->select("credit_note_number_id", $invoice_item2->credit_note_number_id)
                ->select("debit_note_number_id", $invoice_item2->debit_note_number_id)
                ->select("clearance_and_forwarding_number_id", $invoice_item2->clearance_and_forwarding_number_id)
                ->select("quotation_number_id", $invoice_item2->quotation_number_id)
                ->type("item_description", $invoice_item2->item_description)
                ->type("unit_price", $invoice_item2->unit_price)
                ->type("qty", $invoice_item2->qty)
                ->type("total", $invoice_item2->total)
                ->press('Update')
                ->assertRouteIs('admin.invoice_items.index')
                ->assertSeeIn("tr:last-child td[field-key='invoice_number']", $invoice_item2->invoice_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='bill_number']", $invoice_item2->bill_number->invoice_number)
                ->assertSeeIn("tr:last-child td[field-key='credit_note_number']", $invoice_item2->credit_note_number->credit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='debit_note_number']", $invoice_item2->debit_note_number->debit_note_number)
                ->assertSeeIn("tr:last-child td[field-key='clearance_and_forwarding_number']", $invoice_item2->clearance_and_forwarding_number->clearance_and_forwarding_number)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $invoice_item2->quotation_number->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $invoice_item2->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $invoice_item2->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $invoice_item2->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $invoice_item2->total)
                ->logout();
        });
    }

    public function testShowInvoiceItem()
    {
        $admin = \App\User::find(1);
        $invoice_item = factory('App\InvoiceItem')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $invoice_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.invoice_items.index'))
                ->click('tr[data-entry-id="' . $invoice_item->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='invoice_number']", $invoice_item->invoice_number->invoice_number)
                ->assertSeeIn("td[field-key='bill_number']", $invoice_item->bill_number->invoice_number)
                ->assertSeeIn("td[field-key='credit_note_number']", $invoice_item->credit_note_number->credit_note_number)
                ->assertSeeIn("td[field-key='debit_note_number']", $invoice_item->debit_note_number->debit_note_number)
                ->assertSeeIn("td[field-key='clearance_and_forwarding_number']", $invoice_item->clearance_and_forwarding_number->clearance_and_forwarding_number)
                ->assertSeeIn("td[field-key='quotation_number']", $invoice_item->quotation_number->quotation_number)
                ->assertSeeIn("td[field-key='item_description']", $invoice_item->item_description)
                ->assertSeeIn("td[field-key='unit_price']", $invoice_item->unit_price)
                ->assertSeeIn("td[field-key='qty']", $invoice_item->qty)
                ->assertSeeIn("td[field-key='total']", $invoice_item->total)
                ->logout();
        });
    }

}
