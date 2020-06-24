<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TimeProjectTest extends DuskTestCase
{

    public function testCreateTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->clickLink('Add new')
                ->type("name", $time_project->name)
                ->select("client_type", $time_project->client_type)
                ->type("street_address", $time_project->street_address)
                ->type("city", $time_project->city)
                ->type("province", $time_project->province)
                ->type("postal_code", $time_project->postal_code)
                ->type("country", $time_project->country)
                ->type("vat_number", $time_project->vat_number)
                ->type("website", $time_project->website)
                ->type("email", $time_project->email)
                ->type("phone_number_1", $time_project->phone_number_1)
                ->type("phone_number_2", $time_project->phone_number_2)
                ->type("fax_number", $time_project->fax_number)
                ->press('Save')
                ->assertRouteIs('admin.time_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_project->name)
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $time_project->client_type)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $time_project->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $time_project->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $time_project->province)
                ->assertSeeIn("tr:last-child td[field-key='postal_code']", $time_project->postal_code)
                ->assertSeeIn("tr:last-child td[field-key='country']", $time_project->country)
                ->assertSeeIn("tr:last-child td[field-key='vat_number']", $time_project->vat_number)
                ->assertSeeIn("tr:last-child td[field-key='website']", $time_project->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $time_project->email)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_1']", $time_project->phone_number_1)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_2']", $time_project->phone_number_2)
                ->assertSeeIn("tr:last-child td[field-key='fax_number']", $time_project->fax_number)
                ->logout();
        });
    }

    public function testEditTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->create();
        $time_project2 = factory('App\TimeProject')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $time_project, $time_project2) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->click('tr[data-entry-id="' . $time_project->id . '"] .btn-info')
                ->type("name", $time_project2->name)
                ->select("client_type", $time_project2->client_type)
                ->type("street_address", $time_project2->street_address)
                ->type("city", $time_project2->city)
                ->type("province", $time_project2->province)
                ->type("postal_code", $time_project2->postal_code)
                ->type("country", $time_project2->country)
                ->type("vat_number", $time_project2->vat_number)
                ->type("website", $time_project2->website)
                ->type("email", $time_project2->email)
                ->type("phone_number_1", $time_project2->phone_number_1)
                ->type("phone_number_2", $time_project2->phone_number_2)
                ->type("fax_number", $time_project2->fax_number)
                ->press('Update')
                ->assertRouteIs('admin.time_projects.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $time_project2->name)
                ->assertSeeIn("tr:last-child td[field-key='client_type']", $time_project2->client_type)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $time_project2->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $time_project2->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $time_project2->province)
                ->assertSeeIn("tr:last-child td[field-key='postal_code']", $time_project2->postal_code)
                ->assertSeeIn("tr:last-child td[field-key='country']", $time_project2->country)
                ->assertSeeIn("tr:last-child td[field-key='vat_number']", $time_project2->vat_number)
                ->assertSeeIn("tr:last-child td[field-key='website']", $time_project2->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $time_project2->email)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_1']", $time_project2->phone_number_1)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_2']", $time_project2->phone_number_2)
                ->assertSeeIn("tr:last-child td[field-key='fax_number']", $time_project2->fax_number)
                ->logout();
        });
    }

    public function testShowTimeProject()
    {
        $admin = \App\User::find(1);
        $time_project = factory('App\TimeProject')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $time_project) {
            $browser->loginAs($admin)
                ->visit(route('admin.time_projects.index'))
                ->click('tr[data-entry-id="' . $time_project->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $time_project->name)
                ->assertSeeIn("td[field-key='client_type']", $time_project->client_type)
                ->assertSeeIn("td[field-key='street_address']", $time_project->street_address)
                ->assertSeeIn("td[field-key='city']", $time_project->city)
                ->assertSeeIn("td[field-key='province']", $time_project->province)
                ->assertSeeIn("td[field-key='postal_code']", $time_project->postal_code)
                ->assertSeeIn("td[field-key='country']", $time_project->country)
                ->assertSeeIn("td[field-key='vat_number']", $time_project->vat_number)
                ->assertSeeIn("td[field-key='website']", $time_project->website)
                ->assertSeeIn("td[field-key='email']", $time_project->email)
                ->assertSeeIn("td[field-key='phone_number_1']", $time_project->phone_number_1)
                ->assertSeeIn("td[field-key='phone_number_2']", $time_project->phone_number_2)
                ->assertSeeIn("td[field-key='fax_number']", $time_project->fax_number)
                ->logout();
        });
    }

}
