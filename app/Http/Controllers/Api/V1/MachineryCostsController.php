<?php

namespace App\Http\Controllers\Api\V1;

use App\MachineryCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachineryCostsRequest;
use App\Http\Requests\Admin\UpdateMachineryCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachineryCostsController extends Controller
{
    public function index()
    {
        return MachineryCost::all();
    }

    public function show($id)
    {
        return MachineryCost::findOrFail($id);
    }

    public function update(UpdateMachineryCostsRequest $request, $id)
    {
        $machinery_cost = MachineryCost::findOrFail($id);
        $machinery_cost->update($request->all());
        

        return $machinery_cost;
    }

    public function store(StoreMachineryCostsRequest $request)
    {
        $machinery_cost = MachineryCost::create($request->all());
        

        return $machinery_cost;
    }

    public function destroy($id)
    {
        $machinery_cost = MachineryCost::findOrFail($id);
        $machinery_cost->delete();
        return '';
    }
}
