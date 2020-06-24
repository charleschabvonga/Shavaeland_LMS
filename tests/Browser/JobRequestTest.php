<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class JobRequestTest extends DuskTestCase
{

    public function testCreateJobRequest()
    {
        $admin = \App\User::find(1);
        $job_request = factory('App\JobRequest')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $job_request) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_requests.index'))
                ->clickLink('Add new')
                ->select("project_number_id", $job_request->project_number_id)
                ->type("description", $job_request->description)
                ->select("workshop_manager_id", $job_request->workshop_manager_id)
                ->type("job_request_number", $job_request->job_request_number)
                ->type("requested_by", $job_request->requested_by)
                ->select("client_id", $job_request->client_id)
                ->select("contact_person_id", $job_request->contact_person_id)
                ->type("date", $job_request->date)
                ->select("vehicle_type", $job_request->vehicle_type)
                ->type("vehicle_registration_number", $job_request->vehicle_registration_number)
                ->type("make", $job_request->make)
                ->type("model", $job_request->model)
                ->type("mileage", $job_request->mileage)
                ->type("next_service_mileage", $job_request->next_service_mileage)
                ->type("next_service_date", $job_request->next_service_date)
                ->select("status", $job_request->status)
                ->press('Save')
                ->assertRouteIs('admin.job_requests.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $job_request->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='description']", $job_request->description)
                ->assertSeeIn("tr:last-child td[field-key='workshop_manager']", $job_request->workshop_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='job_request_number']", $job_request->job_request_number)
                ->assertSeeIn("tr:last-child td[field-key='requested_by']", $job_request->requested_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $job_request->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $job_request->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $job_request->date)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $job_request->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_registration_number']", $job_request->vehicle_registration_number)
                ->assertSeeIn("tr:last-child td[field-key='make']", $job_request->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $job_request->model)
                ->assertSeeIn("tr:last-child td[field-key='mileage']", $job_request->mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $job_request->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $job_request->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $job_request->status)
                ->logout();
        });
    }

    public function testEditJobRequest()
    {
        $admin = \App\User::find(1);
        $job_request = factory('App\JobRequest')->create();
        $job_request2 = factory('App\JobRequest')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $job_request, $job_request2) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_requests.index'))
                ->click('tr[data-entry-id="' . $job_request->id . '"] .btn-info')
                ->select("project_number_id", $job_request2->project_number_id)
                ->type("description", $job_request2->description)
                ->select("workshop_manager_id", $job_request2->workshop_manager_id)
                ->type("job_request_number", $job_request2->job_request_number)
                ->type("requested_by", $job_request2->requested_by)
                ->select("client_id", $job_request2->client_id)
                ->select("contact_person_id", $job_request2->contact_person_id)
                ->type("date", $job_request2->date)
                ->select("vehicle_type", $job_request2->vehicle_type)
                ->type("vehicle_registration_number", $job_request2->vehicle_registration_number)
                ->type("make", $job_request2->make)
                ->type("model", $job_request2->model)
                ->type("mileage", $job_request2->mileage)
                ->type("next_service_mileage", $job_request2->next_service_mileage)
                ->type("next_service_date", $job_request2->next_service_date)
                ->select("status", $job_request2->status)
                ->press('Update')
                ->assertRouteIs('admin.job_requests.index')
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $job_request2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='description']", $job_request2->description)
                ->assertSeeIn("tr:last-child td[field-key='workshop_manager']", $job_request2->workshop_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='job_request_number']", $job_request2->job_request_number)
                ->assertSeeIn("tr:last-child td[field-key='requested_by']", $job_request2->requested_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $job_request2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $job_request2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $job_request2->date)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_type']", $job_request2->vehicle_type)
                ->assertSeeIn("tr:last-child td[field-key='vehicle_registration_number']", $job_request2->vehicle_registration_number)
                ->assertSeeIn("tr:last-child td[field-key='make']", $job_request2->make)
                ->assertSeeIn("tr:last-child td[field-key='model']", $job_request2->model)
                ->assertSeeIn("tr:last-child td[field-key='mileage']", $job_request2->mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $job_request2->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $job_request2->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $job_request2->status)
                ->logout();
        });
    }

    public function testShowJobRequest()
    {
        $admin = \App\User::find(1);
        $job_request = factory('App\JobRequest')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $job_request) {
            $browser->loginAs($admin)
                ->visit(route('admin.job_requests.index'))
                ->click('tr[data-entry-id="' . $job_request->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='project_number']", $job_request->project_number->operation_number)
                ->assertSeeIn("td[field-key='description']", $job_request->description)
                ->assertSeeIn("td[field-key='workshop_manager']", $job_request->workshop_manager->name)
                ->assertSeeIn("td[field-key='job_request_number']", $job_request->job_request_number)
                ->assertSeeIn("td[field-key='requested_by']", $job_request->requested_by)
                ->assertSeeIn("td[field-key='client']", $job_request->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $job_request->contact_person->contact_name)
                ->assertSeeIn("td[field-key='date']", $job_request->date)
                ->assertSeeIn("td[field-key='vehicle_type']", $job_request->vehicle_type)
                ->assertSeeIn("td[field-key='vehicle_registration_number']", $job_request->vehicle_registration_number)
                ->assertSeeIn("td[field-key='make']", $job_request->make)
                ->assertSeeIn("td[field-key='model']", $job_request->model)
                ->assertSeeIn("td[field-key='mileage']", $job_request->mileage)
                ->assertSeeIn("td[field-key='next_service_mileage']", $job_request->next_service_mileage)
                ->assertSeeIn("td[field-key='next_service_date']", $job_request->next_service_date)
                ->assertSeeIn("td[field-key='status']", $job_request->status)
                ->logout();
        });
    }

}
