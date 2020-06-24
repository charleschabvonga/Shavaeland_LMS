<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeductionItemTest extends DuskTestCase
{

    public function testCreateDeductionItem()
    {
        $admin = \App\User::find(1);
        $deduction_item = factory('App\DeductionItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deduction_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.deduction_items.index'))
                ->clickLink('Add new')
                ->select("item_number_id", $deduction_item->item_number_id)
                ->type("item_description", $deduction_item->item_description)
                ->type("unit_price", $deduction_item->unit_price)
                ->type("qty", $deduction_item->qty)
                ->type("total", $deduction_item->total)
                ->type("unit", $deduction_item->unit)
                ->press('Save')
                ->assertRouteIs('admin.deduction_items.index')
                ->assertSeeIn("tr:last-child td[field-key='item_number']", $deduction_item->item_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $deduction_item->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $deduction_item->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $deduction_item->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $deduction_item->total)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $deduction_item->unit)
                ->logout();
        });
    }

    public function testEditDeductionItem()
    {
        $admin = \App\User::find(1);
        $deduction_item = factory('App\DeductionItem')->create();
        $deduction_item2 = factory('App\DeductionItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deduction_item, $deduction_item2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deduction_items.index'))
                ->click('tr[data-entry-id="' . $deduction_item->id . '"] .btn-info')
                ->select("item_number_id", $deduction_item2->item_number_id)
                ->type("item_description", $deduction_item2->item_description)
                ->type("unit_price", $deduction_item2->unit_price)
                ->type("qty", $deduction_item2->qty)
                ->type("total", $deduction_item2->total)
                ->type("unit", $deduction_item2->unit)
                ->press('Update')
                ->assertRouteIs('admin.deduction_items.index')
                ->assertSeeIn("tr:last-child td[field-key='item_number']", $deduction_item2->item_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $deduction_item2->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $deduction_item2->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $deduction_item2->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $deduction_item2->total)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $deduction_item2->unit)
                ->logout();
        });
    }

    public function testShowDeductionItem()
    {
        $admin = \App\User::find(1);
        $deduction_item = factory('App\DeductionItem')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deduction_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.deduction_items.index'))
                ->click('tr[data-entry-id="' . $deduction_item->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='item_number']", $deduction_item->item_number->payslip_number)
                ->assertSeeIn("td[field-key='item_description']", $deduction_item->item_description)
                ->assertSeeIn("td[field-key='unit_price']", $deduction_item->unit_price)
                ->assertSeeIn("td[field-key='qty']", $deduction_item->qty)
                ->assertSeeIn("td[field-key='total']", $deduction_item->total)
                ->assertSeeIn("td[field-key='unit']", $deduction_item->unit)
                ->logout();
        });
    }

}
