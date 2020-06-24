<?php

namespace App\Http\Controllers\Admin;

use App\RoadFreightSubContractor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoadFreightSubContractorsRequest;
use App\Http\Requests\Admin\UpdateRoadFreightSubContractorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoadFreightSubContractorsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of RoadFreightSubContractor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('road_freight_sub_contractor_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('road_freight_sub_contractor_delete')) {
                return abort(401);
            }
            $road_freight_sub_contractors = RoadFreightSubContractor::onlyTrashed()->get();
        } else {
            $road_freight_sub_contractors = RoadFreightSubContractor::all();
        }

        return view('admin.road_freight_sub_contractors.index', compact('road_freight_sub_contractors'));
    }

    /**
     * Show the form for creating new RoadFreightSubContractor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('road_freight_sub_contractor_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = RoadFreightSubContractor::$enum_status;
        $enum_git_status = RoadFreightSubContractor::$enum_git_status;

        $subcontractor = RoadFreightSubContractor::all();
        $subcontractor_id = $subcontractor->pluck('id')->last();
        $subcontractor_number = 'RSCN-'.($subcontractor_id + 1000);
            
        return view('admin.road_freight_sub_contractors.create', compact('subcontractor_number', 'enum_status', 'enum_git_status', 'vendors'));
    }

    /**
     * Store a newly created RoadFreightSubContractor in storage.
     *
     * @param  \App\Http\Requests\StoreRoadFreightSubContractorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoadFreightSubContractorsRequest $request)
    {
        if (! Gate::allows('road_freight_sub_contractor_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $road_freight_sub_contractor = RoadFreightSubContractor::create($request->all());



        return redirect()->route('admin.road_freight_sub_contractors.index');
    }


    /**
     * Show the form for editing RoadFreightSubContractor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('road_freight_sub_contractor_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = RoadFreightSubContractor::$enum_status;
                    $enum_git_status = RoadFreightSubContractor::$enum_git_status;
            
        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);

        return view('admin.road_freight_sub_contractors.edit', compact('road_freight_sub_contractor', 'enum_status', 'enum_git_status', 'vendors'));
    }

    /**
     * Update RoadFreightSubContractor in storage.
     *
     * @param  \App\Http\Requests\UpdateRoadFreightSubContractorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoadFreightSubContractorsRequest $request, $id)
    {
        if (! Gate::allows('road_freight_sub_contractor_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);
        $road_freight_sub_contractor->update($request->all());



        return redirect()->route('admin.road_freight_sub_contractors.index');
    }


    /**
     * Display RoadFreightSubContractor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('road_freight_sub_contractor_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$vehicle_scs = \App\VehicleSc::where('subcontractor_number_id', $id)->get();$drivers = \App\Driver::where('subcontractor_number_id', $id)->get();$road_freights = \App\RoadFreight::where('subcontractor_number_id', $id)->get();

        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);

        return view('admin.road_freight_sub_contractors.show', compact('road_freight_sub_contractor', 'vehicle_scs', 'drivers', 'road_freights'));
    }


    /**
     * Remove RoadFreightSubContractor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('road_freight_sub_contractor_delete')) {
            return abort(401);
        }
        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);
        $road_freight_sub_contractor->delete();

        return redirect()->route('admin.road_freight_sub_contractors.index');
    }

    /**
     * Delete all selected RoadFreightSubContractor at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('road_freight_sub_contractor_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = RoadFreightSubContractor::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore RoadFreightSubContractor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('road_freight_sub_contractor_delete')) {
            return abort(401);
        }
        $road_freight_sub_contractor = RoadFreightSubContractor::onlyTrashed()->findOrFail($id);
        $road_freight_sub_contractor->restore();

        return redirect()->route('admin.road_freight_sub_contractors.index');
    }

    /**
     * Permanently delete RoadFreightSubContractor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('road_freight_sub_contractor_delete')) {
            return abort(401);
        }
        $road_freight_sub_contractor = RoadFreightSubContractor::onlyTrashed()->findOrFail($id);
        $road_freight_sub_contractor->forceDelete();

        return redirect()->route('admin.road_freight_sub_contractors.index');
    }
}
