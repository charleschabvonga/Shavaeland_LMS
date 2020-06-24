<?php

namespace App\Http\Controllers\Admin;

use App\Violation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreViolationsRequest;
use App\Http\Requests\Admin\UpdateViolationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ViolationsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Violation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('violation_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('violation_delete')) {
                return abort(401);
            }
            $violations = Violation::onlyTrashed()->get();
        } else {
            $violations = Violation::all();
        }

        return view('admin.violations.index', compact('violations'));
    }

    /**
     * Show the form for creating new Violation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('violation_create')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicle_descriptions = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id')->prepend(trans('global.app_please_select'), '');
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Violation::$enum_status;
            
        return view('admin.violations.create', compact('enum_status', 'employee_names', 'vehicle_descriptions', 'trailers', 'road_freight_numbers'));
    }

    /**
     * Store a newly created Violation in storage.
     *
     * @param  \App\Http\Requests\StoreViolationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreViolationsRequest $request)
    {
        if (! Gate::allows('violation_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $violation = Violation::create($request->all());



        return redirect()->route('admin.violations.index');
    }


    /**
     * Show the form for editing Violation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('violation_edit')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicle_descriptions = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id')->prepend(trans('global.app_please_select'), '');
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Violation::$enum_status;
            
        $violation = Violation::findOrFail($id);

        return view('admin.violations.edit', compact('violation', 'enum_status', 'employee_names', 'vehicle_descriptions', 'trailers', 'road_freight_numbers'));
    }

    /**
     * Update Violation in storage.
     *
     * @param  \App\Http\Requests\UpdateViolationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateViolationsRequest $request, $id)
    {
        if (! Gate::allows('violation_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $violation = Violation::findOrFail($id);
        $violation->update($request->all());



        return redirect()->route('admin.violations.index');
    }


    /**
     * Display Violation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('violation_view')) {
            return abort(401);
        }
        $violation = Violation::findOrFail($id);

        return view('admin.violations.show', compact('violation'));
    }


    /**
     * Remove Violation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('violation_delete')) {
            return abort(401);
        }
        $violation = Violation::findOrFail($id);
        $violation->delete();

        return redirect()->route('admin.violations.index');
    }

    /**
     * Delete all selected Violation at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('violation_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Violation::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Violation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('violation_delete')) {
            return abort(401);
        }
        $violation = Violation::onlyTrashed()->findOrFail($id);
        $violation->restore();

        return redirect()->route('admin.violations.index');
    }

    /**
     * Permanently delete Violation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('violation_delete')) {
            return abort(401);
        }
        $violation = Violation::onlyTrashed()->findOrFail($id);
        $violation->forceDelete();

        return redirect()->route('admin.violations.index');
    }
}
