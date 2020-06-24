<?php

namespace App\Http\Controllers\Api\V1;

use App\IncomeCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeCategoriesRequest;
use App\Http\Requests\Admin\UpdateIncomeCategoriesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomeCategoriesController extends Controller
{
    public function index()
    {
        return IncomeCategory::all();
    }

    public function show($id)
    {
        return IncomeCategory::findOrFail($id);
    }

    public function update(UpdateIncomeCategoriesRequest $request, $id)
    {
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->update($request->all());
        
        $invoiceItems           = $income_category->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $income_category->invoice_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentInvoiceItemData[$id] = $data;
            }
        }
        foreach ($invoiceItems as $item) {
            if (isset($currentInvoiceItemData[$item->id])) {
                $item->update($currentInvoiceItemData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $income_category;
    }

    public function store(StoreIncomeCategoriesRequest $request)
    {
        $income_category = IncomeCategory::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $income_category->invoice_items()->create($data);
        }

        return $income_category;
    }

    public function destroy($id)
    {
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->delete();
        return '';
    }
}
