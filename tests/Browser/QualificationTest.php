<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class QualificationTest extends DuskTestCase
{

    public function testCreateQualification()
    {
        $admin = \App\User::find(1);
        $qualification = factory('App\Qualification')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $qualification) {
            $browser->loginAs($admin)
                ->visit(route('admin.qualifications.index'))
                ->clickLink('Add new')
                ->select("employee_name_id", $qualification->employee_name_id)
                ->type("institution", $qualification->institution)
                ->type("description", $qualification->description)
                ->type("date_obtained", $qualification->date_obtained)
                ->type("expiry_date", $qualification->expiry_date)
                ->press('Save')
                ->assertRouteIs('admin.qualifications.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $qualification->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='institution']", $qualification->institution)
                ->assertSeeIn("tr:last-child td[field-key='description']", $qualification->description)
                ->assertSeeIn("tr:last-child td[field-key='date_obtained']", $qualification->date_obtained)
                ->assertSeeIn("tr:last-child td[field-key='expiry_date']", $qualification->expiry_date)
                ->logout();
        });
    }

    public function testEditQualification()
    {
        $admin = \App\User::find(1);
        $qualification = factory('App\Qualification')->create();
        $qualification2 = factory('App\Qualification')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $qualification, $qualification2) {
            $browser->loginAs($admin)
                ->visit(route('admin.qualifications.index'))
                ->click('tr[data-entry-id="' . $qualification->id . '"] .btn-info')
                ->select("employee_name_id", $qualification2->employee_name_id)
                ->type("institution", $qualification2->institution)
                ->type("description", $qualification2->description)
                ->type("date_obtained", $qualification2->date_obtained)
                ->type("expiry_date", $qualification2->expiry_date)
                ->press('Update')
                ->assertRouteIs('admin.qualifications.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $qualification2->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='institution']", $qualification2->institution)
                ->assertSeeIn("tr:last-child td[field-key='description']", $qualification2->description)
                ->assertSeeIn("tr:last-child td[field-key='date_obtained']", $qualification2->date_obtained)
                ->assertSeeIn("tr:last-child td[field-key='expiry_date']", $qualification2->expiry_date)
                ->logout();
        });
    }

    public function testShowQualification()
    {
        $admin = \App\User::find(1);
        $qualification = factory('App\Qualification')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $qualification) {
            $browser->loginAs($admin)
                ->visit(route('admin.qualifications.index'))
                ->click('tr[data-entry-id="' . $qualification->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='employee_name']", $qualification->employee_name->name)
                ->assertSeeIn("td[field-key='institution']", $qualification->institution)
                ->assertSeeIn("td[field-key='description']", $qualification->description)
                ->assertSeeIn("td[field-key='date_obtained']", $qualification->date_obtained)
                ->assertSeeIn("td[field-key='expiry_date']", $qualification->expiry_date)
                ->logout();
        });
    }

}
