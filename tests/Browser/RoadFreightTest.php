<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class RoadFreightTest extends DuskTestCase
{

    public function testCreateRoadFreight()
    {
        $admin = \App\User::find(1);
        $road_freight = factory('App\RoadFreight')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\Driver')->create(), 
            factory('App\Driver')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $road_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freights.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $road_freight->project_number_id)
                ->type("road_freight_number", $road_freight->road_freight_number)
                ->select("freight_contract_type", $road_freight->freight_contract_type)
                ->select("route_id", $road_freight->route_id)
                ->select("client_id", $road_freight->client_id)
                ->select("contact_person_id", $road_freight->contact_person_id)
                ->select("project_manager_id", $road_freight->project_manager_id)
                ->select("driver_id", $road_freight->driver_id)
                ->select("vehicle_id", $road_freight->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("subcontractor_number_id", $road_freight->subcontractor_number_id)
                ->select("vendor_id", $road_freight->vendor_id)
                ->select("vendor_contact_person_id", $road_freight->vendor_contact_person_id)
                ->select('select[name="vendor_drivers[]"]', $relations[2]->id)
                ->select('select[name="vendor_drivers[]"]', $relations[3]->id)
                ->select('select[name="vendor_vehicles[]"]', $relations[4]->id)
                ->select('select[name="vendor_vehicles[]"]', $relations[5]->id)
                ->type("road_freight_income", $road_freight->road_freight_income)
                ->type("road_freight_expenses", $road_freight->road_freight_expenses)
                ->type("machinery_costs", $road_freight->machinery_costs)
                ->type("breakdown", $road_freight->breakdown)
                ->type("total_expenses", $road_freight->total_expenses)
                ->type("net_income", $road_freight->net_income)
                ->press('Save')
                ->assertRouteIs('admin.road_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $road_freight->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $road_freight->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $road_freight->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='route']", $road_freight->route->route)
                ->assertSeeIn("tr:last-child td[field-key='client']", $road_freight->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $road_freight->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $road_freight->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $road_freight->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $road_freight->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $road_freight->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $road_freight->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_contact_person']", $road_freight->vendor_contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:first-child", $relations[4]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:last-child", $relations[5]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_income']", $road_freight->road_freight_income)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_expenses']", $road_freight->road_freight_expenses)
                ->assertSeeIn("tr:last-child td[field-key='machinery_costs']", $road_freight->machinery_costs)
                ->assertSeeIn("tr:last-child td[field-key='breakdown']", $road_freight->breakdown)
                ->assertSeeIn("tr:last-child td[field-key='total_expenses']", $road_freight->total_expenses)
                ->assertSeeIn("tr:last-child td[field-key='net_income']", $road_freight->net_income)
                ->logout();
        });
    }

    public function testEditRoadFreight()
    {
        $admin = \App\User::find(1);
        $road_freight = factory('App\RoadFreight')->create();
        $road_freight2 = factory('App\RoadFreight')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\Driver')->create(), 
            factory('App\Driver')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $road_freight, $road_freight2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freights.index'))
                ->click('tr[data-entry-id="' . $road_freight->id . '"] .btn-info')
                ->select("project_number_id", $road_freight2->project_number_id)
                ->type("road_freight_number", $road_freight2->road_freight_number)
                ->select("freight_contract_type", $road_freight2->freight_contract_type)
                ->select("route_id", $road_freight2->route_id)
                ->select("client_id", $road_freight2->client_id)
                ->select("contact_person_id", $road_freight2->contact_person_id)
                ->select("project_manager_id", $road_freight2->project_manager_id)
                ->select("driver_id", $road_freight2->driver_id)
                ->select("vehicle_id", $road_freight2->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("subcontractor_number_id", $road_freight2->subcontractor_number_id)
                ->select("vendor_id", $road_freight2->vendor_id)
                ->select("vendor_contact_person_id", $road_freight2->vendor_contact_person_id)
                ->select('select[name="vendor_drivers[]"]', $relations[2]->id)
                ->select('select[name="vendor_drivers[]"]', $relations[3]->id)
                ->select('select[name="vendor_vehicles[]"]', $relations[4]->id)
                ->select('select[name="vendor_vehicles[]"]', $relations[5]->id)
                ->type("road_freight_income", $road_freight2->road_freight_income)
                ->type("road_freight_expenses", $road_freight2->road_freight_expenses)
                ->type("machinery_costs", $road_freight2->machinery_costs)
                ->type("breakdown", $road_freight2->breakdown)
                ->type("total_expenses", $road_freight2->total_expenses)
                ->type("net_income", $road_freight2->net_income)
                ->press('Update')
                ->assertRouteIs('admin.road_freights.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $road_freight2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $road_freight2->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $road_freight2->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='route']", $road_freight2->route->route)
                ->assertSeeIn("tr:last-child td[field-key='client']", $road_freight2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $road_freight2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $road_freight2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $road_freight2->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $road_freight2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='subcontractor_number']", $road_freight2->subcontractor_number->subcontractor_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $road_freight2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_contact_person']", $road_freight2->vendor_contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:first-child", $relations[4]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:last-child", $relations[5]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_income']", $road_freight2->road_freight_income)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_expenses']", $road_freight2->road_freight_expenses)
                ->assertSeeIn("tr:last-child td[field-key='machinery_costs']", $road_freight2->machinery_costs)
                ->assertSeeIn("tr:last-child td[field-key='breakdown']", $road_freight2->breakdown)
                ->assertSeeIn("tr:last-child td[field-key='total_expenses']", $road_freight2->total_expenses)
                ->assertSeeIn("tr:last-child td[field-key='net_income']", $road_freight2->net_income)
                ->logout();
        });
    }

    public function testShowRoadFreight()
    {
        $admin = \App\User::find(1);
        $road_freight = factory('App\RoadFreight')->create();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\Driver')->create(), 
            factory('App\Driver')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $road_freight->trailers()->attach([$relations[0]->id, $relations[1]->id]);
        $road_freight->vendor_drivers()->attach([$relations[2]->id, $relations[3]->id]);
        $road_freight->vendor_vehicles()->attach([$relations[4]->id, $relations[5]->id]);

        $this->browse(function (Browser $browser) use ($admin, $road_freight, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.road_freights.index'))
                ->click('tr[data-entry-id="' . $road_freight->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $road_freight->project_number->operation_number)
                ->assertSeeIn("td[field-key='road_freight_number']", $road_freight->road_freight_number)
                ->assertSeeIn("td[field-key='freight_contract_type']", $road_freight->freight_contract_type)
                ->assertSeeIn("td[field-key='route']", $road_freight->route->route)
                ->assertSeeIn("td[field-key='client']", $road_freight->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $road_freight->contact_person->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $road_freight->project_manager->name)
                ->assertSeeIn("td[field-key='driver']", $road_freight->driver->name)
                ->assertSeeIn("td[field-key='vehicle']", $road_freight->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("td[field-key='subcontractor_number']", $road_freight->subcontractor_number->subcontractor_number)
                ->assertSeeIn("td[field-key='vendor']", $road_freight->vendor->name)
                ->assertSeeIn("td[field-key='vendor_contact_person']", $road_freight->vendor_contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:first-child", $relations[2]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_drivers'] span:last-child", $relations[3]->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:first-child", $relations[4]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicles'] span:last-child", $relations[5]->registration_number)
                ->assertSeeIn("td[field-key='road_freight_income']", $road_freight->road_freight_income)
                ->assertSeeIn("td[field-key='road_freight_expenses']", $road_freight->road_freight_expenses)
                ->assertSeeIn("td[field-key='machinery_costs']", $road_freight->machinery_costs)
                ->assertSeeIn("td[field-key='breakdown']", $road_freight->breakdown)
                ->assertSeeIn("td[field-key='total_expenses']", $road_freight->total_expenses)
                ->assertSeeIn("td[field-key='net_income']", $road_freight->net_income)
                ->logout();
        });
    }

}
