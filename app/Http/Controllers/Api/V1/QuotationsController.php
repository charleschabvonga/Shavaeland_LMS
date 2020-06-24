<?php

namespace App\Http\Controllers\Api\V1;

use App\Quotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuotationsRequest;
use App\Http\Requests\Admin\UpdateQuotationsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class QuotationsController extends Controller
{
    public function index()
    {
        return Quotation::all();
    }

    public function show($id)
    {
        return Quotation::findOrFail($id);
    }

    public function update(UpdateQuotationsRequest $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->update($request->all());
        
        $invoiceItems           = $quotation->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $quotation->invoice_items()->create($data);
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

        return $quotation;
    }

    public function store(StoreQuotationsRequest $request)
    {
        $quotation = Quotation::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $quotation->invoice_items()->create($data);
        }

        return $quotation;
    }

    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
        return '';
    }
}
