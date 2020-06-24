<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliveryInstructionTest extends DuskTestCase
{

    public function testCreateDeliveryInstruction()
    {
        $admin = \App\User::find(1);
        $delivery_instruction = factory('App\DeliveryInstruction')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $delivery_instruction, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.delivery_instructions.index'))
                ->clickLink('Add new')
                ->select("road_freight_number_id", $delivery_instruction->road_freight_number_id)
                ->select("freight_contract_type", $delivery_instruction->freight_contract_type)
                ->type("delivery_instruction_number", $delivery_instruction->delivery_instruction_number)
                ->select("driver_id", $delivery_instruction->driver_id)
                ->select("vehicle_id", $delivery_instruction->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("vendor_id", $delivery_instruction->vendor_id)
                ->select("vendor_driver_id", $delivery_instruction->vendor_driver_id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[2]->id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[3]->id)
                ->type("order_number", $delivery_instruction->order_number)
                ->select("client_id", $delivery_instruction->client_id)
                ->select("contact_person_id", $delivery_instruction->contact_person_id)
                ->select("project_manager_id", $delivery_instruction->project_manager_id)
                ->type("delivery_company_name", $delivery_instruction->delivery_company_name)
                ->type("delivery_date_time", $delivery_instruction->delivery_date_time)
                ->type("prepared_by", $delivery_instruction->prepared_by)
                ->select("status", $delivery_instruction->status)
                ->press('Save')
                ->assertRouteIs('admin.delivery_instructions.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $delivery_instruction->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $delivery_instruction->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='delivery_instruction_number']", $delivery_instruction->delivery_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $delivery_instruction->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $delivery_instruction->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $delivery_instruction->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_driver']", $delivery_instruction->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $delivery_instruction->order_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $delivery_instruction->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $delivery_instruction->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $delivery_instruction->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='delivery_company_name']", $delivery_instruction->delivery_company_name)
                ->assertSeeIn("tr:last-child td[field-key='delivery_date_time']", $delivery_instruction->delivery_date_time)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $delivery_instruction->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='status']", $delivery_instruction->status)
                ->logout();
        });
    }

    public function testEditDeliveryInstruction()
    {
        $admin = \App\User::find(1);
        $delivery_instruction = factory('App\DeliveryInstruction')->create();
        $delivery_instruction2 = factory('App\DeliveryInstruction')->make();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $delivery_instruction, $delivery_instruction2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.delivery_instructions.index'))
                ->click('tr[data-entry-id="' . $delivery_instruction->id . '"] .btn-info')
                ->select("road_freight_number_id", $delivery_instruction2->road_freight_number_id)
                ->select("freight_contract_type", $delivery_instruction2->freight_contract_type)
                ->type("delivery_instruction_number", $delivery_instruction2->delivery_instruction_number)
                ->select("driver_id", $delivery_instruction2->driver_id)
                ->select("vehicle_id", $delivery_instruction2->vehicle_id)
                ->select('select[name="trailers[]"]', $relations[0]->id)
                ->select('select[name="trailers[]"]', $relations[1]->id)
                ->select("vendor_id", $delivery_instruction2->vendor_id)
                ->select("vendor_driver_id", $delivery_instruction2->vendor_driver_id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[2]->id)
                ->select('select[name="vendor_vehicle_description[]"]', $relations[3]->id)
                ->type("order_number", $delivery_instruction2->order_number)
                ->select("client_id", $delivery_instruction2->client_id)
                ->select("contact_person_id", $delivery_instruction2->contact_person_id)
                ->select("project_manager_id", $delivery_instruction2->project_manager_id)
                ->type("delivery_company_name", $delivery_instruction2->delivery_company_name)
                ->type("delivery_date_time", $delivery_instruction2->delivery_date_time)
                ->type("prepared_by", $delivery_instruction2->prepared_by)
                ->select("status", $delivery_instruction2->status)
                ->press('Update')
                ->assertRouteIs('admin.delivery_instructions.index')
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $delivery_instruction2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='freight_contract_type']", $delivery_instruction2->freight_contract_type)
                ->assertSeeIn("tr:last-child td[field-key='delivery_instruction_number']", $delivery_instruction2->delivery_instruction_number)
                ->assertSeeIn("tr:last-child td[field-key='driver']", $delivery_instruction2->driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $delivery_instruction2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='vendor']", $delivery_instruction2->vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_driver']", $delivery_instruction2->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='order_number']", $delivery_instruction2->order_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $delivery_instruction2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $delivery_instruction2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $delivery_instruction2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='delivery_company_name']", $delivery_instruction2->delivery_company_name)
                ->assertSeeIn("tr:last-child td[field-key='delivery_date_time']", $delivery_instruction2->delivery_date_time)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $delivery_instruction2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='status']", $delivery_instruction2->status)
                ->logout();
        });
    }

    public function testShowDeliveryInstruction()
    {
        $admin = \App\User::find(1);
        $delivery_instruction = factory('App\DeliveryInstruction')->create();

        $relations = [
            factory('App\Trailer')->create(), 
            factory('App\Trailer')->create(), 
            factory('App\VehicleSc')->create(), 
            factory('App\VehicleSc')->create(), 
        ];

        $delivery_instruction->trailers()->attach([$relations[0]->id, $relations[1]->id]);
        $delivery_instruction->vendor_vehicle_description()->attach([$relations[2]->id, $relations[3]->id]);

        $this->browse(function (Browser $browser) use ($admin, $delivery_instruction, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.delivery_instructions.index'))
                ->click('tr[data-entry-id="' . $delivery_instruction->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='road_freight_number']", $delivery_instruction->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='freight_contract_type']", $delivery_instruction->freight_contract_type)
                ->assertSeeIn("td[field-key='delivery_instruction_number']", $delivery_instruction->delivery_instruction_number)
                ->assertSeeIn("td[field-key='driver']", $delivery_instruction->driver->name)
                ->assertSeeIn("td[field-key='vehicle']", $delivery_instruction->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:first-child", $relations[0]->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='trailers'] span:last-child", $relations[1]->trailer_description)
                ->assertSeeIn("td[field-key='vendor']", $delivery_instruction->vendor->name)
                ->assertSeeIn("td[field-key='vendor_driver']", $delivery_instruction->vendor_driver->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:first-child", $relations[2]->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='vendor_vehicle_description'] span:last-child", $relations[3]->registration_number)
                ->assertSeeIn("td[field-key='order_number']", $delivery_instruction->order_number)
                ->assertSeeIn("td[field-key='client']", $delivery_instruction->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $delivery_instruction->contact_person->contact_name)
                ->assertSeeIn("td[field-key='project_manager']", $delivery_instruction->project_manager->name)
                ->assertSeeIn("td[field-key='delivery_company_name']", $delivery_instruction->delivery_company_name)
                ->assertSeeIn("td[field-key='delivery_date_time']", $delivery_instruction->delivery_date_time)
                ->assertSeeIn("td[field-key='prepared_by']", $delivery_instruction->prepared_by)
                ->assertSeeIn("td[field-key='status']", $delivery_instruction->status)
                ->logout();
        });
    }

}
