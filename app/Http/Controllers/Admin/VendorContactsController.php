<?php

namespace App\Http\Controllers\Admin;

use App\VendorContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorContactsRequest;
use App\Http\Requests\Admin\UpdateVendorContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorContactsController extends Controller
{
    /**
     * Display a listing of VendorContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_contact_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('vendor_contact_delete')) {
                return abort(401);
            }
            $vendor_contacts = VendorContact::onlyTrashed()->get();
        } else {
            $vendor_contacts = VendorContact::all();
        }

        return view('admin.vendor_contacts.index', compact('vendor_contacts'));
    }

    /**
     * Show the form for creating new VendorContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_contact_create')) {
            return abort(401);
        }
        
        $company_names = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.vendor_contacts.create', compact('company_names'));
    }

    /**
     * Store a newly created VendorContact in storage.
     *
     * @param  \App\Http\Requests\StoreVendorContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorContactsRequest $request)
    {
        if (! Gate::allows('vendor_contact_create')) {
            return abort(401);
        }
        $vendor_contact = VendorContact::create($request->all());



        return redirect()->route('admin.vendor_contacts.index');
    }


    /**
     * Show the form for editing VendorContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vendor_contact_edit')) {
            return abort(401);
        }
        
        $company_names = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $vendor_contact = VendorContact::findOrFail($id);

        return view('admin.vendor_contacts.edit', compact('vendor_contact', 'company_names'));
    }

    /**
     * Update VendorContact in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorContactsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorContactsRequest $request, $id)
    {
        if (! Gate::allows('vendor_contact_edit')) {
            return abort(401);
        }
        $vendor_contact = VendorContact::findOrFail($id);
        $vendor_contact->update($request->all());



        return redirect()->route('admin.vendor_contacts.index');
    }


    /**
     * Display VendorContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vendor_contact_view')) {
            return abort(401);
        }
        
        $company_names = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$vendor_accounts = \App\VendorAccount::where('contact_person_id', $id)->get();$debit_notes = \App\DebitNote::where('contact_person_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('contact_person_id', $id)->get();$air_freights = \App\AirFreight::where('airline_or_agent_contact_id', $id)->get();$sea_freights = \App\SeaFreight::where('shipper_or_agent_contact_id', $id)->get();$rail_freights = \App\RailFreight::where('railline_or_agent_contact_id', $id)->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('agent_contact_id', $id)->get();$road_freights = \App\RoadFreight::where('vendor_contact_person_id', $id)->get();

        $vendor_contact = VendorContact::findOrFail($id);

        return view('admin.vendor_contacts.show', compact('vendor_contact', 'vendor_accounts', 'debit_notes', 'expense_categories', 'air_freights', 'sea_freights', 'rail_freights', 'clearance_and_forwardings', 'road_freights'));
    }


    /**
     * Remove VendorContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vendor_contact_delete')) {
            return abort(401);
        }
        $vendor_contact = VendorContact::findOrFail($id);
        $vendor_contact->delete();

        return redirect()->route('admin.vendor_contacts.index');
    }

    /**
     * Delete all selected VendorContact at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vendor_contact_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = VendorContact::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore VendorContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vendor_contact_delete')) {
            return abort(401);
        }
        $vendor_contact = VendorContact::onlyTrashed()->findOrFail($id);
        $vendor_contact->restore();

        return redirect()->route('admin.vendor_contacts.index');
    }

    /**
     * Permanently delete VendorContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vendor_contact_delete')) {
            return abort(401);
        }
        $vendor_contact = VendorContact::onlyTrashed()->findOrFail($id);
        $vendor_contact->forceDelete();

        return redirect()->route('admin.vendor_contacts.index');
    }
}
