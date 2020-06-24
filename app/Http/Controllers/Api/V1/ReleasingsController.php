<?php

namespace App\Http\Controllers\Api\V1;

use App\Releasing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReleasingsRequest;
use App\Http\Requests\Admin\UpdateReleasingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReleasingsController extends Controller
{
    public function index()
    {
        return Releasing::all();
    }

    public function show($id)
    {
        return Releasing::findOrFail($id);
    }

    public function update(UpdateReleasingsRequest $request, $id)
    {
        $releasing = Releasing::findOrFail($id);
        $releasing->update($request->all());
        
        $receivedItems           = $releasing->received_items;
        $currentReceivedItemData = [];
        foreach ($request->input('received_items', []) as $index => $data) {
            if (is_integer($index)) {
                $releasing->received_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentReceivedItemData[$id] = $data;
            }
        }
        foreach ($receivedItems as $item) {
            if (isset($currentReceivedItemData[$item->id])) {
                $item->update($currentReceivedItemData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $releasing;
    }

    public function store(StoreReleasingsRequest $request)
    {
        $releasing = Releasing::create($request->all());
        
        foreach ($request->input('received_items', []) as $data) {
            $releasing->received_items()->create($data);
        }

        return $releasing;
    }

    public function destroy($id)
    {
        $releasing = Releasing::findOrFail($id);
        $releasing->delete();
        return '';
    }
}
