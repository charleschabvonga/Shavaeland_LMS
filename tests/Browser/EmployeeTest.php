<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EmployeeTest extends DuskTestCase
{

    public function testCreateEmployee()
    {
        $admin = \App\User::find(1);
        $employee = factory('App\Employee')->make();

        $relations = [
            factory('App\Department')->create(), 
            factory('App\Department')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $employee, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.employees.index'))
                ->clickLink('Add new')
                ->type("name", $employee->name)
                ->select('select[name="department[]"]', $relations[0]->id)
                ->select('select[name="department[]"]', $relations[1]->id)
                ->select("position", $employee->position)
                ->type("start_date", $employee->start_date)
                ->type("end_date", $employee->end_date)
                ->select("status", $employee->status)
                ->type("street_address", $employee->street_address)
                ->type("city", $employee->city)
                ->type("province", $employee->province)
                ->type("country", $employee->country)
                ->type("sa_mobile", $employee->sa_mobile)
                ->type("int_mobile", $employee->int_mobile)
                ->type("email", $employee->email)
                ->attach("upload_qualifications", base_path("tests/_resources/test.jpg"))
                ->attach("upload_identification_docs", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.employees.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $employee->name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:first-child", $relations[0]->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:last-child", $relations[1]->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='position']", $employee->position)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $employee->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $employee->end_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $employee->status)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $employee->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $employee->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $employee->province)
                ->assertSeeIn("tr:last-child td[field-key='country']", $employee->country)
                ->assertSeeIn("tr:last-child td[field-key='sa_mobile']", $employee->sa_mobile)
                ->assertSeeIn("tr:last-child td[field-key='int_mobile']", $employee->int_mobile)
                ->assertSeeIn("tr:last-child td[field-key='email']", $employee->email)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Employee::first()->upload_qualifications . "']")
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Employee::first()->upload_identification_docs . "']")
                ->logout();
        });
    }

    public function testEditEmployee()
    {
        $admin = \App\User::find(1);
        $employee = factory('App\Employee')->create();
        $employee2 = factory('App\Employee')->make();

        $relations = [
            factory('App\Department')->create(), 
            factory('App\Department')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $employee, $employee2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.employees.index'))
                ->click('tr[data-entry-id="' . $employee->id . '"] .btn-info')
                ->type("name", $employee2->name)
                ->select('select[name="department[]"]', $relations[0]->id)
                ->select('select[name="department[]"]', $relations[1]->id)
                ->select("position", $employee2->position)
                ->type("start_date", $employee2->start_date)
                ->type("end_date", $employee2->end_date)
                ->select("status", $employee2->status)
                ->type("street_address", $employee2->street_address)
                ->type("city", $employee2->city)
                ->type("province", $employee2->province)
                ->type("country", $employee2->country)
                ->type("sa_mobile", $employee2->sa_mobile)
                ->type("int_mobile", $employee2->int_mobile)
                ->type("email", $employee2->email)
                ->attach("upload_qualifications", base_path("tests/_resources/test.jpg"))
                ->attach("upload_identification_docs", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.employees.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $employee2->name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:first-child", $relations[0]->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:last-child", $relations[1]->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='position']", $employee2->position)
                ->assertSeeIn("tr:last-child td[field-key='start_date']", $employee2->start_date)
                ->assertSeeIn("tr:last-child td[field-key='end_date']", $employee2->end_date)
                ->assertSeeIn("tr:last-child td[field-key='status']", $employee2->status)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $employee2->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $employee2->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $employee2->province)
                ->assertSeeIn("tr:last-child td[field-key='country']", $employee2->country)
                ->assertSeeIn("tr:last-child td[field-key='sa_mobile']", $employee2->sa_mobile)
                ->assertSeeIn("tr:last-child td[field-key='int_mobile']", $employee2->int_mobile)
                ->assertSeeIn("tr:last-child td[field-key='email']", $employee2->email)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Employee::first()->upload_qualifications . "']")
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Employee::first()->upload_identification_docs . "']")
                ->logout();
        });
    }

    public function testShowEmployee()
    {
        $admin = \App\User::find(1);
        $employee = factory('App\Employee')->create();

        $relations = [
            factory('App\Department')->create(), 
            factory('App\Department')->create(), 
        ];

        $employee->department()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $employee, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.employees.index'))
                ->click('tr[data-entry-id="' . $employee->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $employee->name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:first-child", $relations[0]->dept_name)
                ->assertSeeIn("tr:last-child td[field-key='department'] span:last-child", $relations[1]->dept_name)
                ->assertSeeIn("td[field-key='position']", $employee->position)
                ->assertSeeIn("td[field-key='start_date']", $employee->start_date)
                ->assertSeeIn("td[field-key='end_date']", $employee->end_date)
                ->assertSeeIn("td[field-key='status']", $employee->status)
                ->assertSeeIn("td[field-key='street_address']", $employee->street_address)
                ->assertSeeIn("td[field-key='city']", $employee->city)
                ->assertSeeIn("td[field-key='province']", $employee->province)
                ->assertSeeIn("td[field-key='country']", $employee->country)
                ->assertSeeIn("td[field-key='sa_mobile']", $employee->sa_mobile)
                ->assertSeeIn("td[field-key='int_mobile']", $employee->int_mobile)
                ->assertSeeIn("td[field-key='email']", $employee->email)
                ->logout();
        });
    }

}
