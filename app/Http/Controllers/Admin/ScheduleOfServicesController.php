<?php

namespace App\Http\Controllers\Admin;

use App\ScheduleOfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScheduleOfServicesRequest;
use App\Http\Requests\Admin\UpdateScheduleOfServicesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ScheduleOfServicesController extends Controller
{
    /**
     * Display a listing of ScheduleOfService.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('schedule_of_service_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('schedule_of_service_delete')) {
                return abort(401);
            }
            $schedule_of_services = ScheduleOfService::onlyTrashed()->get();
        } else {
            $schedule_of_services = ScheduleOfService::all();
        }

        return view('admin.schedule_of_services.index', compact('schedule_of_services'));
    }

    /**
     * Show the form for creating new ScheduleOfService.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('schedule_of_service_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $job_card_numbers = \App\InhouseJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $client_vehicles = \App\ClientVehicle::get()->pluck('registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_client_type = ScheduleOfService::$enum_client_type;
        $enum_status = ScheduleOfService::$enum_status;

        $schedule_of_service = ScheduleOfService::all();
        $schedule_of_service_id = $schedule_of_service->pluck('id')->last();
        $schedule_number = 'SOSN-'.($schedule_of_service_id + 1000);
            
        return view('admin.schedule_of_services.create', compact('schedule_number', 'enum_client_type', 'enum_status', 'clients', 'job_card_numbers', 'vehicles', 'client_vehicles'));
    }

    /**
     * Store a newly created ScheduleOfService in storage.
     *
     * @param  \App\Http\Requests\StoreScheduleOfServicesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScheduleOfServicesRequest $request)
    {
        if (! Gate::allows('schedule_of_service_create')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::create($request->all());



        return redirect()->route('admin.schedule_of_services.index');
    }


    /**
     * Show the form for editing ScheduleOfService.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('schedule_of_service_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $job_card_numbers = \App\InhouseJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $client_vehicles = \App\ClientVehicle::get()->pluck('registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_client_type = ScheduleOfService::$enum_client_type;
                    $enum_status = ScheduleOfService::$enum_status;
            
        $schedule_of_service = ScheduleOfService::findOrFail($id);

        return view('admin.schedule_of_services.edit', compact('schedule_of_service', 'enum_client_type', 'enum_status', 'clients', 'job_card_numbers', 'vehicles', 'client_vehicles'));
    }

    /**
     * Update ScheduleOfService in storage.
     *
     * @param  \App\Http\Requests\UpdateScheduleOfServicesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScheduleOfServicesRequest $request, $id)
    {
        if (! Gate::allows('schedule_of_service_edit')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::findOrFail($id);
        $schedule_of_service->update($request->all());



        return redirect()->route('admin.schedule_of_services.index');
    }


    /**
     * Display ScheduleOfService.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('schedule_of_service_view')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::findOrFail($id);

        return view('admin.schedule_of_services.show', compact('schedule_of_service'));
    }


    /**
     * Remove ScheduleOfService from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('schedule_of_service_delete')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::findOrFail($id);
        $schedule_of_service->delete();

        return redirect()->route('admin.schedule_of_services.index');
    }

    /**
     * Delete all selected ScheduleOfService at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('schedule_of_service_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ScheduleOfService::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ScheduleOfService from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('schedule_of_service_delete')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::onlyTrashed()->findOrFail($id);
        $schedule_of_service->restore();

        return redirect()->route('admin.schedule_of_services.index');
    }

    /**
     * Permanently delete ScheduleOfService from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('schedule_of_service_delete')) {
            return abort(401);
        }
        $schedule_of_service = ScheduleOfService::onlyTrashed()->findOrFail($id);
        $schedule_of_service->forceDelete();

        return redirect()->route('admin.schedule_of_services.index');
    }
}
