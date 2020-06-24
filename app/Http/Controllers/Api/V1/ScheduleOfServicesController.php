<?php

namespace App\Http\Controllers\Api\V1;

use App\ScheduleOfService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScheduleOfServicesRequest;
use App\Http\Requests\Admin\UpdateScheduleOfServicesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ScheduleOfServicesController extends Controller
{
    public function index()
    {
        return ScheduleOfService::all();
    }

    public function show($id)
    {
        return ScheduleOfService::findOrFail($id);
    }

    public function update(UpdateScheduleOfServicesRequest $request, $id)
    {
        $schedule_of_service = ScheduleOfService::findOrFail($id);
        $schedule_of_service->update($request->all());
        

        return $schedule_of_service;
    }

    public function store(StoreScheduleOfServicesRequest $request)
    {
        $schedule_of_service = ScheduleOfService::create($request->all());
        

        return $schedule_of_service;
    }

    public function destroy($id)
    {
        $schedule_of_service = ScheduleOfService::findOrFail($id);
        $schedule_of_service->delete();
        return '';
    }
}
