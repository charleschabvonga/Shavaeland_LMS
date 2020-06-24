<?php

namespace App\Http\Controllers\Admin;

use App\SeaFreight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSeaFreightsRequest;
use App\Http\Requests\Admin\UpdateSeaFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SeaFreightsController extends Controller
{
    /**
     * Display a listing of SeaFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('sea_freight_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('sea_freight_delete')) {
                return abort(401);
            }
            $sea_freights = SeaFreight::onlyTrashed()->get();
        } else {
            $sea_freights = SeaFreight::all();
        }

        return view('admin.sea_freights.index', compact('sea_freights'));
    }

    /**
     * Show the form for creating new SeaFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('sea_freight_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $shipper__or_agents = \App\Vendor::get()->pluck('name', 'id');

        $shipper_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.sea_freights.create', compact('project_numbers', 'clients', 'contact_people', 'shipper__or_agents', 'shipper_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Store a newly created SeaFreight in storage.
     *
     * @param  \App\Http\Requests\StoreSeaFreightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeaFreightsRequest $request)
    {
        if (! Gate::allows('sea_freight_create')) {
            return abort(401);
        }
        $sea_freight = SeaFreight::create($request->all());
        $sea_freight->shipper__or_agent()->sync(array_filter((array)$request->input('shipper__or_agent')));

        foreach ($request->input('load_descriptions', []) as $data) {
            $sea_freight->load_descriptions()->create($data);
        }


        return redirect()->route('admin.sea_freights.index');
    }


    /**
     * Show the form for editing SeaFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('sea_freight_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $shipper__or_agents = \App\Vendor::get()->pluck('name', 'id');

        $shipper_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        $sea_freight = SeaFreight::findOrFail($id);

        return view('admin.sea_freights.edit', compact('sea_freight', 'project_numbers', 'clients', 'contact_people', 'shipper__or_agents', 'shipper_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Update SeaFreight in storage.
     *
     * @param  \App\Http\Requests\UpdateSeaFreightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeaFreightsRequest $request, $id)
    {
        if (! Gate::allows('sea_freight_edit')) {
            return abort(401);
        }
        $sea_freight = SeaFreight::findOrFail($id);
        $sea_freight->update($request->all());
        $sea_freight->shipper__or_agent()->sync(array_filter((array)$request->input('shipper__or_agent')));

        $loadDescriptions           = $sea_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $sea_freight->load_descriptions()->create($data);
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


        return redirect()->route('admin.sea_freights.index');
    }


    /**
     * Display SeaFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('sea_freight_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $shipper__or_agents = \App\Vendor::get()->pluck('name', 'id');

        $shipper_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');$load_descriptions = \App\LoadDescription::where('sea_freight_number_id', $id)->get();

        $sea_freight = SeaFreight::findOrFail($id);

        return view('admin.sea_freights.show', compact('sea_freight', 'load_descriptions'));
    }


    /**
     * Remove SeaFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('sea_freight_delete')) {
            return abort(401);
        }
        $sea_freight = SeaFreight::findOrFail($id);
        $sea_freight->delete();

        return redirect()->route('admin.sea_freights.index');
    }

    /**
     * Delete all selected SeaFreight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('sea_freight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = SeaFreight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore SeaFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('sea_freight_delete')) {
            return abort(401);
        }
        $sea_freight = SeaFreight::onlyTrashed()->findOrFail($id);
        $sea_freight->restore();

        return redirect()->route('admin.sea_freights.index');
    }

    /**
     * Permanently delete SeaFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('sea_freight_delete')) {
            return abort(401);
        }
        $sea_freight = SeaFreight::onlyTrashed()->findOrFail($id);
        $sea_freight->forceDelete();

        return redirect()->route('admin.sea_freights.index');
    }

    public function download($sea_freight_id)
    {
        $sea_freight = SeaFreight::findOrFail($sea_freight_id);
        $pdf = \PDF::loadView('admin.sea_freight.pdf', compact('sea_freight'));
        return $pdf->stream('sea_freight.pdf');
    }
}
