<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TrailerTest extends DuskTestCase
{

    public function testCreateTrailer()
    {
        $admin = \App\User::find(1);
        $trailer = factory('App\Trailer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailer) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailers.index'))
                ->clickLink('Add new')
                ->select("trailer_type_id", $trailer->trailer_type_id)
                ->type("trailer_description", $trailer->trailer_description)
                ->type("make", $trailer->make)
                ->type("model", $trailer->model)
                ->select("availability", $trailer->availability)
                ->select("service_status", $trailer->service_status)
                ->type("chasis_number", $trailer->chasis_number)
                ->type("purchase_date", $trailer->purchase_date)
                ->type("purchase_price", $trailer->purchase_price)
                ->type("salvage_value", $trailer->salvage_value)
                ->type("investment", $trailer->investment)
                ->type("depreciation", $trailer->depreciation)
                ->type("maintenance", $trailer->maintenance)
                ->type("tyre", $trailer->tyre)
                ->press('Save')
                ->assertRouteIs('admin.trailers.index')
                ->assertSeeIn("tr:last-child td[field-key='trailer_type']", $trailer->trailer_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='trailer_description']", $trailer->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $trailer->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $trailer->model)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $trailer->availability)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $trailer->service_status)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $trailer->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $trailer->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $trailer->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $trailer->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $trailer->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $trailer->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $trailer->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $trailer->tyre)
                ->logout();
        });
    }

    public function testEditTrailer()
    {
        $admin = \App\User::find(1);
        $trailer = factory('App\Trailer')->create();
        $trailer2 = factory('App\Trailer')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $trailer, $trailer2) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailers.index'))
                ->click('tr[data-entry-id="' . $trailer->id . '"] .btn-info')
                ->select("trailer_type_id", $trailer2->trailer_type_id)
                ->type("trailer_description", $trailer2->trailer_description)
                ->type("make", $trailer2->make)
                ->type("model", $trailer2->model)
                ->select("availability", $trailer2->availability)
                ->select("service_status", $trailer2->service_status)
                ->type("chasis_number", $trailer2->chasis_number)
                ->type("purchase_date", $trailer2->purchase_date)
                ->type("purchase_price", $trailer2->purchase_price)
                ->type("salvage_value", $trailer2->salvage_value)
                ->type("investment", $trailer2->investment)
                ->type("depreciation", $trailer2->depreciation)
                ->type("maintenance", $trailer2->maintenance)
                ->type("tyre", $trailer2->tyre)
                ->press('Update')
                ->assertRouteIs('admin.trailers.index')
                ->assertSeeIn("tr:last-child td[field-key='trailer_type']", $trailer2->trailer_type->machinery_type)
                ->assertSeeIn("tr:last-child td[field-key='trailer_description']", $trailer2->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='make']", $trailer2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $trailer2->model)
                ->assertSeeIn("tr:last-child td[field-key='availability']", $trailer2->availability)
                ->assertSeeIn("tr:last-child td[field-key='service_status']", $trailer2->service_status)
                ->assertSeeIn("tr:last-child td[field-key='chasis_number']", $trailer2->chasis_number)
                ->assertSeeIn("tr:last-child td[field-key='purchase_date']", $trailer2->purchase_date)
                ->assertSeeIn("tr:last-child td[field-key='purchase_price']", $trailer2->purchase_price)
                ->assertSeeIn("tr:last-child td[field-key='salvage_value']", $trailer2->salvage_value)
                ->assertSeeIn("tr:last-child td[field-key='investment']", $trailer2->investment)
                ->assertSeeIn("tr:last-child td[field-key='depreciation']", $trailer2->depreciation)
                ->assertSeeIn("tr:last-child td[field-key='maintenance']", $trailer2->maintenance)
                ->assertSeeIn("tr:last-child td[field-key='tyre']", $trailer2->tyre)
                ->logout();
        });
    }

    public function testShowTrailer()
    {
        $admin = \App\User::find(1);
        $trailer = factory('App\Trailer')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $trailer) {
            $browser->loginAs($admin)
                ->visit(route('admin.trailers.index'))
                ->click('tr[data-entry-id="' . $trailer->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='trailer_type']", $trailer->trailer_type->machinery_type)
                ->assertSeeIn("td[field-key='trailer_description']", $trailer->trailer_description)
                ->assertSeeIn("td[field-key='make']", $trailer->make)
                ->assertSeeIn("td[field-key='model']", $trailer->model)
                ->assertSeeIn("td[field-key='availability']", $trailer->availability)
                ->assertSeeIn("td[field-key='service_status']", $trailer->service_status)
                ->assertSeeIn("td[field-key='chasis_number']", $trailer->chasis_number)
                ->assertSeeIn("td[field-key='purchase_date']", $trailer->purchase_date)
                ->assertSeeIn("td[field-key='purchase_price']", $trailer->purchase_price)
                ->assertSeeIn("td[field-key='salvage_value']", $trailer->salvage_value)
                ->assertSeeIn("td[field-key='investment']", $trailer->investment)
                ->assertSeeIn("td[field-key='depreciation']", $trailer->depreciation)
                ->assertSeeIn("td[field-key='maintenance']", $trailer->maintenance)
                ->assertSeeIn("td[field-key='tyre']", $trailer->tyre)
                ->logout();
        });
    }

}
