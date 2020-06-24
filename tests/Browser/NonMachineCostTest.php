<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class NonMachineCostTest extends DuskTestCase
{

    public function testCreateNonMachineCost()
    {
        $admin = \App\User::find(1);
        $non_machine_cost = factory('App\NonMachineCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $non_machine_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.non_machine_costs.index'))
                ->clickLink('Add new')
                ->select("road_freight_number_id", $non_machine_cost->road_freight_number_id)
                ->type("item_description", $non_machine_cost->item_description)
                ->type("qty", $non_machine_cost->qty)
                ->type("cost", $non_machine_cost->cost)
                ->type("unit", $non_machine_cost->unit)
                ->type("total", $non_machine_cost->total)
                ->press('Save')
                ->assertRouteIs('admin.non_machine_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $non_machine_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $non_machine_cost->item_description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $non_machine_cost->qty)
                ->assertSeeIn("tr:last-child td[field-key='cost']", $non_machine_cost->cost)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $non_machine_cost->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $non_machine_cost->total)
                ->logout();
        });
    }

    public function testEditNonMachineCost()
    {
        $admin = \App\User::find(1);
        $non_machine_cost = factory('App\NonMachineCost')->create();
        $non_machine_cost2 = factory('App\NonMachineCost')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $non_machine_cost, $non_machine_cost2) {
            $browser->loginAs($admin)
                ->visit(route('admin.non_machine_costs.index'))
                ->click('tr[data-entry-id="' . $non_machine_cost->id . '"] .btn-info')
                ->select("road_freight_number_id", $non_machine_cost2->road_freight_number_id)
                ->type("item_description", $non_machine_cost2->item_description)
                ->type("qty", $non_machine_cost2->qty)
                ->type("cost", $non_machine_cost2->cost)
                ->type("unit", $non_machine_cost2->unit)
                ->type("total", $non_machine_cost2->total)
                ->press('Update')
                ->assertRouteIs('admin.non_machine_costs.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $non_machine_cost2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='item_description']", $non_machine_cost2->item_description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $non_machine_cost2->qty)
                ->assertSeeIn("tr:last-child td[field-key='cost']", $non_machine_cost2->cost)
                ->assertSeeIn("tr:last-child td[field-key='unit']", $non_machine_cost2->unit)
                ->assertSeeIn("tr:last-child td[field-key='total']", $non_machine_cost2->total)
                ->logout();
        });
    }

    public function testShowNonMachineCost()
    {
        $admin = \App\User::find(1);
        $non_machine_cost = factory('App\NonMachineCost')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $non_machine_cost) {
            $browser->loginAs($admin)
                ->visit(route('admin.non_machine_costs.index'))
                ->click('tr[data-entry-id="' . $non_machine_cost->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='road_freight_number']", $non_machine_cost->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='item_description']", $non_machine_cost->item_description)
                ->assertSeeIn("td[field-key='qty']", $non_machine_cost->qty)
                ->assertSeeIn("td[field-key='cost']", $non_machine_cost->cost)
                ->assertSeeIn("td[field-key='unit']", $non_machine_cost->unit)
                ->assertSeeIn("td[field-key='total']", $non_machine_cost->total)
                ->logout();
        });
    }

}
