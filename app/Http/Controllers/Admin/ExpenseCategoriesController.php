<?php

namespace App\Http\Controllers\Admin;

use App\ExpenseCategory;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    /**
     * Display a listing of ExpenseCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('expense_category_access')) {
            return abort(401);
        }


                $expense_categories = ExpenseCategory::all();

        return view('admin.expense_categories.index', compact('expense_categories'));
    }

    /**
     * Show the form for creating new ExpenseCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('expense_category_create')) {
            return abort(401);
        }
        
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $purchase_order_numbers = \App\PurchaseOrder::get()->pluck('purchase_order_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ExpenseCategory::$enum_status;

        $unit = UnitMeasurement::all();


        $credit_note = ExpenseCategory::all();
        $credit_note_id = $credit_note->pluck('id')->last();
        $credit_note_number = 'PCNN-'.($credit_note_id + 1000);
            
        return view('admin.expense_categories.create', compact('unit', 'credit_note_number', 'enum_status', 'transaction_types', 'transaction_numbers', 'vendors', 'contact_people', 'account_managers', 'purchase_order_numbers'));
    }

    /**
     * Store a newly created ExpenseCategory in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpenseCategoriesRequest $request)
    {
        if (! Gate::allows('expense_category_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $expense_category = ExpenseCategory::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit[$i]) && isset($request->unit_price[$i])) {
                $expense_category->invoice_items()->create([
                    'invoice_number_id' => $expense_category->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.expense_categories.index');
    }


    /**
     * Show the form for editing ExpenseCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('expense_category_edit')) {
            return abort(401);
        }
        
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $purchase_order_numbers = \App\PurchaseOrder::get()->pluck('purchase_order_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ExpenseCategory::$enum_status;

        $credit_note = ExpenseCategory::all();
        $credit_note_id = $credit_note->pluck('id')->last();
        $credit_note_number = 'PCNN-'.($credit_note_id + 1000);
            
        $expense_category = ExpenseCategory::findOrFail($id);

        return view('admin.expense_categories.edit', compact('credit_note_number', 'expense_category', 'enum_status', 'transaction_types', 'transaction_numbers', 'vendors', 'contact_people', 'account_managers', 'purchase_order_numbers'));
    }

    /**
     * Update ExpenseCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseCategoriesRequest $request, $id)
    {
        if (! Gate::allows('expense_category_edit')) {
            return abort(401);
        }
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


        return redirect()->route('admin.expense_categories.index');
    }


    /**
     * Display ExpenseCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('expense_category_view')) {
            return abort(401);
        }
        
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $purchase_order_numbers = \App\PurchaseOrder::get()->pluck('purchase_order_number', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('bill_number_id', $id)->get();$debit_notes = \App\DebitNote::where('credit_note_number_id', $id)->get();$expenses = \App\Expense::where('vendor_credit_note_number_id', $id)->get();

        $expense_category = ExpenseCategory::findOrFail($id);

        return view('admin.expense_categories.show', compact('expense_category', 'invoice_items', 'debit_notes', 'expenses'));
    }


    /**
     * Remove ExpenseCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('expense_category_delete')) {
            return abort(401);
        }
        $expense_category = ExpenseCategory::findOrFail($id);
        $expense_category->delete();

        return redirect()->route('admin.expense_categories.index');
    }

    /**
     * Delete all selected ExpenseCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('expense_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ExpenseCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($expense_category_id)
    {
        $expense_category = ExpenseCategory::findOrFail($expense_category_id);
        $pdf = \PDF::loadView('admin.expense_category.pdf', compact('expense_category'));
        return $pdf->stream('expense_category.pdf');
    }

}
