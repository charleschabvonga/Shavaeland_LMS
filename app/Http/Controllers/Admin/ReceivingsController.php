<?php

namespace App\Http\Controllers\Admin;

use App\Receiving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReceivingsRequest;
use App\Http\Requests\Admin\UpdateReceivingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReceivingsController extends Controller
{
    /**
     * Display a listing of Receiving.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('receiving_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('receiving_delete')) {
                return abort(401);
            }
            $receivings = Receiving::onlyTrashed()->get();
        } else {
            $receivings = Receiving::all();
        }

        return view('admin.receivings.index', compact('receivings'));
    }

    /**
     * Show the form for creating new Receiving.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('receiving_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $received_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $receipt = Receiving::all();
        $receipt_id = $receipt->pluck('id')->last();
        $receipt_number = 'RECN-'.($receipt_id + 1000);

        return view('admin.receivings.create', compact('receipt_number', 'project_numbers', 'warehouses', 'clients', 'contact_people', 'received_bies', 'project_managers'));
    }

    /**
     * Store a newly created Receiving in storage.
     *
     * @param  \App\Http\Requests\StoreReceivingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceivingsRequest $request)
    {
        if (! Gate::allows('receiving_create')) {
            return abort(401);
        }
        $receiving = Receiving::create($request->all());

        foreach ($request->input('received_items', []) as $data) {
            $receiving->received_items()->create($data);
        }


        return redirect()->route('admin.receivings.index');
    }


    /**
     * Show the form for editing Receiving.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('receiving_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $received_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $receiving = Receiving::findOrFail($id);

        return view('admin.receivings.edit', compact('receiving', 'project_numbers', 'warehouses', 'clients', 'contact_people', 'received_bies', 'project_managers'));
    }

    /**
     * Update Receiving in storage.
     *
     * @param  \App\Http\Requests\UpdateReceivingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceivingsRequest $request, $id)
    {
        if (! Gate::allows('receiving_edit')) {
            return abort(401);
        }
        $receiving = Receiving::findOrFail($id);
        $receiving->update($request->all());

        $receivedItems           = $receiving->received_items;
        $currentReceivedItemData = [];
        foreach ($request->input('received_items', []) as $index => $data) {
            if (is_integer($index)) {
                $receiving->received_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentReceivedItemData[$id] = $data;
            }
        }
        foreach ($receivedItems as $item) {
            if (isset($currentReceivedItemData[$item->id])) {
                $item->update($currentReceivedItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.receivings.index');
    }


    /**
     * Display Receiving.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('receiving_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $received_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$received_items = \App\ReceivedItem::where('receipt_number_id', $id)->get();

        $receiving = Receiving::findOrFail($id);

        return view('admin.receivings.show', compact('receiving', 'received_items'));
    }


    /**
     * Remove Receiving from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('receiving_delete')) {
            return abort(401);
        }
        $receiving = Receiving::findOrFail($id);
        $receiving->delete();

        return redirect()->route('admin.receivings.index');
    }

    /**
     * Delete all selected Receiving at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('receiving_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Receiving::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Receiving from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('receiving_delete')) {
            return abort(401);
        }
        $receiving = Receiving::onlyTrashed()->findOrFail($id);
        $receiving->restore();

        return redirect()->route('admin.receivings.index');
    }

    /**
     * Permanently delete Receiving from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('receiving_delete')) {
            return abort(401);
        }
        $receiving = Receiving::onlyTrashed()->findOrFail($id);
        $receiving->forceDelete();

        return redirect()->route('admin.receivings.index');
    }

    public function download($receiving_id)
    {
        $receiving = Receiving::findOrFail($receiving_id);
        $pdf = \PDF::loadView('admin.receiving.pdf', compact('receiving'));
        return $pdf->stream('receiving.pdf');
    }
}
