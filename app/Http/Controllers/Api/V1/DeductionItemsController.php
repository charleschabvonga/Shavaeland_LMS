<?php

namespace App\Http\Controllers\Api\V1;

use App\DeductionItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeductionItemsRequest;
use App\Http\Requests\Admin\UpdateDeductionItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DeductionItemsController extends Controller
{
    public function index()
    {
        return DeductionItem::all();
    }

    public function show($id)
    {
        return DeductionItem::findOrFail($id);
    }

    public function update(UpdateDeductionItemsRequest $request, $id)
    {
        $deduction_item = DeductionItem::findOrFail($id);
        $deduction_item->update($request->all());
        

        return $deduction_item;
    }

    public function store(StoreDeductionItemsRequest $request)
    {
        $deduction_item = DeductionItem::create($request->all());
        

        return $deduction_item;
    }

    public function destroy($id)
    {
        $deduction_item = DeductionItem::findOrFail($id);
        $deduction_item->delete();
        return '';
    }
}
