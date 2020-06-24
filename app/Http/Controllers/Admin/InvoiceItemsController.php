<?php

namespace App\Http\Controllers\Admin;

use App\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInvoiceItemsRequest;
use App\Http\Requests\Admin\UpdateInvoiceItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InvoiceItemsController extends Controller
{
    /**
     * Display a listing of InvoiceItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('invoice_item_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('invoice_item_delete')) {
                return abort(401);
            }
            $invoice_items = InvoiceItem::onlyTrashed()->get();
        } else {
            $invoice_items = InvoiceItem::all();
        }

        return view('admin.invoice_items.index', compact('invoice_items'));
    }

    /**
     * Show the form for creating new InvoiceItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('invoice_item_create')) {
            return abort(401);
        }
        
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $bill_numbers = \App\ExpenseCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clearance_and_forwarding_numbers = \App\ClearanceAndForwarding::get()->pluck('clearance_and_forwarding_number', 'id')->prepend(trans('global.app_please_select'), '');
        $quotation_numbers = \App\Quotation::get()->pluck('quotation_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.invoice_items.create', compact('invoice_numbers', 'bill_numbers', 'credit_note_numbers', 'debit_note_numbers', 'clearance_and_forwarding_numbers', 'quotation_numbers'));
    }

    /**
     * Store a newly created InvoiceItem in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceItemsRequest $request)
    {
        if (! Gate::allows('invoice_item_create')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::create($request->all());



        return redirect()->route('admin.invoice_items.index');
    }


    /**
     * Show the form for editing InvoiceItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('invoice_item_edit')) {
            return abort(401);
        }
        
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $bill_numbers = \App\ExpenseCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clearance_and_forwarding_numbers = \App\ClearanceAndForwarding::get()->pluck('clearance_and_forwarding_number', 'id')->prepend(trans('global.app_please_select'), '');
        $quotation_numbers = \App\Quotation::get()->pluck('quotation_number', 'id')->prepend(trans('global.app_please_select'), '');

        $invoice_item = InvoiceItem::findOrFail($id);

        return view('admin.invoice_items.edit', compact('invoice_item', 'invoice_numbers', 'bill_numbers', 'credit_note_numbers', 'debit_note_numbers', 'clearance_and_forwarding_numbers', 'quotation_numbers'));
    }

    /**
     * Update InvoiceItem in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceItemsRequest $request, $id)
    {
        if (! Gate::allows('invoice_item_edit')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::findOrFail($id);
        $invoice_item->update($request->all());



        return redirect()->route('admin.invoice_items.index');
    }


    /**
     * Display InvoiceItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('invoice_item_view')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::findOrFail($id);

        return view('admin.invoice_items.show', compact('invoice_item'));
    }


    /**
     * Remove InvoiceItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('invoice_item_delete')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::findOrFail($id);
        $invoice_item->delete();

        return redirect()->route('admin.invoice_items.index');
    }

    /**
     * Delete all selected InvoiceItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('invoice_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = InvoiceItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore InvoiceItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('invoice_item_delete')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::onlyTrashed()->findOrFail($id);
        $invoice_item->restore();

        return redirect()->route('admin.invoice_items.index');
    }

    /**
     * Permanently delete InvoiceItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('invoice_item_delete')) {
            return abort(401);
        }
        $invoice_item = InvoiceItem::onlyTrashed()->findOrFail($id);
        $invoice_item->forceDelete();

        return redirect()->route('admin.invoice_items.index');
    }
}
