<?php

namespace App\Http\Controllers\Admin;

use App\Part;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartsRequest;
use App\Http\Requests\Admin\UpdatePartsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PartsController extends Controller
{
    /**
     * Display a listing of Part.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('part_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('part_delete')) {
                return abort(401);
            }
            $parts = Part::onlyTrashed()->get();
        } else {
            $parts = Part::all();
        }

        return view('admin.parts.index', compact('parts'));
    }

    /**
     * Show the form for creating new Part.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('part_create')) {
            return abort(401);
        }
        
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $units = \App\UnitMeasurement::get()->pluck('measurement_type', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Part::$enum_status;
            
        return view('admin.parts.create', compact('enum_status', 'repair_centers', 'units'));
    }

    /**
     * Store a newly created Part in storage.
     *
     * @param  \App\Http\Requests\StorePartsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartsRequest $request)
    {
        if (! Gate::allows('part_create')) {
            return abort(401);
        }
        $part = Part::create($request->all());



        return redirect()->route('admin.parts.index');
    }


    /**
     * Show the form for editing Part.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('part_edit')) {
            return abort(401);
        }
        
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $units = \App\UnitMeasurement::get()->pluck('measurement_type', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Part::$enum_status;
            
        $part = Part::findOrFail($id);

        return view('admin.parts.edit', compact('part', 'enum_status', 'repair_centers', 'units'));
    }

    /**
     * Update Part in storage.
     *
     * @param  \App\Http\Requests\UpdatePartsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartsRequest $request, $id)
    {
        if (! Gate::allows('part_edit')) {
            return abort(401);
        }
        $part = Part::findOrFail($id);
        $part->update($request->all());



        return redirect()->route('admin.parts.index');
    }


    /**
     * Display Part.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('part_view')) {
            return abort(401);
        }
        
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $units = \App\UnitMeasurement::get()->pluck('measurement_type', 'id')->prepend(trans('global.app_please_select'), '');$parts_acquireds = \App\PartsAcquired::where('part_id', $id)->get();

        $part = Part::findOrFail($id);

        return view('admin.parts.show', compact('part', 'parts_acquireds'));
    }


    /**
     * Remove Part from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('part_delete')) {
            return abort(401);
        }
        $part = Part::findOrFail($id);
        $part->delete();

        return redirect()->route('admin.parts.index');
    }

    /**
     * Delete all selected Part at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('part_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Part::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Part from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('part_delete')) {
            return abort(401);
        }
        $part = Part::onlyTrashed()->findOrFail($id);
        $part->restore();

        return redirect()->route('admin.parts.index');
    }

    /**
     * Permanently delete Part from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('part_delete')) {
            return abort(401);
        }
        $part = Part::onlyTrashed()->findOrFail($id);
        $part->forceDelete();

        return redirect()->route('admin.parts.index');
    }
}
