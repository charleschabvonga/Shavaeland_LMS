<?php

namespace App\Http\Controllers\Api\V1;

use App\Receiving;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReceivingsRequest;
use App\Http\Requests\Admin\UpdateReceivingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReceivingsController extends Controller
{
    public function index()
    {
        return Receiving::all();
    }

    public function show($id)
    {
        return Receiving::findOrFail($id);
    }

    public function update(UpdateReceivingsRequest $request, $id)
    {
        $receiving = Receiving::findOrFail($id);
        $receiving->update($request->all());
        
        $receivedItems           = $receiving->received_items;
        $currentReceivedItemData = [];
        foreach ($request->input('received_items', []) as $index => $data) {
            if (is_integer($index)) {
                $receiving->received_items()->create($data);
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

        return $receiving;
    }

    public function store(StoreReceivingsRequest $request)
    {
        $receiving = Receiving::create($request->all());
        
        foreach ($request->input('received_items', []) as $data) {
            $receiving->received_items()->create($data);
        }

        return $receiving;
    }

    public function destroy($id)
    {
        $receiving = Receiving::findOrFail($id);
        $receiving->delete();
        return '';
    }
}
