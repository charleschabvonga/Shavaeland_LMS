<?php

namespace App\Http\Controllers\Api\V1;

use App\ClientVehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientVehiclesRequest;
use App\Http\Requests\Admin\UpdateClientVehiclesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientVehiclesController extends Controller
{
    public function index()
    {
        return ClientVehicle::all();
    }

    public function show($id)
    {
        return ClientVehicle::findOrFail($id);
    }

    public function update(UpdateClientVehiclesRequest $request, $id)
    {
        $client_vehicle = ClientVehicle::findOrFail($id);
        $client_vehicle->update($request->all());
        

        return $client_vehicle;
    }

    public function store(StoreClientVehiclesRequest $request)
    {
        $client_vehicle = ClientVehicle::create($request->all());
        

        return $client_vehicle;
    }

    public function destroy($id)
    {
        $client_vehicle = ClientVehicle::findOrFail($id);
        $client_vehicle->delete();
        return '';
    }
}
