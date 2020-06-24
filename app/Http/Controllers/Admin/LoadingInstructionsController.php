<?php

namespace App\Http\Controllers\Admin;

use App\LoadingInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadingInstructionsRequest;
use App\Http\Requests\Admin\UpdateLoadingInstructionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadingInstructionsController extends Controller
{
    /**
     * Display a listing of LoadingInstruction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('loading_instruction_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('loading_instruction_delete')) {
                return abort(401);
            }
            $loading_instructions = LoadingInstruction::onlyTrashed()->get();
        } else {
            $loading_instructions = LoadingInstruction::all();
        }

        return view('admin.loading_instructions.index', compact('loading_instructions'));
    }

    /**
     * Show the form for creating new LoadingInstruction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('loading_instruction_create')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_vehicle_descriptions = \App\VehicleSc::get()->pluck('registration_number', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_freight_contract_type = LoadingInstruction::$enum_freight_contract_type;
        $enum_status = LoadingInstruction::$enum_status;

        $loading_instruction = LoadingInstruction::all();
        $loading_instruction_id = $loading_instruction->pluck('id')->last();
        $loading_instruction_number = 'LI-'.($loading_instruction_id + 1000);
            
        return view('admin.loading_instructions.create', compact('loading_instruction_number', 'enum_freight_contract_type', 'enum_status', 'road_freight_numbers', 'drivers', 'vehicles', 'trailers', 'vendors', 'vendor_drivers', 'vendor_vehicle_descriptions', 'clients', 'contact_people', 'project_managers'));
    }

    /**
     * Store a newly created LoadingInstruction in storage.
     *
     * @param  \App\Http\Requests\StoreLoadingInstructionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoadingInstructionsRequest $request)
    {
        if (! Gate::allows('loading_instruction_create')) {
            return abort(401);
        }
        $loading_instruction = LoadingInstruction::create($request->all());
        $loading_instruction->trailers()->sync(array_filter((array)$request->input('trailers')));
        $loading_instruction->vendor_vehicle_description()->sync(array_filter((array)$request->input('vendor_vehicle_description')));

        foreach ($request->input('loading_requirements', []) as $data) {
            $loading_instruction->loading_requirements()->create($data);
        }
        foreach ($request->input('load_descriptions', []) as $data) {
            $loading_instruction->load_descriptions()->create($data);
        }


        return redirect()->route('admin.loading_instructions.index');
    }


    /**
     * Show the form for editing LoadingInstruction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('loading_instruction_edit')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_vehicle_descriptions = \App\VehicleSc::get()->pluck('registration_number', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_freight_contract_type = LoadingInstruction::$enum_freight_contract_type;
        $enum_status = LoadingInstruction::$enum_status;

        $loading_instruction = LoadingInstruction::all();
        $loading_instruction_id = $loading_instruction->pluck('id')->last();
        $loading_instruction_number = 'LI-'.($loading_instruction_id + 1000);
            
        $loading_instruction = LoadingInstruction::findOrFail($id);

        return view('admin.loading_instructions.edit', compact('loading_instruction_number', 'loading_instruction', 'enum_freight_contract_type', 'enum_status', 'road_freight_numbers', 'drivers', 'vehicles', 'trailers', 'vendors', 'vendor_drivers', 'vendor_vehicle_descriptions', 'clients', 'contact_people', 'project_managers'));
    }

    /**
     * Update LoadingInstruction in storage.
     *
     * @param  \App\Http\Requests\UpdateLoadingInstructionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoadingInstructionsRequest $request, $id)
    {
        if (! Gate::allows('loading_instruction_edit')) {
            return abort(401);
        }
        $loading_instruction = LoadingInstruction::findOrFail($id);
        $loading_instruction->update($request->all());
        $loading_instruction->trailers()->sync(array_filter((array)$request->input('trailers')));
        $loading_instruction->vendor_vehicle_description()->sync(array_filter((array)$request->input('vendor_vehicle_description')));

        $loadingRequirements           = $loading_instruction->loading_requirements;
        $currentLoadingRequirementData = [];
        foreach ($request->input('loading_requirements', []) as $index => $data) {
            if (is_integer($index)) {
                $loading_instruction->loading_requirements()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadingRequirementData[$id] = $data;
            }
        }
        foreach ($loadingRequirements as $item) {
            if (isset($currentLoadingRequirementData[$item->id])) {
                $item->update($currentLoadingRequirementData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $loadDescriptions           = $loading_instruction->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $loading_instruction->load_descriptions()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadDescriptionData[$id] = $data;
            }
        }
        foreach ($loadDescriptions as $item) {
            if (isset($currentLoadDescriptionData[$item->id])) {
                $item->update($currentLoadDescriptionData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.loading_instructions.index');
    }


    /**
     * Display LoadingInstruction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('loading_instruction_view')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $drivers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id');

        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_drivers = \App\Driver::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_vehicle_descriptions = \App\VehicleSc::get()->pluck('registration_number', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$loading_requirements = \App\LoadingRequirement::where('loading_instruction_number_id', $id)->get();$load_descriptions = \App\LoadDescription::where('loading_instruction_number_id', $id)->get();

        $loading_instruction = LoadingInstruction::findOrFail($id);

        return view('admin.loading_instructions.show', compact('loading_instruction', 'loading_requirements', 'load_descriptions'));
    }


    /**
     * Remove LoadingInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('loading_instruction_delete')) {
            return abort(401);
        }
        $loading_instruction = LoadingInstruction::findOrFail($id);
        $loading_instruction->delete();

        return redirect()->route('admin.loading_instructions.index');
    }

    /**
     * Delete all selected LoadingInstruction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('loading_instruction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = LoadingInstruction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore LoadingInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('loading_instruction_delete')) {
            return abort(401);
        }
        $loading_instruction = LoadingInstruction::onlyTrashed()->findOrFail($id);
        $loading_instruction->restore();

        return redirect()->route('admin.loading_instructions.index');
    }

    /**
     * Permanently delete LoadingInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('loading_instruction_delete')) {
            return abort(401);
        }
        $loading_instruction = LoadingInstruction::onlyTrashed()->findOrFail($id);
        $loading_instruction->forceDelete();

        return redirect()->route('admin.loading_instructions.index');
    }

    public function download($loading_instruction_id)
    {
        $loading_instruction = LoadingInstruction::findOrFail($loading_instruction_id);
        $pdf = \PDF::loadView('admin.loading_instructions.pdf', compact('loading_instruction'));
        return $pdf->stream('loading_instruction.pdf');
    } 
}
