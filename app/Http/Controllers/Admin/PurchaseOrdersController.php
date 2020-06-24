<?php

namespace App\Http\Controllers\Admin;

use App\PurchaseOrder;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePurchaseOrdersRequest;
use App\Http\Requests\Admin\UpdatePurchaseOrdersRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PurchaseOrdersController extends Controller
{
    /**
     * Display a listing of PurchaseOrder.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('purchase_order_access')) {
            return abort(401);
        }


                $purchase_orders = PurchaseOrder::all();

        return view('admin.purchase_orders.index', compact('purchase_orders'));
    }

    /**
     * Show the form for creating new PurchaseOrder.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('purchase_order_create')) {
            return abort(401);
        }  
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $buyers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = PurchaseOrder::$enum_status;

        $unit = UnitMeasurement::all();

        $purchase_order = PurchaseOrder::all();
        $purchase_order_id = $purchase_order->pluck('id')->last();
        $purchase_order_number = 'PON-'.($purchase_order_id + 1000);
            
        return view('admin.purchase_orders.create', compact('unit', 'purchase_order_number', 'enum_status', 'vendors', 'contact_people', 'buyers'));
    }

    /**
     * Store a newly created PurchaseOrder in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseOrdersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseOrdersRequest $request)
    {
        if (! Gate::allows('purchase_order_create')) {
            return abort(401);
        }
        $purchase_order = PurchaseOrder::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit[$i]) && isset($request->unit_price[$i])) {
                $purchase_order->invoice_items()->create([
                    'invoice_number_id' => $purchase_order->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.purchase_orders.index');
    }


    /**
     * Show the form for editing PurchaseOrder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('purchase_order_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $buyers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = PurchaseOrder::$enum_status;
            
        $purchase_order = PurchaseOrder::findOrFail($id);

        return view('admin.purchase_orders.edit', compact('purchase_order', 'enum_status', 'vendors', 'contact_people', 'buyers'));
    }

    /**
     * Update PurchaseOrder in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseOrdersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseOrdersRequest $request, $id)
    {
        if (! Gate::allows('purchase_order_edit')) {
            return abort(401);
        }
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


        return redirect()->route('admin.purchase_orders.index');
    }


    /**
     * Display PurchaseOrder.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('purchase_order_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $buyers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('purchase_order_number_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('purchase_order_number_id', $id)->get();

        $purchase_order = PurchaseOrder::findOrFail($id);

        return view('admin.purchase_orders.show', compact('purchase_order', 'invoice_items', 'expense_categories'));
    }


    /**
     * Remove PurchaseOrder from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('purchase_order_delete')) {
            return abort(401);
        }
        $purchase_order = PurchaseOrder::findOrFail($id);
        $purchase_order->delete();

        return redirect()->route('admin.purchase_orders.index');
    }

    /**
     * Delete all selected PurchaseOrder at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('purchase_order_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PurchaseOrder::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($purchase_order_id)
    {
        $purchase_order = PurchaseOrder::findOrFail($purchase_order_id);
        $pdf = \PDF::loadView('admin.purchase_orders.pdf', compact('purchase_order'));
        return $pdf->stream('purchase_order.pdf');
    }

}
