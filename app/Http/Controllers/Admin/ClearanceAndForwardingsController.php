<?php

namespace App\Http\Controllers\Admin;

use App\ClearanceAndForwarding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClearanceAndForwardingsRequest;
use App\Http\Requests\Admin\UpdateClearanceAndForwardingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClearanceAndForwardingsController extends Controller
{
    /**
     * Display a listing of ClearanceAndForwarding.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('clearance_and_forwarding_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('clearance_and_forwarding_delete')) {
                return abort(401);
            }
            $clearance_and_forwardings = ClearanceAndForwarding::onlyTrashed()->get();
        } else {
            $clearance_and_forwardings = ClearanceAndForwarding::all();
        }

        return view('admin.clearance_and_forwardings.index', compact('clearance_and_forwardings'));
    }

    /**
     * Show the form for creating new ClearanceAndForwarding.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('clearance_and_forwarding_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $agents = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.clearance_and_forwardings.create', compact('project_numbers', 'clients', 'contact_people', 'agents', 'agent_contacts', 'project_managers'));
    }

    /**
     * Store a newly created ClearanceAndForwarding in storage.
     *
     * @param  \App\Http\Requests\StoreClearanceAndForwardingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClearanceAndForwardingsRequest $request)
    {
        if (! Gate::allows('clearance_and_forwarding_create')) {
            return abort(401);
        }
        $clearance_and_forwarding = ClearanceAndForwarding::create($request->all());

        foreach ($request->input('invoice_items', []) as $data) {
            $clearance_and_forwarding->invoice_items()->create($data);
        }


        return redirect()->route('admin.clearance_and_forwardings.index');
    }


    /**
     * Show the form for editing ClearanceAndForwarding.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('clearance_and_forwarding_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $agents = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);

        return view('admin.clearance_and_forwardings.edit', compact('clearance_and_forwarding', 'project_numbers', 'clients', 'contact_people', 'agents', 'agent_contacts', 'project_managers'));
    }

    /**
     * Update ClearanceAndForwarding in storage.
     *
     * @param  \App\Http\Requests\UpdateClearanceAndForwardingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClearanceAndForwardingsRequest $request, $id)
    {
        if (! Gate::allows('clearance_and_forwarding_edit')) {
            return abort(401);
        }
        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);
        $clearance_and_forwarding->update($request->all());

        $invoiceItems           = $clearance_and_forwarding->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $clearance_and_forwarding->invoice_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentInvoiceItemData[$id] = $data;
            }
        }
        foreach ($invoiceItems as $item) {
            if (isset($currentInvoiceItemData[$item->id])) {
                $item->update($currentInvoiceItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.clearance_and_forwardings.index');
    }


    /**
     * Display ClearanceAndForwarding.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('clearance_and_forwarding_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $agents = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('clearance_and_forwarding_number_id', $id)->get();

        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);

        return view('admin.clearance_and_forwardings.show', compact('clearance_and_forwarding', 'invoice_items'));
    }


    /**
     * Remove ClearanceAndForwarding from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('clearance_and_forwarding_delete')) {
            return abort(401);
        }
        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);
        $clearance_and_forwarding->delete();

        return redirect()->route('admin.clearance_and_forwardings.index');
    }

    /**
     * Delete all selected ClearanceAndForwarding at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('clearance_and_forwarding_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClearanceAndForwarding::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ClearanceAndForwarding from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('clearance_and_forwarding_delete')) {
            return abort(401);
        }
        $clearance_and_forwarding = ClearanceAndForwarding::onlyTrashed()->findOrFail($id);
        $clearance_and_forwarding->restore();

        return redirect()->route('admin.clearance_and_forwardings.index');
    }

    /**
     * Permanently delete ClearanceAndForwarding from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('clearance_and_forwarding_delete')) {
            return abort(401);
        }
        $clearance_and_forwarding = ClearanceAndForwarding::onlyTrashed()->findOrFail($id);
        $clearance_and_forwarding->forceDelete();

        return redirect()->route('admin.clearance_and_forwardings.index');
    }

    public function download($clearance_and_forwarding_id)
    {
        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($clearance_and_forwarding_id);
        $pdf = \PDF::loadView('admin.clearance_and_forwarding.pdf', compact('clearance_and_forwarding'));
        return $pdf->stream('clearance_and_forwarding.pdf');
    }
}
