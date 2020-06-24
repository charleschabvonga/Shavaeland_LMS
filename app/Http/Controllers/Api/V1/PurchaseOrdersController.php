<?php

namespace App\Http\Controllers\Api\V1;

use App\PurchaseOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePurchaseOrdersRequest;
use App\Http\Requests\Admin\UpdatePurchaseOrdersRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PurchaseOrdersController extends Controller
{
    public function index()
    {
        return PurchaseOrder::all();
    }

    public function show($id)
    {
        return PurchaseOrder::findOrFail($id);
    }

    public function update(UpdatePurchaseOrdersRequest $request, $id)
    {
        $purchase_order = PurchaseOrder::findOrFail($id);
        $purchase_order->update($request->all());
        
        $invoiceItems           = $purchase_order->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $purchase_order->invoice_items()->create($data);
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

        return $purchase_order;
    }

    public function store(StorePurchaseOrdersRequest $request)
    {
        $purchase_order = PurchaseOrder::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $purchase_order->invoice_items()->create($data);
        }

        return $purchase_order;
    }

    public function destroy($id)
    {
        $purchase_order = PurchaseOrder::findOrFail($id);
        $purchase_order->delete();
        return '';
    }
}
