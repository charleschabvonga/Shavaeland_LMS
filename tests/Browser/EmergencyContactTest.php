<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EmergencyContactTest extends DuskTestCase
{

    public function testCreateEmergencyContact()
    {
        $admin = \App\User::find(1);
        $emergency_contact = factory('App\EmergencyContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $emergency_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.emergency_contacts.index'))
                ->clickLink('Add new')
                ->select("employee_name_id", $emergency_contact->employee_name_id)
                ->type("name", $emergency_contact->name)
                ->type("phone1", $emergency_contact->phone1)
                ->type("phone", $emergency_contact->phone)
                ->press('Save')
                ->assertRouteIs('admin.emergency_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $emergency_contact->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $emergency_contact->name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $emergency_contact->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $emergency_contact->phone)
                ->logout();
        });
    }

    public function testEditEmergencyContact()
    {
        $admin = \App\User::find(1);
        $emergency_contact = factory('App\EmergencyContact')->create();
        $emergency_contact2 = factory('App\EmergencyContact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $emergency_contact, $emergency_contact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.emergency_contacts.index'))
                ->click('tr[data-entry-id="' . $emergency_contact->id . '"] .btn-info')
                ->select("employee_name_id", $emergency_contact2->employee_name_id)
                ->type("name", $emergency_contact2->name)
                ->type("phone1", $emergency_contact2->phone1)
                ->type("phone", $emergency_contact2->phone)
                ->press('Update')
                ->assertRouteIs('admin.emergency_contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='employee_name']", $emergency_contact2->employee_name->name)
                ->assertSeeIn("tr:last-child td[field-key='name']", $emergency_contact2->name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $emergency_contact2->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone']", $emergency_contact2->phone)
                ->logout();
        });
    }

    public function testShowEmergencyContact()
    {
        $admin = \App\User::find(1);
        $emergency_contact = factory('App\EmergencyContact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $emergency_contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.emergency_contacts.index'))
                ->click('tr[data-entry-id="' . $emergency_contact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='employee_name']", $emergency_contact->employee_name->name)
                ->assertSeeIn("td[field-key='name']", $emergency_contact->name)
                ->assertSeeIn("td[field-key='phone1']", $emergency_contact->phone1)
                ->assertSeeIn("td[field-key='phone']", $emergency_contact->phone)
                ->logout();
        });
    }

}
