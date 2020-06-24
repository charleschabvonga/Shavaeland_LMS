<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ScheduleOfServiceTest extends DuskTestCase
{

    public function testCreateScheduleOfService()
    {
        $admin = \App\User::find(1);
        $schedule_of_service = factory('App\ScheduleOfService')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_of_service) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_of_services.index'))
                ->clickLink('Add new')
                ->select("client_type", $schedule_of_service->client_type)
                ->select("client_id", $schedule_of_service->client_id)
                ->select("job_card_number_id", $schedule_of_service->job_card_number_id)
                ->select("vehicle_id", $schedule_of_service->vehicle_id)
                ->select("client_vehicle_id", $schedule_of_service->client_vehicle_id)
                ->type("description", $schedule_of_service->description)
                ->type("next_service_mileage", $schedule_of_service->next_service_mileage)
                ->type("next_service_date", $schedule_of_service->next_service_date)
                ->select("status", $schedule_of_service->status)
                ->type("schedule_number", $schedule_of_service->schedule_number)
                ->press('Save')
                ->assertRouteIs('admin.schedule_of_services.index')
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $schedule_of_service->client_type)
                ->assertSeeIn("tr:last-child td[field-key='client']", $schedule_of_service->client->name)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $schedule_of_service->job_card_number->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $schedule_of_service->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle']", $schedule_of_service->client_vehicle->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule_of_service->description)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $schedule_of_service->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $schedule_of_service->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule_of_service->status)
                ->assertSeeIn("tr:last-child td[field-key='schedule_number']", $schedule_of_service->schedule_number)
                ->logout();
        });
    }

    public function testEditScheduleOfService()
    {
        $admin = \App\User::find(1);
        $schedule_of_service = factory('App\ScheduleOfService')->create();
        $schedule_of_service2 = factory('App\ScheduleOfService')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $schedule_of_service, $schedule_of_service2) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_of_services.index'))
                ->click('tr[data-entry-id="' . $schedule_of_service->id . '"] .btn-info')
                ->select("client_type", $schedule_of_service2->client_type)
                ->select("client_id", $schedule_of_service2->client_id)
                ->select("job_card_number_id", $schedule_of_service2->job_card_number_id)
                ->select("vehicle_id", $schedule_of_service2->vehicle_id)
                ->select("client_vehicle_id", $schedule_of_service2->client_vehicle_id)
                ->type("description", $schedule_of_service2->description)
                ->type("next_service_mileage", $schedule_of_service2->next_service_mileage)
                ->type("next_service_date", $schedule_of_service2->next_service_date)
                ->select("status", $schedule_of_service2->status)
                ->type("schedule_number", $schedule_of_service2->schedule_number)
                ->press('Update')
                ->assertRouteIs('admin.schedule_of_services.index')
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $schedule_of_service2->client_type)
                ->assertSeeIn("tr:last-child td[field-key='client']", $schedule_of_service2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='job_card_number']", $schedule_of_service2->job_card_number->job_card_number)
                ->assertSeeIn("tr:last-child td[field-key='vehicle']", $schedule_of_service2->vehicle->vehicle_description)
                ->assertSeeIn("tr:last-child td[field-key='client_vehicle']", $schedule_of_service2->client_vehicle->registration_number)
                ->assertSeeIn("tr:last-child td[field-key='description']", $schedule_of_service2->description)
                ->assertSeeIn("tr:last-child td[field-key='next_service_mileage']", $schedule_of_service2->next_service_mileage)
                ->assertSeeIn("tr:last-child td[field-key='next_service_date']", $schedule_of_service2->next_service_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $schedule_of_service2->status)
                ->assertSeeIn("tr:last-child td[field-key='schedule_number']", $schedule_of_service2->schedule_number)
                ->logout();
        });
    }

    public function testShowScheduleOfService()
    {
        $admin = \App\User::find(1);
        $schedule_of_service = factory('App\ScheduleOfService')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $schedule_of_service) {
            $browser->loginAs($admin)
                ->visit(route('admin.schedule_of_services.index'))
                ->click('tr[data-entry-id="' . $schedule_of_service->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='client_type']", $schedule_of_service->client_type)
                ->assertSeeIn("td[field-key='client']", $schedule_of_service->client->name)
                ->assertSeeIn("td[field-key='job_card_number']", $schedule_of_service->job_card_number->job_card_number)
                ->assertSeeIn("td[field-key='vehicle']", $schedule_of_service->vehicle->vehicle_description)
                ->assertSeeIn("td[field-key='client_vehicle']", $schedule_of_service->client_vehicle->registration_number)
                ->assertSeeIn("td[field-key='description']", $schedule_of_service->description)
                ->assertSeeIn("td[field-key='next_service_mileage']", $schedule_of_service->next_service_mileage)
                ->assertSeeIn("td[field-key='next_service_date']", $schedule_of_service->next_service_date)
                ->assertSeeIn("td[field-key='status']", $schedule_of_service->status)
                ->assertSeeIn("td[field-key='schedule_number']", $schedule_of_service->schedule_number)
                ->logout();
        });
    }

}
