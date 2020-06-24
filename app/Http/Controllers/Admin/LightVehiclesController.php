<?php

namespace App\Http\Controllers\Admin;

use App\LightVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLightVehiclesRequest;
use App\Http\Requests\Admin\UpdateLightVehiclesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LightVehiclesController extends Controller
{
    /**
     * Display a listing of LightVehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('light_vehicle_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('light_vehicle_delete')) {
                return abort(401);
            }
            $light_vehicles = LightVehicle::onlyTrashed()->get();
        } else {
            $light_vehicles = LightVehicle::all();
        }

        return view('admin.light_vehicles.index', compact('light_vehicles'));
    }

    /**
     * Show the form for creating new LightVehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('light_vehicle_create')) {
            return abort(401);
        }
        
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = LightVehicle::$enum_vehicle_type;
                    $enum_service_status = LightVehicle::$enum_service_status;
                    $enum_availability = LightVehicle::$enum_availability;
            
        return view('admin.light_vehicles.create', compact('enum_vehicle_type', 'enum_service_status', 'enum_availability', 'sizes'));
    }

    /**
     * Store a newly created LightVehicle in storage.
     *
     * @param  \App\Http\Requests\StoreLightVehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLightVehiclesRequest $request)
    {
        if (! Gate::allows('light_vehicle_create')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::create($request->all());



        return redirect()->route('admin.light_vehicles.index');
    }


    /**
     * Show the form for editing LightVehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('light_vehicle_edit')) {
            return abort(401);
        }
        
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = LightVehicle::$enum_vehicle_type;
                    $enum_service_status = LightVehicle::$enum_service_status;
                    $enum_availability = LightVehicle::$enum_availability;
            
        $light_vehicle = LightVehicle::findOrFail($id);

        return view('admin.light_vehicles.edit', compact('light_vehicle', 'enum_vehicle_type', 'enum_service_status', 'enum_availability', 'sizes'));
    }

    /**
     * Update LightVehicle in storage.
     *
     * @param  \App\Http\Requests\UpdateLightVehiclesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLightVehiclesRequest $request, $id)
    {
        if (! Gate::allows('light_vehicle_edit')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::findOrFail($id);
        $light_vehicle->update($request->all());



        return redirect()->route('admin.light_vehicles.index');
    }


    /**
     * Display LightVehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('light_vehicle_view')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::findOrFail($id);

        return view('admin.light_vehicles.show', compact('light_vehicle'));
    }


    /**
     * Remove LightVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('light_vehicle_delete')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::findOrFail($id);
        $light_vehicle->delete();

        return redirect()->route('admin.light_vehicles.index');
    }

    /**
     * Delete all selected LightVehicle at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('light_vehicle_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = LightVehicle::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore LightVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('light_vehicle_delete')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::onlyTrashed()->findOrFail($id);
        $light_vehicle->restore();

        return redirect()->route('admin.light_vehicles.index');
    }

    /**
     * Permanently delete LightVehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('light_vehicle_delete')) {
            return abort(401);
        }
        $light_vehicle = LightVehicle::onlyTrashed()->findOrFail($id);
        $light_vehicle->forceDelete();

        return redirect()->route('admin.light_vehicles.index');
    }
}
