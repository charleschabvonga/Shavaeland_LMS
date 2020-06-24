<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class VendorTest extends DuskTestCase
{

    public function testCreateVendor()
    {
        $admin = \App\User::find(1);
        $vendor = factory('App\Vendor')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendors.index'))
                ->clickLink('Add new')
                ->type("name", $vendor->name)
                ->select("vendor_type", $vendor->vendor_type)
                ->type("street_address", $vendor->street_address)
                ->type("city", $vendor->city)
                ->type("province", $vendor->province)
                ->type("postal_code", $vendor->postal_code)
                ->type("country", $vendor->country)
                ->type("vat", $vendor->vat)
                ->type("website", $vendor->website)
                ->type("email", $vendor->email)
                ->type("phone_number_1", $vendor->phone_number_1)
                ->type("phone_number_2", $vendor->phone_number_2)
                ->type("fax_number", $vendor->fax_number)
                ->type("tax_clearance_number", $vendor->tax_clearance_number)
                ->attach("tax_clearance", base_path("tests/_resources/test.jpg"))
                ->type("tax_clearance_expiration_date", $vendor->tax_clearance_expiration_date)
                ->type("company_registration_number", $vendor->company_registration_number)
                ->attach("company_registration", base_path("tests/_resources/test.jpg"))
                ->attach("company_proof_of_residents", base_path("tests/_resources/test.jpg"))
                ->type("directors_name", $vendor->directors_name)
                ->type("director_id_number", $vendor->director_id_number)
                ->attach("directors_proof_of_residence", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.vendors.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $vendor->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_type']", $vendor->vendor_type)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $vendor->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $vendor->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $vendor->province)
                ->assertSeeIn("tr:last-child td[field-key='postal_code']", $vendor->postal_code)
                ->assertSeeIn("tr:last-child td[field-key='country']", $vendor->country)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $vendor->vat)
                ->assertSeeIn("tr:last-child td[field-key='website']", $vendor->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $vendor->email)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_1']", $vendor->phone_number_1)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_2']", $vendor->phone_number_2)
                ->assertSeeIn("tr:last-child td[field-key='fax_number']", $vendor->fax_number)
                ->assertSeeIn("tr:last-child td[field-key='tax_clearance_number']", $vendor->tax_clearance_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->tax_clearance . "']")
                ->assertSeeIn("tr:last-child td[field-key='tax_clearance_expiration_date']", $vendor->tax_clearance_expiration_date)
                ->assertSeeIn("tr:last-child td[field-key='company_registration_number']", $vendor->company_registration_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->company_registration . "']")
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->company_proof_of_residents . "']")
                ->assertSeeIn("tr:last-child td[field-key='directors_name']", $vendor->directors_name)
                ->assertSeeIn("tr:last-child td[field-key='director_id_number']", $vendor->director_id_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->directors_proof_of_residence . "']")
                ->logout();
        });
    }

    public function testEditVendor()
    {
        $admin = \App\User::find(1);
        $vendor = factory('App\Vendor')->create();
        $vendor2 = factory('App\Vendor')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $vendor, $vendor2) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendors.index'))
                ->click('tr[data-entry-id="' . $vendor->id . '"] .btn-info')
                ->type("name", $vendor2->name)
                ->select("vendor_type", $vendor2->vendor_type)
                ->type("street_address", $vendor2->street_address)
                ->type("city", $vendor2->city)
                ->type("province", $vendor2->province)
                ->type("postal_code", $vendor2->postal_code)
                ->type("country", $vendor2->country)
                ->type("vat", $vendor2->vat)
                ->type("website", $vendor2->website)
                ->type("email", $vendor2->email)
                ->type("phone_number_1", $vendor2->phone_number_1)
                ->type("phone_number_2", $vendor2->phone_number_2)
                ->type("fax_number", $vendor2->fax_number)
                ->type("tax_clearance_number", $vendor2->tax_clearance_number)
                ->attach("tax_clearance", base_path("tests/_resources/test.jpg"))
                ->type("tax_clearance_expiration_date", $vendor2->tax_clearance_expiration_date)
                ->type("company_registration_number", $vendor2->company_registration_number)
                ->attach("company_registration", base_path("tests/_resources/test.jpg"))
                ->attach("company_proof_of_residents", base_path("tests/_resources/test.jpg"))
                ->type("directors_name", $vendor2->directors_name)
                ->type("director_id_number", $vendor2->director_id_number)
                ->attach("directors_proof_of_residence", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.vendors.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $vendor2->name)
                ->assertSeeIn("tr:last-child td[field-key='vendor_type']", $vendor2->vendor_type)
                ->assertSeeIn("tr:last-child td[field-key='street_address']", $vendor2->street_address)
                ->assertSeeIn("tr:last-child td[field-key='city']", $vendor2->city)
                ->assertSeeIn("tr:last-child td[field-key='province']", $vendor2->province)
                ->assertSeeIn("tr:last-child td[field-key='postal_code']", $vendor2->postal_code)
                ->assertSeeIn("tr:last-child td[field-key='country']", $vendor2->country)
                ->assertSeeIn("tr:last-child td[field-key='vat']", $vendor2->vat)
                ->assertSeeIn("tr:last-child td[field-key='website']", $vendor2->website)
                ->assertSeeIn("tr:last-child td[field-key='email']", $vendor2->email)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_1']", $vendor2->phone_number_1)
                ->assertSeeIn("tr:last-child td[field-key='phone_number_2']", $vendor2->phone_number_2)
                ->assertSeeIn("tr:last-child td[field-key='fax_number']", $vendor2->fax_number)
                ->assertSeeIn("tr:last-child td[field-key='tax_clearance_number']", $vendor2->tax_clearance_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->tax_clearance . "']")
                ->assertSeeIn("tr:last-child td[field-key='tax_clearance_expiration_date']", $vendor2->tax_clearance_expiration_date)
                ->assertSeeIn("tr:last-child td[field-key='company_registration_number']", $vendor2->company_registration_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->company_registration . "']")
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->company_proof_of_residents . "']")
                ->assertSeeIn("tr:last-child td[field-key='directors_name']", $vendor2->directors_name)
                ->assertSeeIn("tr:last-child td[field-key='director_id_number']", $vendor2->director_id_number)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Vendor::first()->directors_proof_of_residence . "']")
                ->logout();
        });
    }

    public function testShowVendor()
    {
        $admin = \App\User::find(1);
        $vendor = factory('App\Vendor')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $vendor) {
            $browser->loginAs($admin)
                ->visit(route('admin.vendors.index'))
                ->click('tr[data-entry-id="' . $vendor->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $vendor->name)
                ->assertSeeIn("td[field-key='vendor_type']", $vendor->vendor_type)
                ->assertSeeIn("td[field-key='street_address']", $vendor->street_address)
                ->assertSeeIn("td[field-key='city']", $vendor->city)
                ->assertSeeIn("td[field-key='province']", $vendor->province)
                ->assertSeeIn("td[field-key='postal_code']", $vendor->postal_code)
                ->assertSeeIn("td[field-key='country']", $vendor->country)
                ->assertSeeIn("td[field-key='vat']", $vendor->vat)
                ->assertSeeIn("td[field-key='website']", $vendor->website)
                ->assertSeeIn("td[field-key='email']", $vendor->email)
                ->assertSeeIn("td[field-key='phone_number_1']", $vendor->phone_number_1)
                ->assertSeeIn("td[field-key='phone_number_2']", $vendor->phone_number_2)
                ->assertSeeIn("td[field-key='fax_number']", $vendor->fax_number)
                ->assertSeeIn("td[field-key='tax_clearance_number']", $vendor->tax_clearance_number)
                ->assertSeeIn("td[field-key='tax_clearance_expiration_date']", $vendor->tax_clearance_expiration_date)
                ->assertSeeIn("td[field-key='company_registration_number']", $vendor->company_registration_number)
                ->assertSeeIn("td[field-key='directors_name']", $vendor->directors_name)
                ->assertSeeIn("td[field-key='director_id_number']", $vendor->director_id_number)
                ->logout();
        });
    }

}
