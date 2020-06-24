<?php

namespace App\Http\Controllers\Admin;

use App\ClientVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientVehiclesRequest;
use App\Http\Requests\Admin\UpdateClientVehiclesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientVehiclesController extends Controller
{
    /**
     * Display a listing of ClientVehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_vehicle_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_vehicle_delete')) {
                return abort(401);
            }
            $client_vehicles = ClientVehicle::onlyTrashed()->get();
        } else {
            $client_vehicles = ClientVehicle::all();
        }

        return view('admin.client_vehicles.index', compact('client_vehicles'));
    }

    /**
     * Show the form for creating new ClientVehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_vehicle_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = ClientVehicle::$enum_vehicle_type;
                    $enum_status = ClientVehicle::$enum_status;
            
        return view('admin.client_vehicles.create', compact('enum_vehicle_type', 'enum_status', 'clients'));
    }

    /**
     * Store a newly created ClientVehicle in storage.
     *
     * @param  \App\Http\Requests\StoreClientVehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientVehiclesRequest $request)
    {
        if (! Gate::allows('client_vehicle_create')) {
            return abort(401);
        }
        $client_vehicle = ClientVehicle::create($request->all());



        return redirect()->route('admin.client_vehicles.index');
    }


    /**
     * Show the form for editing ClientVehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_vehicle_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = ClientVehicle::$enum_vehicle_type;
                    $enum_status = ClientVehicle::$enum_status;
            
        $client_vehicle = ClientVehicle::findOrFail($id);

        return view('admin.client_vehicles.edit', compact('client_vehicle', 'enum_vehicle_type', 'enum_status', 'clients'));
    }

    /**
     * Update ClientVehicle in storage.
     *
     * @param  \App\Http\Requests\UpdateClientVehiclesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientVehiclesRequest $request, $id)
    {
        if (! Gate::allows('client_vehicle_edit')) {
            return abort(401);
        }
        $client_vehicle = ClientVehicle::findOrFail($id);
        $client_vehicle->update($request->all());



        return redirect()->route('admin.client_vehicles.index');
    }


    /**
     * Display ClientVehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_vehicle_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$schedule_of_services = \App\ScheduleOfService::where('client_vehicle_id', $id)->get();$job_cards = \App\JobCard::where('client_vehicle_reg_no_id', $id)->get();

        $client_vehicle = ClientVehicle::findOrFail($id);

        return view('admin.client_vehicles.show', compact('client_vehicle', 'schedule_of_services', 'job_cards'));
    }


    /**
     * Remove ClientVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_vehicle_delete')) {
            return abort(401);
        }
        $client_vehicle = ClientVehicle::findOrFail($id);
        $client_vehicle->delete();

        return redirect()->route('admin.client_vehicles.index');
    }

    /**
     * Delete all selected ClientVehicle at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_vehicle_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientVehicle::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ClientVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('client_vehicle_delete')) {
            return abort(401);
        }
        $client_vehicle = ClientVehicle::onlyTrashed()->findOrFail($id);
        $client_vehicle->restore();

        return redirect()->route('admin.client_vehicles.index');
    }

    /**
     * Permanently delete ClientVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('client_vehicle_delete')) {
            return abort(401);
        }
        $client_vehicle = ClientVehicle::onlyTrashed()->findOrFail($id);
        $client_vehicle->forceDelete();

        return redirect()->route('admin.client_vehicles.index');
    }
}
