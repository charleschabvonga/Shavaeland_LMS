<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoadDescriptionTest extends DuskTestCase
{

    public function testCreateLoadDescription()
    {
        $admin = \App\User::find(1);
        $load_description = factory('App\LoadDescription')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $load_description) {
            $browser->loginAs($admin)
                ->visit(route('admin.load_descriptions.index'))
                ->clickLink('Add new')
                ->type("description", $load_description->description)
                ->type("qty", $load_description->qty)
                ->type("weight_volume", $load_description->weight_volume)
                ->select("loading_instruction_number_id", $load_description->loading_instruction_number_id)
                ->select("delivery_instruction_number_id", $load_description->delivery_instruction_number_id)
                ->select("air_freight_number_id", $load_description->air_freight_number_id)
                ->select("rail_freight_number_id", $load_description->rail_freight_number_id)
                ->select("sea_freight_number_id", $load_description->sea_freight_number_id)
                ->press('Save')
                ->assertRouteIs('admin.load_descriptions.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $load_description->description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $load_description->qty)
                ->assertSeeIn("tr:last-child td[field-key='weight_volume']", $load_description->weight_volume)
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $load_description->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='delivery_instruction_number']", $load_description->delivery_instruction_number->delivery_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='air_freight_number']", $load_description->air_freight_number->air_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='rail_freight_number']", $load_description->rail_freight_number->rail_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='sea_freight_number']", $load_description->sea_freight_number->sea_freight_number)
                ->logout();
        });
    }

    public function testEditLoadDescription()
    {
        $admin = \App\User::find(1);
        $load_description = factory('App\LoadDescription')->create();
        $load_description2 = factory('App\LoadDescription')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $load_description, $load_description2) {
            $browser->loginAs($admin)
                ->visit(route('admin.load_descriptions.index'))
                ->click('tr[data-entry-id="' . $load_description->id . '"] .btn-info')
                ->type("description", $load_description2->description)
                ->type("qty", $load_description2->qty)
                ->type("weight_volume", $load_description2->weight_volume)
                ->select("loading_instruction_number_id", $load_description2->loading_instruction_number_id)
                ->select("delivery_instruction_number_id", $load_description2->delivery_instruction_number_id)
                ->select("air_freight_number_id", $load_description2->air_freight_number_id)
                ->select("rail_freight_number_id", $load_description2->rail_freight_number_id)
                ->select("sea_freight_number_id", $load_description2->sea_freight_number_id)
                ->press('Update')
                ->assertRouteIs('admin.load_descriptions.index')
                ->assertSeeIn("tr:last-child td[field-key='description']", $load_description2->description)
                ->assertSeeIn("tr:last-child td[field-key='qty']", $load_description2->qty)
                ->assertSeeIn("tr:last-child td[field-key='weight_volume']", $load_description2->weight_volume)
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $load_description2->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='delivery_instruction_number']", $load_description2->delivery_instruction_number->delivery_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='air_freight_number']", $load_description2->air_freight_number->air_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='rail_freight_number']", $load_description2->rail_freight_number->rail_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='sea_freight_number']", $load_description2->sea_freight_number->sea_freight_number)
                ->logout();
        });
    }

    public function testShowLoadDescription()
    {
        $admin = \App\User::find(1);
        $load_description = factory('App\LoadDescription')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $load_description) {
            $browser->loginAs($admin)
                ->visit(route('admin.load_descriptions.index'))
                ->click('tr[data-entry-id="' . $load_description->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='description']", $load_description->description)
                ->assertSeeIn("td[field-key='qty']", $load_description->qty)
                ->assertSeeIn("td[field-key='weight_volume']", $load_description->weight_volume)
                ->assertSeeIn("td[field-key='loading_instruction_number']", $load_description->loading_instruction_number->loading_instruction_number)
                ->assertSeeIn("td[field-key='delivery_instruction_number']", $load_description->delivery_instruction_number->delivery_instruction_number)
                ->assertSeeIn("td[field-key='air_freight_number']", $load_description->air_freight_number->air_freight_number)
                ->assertSeeIn("td[field-key='rail_freight_number']", $load_description->rail_freight_number->rail_freight_number)
                ->assertSeeIn("td[field-key='sea_freight_number']", $load_description->sea_freight_number->sea_freight_number)
                ->logout();
        });
    }

}
