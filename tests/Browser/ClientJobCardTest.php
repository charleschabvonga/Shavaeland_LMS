<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ClientJobCardTest extends DuskTestCase
{

    public function testCreateClientJobCard()
    {
        $admin = \App\User::find(1);
        $client_job_card = factory('App\ClientJobCard')->make();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $client_job_card, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_job_cards.index'))
                ->clickLink('Add new')
                ->select("job_request_number_id", $client_job_card->job_request_number_id)
                ->type("date", $client_job_card->date)
                ->type("job_card_number", $client_job_card->job_card_number)
                ->type("prepared_by", $client_job_card->prepared_by)
                ->select("project_number_id", $client_job_card->project_number_id)
                ->select("client_id", $client_job_card->client_id)
                ->select("contact_person_id", $client_job_card->contact_person_id)
                ->select("status", $client_job_card->status)
                ->select("job_type", $client_job_card->job_type)
                ->select("repair_center_id", $client_job_card->repair_center_id)
                ->select('select[name="technician[]"]', $relations[0]->id)
                ->select('select[name="technician[]"]', $relations[1]->id)
                ->select("client_vehicle_reg_no_id", $client_job_card->client_vehicle_reg_no_id)
                ->type("remarks", $client_job_card->remarks)
                ->type("instructions", $client_job_card->instructions)
                ->type("subtotal", $client_job_card->subtotal)
                ->press('Save')
                ->assertRouteIs('admin.client_job_cards.index')
                ->assertSeeIn("tr:last-child td[field-key='job_request_number']", $client_job_card->job_request_number->job_request_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $client_job_card->date)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $client_job_card->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $client_job_card->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $client_job_card->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_job_card->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $client_job_card->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_job_card->status)
                ->assertSeeIn("tr:last-child td[field-key='job_type']", $client_job_card->job_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $client_job_card->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle_reg_no']", $client_job_card->client_vehicle_reg_no->vehicle_registration_number)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $client_job_card->remarks)
                ->assertSeeIn("tr:last-child td[field-key='instructions']", $client_job_card->instructions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $client_job_card->subtotal)
                ->logout();
        });
    }

    public function testEditClientJobCard()
    {
        $admin = \App\User::find(1);
        $client_job_card = factory('App\ClientJobCard')->create();
        $client_job_card2 = factory('App\ClientJobCard')->make();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $client_job_card, $client_job_card2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_job_cards.index'))
                ->click('tr[data-entry-id="' . $client_job_card->id . '"] .btn-info')
                ->select("job_request_number_id", $client_job_card2->job_request_number_id)
                ->type("date", $client_job_card2->date)
                ->type("job_card_number", $client_job_card2->job_card_number)
                ->type("prepared_by", $client_job_card2->prepared_by)
                ->select("project_number_id", $client_job_card2->project_number_id)
                ->select("client_id", $client_job_card2->client_id)
                ->select("contact_person_id", $client_job_card2->contact_person_id)
                ->select("status", $client_job_card2->status)
                ->select("job_type", $client_job_card2->job_type)
                ->select("repair_center_id", $client_job_card2->repair_center_id)
                ->select('select[name="technician[]"]', $relations[0]->id)
                ->select('select[name="technician[]"]', $relations[1]->id)
                ->select("client_vehicle_reg_no_id", $client_job_card2->client_vehicle_reg_no_id)
                ->type("remarks", $client_job_card2->remarks)
                ->type("instructions", $client_job_card2->instructions)
                ->type("subtotal", $client_job_card2->subtotal)
                ->press('Update')
                ->assertRouteIs('admin.client_job_cards.index')
                ->assertSeeIn("tr:last-child td[field-key='job_request_number']", $client_job_card2->job_request_number->job_request_number)
                ->assertSeeIn("tr:last-child td[field-key='date']", $client_job_card2->date)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $client_job_card2->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $client_job_card2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $client_job_card2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='client']", $client_job_card2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $client_job_card2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='status']", $client_job_card2->status)
                ->assertSeeIn("tr:last-child td[field-key='job_type']", $client_job_card2->job_type)
                ->assertSeeIn("tr:last-child td[field-key='repair_center']", $client_job_card2->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle_reg_no']", $client_job_card2->client_vehicle_reg_no->vehicle_registration_number)
                ->assertSeeIn("tr:last-child td[field-key='remarks']", $client_job_card2->remarks)
                ->assertSeeIn("tr:last-child td[field-key='instructions']", $client_job_card2->instructions)
                ->assertSeeIn("tr:last-child td[field-key='subtotal']", $client_job_card2->subtotal)
                ->logout();
        });
    }

    public function testShowClientJobCard()
    {
        $admin = \App\User::find(1);
        $client_job_card = factory('App\ClientJobCard')->create();

        $relations = [
            factory('App\Employee')->create(), 
            factory('App\Employee')->create(), 
        ];

        $client_job_card->technician()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $client_job_card, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.client_job_cards.index'))
                ->click('tr[data-entry-id="' . $client_job_card->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='job_request_number']", $client_job_card->job_request_number->job_request_number)
                ->assertSeeIn("td[field-key='date']", $client_job_card->date)
                ->assertSeeIn("td[field-key='job_card_number']", $client_job_card->job_card_number)
                ->assertSeeIn("td[field-key='prepared_by']", $client_job_card->prepared_by)
                ->assertSeeIn("td[field-key='project_number']", $client_job_card->project_number->operation_number)
                ->assertSeeIn("td[field-key='client']", $client_job_card->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $client_job_card->contact_person->contact_name)
                ->assertSeeIn("td[field-key='status']", $client_job_card->status)
                ->assertSeeIn("td[field-key='job_type']", $client_job_card->job_type)
                ->assertSeeIn("td[field-key='repair_center']", $client_job_card->repair_center->center_name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='technician'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='client_vehicle_reg_no']", $client_job_card->client_vehicle_reg_no->vehicle_registration_number)
                ->assertSeeIn("td[field-key='remarks']", $client_job_card->remarks)
                ->assertSeeIn("td[field-key='instructions']", $client_job_card->instructions)
                ->assertSeeIn("td[field-key='subtotal']", $client_job_card->subtotal)
                ->logout();
        });
    }

}
