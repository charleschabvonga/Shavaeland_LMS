<?php

namespace App\Http\Controllers\Api\V1;

use App\NonMachineCost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNonMachineCostsRequest;
use App\Http\Requests\Admin\UpdateNonMachineCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NonMachineCostsController extends Controller
{
    public function index()
    {
        return NonMachineCost::all();
    }

    public function show($id)
    {
        return NonMachineCost::findOrFail($id);
    }

    public function update(UpdateNonMachineCostsRequest $request, $id)
    {
        $non_machine_cost = NonMachineCost::findOrFail($id);
        $non_machine_cost->update($request->all());
        

        return $non_machine_cost;
    }

    public function store(StoreNonMachineCostsRequest $request)
    {
        $non_machine_cost = NonMachineCost::create($request->all());
        

        return $non_machine_cost;
    }

    public function destroy($id)
    {
        $non_machine_cost = NonMachineCost::findOrFail($id);
        $non_machine_cost->delete();
        return '';
    }
}
