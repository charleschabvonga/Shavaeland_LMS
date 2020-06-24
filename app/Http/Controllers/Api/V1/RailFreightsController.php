<?php

namespace App\Http\Controllers\Api\V1;

use App\RailFreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRailFreightsRequest;
use App\Http\Requests\Admin\UpdateRailFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RailFreightsController extends Controller
{
    public function index()
    {
        return RailFreight::all();
    }

    public function show($id)
    {
        return RailFreight::findOrFail($id);
    }

    public function update(UpdateRailFreightsRequest $request, $id)
    {
        $rail_freight = RailFreight::findOrFail($id);
        $rail_freight->update($request->all());
        
        $loadDescriptions           = $rail_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $rail_freight->load_descriptions()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadDescriptionData[$id] = $data;
            }
        }
        foreach ($loadDescriptions as $item) {
            if (isset($currentLoadDescriptionData[$item->id])) {
                $item->update($currentLoadDescriptionData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $rail_freight;
    }

    public function store(StoreRailFreightsRequest $request)
    {
        $rail_freight = RailFreight::create($request->all());
        
        foreach ($request->input('load_descriptions', []) as $data) {
            $rail_freight->load_descriptions()->create($data);
        }

        return $rail_freight;
    }

    public function destroy($id)
    {
        $rail_freight = RailFreight::findOrFail($id);
        $rail_freight->delete();
        return '';
    }
}
