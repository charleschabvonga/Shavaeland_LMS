<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DepartmentTest extends DuskTestCase
{

    public function testCreateDepartment()
    {
        $admin = \App\User::find(1);
        $department = factory('App\Department')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $department) {
            $browser->loginAs($admin)
                ->visit(route('admin.departments.index'))
                ->clickLink('Add new')
                ->type("dept_name", $department->dept_name)
                ->type("manager", $department->manager)
                ->type("street_address", $department->street_address)
                ->type("city", $department->city)
                ->type("province", $department->province)
                ->type("country", $department->country)
                ->type("phone_no", $department->phone_no)
                ->type("extension", $department->extension)
                ->type("mobile_number", $department->mobile_number)
                ->type("email", $department->email)
                ->press('Save')
                ->assertRouteIs('admin.departments.index')
                ->assertSeeIn("tr:last-child td[field-key='dept_name']", $department->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='manager']", $department->manager)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $department->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $department->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $department->province)
                ->assertSeeIn("tr:last-child td[field-key='country']", $department->country)
                ->assertSeeIn("tr:last-child td[field-key='phone_no']", $department->phone_no)
                ->assertSeeIn("tr:last-child td[field-key='extension']", $department->extension)
                ->assertSeeIn("tr:last-child td[field-key='mobile_number']", $department->mobile_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $department->email)
                ->logout();
        });
    }

    public function testEditDepartment()
    {
        $admin = \App\User::find(1);
        $department = factory('App\Department')->create();
        $department2 = factory('App\Department')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $department, $department2) {
            $browser->loginAs($admin)
                ->visit(route('admin.departments.index'))
                ->click('tr[data-entry-id="' . $department->id . '"] .btn-info')
                ->type("dept_name", $department2->dept_name)
                ->type("manager", $department2->manager)
                ->type("street_address", $department2->street_address)
                ->type("city", $department2->city)
                ->type("province", $department2->province)
                ->type("country", $department2->country)
                ->type("phone_no", $department2->phone_no)
                ->type("extension", $department2->extension)
                ->type("mobile_number", $department2->mobile_number)
                ->type("email", $department2->email)
                ->press('Update')
                ->assertRouteIs('admin.departments.index')
                ->assertSeeIn("tr:last-child td[field-key='dept_name']", $department2->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='manager']", $department2->manager)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $department2->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $department2->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $department2->province)
                ->assertSeeIn("tr:last-child td[field-key='country']", $department2->country)
                ->assertSeeIn("tr:last-child td[field-key='phone_no']", $department2->phone_no)
                ->assertSeeIn("tr:last-child td[field-key='extension']", $department2->extension)
                ->assertSeeIn("tr:last-child td[field-key='mobile_number']", $department2->mobile_number)
                ->assertSeeIn("tr:last-child td[field-key='email']", $department2->email)
                ->logout();
        });
    }

    public function testShowDepartment()
    {
        $admin = \App\User::find(1);
        $department = factory('App\Department')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $department) {
            $browser->loginAs($admin)
                ->visit(route('admin.departments.index'))
                ->click('tr[data-entry-id="' . $department->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='dept_name']", $department->dept_name)
                ->assertSeeIn("td[field-key='manager']", $department->manager)
                ->assertSeeIn("td[field-key='street_address']", $department->street_address)
                ->assertSeeIn("td[field-key='city']", $department->city)
                ->assertSeeIn("td[field-key='province']", $department->province)
                ->assertSeeIn("td[field-key='country']", $department->country)
                ->assertSeeIn("td[field-key='phone_no']", $department->phone_no)
                ->assertSeeIn("td[field-key='extension']", $department->extension)
                ->assertSeeIn("td[field-key='mobile_number']", $department->mobile_number)
                ->assertSeeIn("td[field-key='email']", $department->email)
                ->logout();
        });
    }

}
