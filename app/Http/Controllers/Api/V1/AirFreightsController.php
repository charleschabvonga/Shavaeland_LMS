<?php

namespace App\Http\Controllers\Api\V1;

use App\AirFreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreAirFreightsRequest;
use App\Http\Requests\Admin\UpdateAirFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class AirFreightsController extends Controller
{
    public function index()
    {
        return AirFreight::all();
    }

    public function show($id)
    {
        return AirFreight::findOrFail($id);
    }

    public function update(UpdateAirFreightsRequest $request, $id)
    {
        $air_freight = AirFreight::findOrFail($id);
        $air_freight->update($request->all());
        
        $loadDescriptions           = $air_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $air_freight->load_descriptions()->create($data);
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

        return $air_freight;
    }

    public function store(StoreAirFreightsRequest $request)
    {
        $air_freight = AirFreight::create($request->all());
        
        foreach ($request->input('load_descriptions', []) as $data) {
            $air_freight->load_descriptions()->create($data);
        }

        return $air_freight;
    }

    public function destroy($id)
    {
        $air_freight = AirFreight::findOrFail($id);
        $air_freight->delete();
        return '';
    }
}
