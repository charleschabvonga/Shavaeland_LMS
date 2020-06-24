<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ReleasingTest extends DuskTestCase
{

    public function testCreateReleasing()
    {
        $admin = \App\User::find(1);
        $releasing = factory('App\Releasing')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $releasing) {
            $browser->loginAs($admin)
                ->visit(route('admin.releasings.index'))
                ->clickLink('Add new')
                ->type("date", $releasing->date)
                ->select("project_number_id", $releasing->project_number_id)
                ->select("warehouse_id", $releasing->warehouse_id)
                ->type("release_number", $releasing->release_number)
                ->type("prepared_by", $releasing->prepared_by)
                ->select("client_id", $releasing->client_id)
                ->select("contact_person_id", $releasing->contact_person_id)
                ->select("released_by_id", $releasing->released_by_id)
                ->select("project_manager_id", $releasing->project_manager_id)
                ->type("area_coverd", $releasing->area_coverd)
                ->press('Save')
                ->assertRouteIs('admin.releasings.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $releasing->date)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $releasing->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='warehouse']", $releasing->warehouse->center_name)
                ->assertSeeIn("tr:last-child td[field-key='release_number']", $releasing->release_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $releasing->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $releasing->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $releasing->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='released_by']", $releasing->released_by->name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $releasing->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='area_coverd']", $releasing->area_coverd)
                ->logout();
        });
    }

    public function testEditReleasing()
    {
        $admin = \App\User::find(1);
        $releasing = factory('App\Releasing')->create();
        $releasing2 = factory('App\Releasing')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $releasing, $releasing2) {
            $browser->loginAs($admin)
                ->visit(route('admin.releasings.index'))
                ->click('tr[data-entry-id="' . $releasing->id . '"] .btn-info')
                ->type("date", $releasing2->date)
                ->select("project_number_id", $releasing2->project_number_id)
                ->select("warehouse_id", $releasing2->warehouse_id)
                ->type("release_number", $releasing2->release_number)
                ->type("prepared_by", $releasing2->prepared_by)
                ->select("client_id", $releasing2->client_id)
                ->select("contact_person_id", $releasing2->contact_person_id)
                ->select("released_by_id", $releasing2->released_by_id)
                ->select("project_manager_id", $releasing2->project_manager_id)
                ->type("area_coverd", $releasing2->area_coverd)
                ->press('Update')
                ->assertRouteIs('admin.releasings.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $releasing2->date)
                ->assertSeeIn("tr:last-child td[field-key='project_number']", $releasing2->project_number->operation_number)
                ->assertSeeIn("tr:last-child td[field-key='warehouse']", $releasing2->warehouse->center_name)
                ->assertSeeIn("tr:last-child td[field-key='release_number']", $releasing2->release_number)
                ->assertSeeIn("tr:last-child td[field-key='prepared_by']", $releasing2->prepared_by)
                ->assertSeeIn("tr:last-child td[field-key='client']", $releasing2->client->name)
                ->assertSeeIn("tr:last-child td[field-key='contact_person']", $releasing2->contact_person->contact_name)
                ->assertSeeIn("tr:last-child td[field-key='released_by']", $releasing2->released_by->name)
                ->assertSeeIn("tr:last-child td[field-key='project_manager']", $releasing2->project_manager->name)
                ->assertSeeIn("tr:last-child td[field-key='area_coverd']", $releasing2->area_coverd)
                ->logout();
        });
    }

    public function testShowReleasing()
    {
        $admin = \App\User::find(1);
        $releasing = factory('App\Releasing')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $releasing) {
            $browser->loginAs($admin)
                ->visit(route('admin.releasings.index'))
                ->click('tr[data-entry-id="' . $releasing->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $releasing->date)
                ->assertSeeIn("td[field-key='project_number']", $releasing->project_number->operation_number)
                ->assertSeeIn("td[field-key='warehouse']", $releasing->warehouse->center_name)
                ->assertSeeIn("td[field-key='release_number']", $releasing->release_number)
                ->assertSeeIn("td[field-key='prepared_by']", $releasing->prepared_by)
                ->assertSeeIn("td[field-key='client']", $releasing->client->name)
                ->assertSeeIn("td[field-key='contact_person']", $releasing->contact_person->contact_name)
                ->assertSeeIn("td[field-key='released_by']", $releasing->released_by->name)
                ->assertSeeIn("td[field-key='project_manager']", $releasing->project_manager->name)
                ->assertSeeIn("td[field-key='area_coverd']", $releasing->area_coverd)
                ->logout();
        });
    }

}
