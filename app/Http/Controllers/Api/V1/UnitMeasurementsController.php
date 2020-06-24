<?php

namespace App\Http\Controllers\Api\V1;

use App\UnitMeasurement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUnitMeasurementsRequest;
use App\Http\Requests\Admin\UpdateUnitMeasurementsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UnitMeasurementsController extends Controller
{
    public function index()
    {
        return UnitMeasurement::all();
    }

    public function show($id)
    {
        return UnitMeasurement::findOrFail($id);
    }

    public function update(UpdateUnitMeasurementsRequest $request, $id)
    {
        $unit_measurement = UnitMeasurement::findOrFail($id);
        $unit_measurement->update($request->all());
        

        return $unit_measurement;
    }

    public function store(StoreUnitMeasurementsRequest $request)
    {
        $unit_measurement = UnitMeasurement::create($request->all());
        

        return $unit_measurement;
    }

    public function destroy($id)
    {
        $unit_measurement = UnitMeasurement::findOrFail($id);
        $unit_measurement->delete();
        return '';
    }
}
