<?php

namespace App\Http\Controllers\Api\V1;

use App\VehicleSc;
use Illuminate\Http\Request;
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

    public function index()
    {
        return VehicleSc::all();
    }

    public function show($id)
    {
        return VehicleSc::findOrFail($id);
    }

    public function update(UpdateVehicleScsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $vehicle_sc = VehicleSc::findOrFail($id);
        $vehicle_sc->update($request->all());
        

        return $vehicle_sc;
    }

    public function store(StoreVehicleScsRequest $request)
    {
        $request = $this->saveFiles($request);
        $vehicle_sc = VehicleSc::create($request->all());
        

        return $vehicle_sc;
    }

    public function destroy($id)
    {
        $vehicle_sc = VehicleSc::findOrFail($id);
        $vehicle_sc->delete();
        return '';
    }
}
