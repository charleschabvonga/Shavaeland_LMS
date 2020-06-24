<?php

namespace App\Http\Controllers\Api\V1;

use App\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorsRequest;
use App\Http\Requests\Admin\UpdateVendorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Vendor::all();
    }

    public function show($id)
    {
        return Vendor::findOrFail($id);
    }

    public function update(UpdateVendorsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());
        
        $vendorContacts           = $vendor->vendor_contacts;
        $currentVendorContactData = [];
        foreach ($request->input('vendor_contacts', []) as $index => $data) {
            if (is_integer($index)) {
                $vendor->vendor_contacts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentVendorContactData[$id] = $data;
            }
        }
        foreach ($vendorContacts as $item) {
            if (isset($currentVendorContactData[$item->id])) {
                $item->update($currentVendorContactData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $roadFreightSubContractors           = $vendor->road_freight_sub_contractors;
        $currentRoadFreightSubContractorData = [];
        foreach ($request->input('road_freight_sub_contractors', []) as $index => $data) {
            if (is_integer($index)) {
                $vendor->road_freight_sub_contractors()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentRoadFreightSubContractorData[$id] = $data;
            }
        }
        foreach ($roadFreightSubContractors as $item) {
            if (isset($currentRoadFreightSubContractorData[$item->id])) {
                $item->update($currentRoadFreightSubContractorData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $vendor;
    }

    public function store(StoreVendorsRequest $request)
    {
        $request = $this->saveFiles($request);
        $vendor = Vendor::create($request->all());
        
        foreach ($request->input('vendor_contacts', []) as $data) {
            $vendor->vendor_contacts()->create($data);
        }
        foreach ($request->input('road_freight_sub_contractors', []) as $data) {
            $vendor->road_freight_sub_contractors()->create($data);
        }

        return $vendor;
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->delete();
        return '';
    }
}
