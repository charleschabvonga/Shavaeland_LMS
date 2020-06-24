<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RailFreightTest extends DuskTestCase
{

    public function testCreateRailFreight()
    {
        $admin = \App\User::find(1);
        $rail_freight = factory('App\RailFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $rail_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.rail_freights.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $rail_freight->project_number_id)
                ->type("rail_freight_number", $rail_freight->rail_freight_number)
                ->select("client_id", $rail_freight->client_id)
                ->select("contact_person_id", $rail_freight->contact_person_id)
                ->select('select[name="railline_or_agent[]"]', $relations[0]->id)
                ->select('select[name="railline_or_agent[]"]', $relations[1]->id)
                ->select("railline_or_agent_contact_id", $rail_freight->railline_or_agent_contact_id)
                ->select("project_manager_id", $rail_freight->project_manager_id)
                ->type("trip_number", $rail_freight->trip_number)
                ->select("route_id", $rail_freight->route_id)
                ->press('Save')
                ->assertRouteIs('admin.rail_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $rail_freight->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='rail_freight_number']", $rail_freight->rail_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $rail_freight->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $rail_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent_contact']", $rail_freight->railline_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $rail_freight->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='trip_number']", $rail_freight->trip_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $rail_freight->route->route)
                ->logout();
        });
    }

    public function testEditRailFreight()
    {
        $admin = \App\User::find(1);
        $rail_freight = factory('App\RailFreight')->create();
        $rail_freight2 = factory('App\RailFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $rail_freight, $rail_freight2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.rail_freights.index'))
                ->click('tr[data-entry-id="' . $rail_freight->id . '"] .btn-info')
                ->select("project_number_id", $rail_freight2->project_number_id)
                ->type("rail_freight_number", $rail_freight2->rail_freight_number)
                ->select("client_id", $rail_freight2->client_id)
                ->select("contact_person_id", $rail_freight2->contact_person_id)
                ->select('select[name="railline_or_agent[]"]', $relations[0]->id)
                ->select('select[name="railline_or_agent[]"]', $relations[1]->id)
                ->select("railline_or_agent_contact_id", $rail_freight2->railline_or_agent_contact_id)
                ->select("project_manager_id", $rail_freight2->project_manager_id)
                ->type("trip_number", $rail_freight2->trip_number)
                ->select("route_id", $rail_freight2->route_id)
                ->press('Update')
                ->assertRouteIs('admin.rail_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $rail_freight2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='rail_freight_number']", $rail_freight2->rail_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $rail_freight2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $rail_freight2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent_contact']", $rail_freight2->railline_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $rail_freight2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='trip_number']", $rail_freight2->trip_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $rail_freight2->route->route)
                ->logout();
        });
    }

    public function testShowRailFreight()
    {
        $admin = \App\User::find(1);
        $rail_freight = factory('App\RailFreight')->create();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $rail_freight->railline_or_agent()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $rail_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.rail_freights.index'))
                ->click('tr[data-entry-id="' . $rail_freight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $rail_freight->project_number->operation_number)
                ->assertSeeIn("td[field-key='rail_freight_number']", $rail_freight->rail_freight_number)
                ->assertSeeIn("td[field-key='client']", $rail_freight->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $rail_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='railline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='railline_or_agent_contact']", $rail_freight->railline_or_agent_contact->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $rail_freight->project_manager->name)
                ->assertSeeIn("td[field-key='trip_number']", $rail_freight->trip_number)
                ->assertSeeIn("td[field-key='route']", $rail_freight->route->route)
                ->logout();
        });
    }

}
