<?php

namespace App\Http\Controllers\Admin;

use App\RoadFreight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoadFreightsRequest;
use App\Http\Requests\Admin\UpdateRoadFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoadFreightsController extends Controller
{
    /**
     * Display a listing of RoadFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('road_freight_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('road_freight_delete')) {
                return abort(401);
            }
            $road_freights = RoadFreight::onlyTrashed()->get();
        } else {
            $road_freights = RoadFreight::all();
        }

        return view('admin.road_freights.index', compact('road_freights'));
    }

    /**
     * Show the form for creating new RoadFreight.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('road_freight_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id');

        $vendor_vehicles = \App\VehicleSc::get()->pluck('registration_number', 'id');

        $enum_freight_contract_type = RoadFreight::$enum_freight_contract_type;

        $road_freight = RoadFreight::all();
        $road_freight_id = $road_freight->pluck('id')->last();
        $road_freight_number = 'RFN-'.($road_freight_id + 1000);
            
        return view('admin.road_freights.create', compact('road_freight_number', 'enum_freight_contract_type', 'project_numbers', 'routes', 'clients', 'contact_people', 'project_managers', 'drivers', 'vehicles', 'trailers', 'subcontractor_numbers', 'vendors', 'vendor_contact_people', 'vendor_drivers', 'vendor_vehicles'));
    }

    /**
     * Store a newly created RoadFreight in storage.
     *
     * @param  \App\Http\Requests\StoreRoadFreightsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoadFreightsRequest $request)
    {
        if (! Gate::allows('road_freight_create')) {
            return abort(401);
        }
        $road_freight = RoadFreight::create($request->all());
        $road_freight->trailers()->sync(array_filter((array)$request->input('trailers')));
        $road_freight->vendor_drivers()->sync(array_filter((array)$request->input('vendor_drivers')));
        $road_freight->vendor_vehicles()->sync(array_filter((array)$request->input('vendor_vehicles')));

        foreach ($request->input('non_machine_costs', []) as $data) {
            $road_freight->non_machine_costs()->create($data);
        }


        return redirect()->route('admin.road_freights.index');
    }


    /**
     * Show the form for editing RoadFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('road_freight_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id');

        $vendor_vehicles = \App\VehicleSc::get()->pluck('registration_number', 'id');

        $enum_freight_contract_type = RoadFreight::$enum_freight_contract_type;
            
        $road_freight = RoadFreight::findOrFail($id);

        return view('admin.road_freights.edit', compact('road_freight', 'enum_freight_contract_type', 'project_numbers', 'routes', 'clients', 'contact_people', 'project_managers', 'drivers', 'vehicles', 'trailers', 'subcontractor_numbers', 'vendors', 'vendor_contact_people', 'vendor_drivers', 'vendor_vehicles'));
    }

    /**
     * Update RoadFreight in storage.
     *
     * @param  \App\Http\Requests\UpdateRoadFreightsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoadFreightsRequest $request, $id)
    {
        if (! Gate::allows('road_freight_edit')) {
            return abort(401);
        }
        $road_freight = RoadFreight::findOrFail($id);
        $road_freight->update($request->all());
        $road_freight->trailers()->sync(array_filter((array)$request->input('trailers')));
        $road_freight->vendor_drivers()->sync(array_filter((array)$request->input('vendor_drivers')));
        $road_freight->vendor_vehicles()->sync(array_filter((array)$request->input('vendor_vehicles')));

        $nonMachineCosts           = $road_freight->non_machine_costs;
        $currentNonMachineCostData = [];
        foreach ($request->input('non_machine_costs', []) as $index => $data) {
            if (is_integer($index)) {
                $road_freight->non_machine_costs()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentNonMachineCostData[$id] = $data;
            }
        }
        foreach ($nonMachineCosts as $item) {
            if (isset($currentNonMachineCostData[$item->id])) {
                $item->update($currentNonMachineCostData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.road_freights.index');
    }


    /**
     * Display RoadFreight.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('road_freight_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id');

        $vendor_vehicles = \App\VehicleSc::get()->pluck('registration_number', 'id');
$non_machine_costs = \App\NonMachineCost::where('road_freight_number_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('road_freight_number_id', $id)->get();$machinery_costs = \App\MachineryCost::where('road_freight_number_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('road_freight_number_id', $id)->get();$fuel_costs = \App\FuelCost::where('road_freight_number_id', $id)->get();$violations = \App\Violation::where('road_freight_number_id', $id)->get();$inhouse_job_cards = \App\InhouseJobCard::where('road_freight_number_id', $id)->get();

        $road_freight = RoadFreight::findOrFail($id);

        return view('admin.road_freights.show', compact('road_freight', 'non_machine_costs', 'delivery_instructions', 'machinery_costs', 'loading_instructions', 'fuel_costs', 'violations', 'inhouse_job_cards'));
    }


    /**
     * Remove RoadFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('road_freight_delete')) {
            return abort(401);
        }
        $road_freight = RoadFreight::findOrFail($id);
        $road_freight->delete();

        return redirect()->route('admin.road_freights.index');
    }

    /**
     * Delete all selected RoadFreight at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('road_freight_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RoadFreight::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RoadFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('road_freight_delete')) {
            return abort(401);
        }
        $road_freight = RoadFreight::onlyTrashed()->findOrFail($id);
        $road_freight->restore();

        return redirect()->route('admin.road_freights.index');
    }

    /**
     * Permanently delete RoadFreight from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('road_freight_delete')) {
            return abort(401);
        }
        $road_freight = RoadFreight::onlyTrashed()->findOrFail($id);
        $road_freight->forceDelete();

        return redirect()->route('admin.road_freights.index');
    }

    public function download($road_freight_id)
    {
        $road_freight = RoadFreight::findOrFail($road_freight_id);
        $pdf = \PDF::loadView('admin.road_freights.pdf', compact('road_freight'));
        return $pdf->stream('road_freight.pdf');
    }
}
