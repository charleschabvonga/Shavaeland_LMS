<?php

namespace App\Http\Controllers\Admin;

use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    /**
     * Display a listing of Vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('vendor_delete')) {
                return abort(401);
            }
            $vendors = Vendor::onlyTrashed()->get();
        } else {
            $vendors = Vendor::all();
        }

        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating new Vendor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }        $enum_vendor_type = Vendor::$enum_vendor_type;
            
        return view('admin.vendors.create', compact('enum_vendor_type'));
    }

    /**
     * Store a newly created Vendor in storage.
     *
     * @param  \App\Http\Requests\StoreVendorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorsRequest $request)
    {
        if (! Gate::allows('vendor_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $vendor = Vendor::create($request->all());

        foreach ($request->input('vendor_contacts', []) as $data) {
            $vendor->vendor_contacts()->create($data);
        }
        foreach ($request->input('road_freight_sub_contractors', []) as $data) {
            $vendor->road_freight_sub_contractors()->create($data);
        }

        foreach ($request->input('tax_clearance_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
        }
        foreach ($request->input('company_registration_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
        }
        foreach ($request->input('company_proof_of_residents_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
        }
        foreach ($request->input('directors_proof_of_residence_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
        }

        return redirect()->route('admin.vendors.index');
    }


    /**
     * Show the form for editing Vendor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vendor_edit')) {
            return abort(401);
        }        $enum_vendor_type = Vendor::$enum_vendor_type;
            
        $vendor = Vendor::findOrFail($id);

        return view('admin.vendors.edit', compact('vendor', 'enum_vendor_type'));
    }

    /**
     * Update Vendor in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorsRequest $request, $id)
    {
        if (! Gate::allows('vendor_edit')) {
            return abort(401);
        }
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

        $media = [];
        foreach ($request->input('tax_clearance_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $vendor->updateMedia($media, 'tax_clearance');
        $media = [];
        foreach ($request->input('company_registration_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $vendor->updateMedia($media, 'company_registration');
        $media = [];
        foreach ($request->input('company_proof_of_residents_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $vendor->updateMedia($media, 'company_proof_of_residents');
        $media = [];
        foreach ($request->input('directors_proof_of_residence_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $vendor->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $vendor->updateMedia($media, 'directors_proof_of_residence');

        return redirect()->route('admin.vendors.index');
    }


    /**
     * Display Vendor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vendor_view')) {
            return abort(401);
        }
        $vendor_accounts = \App\VendorAccount::where('vendor_id', $id)->get();$vendor_contacts = \App\VendorContact::where('company_name_id', $id)->get();$workshops = \App\Workshop::where('vendor_id', $id)->get();$warehouses = \App\Warehouse::where('vendor_id', $id)->get();$purchase_orders = \App\PurchaseOrder::where('vendor_id', $id)->get();$drivers = \App\Driver::where('vendor_id', $id)->get();$vehicle_scs = \App\VehicleSc::where('vendor_id', $id)->get();$road_freight_sub_contractors = \App\RoadFreightSubContractor::where('vendor_id', $id)->get();$air_freights = \App\AirFreight::whereHas('airline_or_agent',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$sea_freights = \App\SeaFreight::whereHas('shipper__or_agent',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$rail_freights = \App\RailFreight::whereHas('railline_or_agent',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('agent_id', $id)->get();$vendor_bank_payments = \App\VendorBankPayment::where('vendor_id', $id)->get();$debit_notes = \App\DebitNote::where('vendor_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('vendor_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('vendor_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('vendor_id', $id)->get();$expenses = \App\Expense::where('vendor_id', $id)->get();$bank_payments = \App\BankPayment::where('vendor_id', $id)->get();$incomes = \App\Income::where('vendor_id', $id)->get();$road_freights = \App\RoadFreight::where('vendor_id', $id)->get();

        $vendor = Vendor::findOrFail($id);

        return view('admin.vendors.show', compact('vendor', 'vendor_accounts', 'vendor_contacts', 'workshops', 'warehouses', 'purchase_orders', 'drivers', 'vehicle_scs', 'road_freight_sub_contractors', 'air_freights', 'sea_freights', 'rail_freights', 'clearance_and_forwardings', 'vendor_bank_payments', 'debit_notes', 'loading_instructions', 'delivery_instructions', 'expense_categories', 'expenses', 'bank_payments', 'incomes', 'road_freights'));
    }


    /**
     * Remove Vendor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vendor_delete')) {
            return abort(401);
        }
        $vendor = Vendor::findOrFail($id);
        $vendor->deletePreservingMedia();

        return redirect()->route('admin.vendors.index');
    }

    /**
     * Delete all selected Vendor at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vendor_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Vendor::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Vendor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vendor_delete')) {
            return abort(401);
        }
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->restore();

        return redirect()->route('admin.vendors.index');
    }

    /**
     * Permanently delete Vendor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vendor_delete')) {
            return abort(401);
        }
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->forceDelete();

        return redirect()->route('admin.vendors.index');
    }
}
