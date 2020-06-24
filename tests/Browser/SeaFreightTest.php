<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class SeaFreightTest extends DuskTestCase
{

    public function testCreateSeaFreight()
    {
        $admin = \App\User::find(1);
        $sea_freight = factory('App\SeaFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $sea_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.sea_freights.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $sea_freight->project_number_id)
                ->type("sea_freight_number", $sea_freight->sea_freight_number)
                ->select("client_id", $sea_freight->client_id)
                ->select("contact_person_id", $sea_freight->contact_person_id)
                ->select('select[name="shipper__or_agent[]"]', $relations[0]->id)
                ->select('select[name="shipper__or_agent[]"]', $relations[1]->id)
                ->select("shipper_or_agent_contact_id", $sea_freight->shipper_or_agent_contact_id)
                ->select("project_manager_id", $sea_freight->project_manager_id)
                ->type("voyage_number", $sea_freight->voyage_number)
                ->select("route_id", $sea_freight->route_id)
                ->press('Save')
                ->assertRouteIs('admin.sea_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $sea_freight->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='sea_freight_number']", $sea_freight->sea_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $sea_freight->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $sea_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='shipper_or_agent_contact']", $sea_freight->shipper_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $sea_freight->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='voyage_number']", $sea_freight->voyage_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $sea_freight->route->route)
                ->logout();
        });
    }

    public function testEditSeaFreight()
    {
        $admin = \App\User::find(1);
        $sea_freight = factory('App\SeaFreight')->create();
        $sea_freight2 = factory('App\SeaFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $sea_freight, $sea_freight2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.sea_freights.index'))
                ->click('tr[data-entry-id="' . $sea_freight->id . '"] .btn-info')
                ->select("project_number_id", $sea_freight2->project_number_id)
                ->type("sea_freight_number", $sea_freight2->sea_freight_number)
                ->select("client_id", $sea_freight2->client_id)
                ->select("contact_person_id", $sea_freight2->contact_person_id)
                ->select('select[name="shipper__or_agent[]"]', $relations[0]->id)
                ->select('select[name="shipper__or_agent[]"]', $relations[1]->id)
                ->select("shipper_or_agent_contact_id", $sea_freight2->shipper_or_agent_contact_id)
                ->select("project_manager_id", $sea_freight2->project_manager_id)
                ->type("voyage_number", $sea_freight2->voyage_number)
                ->select("route_id", $sea_freight2->route_id)
                ->press('Update')
                ->assertRouteIs('admin.sea_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $sea_freight2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='sea_freight_number']", $sea_freight2->sea_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $sea_freight2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $sea_freight2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='shipper_or_agent_contact']", $sea_freight2->shipper_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $sea_freight2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='voyage_number']", $sea_freight2->voyage_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $sea_freight2->route->route)
                ->logout();
        });
    }

    public function testShowSeaFreight()
    {
        $admin = \App\User::find(1);
        $sea_freight = factory('App\SeaFreight')->create();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $sea_freight->shipper__or_agent()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $sea_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.sea_freights.index'))
                ->click('tr[data-entry-id="' . $sea_freight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $sea_freight->project_number->operation_number)
                ->assertSeeIn("td[field-key='sea_freight_number']", $sea_freight->sea_freight_number)
                ->assertSeeIn("td[field-key='client']", $sea_freight->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $sea_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='shipper__or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='shipper_or_agent_contact']", $sea_freight->shipper_or_agent_contact->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $sea_freight->project_manager->name)
                ->assertSeeIn("td[field-key='voyage_number']", $sea_freight->voyage_number)
                ->assertSeeIn("td[field-key='route']", $sea_freight->route->route)
                ->logout();
        });
    }

}
