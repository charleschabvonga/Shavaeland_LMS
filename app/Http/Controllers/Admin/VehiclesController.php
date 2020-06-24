<?php

namespace App\Http\Controllers\Admin;

use App\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVehiclesRequest;
use App\Http\Requests\Admin\UpdateVehiclesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VehiclesController extends Controller
{
    /**
     * Display a listing of Vehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vehicle_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('vehicle_delete')) {
                return abort(401);
            }
            $vehicles = Vehicle::onlyTrashed()->get();
        } else {
            $vehicles = Vehicle::all();
        }

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating new Vehicle.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vehicle_create')) {
            return abort(401);
        }
        
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_service_status = Vehicle::$enum_service_status;
                    $enum_availability = Vehicle::$enum_availability;
            
        return view('admin.vehicles.create', compact('enum_service_status', 'enum_availability', 'sizes'));
    }

    /**
     * Store a newly created Vehicle in storage.
     *
     * @param  \App\Http\Requests\StoreVehiclesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehiclesRequest $request)
    {
        if (! Gate::allows('vehicle_create')) {
            return abort(401);
        }
        $vehicle = Vehicle::create($request->all());



        return redirect()->route('admin.vehicles.index');
    }


    /**
     * Show the form for editing Vehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vehicle_edit')) {
            return abort(401);
        }
        
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_service_status = Vehicle::$enum_service_status;
                    $enum_availability = Vehicle::$enum_availability;
            
        $vehicle = Vehicle::findOrFail($id);

        return view('admin.vehicles.edit', compact('vehicle', 'enum_service_status', 'enum_availability', 'sizes'));
    }

    /**
     * Update Vehicle in storage.
     *
     * @param  \App\Http\Requests\UpdateVehiclesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehiclesRequest $request, $id)
    {
        if (! Gate::allows('vehicle_edit')) {
            return abort(401);
        }
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());



        return redirect()->route('admin.vehicles.index');
    }


    /**
     * Display Vehicle.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vehicle_view')) {
            return abort(401);
        }
        
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');$violations = \App\Violation::where('vehicle_description_id', $id)->get();$fuel_costs = \App\FuelCost::where('vehicle_id', $id)->get();$schedule_of_services = \App\ScheduleOfService::where('vehicle_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('vehicle_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('vehicle_id', $id)->get();$income_expense_calculators = \App\IncomeExpenseCalculator::where('vehicles_id', $id)->get();$machinery_costs = \App\MachineryCost::where('vehicle_description_id', $id)->get();$road_freights = \App\RoadFreight::where('vehicle_id', $id)->get();$inhouse_job_cards = \App\InhouseJobCard::where('vehicle_id', $id)->get();

        $vehicle = Vehicle::findOrFail($id);

        return view('admin.vehicles.show', compact('vehicle', 'violations', 'fuel_costs', 'schedule_of_services', 'loading_instructions', 'delivery_instructions', 'income_expense_calculators', 'machinery_costs', 'road_freights', 'inhouse_job_cards'));
    }


    /**
     * Remove Vehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vehicle_delete')) {
            return abort(401);
        }
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Delete all selected Vehicle at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vehicle_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Vehicle::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Vehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vehicle_delete')) {
            return abort(401);
        }
        $vehicle = Vehicle::onlyTrashed()->findOrFail($id);
        $vehicle->restore();

        return redirect()->route('admin.vehicles.index');
    }

    /**
     * Permanently delete Vehicle from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vehicle_delete')) {
            return abort(401);
        }
        $vehicle = Vehicle::onlyTrashed()->findOrFail($id);
        $vehicle->forceDelete();

        return redirect()->route('admin.vehicles.index');
    }
}
