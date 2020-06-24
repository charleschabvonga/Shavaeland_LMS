<?php

namespace App\Http\Controllers\Admin;

use App\MachineryCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachineryCostsRequest;
use App\Http\Requests\Admin\UpdateMachineryCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachineryCostsController extends Controller
{
    /**
     * Display a listing of MachineryCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('machinery_cost_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('machinery_cost_delete')) {
                return abort(401);
            }
            $machinery_costs = MachineryCost::onlyTrashed()->get();
        } else {
            $machinery_costs = MachineryCost::all();
        }

        return view('admin.machinery_costs.index', compact('machinery_costs'));
    }

    /**
     * Show the form for creating new MachineryCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('machinery_cost_create')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicle_descriptions = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');

        $truck_attachment_statuses = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');
        $machinery_attachment_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_load_status = MachineryCost::$enum_load_status;
        $enum_attachment_type = MachineryCost::$enum_attachment_type;

        $fuel_price = 15.08;
        $oil_price = 85.00;
        $tyre_price = 2500.00;
        $number_of_tyres = 10;
        $purchase_price = 300000.00;
        
        return view('admin.machinery_costs.create', compact('purchase_price', 'tyre_price', 'number_of_tyres', 'fuel_price', 'oil_price', 'enum_load_status', 'enum_attachment_type', 'road_freight_numbers', 'routes', 'vehicle_descriptions', 'truck_attachment_statuses', 'machinery_attachment_types', 'sizes'));
    }

    /**
     * Store a newly created MachineryCost in storage.
     *
     * @param  \App\Http\Requests\StoreMachineryCostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMachineryCostsRequest $request)
    {
        if (! Gate::allows('machinery_cost_create')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::create($request->all());
        //$machinery_cost->machinery()->sync(array_filter((array)$request->input('machinery')));



        return redirect()->route('admin.machinery_costs.index');
    }


    /**
     * Show the form for editing MachineryCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('machinery_cost_edit')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicle_descriptions = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');

        $truck_attachment_statuses = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');
        $machinery_attachment_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_load_status = MachineryCost::$enum_load_status;
        $enum_attachment_type = MachineryCost::$enum_attachment_type;
            
        $machinery_cost = MachineryCost::findOrFail($id);

        return view('admin.machinery_costs.edit', compact('machinery_cost', 'enum_load_status', 'enum_attachment_type', 'road_freight_numbers', 'routes', 'vehicle_descriptions', 'truck_attachment_statuses', 'machinery_attachment_types', 'sizes'));
    }

    /**
     * Update MachineryCost in storage.
     *
     * @param  \App\Http\Requests\UpdateMachineryCostsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMachineryCostsRequest $request, $id)
    {
        if (! Gate::allows('machinery_cost_edit')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::findOrFail($id);
        $machinery_cost->update($request->all());
        //$machinery_cost->machinery()->sync(array_filter((array)$request->input('machinery')));



        return redirect()->route('admin.machinery_costs.index');
    }


    /**
     * Display MachineryCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('machinery_cost_view')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::findOrFail($id);

        return view('admin.machinery_costs.show', compact('machinery_cost'));
    }


    /**
     * Remove MachineryCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('machinery_cost_delete')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::findOrFail($id);
        $machinery_cost->delete();

        return redirect()->route('admin.machinery_costs.index');
    }

    /**
     * Delete all selected MachineryCost at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('machinery_cost_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = MachineryCost::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore MachineryCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('machinery_cost_delete')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::onlyTrashed()->findOrFail($id);
        $machinery_cost->restore();

        return redirect()->route('admin.machinery_costs.index');
    }

    /**
     * Permanently delete MachineryCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('machinery_cost_delete')) {
            return abort(401);
        }
        $machinery_cost = MachineryCost::onlyTrashed()->findOrFail($id);
        $machinery_cost->forceDelete();

        return redirect()->route('admin.machinery_costs.index');
    }
}
