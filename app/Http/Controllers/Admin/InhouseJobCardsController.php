<?php

namespace App\Http\Controllers\Admin;

use App\InhouseJobCard;
use App\Workshop;
use App\Part; 
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInhouseJobCardsRequest;
use App\Http\Requests\Admin\UpdateInhouseJobCardsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InhouseJobCardsController extends Controller
{
    /**
     * Display a listing of InhouseJobCard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('inhouse_job_card_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('inhouse_job_card_delete')) {
                return abort(401);
            }
            $inhouse_job_cards = InhouseJobCard::onlyTrashed()->get();
        } else {
            $inhouse_job_cards = InhouseJobCard::all();
        }

        return view('admin.inhouse_job_cards.index', compact('inhouse_job_cards'));
    }

    /**
     * Show the form for creating new InhouseJobCard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('inhouse_job_card_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $workshop_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id')->prepend(trans('global.app_please_select'), '');
        $light_vehicles = \App\LightVehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $client_vehicle_reg_nos = \App\VehicleSc::get()->pluck('registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = InhouseJobCard::$enum_vehicle_type;
        $enum_client_type = InhouseJobCard::$enum_client_type;
        $enum_job_card_type = InhouseJobCard::$enum_job_card_type;
        $enum_job_type = InhouseJobCard::$enum_job_type;
        $enum_status = InhouseJobCard::$enum_status;

        $workshops = Workshop::all();
        $parts = Part::all();
        $unit = UnitMeasurement::all();

        $job_card = InhouseJobCard::all();
        $job_card_id = $job_card->pluck('id')->last();
        $job_card_number = 'JCN-'.($job_card_id + 1000);
            
        return view('admin.inhouse_job_cards.create', compact('unit', 'workshop_managers', 'workshops', 'parts', 'job_card_number', 'enum_status', 'enum_vehicle_type', 'enum_client_type', 'enum_job_card_type', 'enum_job_type', 'project_numbers', 'repair_centers', 'technicians', 'vehicles', 'trailers', 'light_vehicles', 'client_vehicle_reg_nos', 'road_freight_numbers'));
    }

    /**
     * Store a newly created InhouseJobCard in storage.
     *
     * @param  \App\Http\Requests\StoreInhouseJobCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInhouseJobCardsRequest $request)
    {
        if (! Gate::allows('inhouse_job_card_create')) {
            return abort(401);
        }
        $inhouse_job_card = InhouseJobCard::create($request->all());
        $inhouse_job_card->technician()->sync(array_filter((array)$request->input('technician')));

        for ($i=0; $i < count($request->workshop); $i++) {
            if (isset($request->part[$i]) && isset($request->qty[$i]) && isset($request->unit[$i]) && isset($request->price[$i])) {
                $inhouse_job_card->job_card_items()->create([
                    'job_card_number_id' => $inhouse_job_card->id,
                    'workshop' => $request->workshop[$i],
                    'part' => $request->part[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'price' => $request->price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.inhouse_job_cards.index');
    }


    /**
     * Show the form for editing InhouseJobCard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('inhouse_job_card_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $workshop_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id')->prepend(trans('global.app_please_select'), '');
        $light_vehicles = \App\LightVehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $client_vehicle_reg_nos = \App\VehicleSc::get()->pluck('registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = InhouseJobCard::$enum_vehicle_type;
        $enum_client_type = InhouseJobCard::$enum_client_type;
        $enum_job_card_type = InhouseJobCard::$enum_job_card_type;
        $enum_job_type = InhouseJobCard::$enum_job_type;
        $enum_status = InhouseJobCard::$enum_status;

        $workshops = Workshop::all();
        $parts = Part::all();
            
        $inhouse_job_card = InhouseJobCard::findOrFail($id);

        return view('admin.inhouse_job_cards.edit', compact('workshop_managers', 'enum_status', 'workshops', 'parts', 'inhouse_job_card', 'enum_vehicle_type', 'enum_client_type', 'enum_job_card_type', 'enum_job_type', 'project_numbers', 'repair_centers', 'technicians', 'vehicles', 'trailers', 'light_vehicles', 'client_vehicle_reg_nos', 'road_freight_numbers'));
    }

    /**
     * Update InhouseJobCard in storage.
     *
     * @param  \App\Http\Requests\UpdateInhouseJobCardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInhouseJobCardsRequest $request, $id)
    {
        if (! Gate::allows('inhouse_job_card_edit')) {
            return abort(401);
        }
        $inhouse_job_card = InhouseJobCard::findOrFail($id);
        $inhouse_job_card->update($request->all());
        $inhouse_job_card->technician()->sync(array_filter((array)$request->input('technician')));

        $jobCardItems           = $inhouse_job_card->job_card_items;
        $currentJobCardItemData = [];
        foreach ($request->input('job_card_items', []) as $index => $data) {
            if (is_integer($index)) {
                $inhouse_job_card->job_card_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentJobCardItemData[$id] = $data;
            }
        }
        foreach ($jobCardItems as $item) {
            if (isset($currentJobCardItemData[$item->id])) {
                $item->update($currentJobCardItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.inhouse_job_cards.index');
    }


    /**
     * Display InhouseJobCard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('inhouse_job_card_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $trailers = \App\Trailer::get()->pluck('trailer_description', 'id')->prepend(trans('global.app_please_select'), '');
        $light_vehicles = \App\LightVehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $client_vehicle_reg_nos = \App\VehicleSc::get()->pluck('registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');$job_card_items = \App\JobCardItem::where('job_card_items_id', $id)->get();$schedule_of_services = \App\ScheduleOfService::where('job_card_number_id', $id)->get();

        $inhouse_job_card = InhouseJobCard::findOrFail($id);

        return view('admin.inhouse_job_cards.show', compact('inhouse_job_card', 'job_card_items', 'schedule_of_services'));
    }


    /**
     * Remove InhouseJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('inhouse_job_card_delete')) {
            return abort(401);
        }
        $inhouse_job_card = InhouseJobCard::findOrFail($id);
        $inhouse_job_card->delete();

        return redirect()->route('admin.inhouse_job_cards.index');
    }

    /**
     * Delete all selected InhouseJobCard at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('inhouse_job_card_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = InhouseJobCard::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore InhouseJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('inhouse_job_card_delete')) {
            return abort(401);
        }
        $inhouse_job_card = InhouseJobCard::onlyTrashed()->findOrFail($id);
        $inhouse_job_card->restore();

        return redirect()->route('admin.inhouse_job_cards.index');
    }

    /**
     * Permanently delete InhouseJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('inhouse_job_card_delete')) {
            return abort(401);
        }
        $inhouse_job_card = InhouseJobCard::onlyTrashed()->findOrFail($id);
        $inhouse_job_card->forceDelete();

        return redirect()->route('admin.inhouse_job_cards.index');
    }

    public function download($inhouse_job_card_id)
    {
        $inhouse_job_card = InhouseJobCard::findOrFail($inhouse_job_card_id);
        $pdf = \PDF::loadView('admin.inhouse_job_cards.pdf', compact('inhouse_job_card'));
        return $pdf->stream('job_card.pdf');
    }
}
