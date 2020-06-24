<?php

namespace App\Http\Controllers\Api\V1;

use App\VendorContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorContactsRequest;
use App\Http\Requests\Admin\UpdateVendorContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorContactsController extends Controller
{
    public function index()
    {
        return VendorContact::all();
    }

    public function show($id)
    {
        return VendorContact::findOrFail($id);
    }

    public function update(UpdateVendorContactsRequest $request, $id)
    {
        $vendor_contact = VendorContact::findOrFail($id);
        $vendor_contact->update($request->all());
        

        return $vendor_contact;
    }

    public function store(StoreVendorContactsRequest $request)
    {
        $vendor_contact = VendorContact::create($request->all());
        

        return $vendor_contact;
    }

    public function destroy($id)
    {
        $vendor_contact = VendorContact::findOrFail($id);
        $vendor_contact->delete();
        return '';
    }
}
