<?php

namespace App\Http\Controllers\Admin;

use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUnitMeasurementsRequest;
use App\Http\Requests\Admin\UpdateUnitMeasurementsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UnitMeasurementsController extends Controller
{
    /**
     * Display a listing of UnitMeasurement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('unit_measurement_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('unit_measurement_delete')) {
                return abort(401);
            }
            $unit_measurements = UnitMeasurement::onlyTrashed()->get();
        } else {
            $unit_measurements = UnitMeasurement::all();
        }

        return view('admin.unit_measurements.index', compact('unit_measurements'));
    }

    /**
     * Show the form for creating new UnitMeasurement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('unit_measurement_create')) {
            return abort(401);
        }
        return view('admin.unit_measurements.create');
    }

    /**
     * Store a newly created UnitMeasurement in storage.
     *
     * @param  \App\Http\Requests\StoreUnitMeasurementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUnitMeasurementsRequest $request)
    {
        if (! Gate::allows('unit_measurement_create')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::create($request->all());



        return redirect()->route('admin.unit_measurements.index');
    }


    /**
     * Show the form for editing UnitMeasurement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('unit_measurement_edit')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::findOrFail($id);

        return view('admin.unit_measurements.edit', compact('unit_measurement'));
    }

    /**
     * Update UnitMeasurement in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitMeasurementsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUnitMeasurementsRequest $request, $id)
    {
        if (! Gate::allows('unit_measurement_edit')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::findOrFail($id);
        $unit_measurement->update($request->all());



        return redirect()->route('admin.unit_measurements.index');
    }


    /**
     * Display UnitMeasurement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('unit_measurement_view')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::findOrFail($id);

        return view('admin.unit_measurements.show', compact('unit_measurement'));
    }


    /**
     * Remove UnitMeasurement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('unit_measurement_delete')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::findOrFail($id);
        $unit_measurement->delete();

        return redirect()->route('admin.unit_measurements.index');
    }

    /**
     * Delete all selected UnitMeasurement at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('unit_measurement_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = UnitMeasurement::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore UnitMeasurement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('unit_measurement_delete')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::onlyTrashed()->findOrFail($id);
        $unit_measurement->restore();

        return redirect()->route('admin.unit_measurements.index');
    }

    /**
     * Permanently delete UnitMeasurement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('unit_measurement_delete')) {
            return abort(401);
        }
        $unit_measurement = UnitMeasurement::onlyTrashed()->findOrFail($id);
        $unit_measurement->forceDelete();

        return redirect()->route('admin.unit_measurements.index');
    }
}
