<?php

namespace App\Http\Controllers\Admin;

use App\ClientContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientContactsRequest;
use App\Http\Requests\Admin\UpdateClientContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientContactsController extends Controller
{
    /**
     * Display a listing of ClientContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_contact_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_contact_delete')) {
                return abort(401);
            }
            $client_contacts = ClientContact::onlyTrashed()->get();
        } else {
            $client_contacts = ClientContact::all();
        }

        return view('admin.client_contacts.index', compact('client_contacts'));
    }

    /**
     * Show the form for creating new ClientContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_contact_create')) {
            return abort(401);
        }
        
        $company_names = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.client_contacts.create', compact('company_names'));
    }

    /**
     * Store a newly created ClientContact in storage.
     *
     * @param  \App\Http\Requests\StoreClientContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientContactsRequest $request)
    {
        if (! Gate::allows('client_contact_create')) {
            return abort(401);
        }
        $client_contact = ClientContact::create($request->all());



        return redirect()->route('admin.client_contacts.index');
    }


    /**
     * Show the form for editing ClientContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_contact_edit')) {
            return abort(401);
        }
        
        $company_names = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $client_contact = ClientContact::findOrFail($id);

        return view('admin.client_contacts.edit', compact('client_contact', 'company_names'));
    }

    /**
     * Update ClientContact in storage.
     *
     * @param  \App\Http\Requests\UpdateClientContactsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientContactsRequest $request, $id)
    {
        if (! Gate::allows('client_contact_edit')) {
            return abort(401);
        }
        $client_contact = ClientContact::findOrFail($id);
        $client_contact->update($request->all());



        return redirect()->route('admin.client_contacts.index');
    }


    /**
     * Display ClientContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_contact_view')) {
            return abort(401);
        }
        
        $company_names = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$client_accounts = \App\ClientAccount::where('contact_person_id', $id)->get();$quotations = \App\Quotation::where('contact_person_id', $id)->get();$income_categories = \App\IncomeCategory::where('contact_person_id', $id)->get();$credit_notes = \App\CreditNote::where('contact_person_id', $id)->get();$air_freights = \App\AirFreight::where('contact_person_id', $id)->get();$rail_freights = \App\RailFreight::where('contact_person_id', $id)->get();$sea_freights = \App\SeaFreight::where('contact_person_id', $id)->get();$job_cards = \App\JobCard::where('contact_person_id', $id)->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('contact_person_id', $id)->get();$releasings = \App\Releasing::where('contact_person_id', $id)->get();$receivings = \App\Receiving::where('contact_person_id', $id)->get();$road_freights = \App\RoadFreight::where('contact_person_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('contact_person_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('contact_person_id', $id)->get();

        $client_contact = ClientContact::findOrFail($id);

        return view('admin.client_contacts.show', compact('client_contact', 'client_accounts', 'quotations', 'income_categories', 'credit_notes', 'air_freights', 'rail_freights', 'sea_freights', 'job_cards', 'clearance_and_forwardings', 'releasings', 'receivings', 'road_freights', 'delivery_instructions', 'loading_instructions'));
    }


    /**
     * Remove ClientContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_contact_delete')) {
            return abort(401);
        }
        $client_contact = ClientContact::findOrFail($id);
        $client_contact->delete();

        return redirect()->route('admin.client_contacts.index');
    }

    /**
     * Delete all selected ClientContact at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_contact_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientContact::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ClientContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('client_contact_delete')) {
            return abort(401);
        }
        $client_contact = ClientContact::onlyTrashed()->findOrFail($id);
        $client_contact->restore();

        return redirect()->route('admin.client_contacts.index');
    }

    /**
     * Permanently delete ClientContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('client_contact_delete')) {
            return abort(401);
        }
        $client_contact = ClientContact::onlyTrashed()->findOrFail($id);
        $client_contact->forceDelete();

        return redirect()->route('admin.client_contacts.index');
    }
}
