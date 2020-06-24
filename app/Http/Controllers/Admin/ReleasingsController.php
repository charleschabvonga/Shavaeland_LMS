<?php

namespace App\Http\Controllers\Admin;

use App\Releasing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReleasingsRequest;
use App\Http\Requests\Admin\UpdateReleasingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReleasingsController extends Controller
{
    /**
     * Display a listing of Releasing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('releasing_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('releasing_delete')) {
                return abort(401);
            }
            $releasings = Releasing::onlyTrashed()->get();
        } else {
            $releasings = Releasing::all();
        }

        return view('admin.releasings.index', compact('releasings'));
    }

    /**
     * Show the form for creating new Releasing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('releasing_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $released_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $release = Releasing::all();
        $release_id = $release->pluck('id')->last();
        $release_number = 'RELN-'.($release_id + 1000);

        return view('admin.releasings.create', compact('release_number', 'project_numbers', 'warehouses', 'clients', 'contact_people', 'released_bies', 'project_managers'));
    }

    /**
     * Store a newly created Releasing in storage.
     *
     * @param  \App\Http\Requests\StoreReleasingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReleasingsRequest $request)
    {
        if (! Gate::allows('releasing_create')) {
            return abort(401);
        }
        $releasing = Releasing::create($request->all());

        foreach ($request->input('received_items', []) as $data) {
            $releasing->received_items()->create($data);
        }


        return redirect()->route('admin.releasings.index');
    }


    /**
     * Show the form for editing Releasing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('releasing_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $released_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $releasing = Releasing::findOrFail($id);

        return view('admin.releasings.edit', compact('releasing', 'project_numbers', 'warehouses', 'clients', 'contact_people', 'released_bies', 'project_managers'));
    }

    /**
     * Update Releasing in storage.
     *
     * @param  \App\Http\Requests\UpdateReleasingsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReleasingsRequest $request, $id)
    {
        if (! Gate::allows('releasing_edit')) {
            return abort(401);
        }
        $releasing = Releasing::findOrFail($id);
        $releasing->update($request->all());

        $receivedItems           = $releasing->received_items;
        $currentReceivedItemData = [];
        foreach ($request->input('received_items', []) as $index => $data) {
            if (is_integer($index)) {
                $releasing->received_items()->create($data);
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


        return redirect()->route('admin.releasings.index');
    }


    /**
     * Display Releasing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('releasing_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $warehouses = \App\Warehouse::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $released_bies = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$received_items = \App\ReceivedItem::where('release_number_id', $id)->get();

        $releasing = Releasing::findOrFail($id);

        return view('admin.releasings.show', compact('releasing', 'received_items'));
    }


    /**
     * Remove Releasing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('releasing_delete')) {
            return abort(401);
        }
        $releasing = Releasing::findOrFail($id);
        $releasing->delete();

        return redirect()->route('admin.releasings.index');
    }

    /**
     * Delete all selected Releasing at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('releasing_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Releasing::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Releasing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('releasing_delete')) {
            return abort(401);
        }
        $releasing = Releasing::onlyTrashed()->findOrFail($id);
        $releasing->restore();

        return redirect()->route('admin.releasings.index');
    }

    /**
     * Permanently delete Releasing from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('releasing_delete')) {
            return abort(401);
        }
        $releasing = Releasing::onlyTrashed()->findOrFail($id);
        $releasing->forceDelete();

        return redirect()->route('admin.releasings.index');
    }

    public function download($releasing_id)
    {
        $releasing = Releasing::findOrFail($releasing_id);
        $pdf = \PDF::loadView('admin.releasing.pdf', compact('releasing'));
        return $pdf->stream('releasing.pdf');
    }
}
