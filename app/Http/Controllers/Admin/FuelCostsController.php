<?php

namespace App\Http\Controllers\Admin;

use App\FuelCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFuelCostsRequest;
use App\Http\Requests\Admin\UpdateFuelCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class FuelCostsController extends Controller
{
    /**
     * Display a listing of FuelCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('fuel_cost_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('fuel_cost_delete')) {
                return abort(401);
            }
            $fuel_costs = FuelCost::onlyTrashed()->get();
        } else {
            $fuel_costs = FuelCost::all();
        }

        return view('admin.fuel_costs.index', compact('fuel_costs'));
    }

    /**
     * Show the form for creating new FuelCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('fuel_cost_create')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');

        $receipt_number = FuelCost::all();
        $receipt_number_id = $receipt_number->pluck('id')->last();
        $receipt_number = 'FPN-'.($receipt_number_id + 1000);

        return view('admin.fuel_costs.create', compact('receipt_number', 'road_freight_numbers', 'vehicles'));
    }

    /**
     * Store a newly created FuelCost in storage.
     *
     * @param  \App\Http\Requests\StoreFuelCostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFuelCostsRequest $request)
    {
        if (! Gate::allows('fuel_cost_create')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::create($request->all());



        return redirect()->route('admin.fuel_costs.index');
    }


    /**
     * Show the form for editing FuelCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('fuel_cost_edit')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');

        $fuel_cost = FuelCost::findOrFail($id);

        $receipt_number = FuelCost::all();
        $receipt_number_id = $receipt_number->pluck('id')->last();
        $receipt_number = 'FPN-'.($receipt_number_id + 1000);

        return view('admin.fuel_costs.edit', compact('receipt_number', 'fuel_cost', 'road_freight_numbers', 'vehicles'));
    }

    /**
     * Update FuelCost in storage.
     *
     * @param  \App\Http\Requests\UpdateFuelCostsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuelCostsRequest $request, $id)
    {
        if (! Gate::allows('fuel_cost_edit')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::findOrFail($id);
        $fuel_cost->update($request->all());



        return redirect()->route('admin.fuel_costs.index');
    }


    /**
     * Display FuelCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('fuel_cost_view')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::findOrFail($id);

        return view('admin.fuel_costs.show', compact('fuel_cost'));
    }


    /**
     * Remove FuelCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('fuel_cost_delete')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::findOrFail($id);
        $fuel_cost->delete();

        return redirect()->route('admin.fuel_costs.index');
    }

    /**
     * Delete all selected FuelCost at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('fuel_cost_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = FuelCost::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore FuelCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('fuel_cost_delete')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::onlyTrashed()->findOrFail($id);
        $fuel_cost->restore();

        return redirect()->route('admin.fuel_costs.index');
    }

    /**
     * Permanently delete FuelCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('fuel_cost_delete')) {
            return abort(401);
        }
        $fuel_cost = FuelCost::onlyTrashed()->findOrFail($id);
        $fuel_cost->forceDelete();

        return redirect()->route('admin.fuel_costs.index');
    }
}
