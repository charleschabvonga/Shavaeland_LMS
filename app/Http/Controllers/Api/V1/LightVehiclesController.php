<?php

namespace App\Http\Controllers\Api\V1;

use App\LightVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLightVehiclesRequest;
use App\Http\Requests\Admin\UpdateLightVehiclesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LightVehiclesController extends Controller
{
    public function index()
    {
        return LightVehicle::all();
    }

    public function show($id)
    {
        return LightVehicle::findOrFail($id);
    }

    public function update(UpdateLightVehiclesRequest $request, $id)
    {
        $light_vehicle = LightVehicle::findOrFail($id);
        $light_vehicle->update($request->all());
        

        return $light_vehicle;
    }

    public function store(StoreLightVehiclesRequest $request)
    {
        $light_vehicle = LightVehicle::create($request->all());
        

        return $light_vehicle;
    }

    public function destroy($id)
    {
        $light_vehicle = LightVehicle::findOrFail($id);
        $light_vehicle->delete();
        return '';
    }
}
