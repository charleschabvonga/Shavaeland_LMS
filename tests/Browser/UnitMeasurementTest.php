<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class UnitMeasurementTest extends DuskTestCase
{

    public function testCreateUnitMeasurement()
    {
        $admin = \App\User::find(1);
        $unit_measurement = factory('App\UnitMeasurement')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $unit_measurement) {
            $browser->loginAs($admin)
                ->visit(route('admin.unit_measurements.index'))
                ->clickLink('Add new')
                ->type("measurement_type", $unit_measurement->measurement_type)
                ->press('Save')
                ->assertRouteIs('admin.unit_measurements.index')
                ->assertSeeIn("tr:last-child td[field-key='measurement_type']", $unit_measurement->measurement_type)
                ->logout();
        });
    }

    public function testEditUnitMeasurement()
    {
        $admin = \App\User::find(1);
        $unit_measurement = factory('App\UnitMeasurement')->create();
        $unit_measurement2 = factory('App\UnitMeasurement')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $unit_measurement, $unit_measurement2) {
            $browser->loginAs($admin)
                ->visit(route('admin.unit_measurements.index'))
                ->click('tr[data-entry-id="' . $unit_measurement->id . '"] .btn-info')
                ->type("measurement_type", $unit_measurement2->measurement_type)
                ->press('Update')
                ->assertRouteIs('admin.unit_measurements.index')
                ->assertSeeIn("tr:last-child td[field-key='measurement_type']", $unit_measurement2->measurement_type)
                ->logout();
        });
    }

    public function testShowUnitMeasurement()
    {
        $admin = \App\User::find(1);
        $unit_measurement = factory('App\UnitMeasurement')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $unit_measurement) {
            $browser->loginAs($admin)
                ->visit(route('admin.unit_measurements.index'))
                ->click('tr[data-entry-id="' . $unit_measurement->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='measurement_type']", $unit_measurement->measurement_type)
                ->logout();
        });
    }

}
