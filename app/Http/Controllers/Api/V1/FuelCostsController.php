<?php

namespace App\Http\Controllers\Api\V1;

use App\FuelCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFuelCostsRequest;
use App\Http\Requests\Admin\UpdateFuelCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class FuelCostsController extends Controller
{
    public function index()
    {
        return FuelCost::all();
    }

    public function show($id)
    {
        return FuelCost::findOrFail($id);
    }

    public function update(UpdateFuelCostsRequest $request, $id)
    {
        $fuel_cost = FuelCost::findOrFail($id);
        $fuel_cost->update($request->all());
        

        return $fuel_cost;
    }

    public function store(StoreFuelCostsRequest $request)
    {
        $fuel_cost = FuelCost::create($request->all());
        

        return $fuel_cost;
    }

    public function destroy($id)
    {
        $fuel_cost = FuelCost::findOrFail($id);
        $fuel_cost->delete();
        return '';
    }
}
