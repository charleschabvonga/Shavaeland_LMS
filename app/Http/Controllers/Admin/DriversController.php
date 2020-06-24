<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDriversRequest;
use App\Http\Requests\Admin\UpdateDriversRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DriversController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('driver_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('driver_delete')) {
                return abort(401);
            }
            $drivers = Driver::onlyTrashed()->get();
        } else {
            $drivers = Driver::all();
        }

        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating new Driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('driver_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Driver::$enum_status;
            
        return view('admin.drivers.create', compact('enum_status', 'vendors', 'subcontractor_numbers'));
    }

    /**
     * Store a newly created Driver in storage.
     *
     * @param  \App\Http\Requests\StoreDriversRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDriversRequest $request)
    {
        if (! Gate::allows('driver_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $driver = Driver::create($request->all());



        return redirect()->route('admin.drivers.index');
    }


    /**
     * Show the form for editing Driver.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('driver_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Driver::$enum_status;
            
        $driver = Driver::findOrFail($id);

        return view('admin.drivers.edit', compact('driver', 'enum_status', 'vendors', 'subcontractor_numbers'));
    }

    /**
     * Update Driver in storage.
     *
     * @param  \App\Http\Requests\UpdateDriversRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriversRequest $request, $id)
    {
        if (! Gate::allows('driver_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());



        return redirect()->route('admin.drivers.index');
    }


    /**
     * Display Driver.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('driver_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');$loading_instructions = \App\LoadingInstruction::where('vendor_driver_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('vendor_driver_id', $id)->get();$road_freights = \App\RoadFreight::whereHas('vendor_drivers',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $driver = Driver::findOrFail($id);

        return view('admin.drivers.show', compact('driver', 'loading_instructions', 'delivery_instructions', 'road_freights'));
    }


    /**
     * Remove Driver from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('driver_delete')) {
            return abort(401);
        }
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return redirect()->route('admin.drivers.index');
    }

    /**
     * Delete all selected Driver at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('driver_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Driver::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Driver from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('driver_delete')) {
            return abort(401);
        }
        $driver = Driver::onlyTrashed()->findOrFail($id);
        $driver->restore();

        return redirect()->route('admin.drivers.index');
    }

    /**
     * Permanently delete Driver from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('driver_delete')) {
            return abort(401);
        }
        $driver = Driver::onlyTrashed()->findOrFail($id);
        $driver->forceDelete();

        return redirect()->route('admin.drivers.index');
    }
}
