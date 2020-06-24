<?php

namespace App\Http\Controllers\Admin;

use App\DebitNote;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDebitNotesRequest;
use App\Http\Requests\Admin\UpdateDebitNotesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DebitNotesController extends Controller
{
    /**
     * Display a listing of DebitNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('debit_note_access')) {
            return abort(401);
        }


                $debit_notes = DebitNote::all();

        return view('admin.debit_notes.index', compact('debit_notes'));
    }

    /**
     * Show the form for creating new DebitNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('debit_note_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_payment_numbers = \App\Expense::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_refund_type = DebitNote::$enum_refund_type;
        $enum_status = DebitNote::$enum_status;

        $unit = UnitMeasurement::all();

        $debit_note = DebitNote::all();
        $debit_note_id = $debit_note->pluck('id')->last();
        $debit_note_number = 'DNN-'.($debit_note_id + 1000);
            
        return view('admin.debit_notes.create', compact('unit', 'debit_note_number', 'enum_refund_type', 'enum_status', 'vendors', 'contact_people', 'account_managers', 'transaction_numbers', 'credit_note_numbers', 'withdrawal_transaction_numbers', 'credit_note_payment_numbers'));
    }

    /**
     * Store a newly created DebitNote in storage.
     *
     * @param  \App\Http\Requests\StoreDebitNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDebitNotesRequest $request)
    {
        if (! Gate::allows('debit_note_create')) {
            return abort(401);
        }
        $debit_note = DebitNote::create($request->all());

        foreach ($request->input('invoice_items', []) as $data) {
            $debit_note->invoice_items()->create($data);
        }

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit_price[$i])) {
                $debit_note->invoice_items()->create([
                    'invoice_number_id' => $debit_note->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.debit_notes.index');
    }


    /**
     * Show the form for editing DebitNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('debit_note_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_payment_numbers = \App\Expense::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_refund_type = DebitNote::$enum_refund_type;
        $enum_status = DebitNote::$enum_status;
            
        $debit_note = DebitNote::findOrFail($id);

        return view('admin.debit_notes.edit', compact('debit_note', 'enum_refund_type', 'enum_status', 'vendors', 'contact_people', 'account_managers', 'transaction_numbers', 'credit_note_numbers', 'withdrawal_transaction_numbers', 'credit_note_payment_numbers'));
    }

    /**
     * Update DebitNote in storage.
     *
     * @param  \App\Http\Requests\UpdateDebitNotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDebitNotesRequest $request, $id)
    {
        if (! Gate::allows('debit_note_edit')) {
            return abort(401);
        }
        $debit_note = DebitNote::findOrFail($id);
        $debit_note->update($request->all());

        $invoiceItems           = $debit_note->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $debit_note->invoice_items()->create($data);
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


        return redirect()->route('admin.debit_notes.index');
    }


    /**
     * Display DebitNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('debit_note_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_payment_numbers = \App\Expense::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('debit_note_number_id', $id)->get();$expenses = \App\Expense::where('debit_note_number_id', $id)->get();$incomes = \App\Income::where('debit_note_number_id', $id)->get();

        $debit_note = DebitNote::findOrFail($id);

        return view('admin.debit_notes.show', compact('debit_note', 'invoice_items', 'expenses', 'incomes'));
    }


    /**
     * Remove DebitNote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('debit_note_delete')) {
            return abort(401);
        }
        $debit_note = DebitNote::findOrFail($id);
        $debit_note->delete();

        return redirect()->route('admin.debit_notes.index');
    }

    /**
     * Delete all selected DebitNote at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('debit_note_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DebitNote::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($debit_note_id)
    {
        $debit_note = DebitNote::findOrFail($debit_note_id);
        $pdf = \PDF::loadView('admin.debit_notes.pdf', compact('debit_note'));
        return $pdf->stream('debit_note.pdf');
    }

}
