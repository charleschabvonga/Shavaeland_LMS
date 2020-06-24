<?php

namespace App\Http\Controllers\Admin;

use App\CreditNote;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCreditNotesRequest;
use App\Http\Requests\Admin\UpdateCreditNotesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CreditNotesController extends Controller
{
    /**
     * Display a listing of CreditNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('credit_note_access')) {
            return abort(401);
        }


                $credit_notes = CreditNote::all();

        return view('admin.credit_notes.index', compact('credit_notes'));
    }

    /**
     * Show the form for creating new CreditNote.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('credit_note_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $bank_references = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_payment_numbers = \App\Income::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_refund_type = CreditNote::$enum_refund_type;
        $enum_status = CreditNote::$enum_status;

        $unit = UnitMeasurement::all();

        $credit_note = CreditNote::all();
        $credit_note_id = $credit_note->pluck('id')->last();
        $credit_note_number = 'SCNN-'.($credit_note_id + 1000);
            
        return view('admin.credit_notes.create', compact('unit', 'credit_note_number', 'enum_refund_type', 'enum_status', 'clients', 'contact_people', 'account_managers', 'project_numbers', 'invoice_numbers', 'bank_references', 'invoice_payment_numbers'));
    }

    /**
     * Store a newly created CreditNote in storage.
     *
     * @param  \App\Http\Requests\StoreCreditNotesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCreditNotesRequest $request)
    {
        if (! Gate::allows('credit_note_create')) {
            return abort(401);
        }
        $credit_note = CreditNote::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit_price[$i])) {
                $credit_note->invoice_items()->create([
                    'invoice_number_id' => $credit_note->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.credit_notes.index');
    }


    /**
     * Show the form for editing CreditNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('credit_note_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $bank_references = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_payment_numbers = \App\Income::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_refund_type = CreditNote::$enum_refund_type;
                    $enum_status = CreditNote::$enum_status;
            
        $credit_note = CreditNote::findOrFail($id);

        return view('admin.credit_notes.edit', compact('credit_note', 'enum_refund_type', 'enum_status', 'clients', 'contact_people', 'account_managers', 'project_numbers', 'invoice_numbers', 'bank_references', 'invoice_payment_numbers'));
    }

    /**
     * Update CreditNote in storage.
     *
     * @param  \App\Http\Requests\UpdateCreditNotesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCreditNotesRequest $request, $id)
    {
        if (! Gate::allows('credit_note_edit')) {
            return abort(401);
        }
        $credit_note = CreditNote::findOrFail($id);
        $credit_note->update($request->all());

        $invoiceItems           = $credit_note->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $credit_note->invoice_items()->create($data);
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


        return redirect()->route('admin.credit_notes.index');
    }


    /**
     * Display CreditNote.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('credit_note_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $bank_references = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_payment_numbers = \App\Income::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('credit_note_number_id', $id)->get();$expenses = \App\Expense::where('client_credit_note_number_id', $id)->get();$incomes = \App\Income::where('sales_credit_note_number_id', $id)->get();

        $credit_note = CreditNote::findOrFail($id);

        return view('admin.credit_notes.show', compact('credit_note', 'invoice_items', 'expenses', 'incomes'));
    }


    /**
     * Remove CreditNote from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('credit_note_delete')) {
            return abort(401);
        }
        $credit_note = CreditNote::findOrFail($id);
        $credit_note->delete();

        return redirect()->route('admin.credit_notes.index');
    }

    /**
     * Delete all selected CreditNote at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('credit_note_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CreditNote::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($credit_note_id)
    {
        $credit_note = CreditNote::findOrFail($credit_note_id);
        $pdf = \PDF::loadView('admin.credit_note.pdf', compact('credit_note'));
        return $pdf->stream('credit_note.pdf');
    }

}
