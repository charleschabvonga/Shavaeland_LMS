<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DrugTestTest extends DuskTestCase
{

    public function testCreateDrugTest()
    {
        $admin = \App\User::find(1);
        $drug_test = factory('App\DrugTest')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $drug_test) {
            $browser->loginAs($admin)
                ->visit(route('admin.drug_tests.index'))
                ->clickLink('Add new')
                ->type("drug_test_number", $drug_test->drug_test_number)
                ->select("employee_name_id", $drug_test->employee_name_id)
                ->type("last_annual_drug_test", $drug_test->last_annual_drug_test)
                ->type("last_random_drug_test", $drug_test->last_random_drug_test)
                ->type("last_physical_exam_date", $drug_test->last_physical_exam_date)
                ->type("description", $drug_test->description)
                ->press('Save')
                ->assertRouteIs('admin.drug_tests.index')
                ->assertSeeIn("tr:last-child td[field-key='drug_test_number']", $drug_test->drug_test_number)
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $drug_test->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='last_annual_drug_test']", $drug_test->last_annual_drug_test)
                ->assertSeeIn("tr:last-child td[field-key='last_random_drug_test']", $drug_test->last_random_drug_test)
                ->assertSeeIn("tr:last-child td[field-key='last_physical_exam_date']", $drug_test->last_physical_exam_date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $drug_test->description)
                ->logout();
        });
    }

    public function testEditDrugTest()
    {
        $admin = \App\User::find(1);
        $drug_test = factory('App\DrugTest')->create();
        $drug_test2 = factory('App\DrugTest')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $drug_test, $drug_test2) {
            $browser->loginAs($admin)
                ->visit(route('admin.drug_tests.index'))
                ->click('tr[data-entry-id="' . $drug_test->id . '"] .btn-info')
                ->type("drug_test_number", $drug_test2->drug_test_number)
                ->select("employee_name_id", $drug_test2->employee_name_id)
                ->type("last_annual_drug_test", $drug_test2->last_annual_drug_test)
                ->type("last_random_drug_test", $drug_test2->last_random_drug_test)
                ->type("last_physical_exam_date", $drug_test2->last_physical_exam_date)
                ->type("description", $drug_test2->description)
                ->press('Update')
                ->assertRouteIs('admin.drug_tests.index')
                ->assertSeeIn("tr:last-child td[field-key='drug_test_number']", $drug_test2->drug_test_number)
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $drug_test2->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='last_annual_drug_test']", $drug_test2->last_annual_drug_test)
                ->assertSeeIn("tr:last-child td[field-key='last_random_drug_test']", $drug_test2->last_random_drug_test)
                ->assertSeeIn("tr:last-child td[field-key='last_physical_exam_date']", $drug_test2->last_physical_exam_date)
                ->assertSeeIn("tr:last-child td[field-key='description']", $drug_test2->description)
                ->logout();
        });
    }

    public function testShowDrugTest()
    {
        $admin = \App\User::find(1);
        $drug_test = factory('App\DrugTest')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $drug_test) {
            $browser->loginAs($admin)
                ->visit(route('admin.drug_tests.index'))
                ->click('tr[data-entry-id="' . $drug_test->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='drug_test_number']", $drug_test->drug_test_number)
                ->assertSeeIn("td[field-key='employee_name']", $drug_test->employee_name->name)
                ->assertSeeIn("td[field-key='last_annual_drug_test']", $drug_test->last_annual_drug_test)
                ->assertSeeIn("td[field-key='last_random_drug_test']", $drug_test->last_random_drug_test)
                ->assertSeeIn("td[field-key='last_physical_exam_date']", $drug_test->last_physical_exam_date)
                ->assertSeeIn("td[field-key='description']", $drug_test->description)
                ->logout();
        });
    }

}
