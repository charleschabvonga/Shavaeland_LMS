<?php

namespace App\Http\Controllers\Admin;

use App\AirFreight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAirFreightsRequest;
use App\Http\Requests\Admin\UpdateAirFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AirFreightsController extends Controller
{
    /**
     * Display a listing of AirFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('air_freight_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('air_freight_delete')) {
                return abort(401);
            }
            $air_freights = AirFreight::onlyTrashed()->get();
        } else {
            $air_freights = AirFreight::all();
        }

        return view('admin.air_freights.index', compact('air_freights'));
    }

    /**
     * Show the form for creating new AirFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('air_freight_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $airline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $airline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.air_freights.create', compact('project_numbers', 'clients', 'contact_people', 'airline_or_agents', 'airline_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Store a newly created AirFreight in storage.
     *
     * @param  \App\Http\Requests\StoreAirFreightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAirFreightsRequest $request)
    {
        if (! Gate::allows('air_freight_create')) {
            return abort(401);
        }
        $air_freight = AirFreight::create($request->all());
        $air_freight->airline_or_agent()->sync(array_filter((array)$request->input('airline_or_agent')));

        foreach ($request->input('load_descriptions', []) as $data) {
            $air_freight->load_descriptions()->create($data);
        }


        return redirect()->route('admin.air_freights.index');
    }


    /**
     * Show the form for editing AirFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('air_freight_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $airline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $airline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');

        $air_freight = AirFreight::findOrFail($id);

        return view('admin.air_freights.edit', compact('air_freight', 'project_numbers', 'clients', 'contact_people', 'airline_or_agents', 'airline_or_agent_contacts', 'project_managers', 'routes'));
    }

    /**
     * Update AirFreight in storage.
     *
     * @param  \App\Http\Requests\UpdateAirFreightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAirFreightsRequest $request, $id)
    {
        if (! Gate::allows('air_freight_edit')) {
            return abort(401);
        }
        $air_freight = AirFreight::findOrFail($id);
        $air_freight->update($request->all());
        $air_freight->airline_or_agent()->sync(array_filter((array)$request->input('airline_or_agent')));

        $loadDescriptions           = $air_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $air_freight->load_descriptions()->create($data);
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


        return redirect()->route('admin.air_freights.index');
    }


    /**
     * Display AirFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('air_freight_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $airline_or_agents = \App\Vendor::get()->pluck('name', 'id');

        $airline_or_agent_contacts = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');$load_descriptions = \App\LoadDescription::where('air_freight_number_id', $id)->get();

        $air_freight = AirFreight::findOrFail($id);

        return view('admin.air_freights.show', compact('air_freight', 'load_descriptions'));
    }


    /**
     * Remove AirFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('air_freight_delete')) {
            return abort(401);
        }
        $air_freight = AirFreight::findOrFail($id);
        $air_freight->delete();

        return redirect()->route('admin.air_freights.index');
    }

    /**
     * Delete all selected AirFreight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('air_freight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = AirFreight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore AirFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('air_freight_delete')) {
            return abort(401);
        }
        $air_freight = AirFreight::onlyTrashed()->findOrFail($id);
        $air_freight->restore();

        return redirect()->route('admin.air_freights.index');
    }

    /**
     * Permanently delete AirFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('air_freight_delete')) {
            return abort(401);
        }
        $air_freight = AirFreight::onlyTrashed()->findOrFail($id);
        $air_freight->forceDelete();

        return redirect()->route('admin.air_freights.index');
    }

    public function download($air_freight_id)
    {
        $air_freight = AirFreight::findOrFail($air_freight_id);
        $pdf = \PDF::loadView('admin.air_freight.pdf', compact('air_freight'));
        return $pdf->stream('air_freight.pdf');
    }
}
