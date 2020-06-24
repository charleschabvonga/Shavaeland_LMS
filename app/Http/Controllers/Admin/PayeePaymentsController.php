<?php

namespace App\Http\Controllers\Admin;

use App\PayeePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayeePaymentsRequest;
use App\Http\Requests\Admin\UpdatePayeePaymentsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayeePaymentsController extends Controller
{
    /**
     * Display a listing of PayeePayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payee_payment_access')) {
            return abort(401);
        }


                $payee_payments = PayeePayment::all();

        return view('admin.payee_payments.index', compact('payee_payments'));
    }

    /**
     * Show the form for creating new PayeePayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payee_payment_create')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $payslip_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');
        $batch_numbers = \App\SalariesRequestTotal::get()->pluck('batch_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $payee_account_numbers = \App\PayeeAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_mode = PayeePayment::$enum_payment_mode;

        $payee_payment = PayeePayment::all();
        $payee_payment_id = $payee_payment->pluck('id')->last();
        $payee_payment_number = 'PPN-'.($payee_payment_id + 1000);
            
        return view('admin.payee_payments.create', compact('payee_payment_number', 'enum_payment_mode', 'employees', 'payslip_numbers', 'batch_numbers', 'withdrawal_transaction_numbers', 'payee_account_numbers'));
    }

    /**
     * Store a newly created PayeePayment in storage.
     *
     * @param  \App\Http\Requests\StorePayeePaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayeePaymentsRequest $request)
    {
        if (! Gate::allows('payee_payment_create')) {
            return abort(401);
        }
        $payee_payment = PayeePayment::create($request->all());



        return redirect()->route('admin.payee_payments.index');
    }


    /**
     * Show the form for editing PayeePayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payee_payment_edit')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $payslip_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');
        $batch_numbers = \App\SalariesRequestTotal::get()->pluck('batch_number', 'id')->prepend(trans('global.app_please_select'), '');
        $withdrawal_transaction_numbers = \App\VendorBankPayment::get()->pluck('payment_number', 'id')->prepend(trans('global.app_please_select'), '');
        $payee_account_numbers = \App\PayeeAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_payment_mode = PayeePayment::$enum_payment_mode;
            
        $payee_payment = PayeePayment::findOrFail($id);

        return view('admin.payee_payments.edit', compact('payee_payment', 'enum_payment_mode', 'employees', 'payslip_numbers', 'batch_numbers', 'withdrawal_transaction_numbers', 'payee_account_numbers'));
    }

    /**
     * Update PayeePayment in storage.
     *
     * @param  \App\Http\Requests\UpdatePayeePaymentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayeePaymentsRequest $request, $id)
    {
        if (! Gate::allows('payee_payment_edit')) {
            return abort(401);
        }
        $payee_payment = PayeePayment::findOrFail($id);
        $payee_payment->update($request->all());



        return redirect()->route('admin.payee_payments.index');
    }


    /**
     * Display PayeePayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payee_payment_view')) {
            return abort(401);
        }
        $payee_payment = PayeePayment::findOrFail($id);

        return view('admin.payee_payments.show', compact('payee_payment'));
    }


    /**
     * Remove PayeePayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payee_payment_delete')) {
            return abort(401);
        }
        $payee_payment = PayeePayment::findOrFail($id);
        $payee_payment->delete();

        return redirect()->route('admin.payee_payments.index');
    }

    /**
     * Delete all selected PayeePayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payee_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PayeePayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
