<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class OvertimeAndBonusItemTest extends DuskTestCase
{

    public function testCreateOvertimeAndBonusItem()
    {
        $admin = \App\User::find(1);
        $overtime_and_bonus_item = factory('App\OvertimeAndBonusItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $overtime_and_bonus_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.overtime_and_bonus_items.index'))
                ->clickLink('Add new')
                ->select("item_number_id", $overtime_and_bonus_item->item_number_id)
                ->type("item_description", $overtime_and_bonus_item->item_description)
                ->type("unit_price", $overtime_and_bonus_item->unit_price)
                ->type("qty", $overtime_and_bonus_item->qty)
                ->type("total", $overtime_and_bonus_item->total)
                ->type("unit", $overtime_and_bonus_item->unit)
                ->press('Save')
                ->assertRouteIs('admin.overtime_and_bonus_items.index')
                ->assertSeeIn("tr:last-child td[field-key='item_number']", $overtime_and_bonus_item->item_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $overtime_and_bonus_item->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $overtime_and_bonus_item->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $overtime_and_bonus_item->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $overtime_and_bonus_item->total)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $overtime_and_bonus_item->unit)
                ->logout();
        });
    }

    public function testEditOvertimeAndBonusItem()
    {
        $admin = \App\User::find(1);
        $overtime_and_bonus_item = factory('App\OvertimeAndBonusItem')->create();
        $overtime_and_bonus_item2 = factory('App\OvertimeAndBonusItem')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $overtime_and_bonus_item, $overtime_and_bonus_item2) {
            $browser->loginAs($admin)
                ->visit(route('admin.overtime_and_bonus_items.index'))
                ->click('tr[data-entry-id="' . $overtime_and_bonus_item->id . '"] .btn-info')
                ->select("item_number_id", $overtime_and_bonus_item2->item_number_id)
                ->type("item_description", $overtime_and_bonus_item2->item_description)
                ->type("unit_price", $overtime_and_bonus_item2->unit_price)
                ->type("qty", $overtime_and_bonus_item2->qty)
                ->type("total", $overtime_and_bonus_item2->total)
                ->type("unit", $overtime_and_bonus_item2->unit)
                ->press('Update')
                ->assertRouteIs('admin.overtime_and_bonus_items.index')
                ->assertSeeIn("tr:last-child td[field-key='item_number']", $overtime_and_bonus_item2->item_number->payslip_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $overtime_and_bonus_item2->item_description)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $overtime_and_bonus_item2->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $overtime_and_bonus_item2->qty)
                ->assertSeeIn("tr:last-child td[field-key='total']", $overtime_and_bonus_item2->total)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $overtime_and_bonus_item2->unit)
                ->logout();
        });
    }

    public function testShowOvertimeAndBonusItem()
    {
        $admin = \App\User::find(1);
        $overtime_and_bonus_item = factory('App\OvertimeAndBonusItem')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $overtime_and_bonus_item) {
            $browser->loginAs($admin)
                ->visit(route('admin.overtime_and_bonus_items.index'))
                ->click('tr[data-entry-id="' . $overtime_and_bonus_item->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='item_number']", $overtime_and_bonus_item->item_number->payslip_number)
                ->assertSeeIn("td[field-key='item_description']", $overtime_and_bonus_item->item_description)
                ->assertSeeIn("td[field-key='unit_price']", $overtime_and_bonus_item->unit_price)
                ->assertSeeIn("td[field-key='qty']", $overtime_and_bonus_item->qty)
                ->assertSeeIn("td[field-key='total']", $overtime_and_bonus_item->total)
                ->assertSeeIn("td[field-key='unit']", $overtime_and_bonus_item->unit)
                ->logout();
        });
    }

}
