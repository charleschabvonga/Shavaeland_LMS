<?php

namespace App\Http\Controllers\Admin;

use App\RailFreight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRailFreightsRequest;
use App\Http\Requests\Admin\UpdateRailFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RailFreightsController extends Controller
{
    /**
     * Display a listing of RailFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('rail_freight_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('rail_freight_delete')) {
                return abort(401);
            }
            $rail_freights = RailFreight::onlyTrashed()->get();
        } else {
            $rail_freights = RailFreight::all();
        }

        return view('admin.rail_freights.index', compact('rail_freights'));
    }

    /**
     * Show the form for creating new RailFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('rail_freight_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $railline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $railline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.rail_freights.create', compact('project_numbers', 'clients', 'contact_people', 'railline_or_agents', 'railline_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Store a newly created RailFreight in storage.
     *
     * @param  \App\Http\Requests\StoreRailFreightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRailFreightsRequest $request)
    {
        if (! Gate::allows('rail_freight_create')) {
            return abort(401);
        }
        $rail_freight = RailFreight::create($request->all());
        $rail_freight->railline_or_agent()->sync(array_filter((array)$request->input('railline_or_agent')));

        foreach ($request->input('load_descriptions', []) as $data) {
            $rail_freight->load_descriptions()->create($data);
        }


        return redirect()->route('admin.rail_freights.index');
    }


    /**
     * Show the form for editing RailFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('rail_freight_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $railline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $railline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        $rail_freight = RailFreight::findOrFail($id);

        return view('admin.rail_freights.edit', compact('rail_freight', 'project_numbers', 'clients', 'contact_people', 'railline_or_agents', 'railline_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Update RailFreight in storage.
     *
     * @param  \App\Http\Requests\UpdateRailFreightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRailFreightsRequest $request, $id)
    {
        if (! Gate::allows('rail_freight_edit')) {
            return abort(401);
        }
        $rail_freight = RailFreight::findOrFail($id);
        $rail_freight->update($request->all());
        $rail_freight->railline_or_agent()->sync(array_filter((array)$request->input('railline_or_agent')));

        $loadDescriptions           = $rail_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $rail_freight->load_descriptions()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadDescriptionData[$id] = $data;
            }
        }
        foreach ($loadDescriptions as $item) {
            if (isset($currentLoadDescriptionData[$item->id])) {
                $item->update($currentLoadDescriptionData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.rail_freights.index');
    }


    /**
     * Display RailFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('rail_freight_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $railline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $railline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');$load_descriptions = \App\LoadDescription::where('rail_freight_number_id', $id)->get();

        $rail_freight = RailFreight::findOrFail($id);

        return view('admin.rail_freights.show', compact('rail_freight', 'load_descriptions'));
    }


    /**
     * Remove RailFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('rail_freight_delete')) {
            return abort(401);
        }
        $rail_freight = RailFreight::findOrFail($id);
        $rail_freight->delete();

        return redirect()->route('admin.rail_freights.index');
    }

    /**
     * Delete all selected RailFreight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('rail_freight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RailFreight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RailFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('rail_freight_delete')) {
            return abort(401);
        }
        $rail_freight = RailFreight::onlyTrashed()->findOrFail($id);
        $rail_freight->restore();

        return redirect()->route('admin.rail_freights.index');
    }

    /**
     * Permanently delete RailFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('rail_freight_delete')) {
            return abort(401);
        }
        $rail_freight = RailFreight::onlyTrashed()->findOrFail($id);
        $rail_freight->forceDelete();

        return redirect()->route('admin.rail_freights.index');
    }

    public function download($rail_freight_id)
    {
        $rail_freight = RailFreight::findOrFail($rail_freight_id);
        $pdf = \PDF::loadView('admin.rail_freight.pdf', compact('rail_freight'));
        return $pdf->stream('rail_freight.pdf');
    }
}
