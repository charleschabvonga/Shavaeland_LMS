<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartsAcquiredTest extends DuskTestCase
{

    public function testCreatePartsAcquired()
    {
        $admin = \App\User::find(1);
        $parts_acquired = factory('App\PartsAcquired')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $parts_acquired) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts_acquireds.index'))
                ->clickLink('Add new')
                ->type("order_number", $parts_acquired->order_number)
                ->type("prepared_by", $parts_acquired->prepared_by)
                ->type("date", $parts_acquired->date)
                ->select("transaction_type", $parts_acquired->transaction_type)
                ->select("repair_center_id", $parts_acquired->repair_center_id)
                ->select("received_by_id", $parts_acquired->received_by_id)
                ->select("dispatched_by_id", $parts_acquired->dispatched_by_id)
                ->select("part_id", $parts_acquired->part_id)
                ->type("qty", $parts_acquired->qty)
                ->type("unit_price", $parts_acquired->unit_price)
                ->type("total", $parts_acquired->total)
                ->press('Save')
                ->assertRouteIs('admin.parts_acquireds.index')
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $parts_acquired->order_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $parts_acquired->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='date']", $parts_acquired->date)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $parts_acquired->transaction_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $parts_acquired->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='received_by']", $parts_acquired->received_by->name)
                ->assertSeeIn("tr:last-child td[field-key='dispatched_by']", $parts_acquired->dispatched_by->name)
                ->assertSeeIn("tr:last-child td[field-key='part']", $parts_acquired->part->part)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $parts_acquired->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $parts_acquired->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='total']", $parts_acquired->total)
                ->logout();
        });
    }

    public function testEditPartsAcquired()
    {
        $admin = \App\User::find(1);
        $parts_acquired = factory('App\PartsAcquired')->create();
        $parts_acquired2 = factory('App\PartsAcquired')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $parts_acquired, $parts_acquired2) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts_acquireds.index'))
                ->click('tr[data-entry-id="' . $parts_acquired->id . '"] .btn-info')
                ->type("order_number", $parts_acquired2->order_number)
                ->type("prepared_by", $parts_acquired2->prepared_by)
                ->type("date", $parts_acquired2->date)
                ->select("transaction_type", $parts_acquired2->transaction_type)
                ->select("repair_center_id", $parts_acquired2->repair_center_id)
                ->select("received_by_id", $parts_acquired2->received_by_id)
                ->select("dispatched_by_id", $parts_acquired2->dispatched_by_id)
                ->select("part_id", $parts_acquired2->part_id)
                ->type("qty", $parts_acquired2->qty)
                ->type("unit_price", $parts_acquired2->unit_price)
                ->type("total", $parts_acquired2->total)
                ->press('Update')
                ->assertRouteIs('admin.parts_acquireds.index')
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $parts_acquired2->order_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $parts_acquired2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='date']", $parts_acquired2->date)
                ->assertSeeIn("tr:last-child td[field-key='transaction_type']", $parts_acquired2->transaction_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $parts_acquired2->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='received_by']", $parts_acquired2->received_by->name)
                ->assertSeeIn("tr:last-child td[field-key='dispatched_by']", $parts_acquired2->dispatched_by->name)
                ->assertSeeIn("tr:last-child td[field-key='part']", $parts_acquired2->part->part)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $parts_acquired2->qty)
                ->assertSeeIn("tr:last-child td[field-key='unit_price']", $parts_acquired2->unit_price)
                ->assertSeeIn("tr:last-child td[field-key='total']", $parts_acquired2->total)
                ->logout();
        });
    }

    public function testShowPartsAcquired()
    {
        $admin = \App\User::find(1);
        $parts_acquired = factory('App\PartsAcquired')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $parts_acquired) {
            $browser->loginAs($admin)
                ->visit(route('admin.parts_acquireds.index'))
                ->click('tr[data-entry-id="' . $parts_acquired->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='order_number']", $parts_acquired->order_number)
                ->assertSeeIn("td[field-key='prepared_by']", $parts_acquired->prepared_by)
                ->assertSeeIn("td[field-key='date']", $parts_acquired->date)
                ->assertSeeIn("td[field-key='transaction_type']", $parts_acquired->transaction_type)
                ->assertSeeIn("td[field-key='repair_center']", $parts_acquired->repair_center->center_name)
                ->assertSeeIn("td[field-key='received_by']", $parts_acquired->received_by->name)
                ->assertSeeIn("td[field-key='dispatched_by']", $parts_acquired->dispatched_by->name)
                ->assertSeeIn("td[field-key='part']", $parts_acquired->part->part)
                ->assertSeeIn("td[field-key='qty']", $parts_acquired->qty)
                ->assertSeeIn("td[field-key='unit_price']", $parts_acquired->unit_price)
                ->assertSeeIn("td[field-key='total']", $parts_acquired->total)
                ->logout();
        });
    }

}
