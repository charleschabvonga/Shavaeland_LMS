<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class AirFreightTest extends DuskTestCase
{

    public function testCreateAirFreight()
    {
        $admin = \App\User::find(1);
        $air_freight = factory('App\AirFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $air_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.air_freights.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $air_freight->project_number_id)
                ->type("air_freight_number", $air_freight->air_freight_number)
                ->select("client_id", $air_freight->client_id)
                ->select("contact_person_id", $air_freight->contact_person_id)
                ->select('select[name="airline_or_agent[]"]', $relations[0]->id)
                ->select('select[name="airline_or_agent[]"]', $relations[1]->id)
                ->select("airline_or_agent_contact_id", $air_freight->airline_or_agent_contact_id)
                ->select("project_manager_id", $air_freight->project_manager_id)
                ->type("flight_number", $air_freight->flight_number)
                ->select("route_id", $air_freight->route_id)
                ->press('Save')
                ->assertRouteIs('admin.air_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $air_freight->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='air_freight_number']", $air_freight->air_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $air_freight->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $air_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent_contact']", $air_freight->airline_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $air_freight->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='flight_number']", $air_freight->flight_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $air_freight->route->route)
                ->logout();
        });
    }

    public function testEditAirFreight()
    {
        $admin = \App\User::find(1);
        $air_freight = factory('App\AirFreight')->create();
        $air_freight2 = factory('App\AirFreight')->make();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $air_freight, $air_freight2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.air_freights.index'))
                ->click('tr[data-entry-id="' . $air_freight->id . '"] .btn-info')
                ->select("project_number_id", $air_freight2->project_number_id)
                ->type("air_freight_number", $air_freight2->air_freight_number)
                ->select("client_id", $air_freight2->client_id)
                ->select("contact_person_id", $air_freight2->contact_person_id)
                ->select('select[name="airline_or_agent[]"]', $relations[0]->id)
                ->select('select[name="airline_or_agent[]"]', $relations[1]->id)
                ->select("airline_or_agent_contact_id", $air_freight2->airline_or_agent_contact_id)
                ->select("project_manager_id", $air_freight2->project_manager_id)
                ->type("flight_number", $air_freight2->flight_number)
                ->select("route_id", $air_freight2->route_id)
                ->press('Update')
                ->assertRouteIs('admin.air_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $air_freight2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='air_freight_number']", $air_freight2->air_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $air_freight2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $air_freight2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent_contact']", $air_freight2->airline_or_agent_contact->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $air_freight2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='flight_number']", $air_freight2->flight_number)
                ->assertSeeIn("tr:last-child td[field-key='route']", $air_freight2->route->route)
                ->logout();
        });
    }

    public function testShowAirFreight()
    {
        $admin = \App\User::find(1);
        $air_freight = factory('App\AirFreight')->create();

        $relations = [
            factory('App\Vendor')->create(), 
            factory('App\Vendor')->create(), 
        ];

        $air_freight->airline_or_agent()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $air_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.air_freights.index'))
                ->click('tr[data-entry-id="' . $air_freight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $air_freight->project_number->operation_number)
                ->assertSeeIn("td[field-key='air_freight_number']", $air_freight->air_freight_number)
                ->assertSeeIn("td[field-key='client']", $air_freight->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $air_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='airline_or_agent'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='airline_or_agent_contact']", $air_freight->airline_or_agent_contact->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $air_freight->project_manager->name)
                ->assertSeeIn("td[field-key='flight_number']", $air_freight->flight_number)
                ->assertSeeIn("td[field-key='route']", $air_freight->route->route)
                ->logout();
        });
    }

}
