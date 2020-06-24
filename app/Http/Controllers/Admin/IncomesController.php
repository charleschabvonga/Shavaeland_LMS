<?php

namespace App\Http\Controllers\Admin;

use App\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomesRequest;
use App\Http\Requests\Admin\UpdateIncomesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomesController extends Controller
{
    /**
     * Display a listing of Income.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('income_access')) {
            return abort(401);
        }


                $incomes = Income::all();

        return view('admin.incomes.index', compact('incomes'));
    }

    /**
     * Show the form for creating new Income.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('income_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $deposit_transaction_numbers = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_type = Income::$enum_payment_type;

        $payment = Income::all();
        $payment_id = $payment->pluck('id')->last();
        $payment_number = 'IPYN-'.($payment_id + 1000);
            
        return view('admin.incomes.create', compact('payment_number', 'enum_payment_type', 'clients', 'vendors', 'invoice_numbers', 'debit_note_numbers', 'sales_credit_note_numbers', 'deposit_transaction_numbers', 'operation_types', 'project_types', 'project_numbers'));
    }

    /**
     * Store a newly created Income in storage.
     *
     * @param  \App\Http\Requests\StoreIncomesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomesRequest $request)
    {
        if (! Gate::allows('income_create')) {
            return abort(401);
        }
        $income = Income::create($request->all());



        return redirect()->route('admin.incomes.index');
    }


    /**
     * Show the form for editing Income.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('income_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $deposit_transaction_numbers = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_type = Income::$enum_payment_type;
            
        $income = Income::findOrFail($id);

        return view('admin.incomes.edit', compact('income', 'enum_payment_type', 'clients', 'vendors', 'invoice_numbers', 'debit_note_numbers', 'sales_credit_note_numbers', 'deposit_transaction_numbers', 'operation_types', 'project_types', 'project_numbers'));
    }

    /**
     * Update Income in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomesRequest $request, $id)
    {
        if (! Gate::allows('income_edit')) {
            return abort(401);
        }
        $income = Income::findOrFail($id);
        $income->update($request->all());



        return redirect()->route('admin.incomes.index');
    }


    /**
     * Display Income.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('income_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $invoice_numbers = \App\IncomeCategory::get()->pluck('invoice_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $deposit_transaction_numbers = \App\BankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $operation_types = \App\OperationType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');$credit_notes = \App\CreditNote::where('invoice_payment_number_id', $id)->get();

        $income = Income::findOrFail($id);

        return view('admin.incomes.show', compact('income', 'credit_notes'));
    }


    /**
     * Remove Income from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('income_delete')) {
            return abort(401);
        }
        $income = Income::findOrFail($id);
        $income->delete();

        return redirect()->route('admin.incomes.index');
    }

    /**
     * Delete all selected Income at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('income_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Income::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
