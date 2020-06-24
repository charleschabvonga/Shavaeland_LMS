<?php

namespace App\Http\Controllers\Admin;

use App\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpensesRequest;
use App\Http\Requests\Admin\UpdateExpensesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ExpensesController extends Controller
{
    /**
     * Display a listing of Expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('expense_access')) {
            return abort(401);
        }


                $expenses = Expense::all();

        return view('admin.expenses.index', compact('expenses'));
    }

    /**
     * Show the form for creating new Expense.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('expense_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $client_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_type = Expense::$enum_payment_type;

        $payment = Expense::all();
        $payment_id = $payment->pluck('id')->last();
        $payment_number = 'OPYN-'.($payment_id + 1000);
            
        return view('admin.expenses.create', compact('payment_number', 'enum_payment_type', 'vendors', 'clients', 'vendor_credit_note_numbers', 'client_credit_note_numbers', 'debit_note_numbers', 'withdrawal_transaction_numbers', 'operation_types', 'transaction_types', 'transaction_numbers'));
    }

    /**
     * Store a newly created Expense in storage.
     *
     * @param  \App\Http\Requests\StoreExpensesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        if (! Gate::allows('expense_create')) {
            return abort(401);
        }
        $expense = Expense::create($request->all());



        return redirect()->route('admin.expenses.index');
    }


    /**
     * Show the form for editing Expense.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('expense_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $client_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_type = Expense::$enum_payment_type;
            
        $expense = Expense::findOrFail($id);

        return view('admin.expenses.edit', compact('expense', 'enum_payment_type', 'vendors', 'clients', 'vendor_credit_note_numbers', 'client_credit_note_numbers', 'debit_note_numbers', 'withdrawal_transaction_numbers', 'operation_types', 'transaction_types', 'transaction_numbers'));
    }

    /**
     * Update Expense in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, $id)
    {
        if (! Gate::allows('expense_edit')) {
            return abort(401);
        }
        $expense = Expense::findOrFail($id);
        $expense->update($request->all());



        return redirect()->route('admin.expenses.index');
    }


    /**
     * Display Expense.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('expense_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_credit_note_numbers = \App\ExpenseCategory::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $client_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $transaction_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');$debit_notes = \App\DebitNote::where('credit_note_payment_number_id', $id)->get();

        $expense = Expense::findOrFail($id);

        return view('admin.expenses.show', compact('expense', 'debit_notes'));
    }


    /**
     * Remove Expense from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('expense_delete')) {
            return abort(401);
        }
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('admin.expenses.index');
    }

    /**
     * Delete all selected Expense at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('expense_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Expense::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
