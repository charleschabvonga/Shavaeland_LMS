<?php

namespace App\Http\Controllers\Admin;

use App\VehicleSc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVehicleScsRequest;
use App\Http\Requests\Admin\UpdateVehicleScsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VehicleScsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of VehicleSc.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vehicle_sc_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('vehicle_sc_delete')) {
                return abort(401);
            }
            $vehicle_scs = VehicleSc::onlyTrashed()->get();
        } else {
            $vehicle_scs = VehicleSc::all();
        }

        return view('admin.vehicle_scs.index', compact('vehicle_scs'));
    }

    /**
     * Show the form for creating new VehicleSc.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vehicle_sc_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = VehicleSc::$enum_vehicle_type;
        $enum_status = VehicleSc::$enum_status;
            
        return view('admin.vehicle_scs.create', compact('enum_vehicle_type', 'enum_status', 'vendors', 'subcontractor_numbers'));
    }

    /**
     * Store a newly created VehicleSc in storage.
     *
     * @param  \App\Http\Requests\StoreVehicleScsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleScsRequest $request)
    {
        if (! Gate::allows('vehicle_sc_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $vehicle_sc = VehicleSc::create($request->all());



        return redirect()->route('admin.vehicle_scs.index');
    }


    /**
     * Show the form for editing VehicleSc.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vehicle_sc_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = VehicleSc::$enum_vehicle_type;
        $enum_status = VehicleSc::$enum_status;
            
        $vehicle_sc = VehicleSc::findOrFail($id);

        return view('admin.vehicle_scs.edit', compact('vehicle_sc', 'enum_status', 'enum_vehicle_type', 'vendors', 'subcontractor_numbers'));
    }

    /**
     * Update VehicleSc in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicleScsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleScsRequest $request, $id)
    {
        if (! Gate::allows('vehicle_sc_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $vehicle_sc = VehicleSc::findOrFail($id);
        $vehicle_sc->update($request->all());



        return redirect()->route('admin.vehicle_scs.index');
    }


    /**
     * Display VehicleSc.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vehicle_sc_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $subcontractor_numbers = \App\RoadFreightSubContractor::get()->pluck('subcontractor_number', 'id')->prepend(trans('global.app_please_select'), '');$loading_instructions = \App\LoadingInstruction::whereHas('vendor_vehicle_description',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$delivery_instructions = \App\DeliveryInstruction::whereHas('vendor_vehicle_description',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$road_freights = \App\RoadFreight::whereHas('vendor_vehicles',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$inhouse_job_cards = \App\InhouseJobCard::where('client_vehicle_reg_no_id', $id)->get();

        $vehicle_sc = VehicleSc::findOrFail($id);

        return view('admin.vehicle_scs.show', compact('vehicle_sc', 'loading_instructions', 'delivery_instructions', 'road_freights', 'inhouse_job_cards'));
    }


    /**
     * Remove VehicleSc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vehicle_sc_delete')) {
            return abort(401);
        }
        $vehicle_sc = VehicleSc::findOrFail($id);
        $vehicle_sc->delete();

        return redirect()->route('admin.vehicle_scs.index');
    }

    /**
     * Delete all selected VehicleSc at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vehicle_sc_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = VehicleSc::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore VehicleSc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vehicle_sc_delete')) {
            return abort(401);
        }
        $vehicle_sc = VehicleSc::onlyTrashed()->findOrFail($id);
        $vehicle_sc->restore();

        return redirect()->route('admin.vehicle_scs.index');
    }

    /**
     * Permanently delete VehicleSc from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vehicle_sc_delete')) {
            return abort(401);
        }
        $vehicle_sc = VehicleSc::onlyTrashed()->findOrFail($id);
        $vehicle_sc->forceDelete();

        return redirect()->route('admin.vehicle_scs.index');
    }
}
