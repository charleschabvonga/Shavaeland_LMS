<?php

namespace App\Http\Controllers\Api\V1;

use App\SeaFreight;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSeaFreightsRequest;
use App\Http\Requests\Admin\UpdateSeaFreightsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SeaFreightsController extends Controller
{
    public function index()
    {
        return SeaFreight::all();
    }

    public function show($id)
    {
        return SeaFreight::findOrFail($id);
    }

    public function update(UpdateSeaFreightsRequest $request, $id)
    {
        $sea_freight = SeaFreight::findOrFail($id);
        $sea_freight->update($request->all());
        
        $loadDescriptions           = $sea_freight->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $sea_freight->load_descriptions()->create($data);
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

        return $sea_freight;
    }

    public function store(StoreSeaFreightsRequest $request)
    {
        $sea_freight = SeaFreight::create($request->all());
        
        foreach ($request->input('load_descriptions', []) as $data) {
            $sea_freight->load_descriptions()->create($data);
        }

        return $sea_freight;
    }

    public function destroy($id)
    {
        $sea_freight = SeaFreight::findOrFail($id);
        $sea_freight->delete();
        return '';
    }
}
