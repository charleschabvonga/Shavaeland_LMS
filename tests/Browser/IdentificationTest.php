<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class IdentificationTest extends DuskTestCase
{

    public function testCreateIdentification()
    {
        $admin = \App\User::find(1);
        $identification = factory('App\Identification')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $identification) {
            $browser->loginAs($admin)
                ->visit(route('admin.identifications.index'))
                ->clickLink('Add new')
                ->select("employee_name_id", $identification->employee_name_id)
                ->type("id_type", $identification->id_type)
                ->type("id_number", $identification->id_number)
                ->type("date_of_birth", $identification->date_of_birth)
                ->type("date_obtained", $identification->date_obtained)
                ->type("expiry_date", $identification->expiry_date)
                ->press('Save')
                ->assertRouteIs('admin.identifications.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $identification->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='id_type']", $identification->id_type)
                ->assertSeeIn("tr:last-child td[field-key='id_number']", $identification->id_number)
                ->assertSeeIn("tr:last-child td[field-key='date_of_birth']", $identification->date_of_birth)
                ->assertSeeIn("tr:last-child td[field-key='date_obtained']", $identification->date_obtained)
                ->assertSeeIn("tr:last-child td[field-key='expiry_date']", $identification->expiry_date)
                ->logout();
        });
    }

    public function testEditIdentification()
    {
        $admin = \App\User::find(1);
        $identification = factory('App\Identification')->create();
        $identification2 = factory('App\Identification')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $identification, $identification2) {
            $browser->loginAs($admin)
                ->visit(route('admin.identifications.index'))
                ->click('tr[data-entry-id="' . $identification->id . '"] .btn-info')
                ->select("employee_name_id", $identification2->employee_name_id)
                ->type("id_type", $identification2->id_type)
                ->type("id_number", $identification2->id_number)
                ->type("date_of_birth", $identification2->date_of_birth)
                ->type("date_obtained", $identification2->date_obtained)
                ->type("expiry_date", $identification2->expiry_date)
                ->press('Update')
                ->assertRouteIs('admin.identifications.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $identification2->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='id_type']", $identification2->id_type)
                ->assertSeeIn("tr:last-child td[field-key='id_number']", $identification2->id_number)
                ->assertSeeIn("tr:last-child td[field-key='date_of_birth']", $identification2->date_of_birth)
                ->assertSeeIn("tr:last-child td[field-key='date_obtained']", $identification2->date_obtained)
                ->assertSeeIn("tr:last-child td[field-key='expiry_date']", $identification2->expiry_date)
                ->logout();
        });
    }

    public function testShowIdentification()
    {
        $admin = \App\User::find(1);
        $identification = factory('App\Identification')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $identification) {
            $browser->loginAs($admin)
                ->visit(route('admin.identifications.index'))
                ->click('tr[data-entry-id="' . $identification->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='employee_name']", $identification->employee_name->name)
                ->assertSeeIn("td[field-key='id_type']", $identification->id_type)
                ->assertSeeIn("td[field-key='id_number']", $identification->id_number)
                ->assertSeeIn("td[field-key='date_of_birth']", $identification->date_of_birth)
                ->assertSeeIn("td[field-key='date_obtained']", $identification->date_obtained)
                ->assertSeeIn("td[field-key='expiry_date']", $identification->expiry_date)
                ->logout();
        });
    }

}
