<?php

namespace App\Http\Controllers\Admin;

use App\VendorBankPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorBankPaymentsRequest;
use App\Http\Requests\Admin\UpdateVendorBankPaymentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorBankPaymentsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of VendorBankPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_bank_payment_access')) {
            return abort(401);
        }


                $vendor_bank_payments = VendorBankPayment::all();

        return view('admin.vendor_bank_payments.index', compact('vendor_bank_payments'));
    }

    /**
     * Show the form for creating new VendorBankPayment.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_bank_payment_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $client_account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_withdrawer = VendorBankPayment::$enum_withdrawer;
        $enum_payment_mode = VendorBankPayment::$enum_payment_mode;

        $payment = VendorBankPayment::all();
        $payment_id = $payment->pluck('id')->last();
        $payment_number = 'ODN-'.($payment_id + 1000);
            
        return view('admin.vendor_bank_payments.create', compact('credit_note_numbers', 'payment_number', 'enum_withdrawer', 'enum_payment_mode', 'vendors', 'account_numbers', 'clients', 'client_account_numbers'));
    }

    /**
     * Store a newly created VendorBankPayment in storage.
     *
     * @param  \App\Http\Requests\StoreVendorBankPaymentsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorBankPaymentsRequest $request)
    {
        if (! Gate::allows('vendor_bank_payment_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $vendor_bank_payment = VendorBankPayment::create($request->all());



        return redirect()->route('admin.vendor_bank_payments.index');
    }


    /**
     * Show the form for editing VendorBankPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vendor_bank_payment_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $client_account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_withdrawer = VendorBankPayment::$enum_withdrawer;
        $enum_payment_mode = VendorBankPayment::$enum_payment_mode;
            
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);

        return view('admin.vendor_bank_payments.edit', compact('credit_note_numbers', 'vendor_bank_payment', 'enum_withdrawer', 'enum_payment_mode', 'vendors', 'account_numbers', 'clients', 'client_account_numbers'));
    }

    /**
     * Update VendorBankPayment in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorBankPaymentsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorBankPaymentsRequest $request, $id)
    {
        if (! Gate::allows('vendor_bank_payment_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);
        $vendor_bank_payment->update($request->all());



        return redirect()->route('admin.vendor_bank_payments.index');
    }


    /**
     * Display VendorBankPayment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vendor_bank_payment_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\VendorAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $client_account_numbers = \App\ClientAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');$payee_payments = \App\PayeePayment::where('withdrawal_transaction_number_id', $id)->get();$debit_notes = \App\DebitNote::where('withdrawal_transaction_number_id', $id)->get();$expenses = \App\Expense::where('withdrawal_transaction_number_id', $id)->get();
        $credit_note_numbers = \App\CreditNote::get()->pluck('credit_note_number', 'id')->prepend(trans('global.app_please_select'), '');
        
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);

        return view('admin.vendor_bank_payments.show', compact('vendor_bank_payment', 'payee_payments', 'debit_notes', 'expenses'));
    }


    /**
     * Remove VendorBankPayment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vendor_bank_payment_delete')) {
            return abort(401);
        }
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);
        $vendor_bank_payment->delete();

        return redirect()->route('admin.vendor_bank_payments.index');
    }

    /**
     * Delete all selected VendorBankPayment at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vendor_bank_payment_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = VendorBankPayment::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
