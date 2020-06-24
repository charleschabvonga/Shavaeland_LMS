<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class InhouseJobCardTest extends DuskTestCase
{

    public function testCreateInhouseJobCard()
    {
        $admin = \App\User::find(1);
        $inhouse_job_card = factory('App\InhouseJobCard')->make();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $inhouse_job_card, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.inhouse_job_cards.index'))
                ->clickLink('Add new')
                ->type("date", $inhouse_job_card->date)
                ->select("vehicle_type", $inhouse_job_card->vehicle_type)
                ->type("mileage", $inhouse_job_card->mileage)
                ->type("job_card_number", $inhouse_job_card->job_card_number)
                ->type("prepared_by", $inhouse_job_card->prepared_by)
                ->select("project_number_id", $inhouse_job_card->project_number_id)
                ->select("client_type", $inhouse_job_card->client_type)
                ->select("job_card_type", $inhouse_job_card->job_card_type)
                ->select("job_type", $inhouse_job_card->job_type)
                ->select("repair_center_id", $inhouse_job_card->repair_center_id)
                ->select('select[name="technician[]"]', $relations[0]->id)
                ->select('select[name="technician[]"]', $relations[1]->id)
                ->select("vehicle_id", $inhouse_job_card->vehicle_id)
                ->select("trailer_id", $inhouse_job_card->trailer_id)
                ->select("light_vehicles_id", $inhouse_job_card->light_vehicles_id)
                ->select("client_vehicle_reg_no_id", $inhouse_job_card->client_vehicle_reg_no_id)
                ->select("road_freight_number_id", $inhouse_job_card->road_freight_number_id)
                ->type("remarks", $inhouse_job_card->remarks)
                ->type("instructions", $inhouse_job_card->instructions)
                ->type("subtotal", $inhouse_job_card->subtotal)
                ->press('Save')
                ->assertRouteIs('admin.inhouse_job_cards.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $inhouse_job_card->date)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $inhouse_job_card->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='mileage']", $inhouse_job_card->mileage)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $inhouse_job_card->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $inhouse_job_card->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $inhouse_job_card->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $inhouse_job_card->client_type)
                ->assertSeeIn("tr:last-child td[field-key='job_card_type']", $inhouse_job_card->job_card_type)
                ->assertSeeIn("tr:last-child td[field-key='job_type']", $inhouse_job_card->job_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $inhouse_job_card->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $inhouse_job_card->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailer']", $inhouse_job_card->trailer->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='light_vehicles']", $inhouse_job_card->light_vehicles->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle_reg_no']", $inhouse_job_card->client_vehicle_reg_no->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $inhouse_job_card->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $inhouse_job_card->remarks)
                ->assertSeeIn("tr:last-child td[field-key='instructions']", $inhouse_job_card->instructions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $inhouse_job_card->subtotal)
                ->logout();
        });
    }

    public function testEditInhouseJobCard()
    {
        $admin = \App\User::find(1);
        $inhouse_job_card = factory('App\InhouseJobCard')->create();
        $inhouse_job_card2 = factory('App\InhouseJobCard')->make();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $inhouse_job_card, $inhouse_job_card2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.inhouse_job_cards.index'))
                ->click('tr[data-entry-id="' . $inhouse_job_card->id . '"] .btn-info')
                ->type("date", $inhouse_job_card2->date)
                ->select("vehicle_type", $inhouse_job_card2->vehicle_type)
                ->type("mileage", $inhouse_job_card2->mileage)
                ->type("job_card_number", $inhouse_job_card2->job_card_number)
                ->type("prepared_by", $inhouse_job_card2->prepared_by)
                ->select("project_number_id", $inhouse_job_card2->project_number_id)
                ->select("client_type", $inhouse_job_card2->client_type)
                ->select("job_card_type", $inhouse_job_card2->job_card_type)
                ->select("job_type", $inhouse_job_card2->job_type)
                ->select("repair_center_id", $inhouse_job_card2->repair_center_id)
                ->select('select[name="technician[]"]', $relations[0]->id)
                ->select('select[name="technician[]"]', $relations[1]->id)
                ->select("vehicle_id", $inhouse_job_card2->vehicle_id)
                ->select("trailer_id", $inhouse_job_card2->trailer_id)
                ->select("light_vehicles_id", $inhouse_job_card2->light_vehicles_id)
                ->select("client_vehicle_reg_no_id", $inhouse_job_card2->client_vehicle_reg_no_id)
                ->select("road_freight_number_id", $inhouse_job_card2->road_freight_number_id)
                ->type("remarks", $inhouse_job_card2->remarks)
                ->type("instructions", $inhouse_job_card2->instructions)
                ->type("subtotal", $inhouse_job_card2->subtotal)
                ->press('Update')
                ->assertRouteIs('admin.inhouse_job_cards.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $inhouse_job_card2->date)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $inhouse_job_card2->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='mileage']", $inhouse_job_card2->mileage)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $inhouse_job_card2->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $inhouse_job_card2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $inhouse_job_card2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $inhouse_job_card2->client_type)
                ->assertSeeIn("tr:last-child td[field-key='job_card_type']", $inhouse_job_card2->job_card_type)
                ->assertSeeIn("tr:last-child td[field-key='job_type']", $inhouse_job_card2->job_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $inhouse_job_card2->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $inhouse_job_card2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='trailer']", $inhouse_job_card2->trailer->trailer_description)
                ->assertSeeIn("tr:last-child td[field-key='light_vehicles']", $inhouse_job_card2->light_vehicles->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle_reg_no']", $inhouse_job_card2->client_vehicle_reg_no->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='road_freight_number']", $inhouse_job_card2->road_freight_number->road_freight_number)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $inhouse_job_card2->remarks)
                ->assertSeeIn("tr:last-child td[field-key='instructions']", $inhouse_job_card2->instructions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $inhouse_job_card2->subtotal)
                ->logout();
        });
    }

    public function testShowInhouseJobCard()
    {
        $admin = \App\User::find(1);
        $inhouse_job_card = factory('App\InhouseJobCard')->create();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $inhouse_job_card->technician()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $inhouse_job_card, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.inhouse_job_cards.index'))
                ->click('tr[data-entry-id="' . $inhouse_job_card->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $inhouse_job_card->date)
                ->assertSeeIn("td[field-key='vehicle_type']", $inhouse_job_card->vehicle_type)
                ->assertSeeIn("td[field-key='mileage']", $inhouse_job_card->mileage)
                ->assertSeeIn("td[field-key='job_card_number']", $inhouse_job_card->job_card_number)
                ->assertSeeIn("td[field-key='prepared_by']", $inhouse_job_card->prepared_by)
                ->assertSeeIn("td[field-key='project_number']", $inhouse_job_card->project_number->operation_number)
                ->assertSeeIn("td[field-key='client_type']", $inhouse_job_card->client_type)
                ->assertSeeIn("td[field-key='job_card_type']", $inhouse_job_card->job_card_type)
                ->assertSeeIn("td[field-key='job_type']", $inhouse_job_card->job_type)
                ->assertSeeIn("td[field-key='repair_center']", $inhouse_job_card->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='vehicle']", $inhouse_job_card->vehicle->vehicle_description)
                ->assertSeeIn("td[field-key='trailer']", $inhouse_job_card->trailer->trailer_description)
                ->assertSeeIn("td[field-key='light_vehicles']", $inhouse_job_card->light_vehicles->vehicle_description)
                ->assertSeeIn("td[field-key='client_vehicle_reg_no']", $inhouse_job_card->client_vehicle_reg_no->registration_number)
                ->assertSeeIn("td[field-key='road_freight_number']", $inhouse_job_card->road_freight_number->road_freight_number)
                ->assertSeeIn("td[field-key='remarks']", $inhouse_job_card->remarks)
                ->assertSeeIn("td[field-key='instructions']", $inhouse_job_card->instructions)
                ->assertSeeIn("td[field-key='subtotal']", $inhouse_job_card->subtotal)
                ->logout();
        });
    }

}
