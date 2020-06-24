<?php

namespace App\Http\Controllers\Api\V1;

use App\ReceivedItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReceivedItemsRequest;
use App\Http\Requests\Admin\UpdateReceivedItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReceivedItemsController extends Controller
{
    public function index()
    {
        return ReceivedItem::all();
    }

    public function show($id)
    {
        return ReceivedItem::findOrFail($id);
    }

    public function update(UpdateReceivedItemsRequest $request, $id)
    {
        $received_item = ReceivedItem::findOrFail($id);
        $received_item->update($request->all());
        

        return $received_item;
    }

    public function store(StoreReceivedItemsRequest $request)
    {
        $received_item = ReceivedItem::create($request->all());
        

        return $received_item;
    }

    public function destroy($id)
    {
        $received_item = ReceivedItem::findOrFail($id);
        $received_item->delete();
        return '';
    }
}
