<?php

namespace App\Http\Controllers\Api\V1;

use App\InvoiceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvoiceItemsRequest;
use App\Http\Requests\Admin\UpdateInvoiceItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InvoiceItemsController extends Controller
{
    public function index()
    {
        return InvoiceItem::all();
    }

    public function show($id)
    {
        return InvoiceItem::findOrFail($id);
    }

    public function update(UpdateInvoiceItemsRequest $request, $id)
    {
        $invoice_item = InvoiceItem::findOrFail($id);
        $invoice_item->update($request->all());
        

        return $invoice_item;
    }

    public function store(StoreInvoiceItemsRequest $request)
    {
        $invoice_item = InvoiceItem::create($request->all());
        

        return $invoice_item;
    }

    public function destroy($id)
    {
        $invoice_item = InvoiceItem::findOrFail($id);
        $invoice_item->delete();
        return '';
    }
}
