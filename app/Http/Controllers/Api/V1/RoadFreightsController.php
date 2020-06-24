<?php

namespace App\Http\Controllers\Api\V1;

use App\RoadFreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoadFreightsRequest;
use App\Http\Requests\Admin\UpdateRoadFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoadFreightsController extends Controller
{
    public function index()
    {
        return RoadFreight::all();
    }

    public function show($id)
    {
        return RoadFreight::findOrFail($id);
    }

    public function update(UpdateRoadFreightsRequest $request, $id)
    {
        $road_freight = RoadFreight::findOrFail($id);
        $road_freight->update($request->all());
        
        $nonMachineCosts           = $road_freight->non_machine_costs;
        $currentNonMachineCostData = [];
        foreach ($request->input('non_machine_costs', []) as $index => $data) {
            if (is_integer($index)) {
                $road_freight->non_machine_costs()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentNonMachineCostData[$id] = $data;
            }
        }
        foreach ($nonMachineCosts as $item) {
            if (isset($currentNonMachineCostData[$item->id])) {
                $item->update($currentNonMachineCostData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $road_freight;
    }

    public function store(StoreRoadFreightsRequest $request)
    {
        $road_freight = RoadFreight::create($request->all());
        
        foreach ($request->input('non_machine_costs', []) as $data) {
            $road_freight->non_machine_costs()->create($data);
        }

        return $road_freight;
    }

    public function destroy($id)
    {
        $road_freight = RoadFreight::findOrFail($id);
        $road_freight->delete();
        return '';
    }
}
