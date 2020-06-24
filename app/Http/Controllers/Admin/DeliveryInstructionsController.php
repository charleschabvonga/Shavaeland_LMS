<?php

namespace App\Http\Controllers\Admin;

use App\DeliveryInstruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliveryInstructionsRequest;
use App\Http\Requests\Admin\UpdateDeliveryInstructionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DeliveryInstructionsController extends Controller
{
    /**
     * Display a listing of DeliveryInstruction.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('delivery_instruction_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('delivery_instruction_delete')) {
                return abort(401);
            }
            $delivery_instructions = DeliveryInstruction::onlyTrashed()->get();
        } else {
            $delivery_instructions = DeliveryInstruction::all();
        }

        return view('admin.delivery_instructions.index', compact('delivery_instructions'));
    }

    /**
     * Show the form for creating new DeliveryInstruction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('delivery_instruction_create')) {
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
        $enum_freight_contract_type = DeliveryInstruction::$enum_freight_contract_type;
        $enum_status = DeliveryInstruction::$enum_status;

        $delivery = DeliveryInstruction::all();
        $delivery_id = $delivery->pluck('id')->last();
        $delivery_instruction_number = 'DI-'.($delivery_id + 1000);
            
        return view('admin.delivery_instructions.create', compact('delivery_instruction_number', 'enum_freight_contract_type', 'enum_status', 'road_freight_numbers', 'drivers', 'vehicles', 'trailers', 'vendors', 'vendor_drivers', 'vendor_vehicle_descriptions', 'clients', 'contact_people', 'project_managers'));
    }

    /**
     * Store a newly created DeliveryInstruction in storage.
     *
     * @param  \App\Http\Requests\StoreDeliveryInstructionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryInstructionsRequest $request)
    {
        if (! Gate::allows('delivery_instruction_create')) {
            return abort(401);
        }
        $delivery_instruction = DeliveryInstruction::create($request->all());
        $delivery_instruction->trailers()->sync(array_filter((array)$request->input('trailers')));
        $delivery_instruction->vendor_vehicle_description()->sync(array_filter((array)$request->input('vendor_vehicle_description')));

        foreach ($request->input('load_descriptions', []) as $data) {
            $delivery_instruction->load_descriptions()->create($data);
        }


        return redirect()->route('admin.delivery_instructions.index');
    }


    /**
     * Show the form for editing DeliveryInstruction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('delivery_instruction_edit')) {
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
        $enum_freight_contract_type = DeliveryInstruction::$enum_freight_contract_type;
        $enum_status = DeliveryInstruction::$enum_status;

        $delivery = DeliveryInstruction::all();
        $delivery_id = $delivery->pluck('id')->last();
        $delivery_instruction_number = 'DI-'.($delivery_id + 1000);
            
        $delivery_instruction = DeliveryInstruction::findOrFail($id);

        return view('admin.delivery_instructions.edit', compact('delivery_instruction_number', 'delivery_instruction', 'enum_freight_contract_type', 'enum_status', 'road_freight_numbers', 'drivers', 'vehicles', 'trailers', 'vendors', 'vendor_drivers', 'vendor_vehicle_descriptions', 'clients', 'contact_people', 'project_managers'));
    }

    /**
     * Update DeliveryInstruction in storage.
     *
     * @param  \App\Http\Requests\UpdateDeliveryInstructionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryInstructionsRequest $request, $id)
    {
        if (! Gate::allows('delivery_instruction_edit')) {
            return abort(401);
        }
        $delivery_instruction = DeliveryInstruction::findOrFail($id);
        $delivery_instruction->update($request->all());
        $delivery_instruction->trailers()->sync(array_filter((array)$request->input('trailers')));
        $delivery_instruction->vendor_vehicle_description()->sync(array_filter((array)$request->input('vendor_vehicle_description')));

        $loadDescriptions           = $delivery_instruction->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $delivery_instruction->load_descriptions()->create($data);
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


        return redirect()->route('admin.delivery_instructions.index');
    }


    /**
     * Display DeliveryInstruction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('delivery_instruction_view')) {
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
        $project_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$load_descriptions = \App\LoadDescription::where('delivery_instruction_number_id', $id)->get();

        $delivery_instruction = DeliveryInstruction::findOrFail($id);

        return view('admin.delivery_instructions.show', compact('delivery_instruction', 'load_descriptions'));
    }


    /**
     * Remove DeliveryInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('delivery_instruction_delete')) {
            return abort(401);
        }
        $delivery_instruction = DeliveryInstruction::findOrFail($id);
        $delivery_instruction->delete();

        return redirect()->route('admin.delivery_instructions.index');
    }

    /**
     * Delete all selected DeliveryInstruction at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('delivery_instruction_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeliveryInstruction::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeliveryInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('delivery_instruction_delete')) {
            return abort(401);
        }
        $delivery_instruction = DeliveryInstruction::onlyTrashed()->findOrFail($id);
        $delivery_instruction->restore();

        return redirect()->route('admin.delivery_instructions.index');
    }

    /**
     * Permanently delete DeliveryInstruction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('delivery_instruction_delete')) {
            return abort(401);
        }
        $delivery_instruction = DeliveryInstruction::onlyTrashed()->findOrFail($id);
        $delivery_instruction->forceDelete();

        return redirect()->route('admin.delivery_instructions.index');
    }

    public function download($delivery_instruction_id)
    {
        $delivery_instruction = DeliveryInstruction::findOrFail($delivery_instruction_id);
        $pdf = \PDF::loadView('admin.delivery_instruction.pdf', compact('delivery_instruction'));
        return $pdf->stream('delivery_instruction.pdf');
    }
}
