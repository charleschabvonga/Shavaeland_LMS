<?php

namespace App\Http\Controllers\Admin;

use App\BankPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBankPaymentsRequest;
use App\Http\Requests\Admin\UpdateBankPaymentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class BankPaymentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of BankPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('bank_payment_access')) {
            return abort(401);
        }


                $bank_payments = BankPayment::all();

        return view('admin.bank_payments.index', compact('bank_payments'));
    }

    /**
     * Show the form for creating new BankPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('bank_payment_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_depositor = BankPayment::$enum_depositor;
        $enum_payment_mode = BankPayment::$enum_payment_mode;

        $payment = BankPayment::all();
        $payment_id = $payment->pluck('id')->last();
        $payment_number = 'IDN-'.($payment_id + 1000);
            
        return view('admin.bank_payments.create', compact('debit_note_numbers', 'payment_number', 'enum_depositor', 'enum_payment_mode', 'clients', 'account_numbers', 'vendors', 'vendor_account_numbers'));
    }

    /**
     * Store a newly created BankPayment in storage.
     *
     * @param  \App\Http\Requests\StoreBankPaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankPaymentsRequest $request)
    {
        if (! Gate::allows('bank_payment_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $bank_payment = BankPayment::create($request->all());



        return redirect()->route('admin.bank_payments.index');
    }


    /**
     * Show the form for editing BankPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('bank_payment_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_depositor = BankPayment::$enum_depositor;
        $enum_payment_mode = BankPayment::$enum_payment_mode;
            
        $bank_payment = BankPayment::findOrFail($id);

        return view('admin.bank_payments.edit', compact('debit_note_numbers', 'bank_payment', 'enum_depositor', 'enum_payment_mode', 'clients', 'account_numbers', 'vendors', 'vendor_account_numbers'));
    }

    /**
     * Update BankPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateBankPaymentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankPaymentsRequest $request, $id)
    {
        if (! Gate::allows('bank_payment_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $bank_payment = BankPayment::findOrFail($id);
        $bank_payment->update($request->all());



        return redirect()->route('admin.bank_payments.index');
    }


    /**
     * Display BankPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('bank_payment_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $vendor_account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');$credit_notes = \App\CreditNote::where('bank_reference_id', $id)->get();$incomes = \App\Income::where('deposit_transaction_number_id', $id)->get();
        $debit_note_numbers = \App\DebitNote::get()->pluck('debit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        
        $bank_payment = BankPayment::findOrFail($id);

        return view('admin.bank_payments.show', compact('bank_payment', 'credit_notes', 'incomes'));
    }


    /**
     * Remove BankPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('bank_payment_delete')) {
            return abort(401);
        }
        $bank_payment = BankPayment::findOrFail($id);
        $bank_payment->delete();

        return redirect()->route('admin.bank_payments.index');
    }

    /**
     * Delete all selected BankPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('bank_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = BankPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
