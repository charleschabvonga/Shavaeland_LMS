<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class QuotationTest extends DuskTestCase
{

    public function testCreateQuotation()
    {
        $admin = \App\User::find(1);
        $quotation = factory('App\Quotation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $quotation) {
            $browser->loginAs($admin)
                ->visit(route('admin.quotations.index'))
                ->clickLink('Add new')
                ->select("client_id", $quotation->client_id)
                ->select("contact_person_id", $quotation->contact_person_id)
                ->select("sales_person_id", $quotation->sales_person_id)
                ->type("quotation_number", $quotation->quotation_number)
                ->type("date", $quotation->date)
                ->type("due_date", $quotation->due_date)
                ->select("status", $quotation->status)
                ->type("subtotal", $quotation->subtotal)
                ->type("vat", $quotation->vat)
                ->type("vat_amount", $quotation->vat_amount)
                ->type("total_amount", $quotation->total_amount)
                ->type("prepared_by", $quotation->prepared_by)
                ->press('Save')
                ->assertRouteIs('admin.quotations.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $quotation->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $quotation->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='sales_person']", $quotation->sales_person->name)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $quotation->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $quotation->date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $quotation->due_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $quotation->status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $quotation->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $quotation->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $quotation->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $quotation->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $quotation->prepared_by)
                ->logout();
        });
    }

    public function testEditQuotation()
    {
        $admin = \App\User::find(1);
        $quotation = factory('App\Quotation')->create();
        $quotation2 = factory('App\Quotation')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $quotation, $quotation2) {
            $browser->loginAs($admin)
                ->visit(route('admin.quotations.index'))
                ->click('tr[data-entry-id="' . $quotation->id . '"] .btn-info')
                ->select("client_id", $quotation2->client_id)
                ->select("contact_person_id", $quotation2->contact_person_id)
                ->select("sales_person_id", $quotation2->sales_person_id)
                ->type("quotation_number", $quotation2->quotation_number)
                ->type("date", $quotation2->date)
                ->type("due_date", $quotation2->due_date)
                ->select("status", $quotation2->status)
                ->type("subtotal", $quotation2->subtotal)
                ->type("vat", $quotation2->vat)
                ->type("vat_amount", $quotation2->vat_amount)
                ->type("total_amount", $quotation2->total_amount)
                ->type("prepared_by", $quotation2->prepared_by)
                ->press('Update')
                ->assertRouteIs('admin.quotations.index')
                ->assertSeeIn("tr:last-child td[field-key='client']", $quotation2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $quotation2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='sales_person']", $quotation2->sales_person->name)
                ->assertSeeIn("tr:last-child td[field-key='quotation_number']", $quotation2->quotation_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $quotation2->date)
                ->assertSeeIn("tr:last-child td[field-key='due_date']", $quotation2->due_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $quotation2->status)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $quotation2->subtotal)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $quotation2->vat)
                ->assertSeeIn("tr:last-child td[field-key='vat_amount']", $quotation2->vat_amount)
                ->assertSeeIn("tr:last-child td[field-key='total_amount']", $quotation2->total_amount)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $quotation2->prepared_by)
                ->logout();
        });
    }

    public function testShowQuotation()
    {
        $admin = \App\User::find(1);
        $quotation = factory('App\Quotation')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $quotation) {
            $browser->loginAs($admin)
                ->visit(route('admin.quotations.index'))
                ->click('tr[data-entry-id="' . $quotation->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='client']", $quotation->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $quotation->contact_person->contact_name)
                ->assertSeeIn("td[field-key='sales_person']", $quotation->sales_person->name)
                ->assertSeeIn("td[field-key='quotation_number']", $quotation->quotation_number)
                ->assertSeeIn("td[field-key='date']", $quotation->date)
                ->assertSeeIn("td[field-key='due_date']", $quotation->due_date)
                ->assertSeeIn("td[field-key='status']", $quotation->status)
                ->assertSeeIn("td[field-key='subtotal']", $quotation->subtotal)
                ->assertSeeIn("td[field-key='vat']", $quotation->vat)
                ->assertSeeIn("td[field-key='vat_amount']", $quotation->vat_amount)
                ->assertSeeIn("td[field-key='total_amount']", $quotation->total_amount)
                ->assertSeeIn("td[field-key='prepared_by']", $quotation->prepared_by)
                ->logout();
        });
    }

}
