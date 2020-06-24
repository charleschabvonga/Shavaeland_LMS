<?php

namespace App\Http\Controllers\Api\V1;

use App\OvertimeAndBonusItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOvertimeAndBonusItemsRequest;
use App\Http\Requests\Admin\UpdateOvertimeAndBonusItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OvertimeAndBonusItemsController extends Controller
{
    public function index()
    {
        return OvertimeAndBonusItem::all();
    }

    public function show($id)
    {
        return OvertimeAndBonusItem::findOrFail($id);
    }

    public function update(UpdateOvertimeAndBonusItemsRequest $request, $id)
    {
        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);
        $overtime_and_bonus_item->update($request->all());
        

        return $overtime_and_bonus_item;
    }

    public function store(StoreOvertimeAndBonusItemsRequest $request)
    {
        $overtime_and_bonus_item = OvertimeAndBonusItem::create($request->all());
        

        return $overtime_and_bonus_item;
    }

    public function destroy($id)
    {
        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);
        $overtime_and_bonus_item->delete();
        return '';
    }
}
