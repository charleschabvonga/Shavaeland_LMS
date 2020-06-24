<?php

namespace App\Http\Controllers\Api\V1;

use App\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpenseCategoriesRequest;
use App\Http\Requests\Admin\UpdateExpenseCategoriesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ExpenseCategoriesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return ExpenseCategory::all();
    }

    public function show($id)
    {
        return ExpenseCategory::findOrFail($id);
    }

    public function update(UpdateExpenseCategoriesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->update($request->all());
        
        $invoiceItems           = $expense_category->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $expense_category->invoice_items()->create($data);
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

        return $expense_category;
    }

    public function store(StoreExpenseCategoriesRequest $request)
    {
        $request = $this->saveFiles($request);
        $expense_category = ExpenseCategory::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $expense_category->invoice_items()->create($data);
        }

        return $expense_category;
    }

    public function destroy($id)
    {
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->delete();
        return '';
    }
}
