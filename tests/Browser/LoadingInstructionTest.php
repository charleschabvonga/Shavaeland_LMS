<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoadingInstructionTest extends DuskTestCase
{

    public function testCreateLoadingInstruction()
    {
        $admin = \App\User::find(1);
        $loading_instruction = factory('App\LoadingInstruction')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $loading_instruction, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_instructions.index'))
                ->clickLink('Add new')
                ->select("road_freight_number_id", $loading_instruction->road_freight_number_id)
                ->select("freight_contract_type", $loading_instruction->freight_contract_type)
                ->type("loading_instruction_number", $loading_instruction->loading_instruction_number)
                ->select("driver_id", $loading_instruction->driver_id)
                ->select("vehicle_id", $loading_instruction->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("vendor_id", $loading_instruction->vendor_id)
                ->select("vendor_driver_id", $loading_instruction->vendor_driver_id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[2]->id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[3]->id)
                ->type("order_number", $loading_instruction->order_number)
                ->select("client_id", $loading_instruction->client_id)
                ->select("contact_person_id", $loading_instruction->contact_person_id)
                ->select("project_manager_id", $loading_instruction->project_manager_id)
                ->type("pick_up_company_name", $loading_instruction->pick_up_company_name)
                ->type("pickup_date_time", $loading_instruction->pickup_date_time)
                ->type("prepared_by", $loading_instruction->prepared_by)
                ->select("status", $loading_instruction->status)
                ->press('Save')
                ->assertRouteIs('admin.loading_instructions.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $loading_instruction->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $loading_instruction->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $loading_instruction->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $loading_instruction->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $loading_instruction->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $loading_instruction->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_driver']", $loading_instruction->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $loading_instruction->order_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $loading_instruction->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $loading_instruction->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $loading_instruction->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='pick_up_company_name']", $loading_instruction->pick_up_company_name)
                ->assertSeeIn("tr:last-child td[field-key='pickup_date_time']", $loading_instruction->pickup_date_time)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $loading_instruction->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='status']", $loading_instruction->status)
                ->logout();
        });
    }

    public function testEditLoadingInstruction()
    {
        $admin = \App\User::find(1);
        $loading_instruction = factory('App\LoadingInstruction')->create();
        $loading_instruction2 = factory('App\LoadingInstruction')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $loading_instruction, $loading_instruction2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_instructions.index'))
                ->click('tr[data-entry-id="' . $loading_instruction->id . '"] .btn-info')
                ->select("road_freight_number_id", $loading_instruction2->road_freight_number_id)
                ->select("freight_contract_type", $loading_instruction2->freight_contract_type)
                ->type("loading_instruction_number", $loading_instruction2->loading_instruction_number)
                ->select("driver_id", $loading_instruction2->driver_id)
                ->select("vehicle_id", $loading_instruction2->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("vendor_id", $loading_instruction2->vendor_id)
                ->select("vendor_driver_id", $loading_instruction2->vendor_driver_id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[2]->id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[3]->id)
                ->type("order_number", $loading_instruction2->order_number)
                ->select("client_id", $loading_instruction2->client_id)
                ->select("contact_person_id", $loading_instruction2->contact_person_id)
                ->select("project_manager_id", $loading_instruction2->project_manager_id)
                ->type("pick_up_company_name", $loading_instruction2->pick_up_company_name)
                ->type("pickup_date_time", $loading_instruction2->pickup_date_time)
                ->type("prepared_by", $loading_instruction2->prepared_by)
                ->select("status", $loading_instruction2->status)
                ->press('Update')
                ->assertRouteIs('admin.loading_instructions.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $loading_instruction2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $loading_instruction2->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='loading_instruction_number']", $loading_instruction2->loading_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $loading_instruction2->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $loading_instruction2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $loading_instruction2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_driver']", $loading_instruction2->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $loading_instruction2->order_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $loading_instruction2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $loading_instruction2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $loading_instruction2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='pick_up_company_name']", $loading_instruction2->pick_up_company_name)
                ->assertSeeIn("tr:last-child td[field-key='pickup_date_time']", $loading_instruction2->pickup_date_time)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $loading_instruction2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='status']", $loading_instruction2->status)
                ->logout();
        });
    }

    public function testShowLoadingInstruction()
    {
        $admin = \App\User::find(1);
        $loading_instruction = factory('App\LoadingInstruction')->create();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $loading_instruction->trailers()->attach([$relations[0]->id, $relations[1]->id]);
        $loading_instruction->vendor_vehicle_description()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $loading_instruction, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.loading_instructions.index'))
                ->click('tr[data-entry-id="' . $loading_instruction->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='road_freight_number']", $loading_instruction->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='freight_contract_type']", $loading_instruction->freight_contract_type)
                ->assertSeeIn("td[field-key='loading_instruction_number']", $loading_instruction->loading_instruction_number)
                ->assertSeeIn("td[field-key='driver']", $loading_instruction->driver->name)
                ->assertSeeIn("td[field-key='vehicle']", $loading_instruction->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("td[field-key='vendor']", $loading_instruction->vendor->name)
                ->assertSeeIn("td[field-key='vendor_driver']", $loading_instruction->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("td[field-key='order_number']", $loading_instruction->order_number)
                ->assertSeeIn("td[field-key='client']", $loading_instruction->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $loading_instruction->contact_person->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $loading_instruction->project_manager->name)
                ->assertSeeIn("td[field-key='pick_up_company_name']", $loading_instruction->pick_up_company_name)
                ->assertSeeIn("td[field-key='pickup_date_time']", $loading_instruction->pickup_date_time)
                ->assertSeeIn("td[field-key='prepared_by']", $loading_instruction->prepared_by)
                ->assertSeeIn("td[field-key='status']", $loading_instruction->status)
                ->logout();
        });
    }

}
