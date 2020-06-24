<?php

namespace App\Http\Controllers\Admin;

use App\VendorAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorAccountsRequest;
use App\Http\Requests\Admin\UpdateVendorAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorAccountsController extends Controller
{
    /**
     * Display a listing of VendorAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('vendor_account_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('vendor_account_delete')) {
                return abort(401);
            }
            $vendor_accounts = VendorAccount::onlyTrashed()->get();
        } else {
            $vendor_accounts = VendorAccount::all();
        }

        return view('admin.vendor_accounts.index', compact('vendor_accounts'));
    }

    /**
     * Show the form for creating new VendorAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('vendor_account_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = VendorAccount::$enum_status;

        $account = VendorAccount::all();
        $account_id = $account->pluck('id')->last();
        $account_number = 'VACC-'.($account_id + 1000); 
            
        return view('admin.vendor_accounts.create', compact('account_number', 'enum_status', 'vendors', 'contact_people', 'account_managers'));
    }

    /**
     * Store a newly created VendorAccount in storage.
     *
     * @param  \App\Http\Requests\StoreVendorAccountsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorAccountsRequest $request)
    {
        if (! Gate::allows('vendor_account_create')) {
            return abort(401);
        }
        $vendor_account = VendorAccount::create($request->all());



        return redirect()->route('admin.vendor_accounts.index');
    }


    /**
     * Show the form for editing VendorAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('vendor_account_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = VendorAccount::$enum_status;
            
        $vendor_account = VendorAccount::findOrFail($id);

        return view('admin.vendor_accounts.edit', compact('vendor_account', 'enum_status', 'vendors', 'contact_people', 'account_managers'));
    }

    /**
     * Update VendorAccount in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorAccountsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorAccountsRequest $request, $id)
    {
        if (! Gate::allows('vendor_account_edit')) {
            return abort(401);
        }
        $vendor_account = VendorAccount::findOrFail($id);
        $vendor_account->update($request->all());



        return redirect()->route('admin.vendor_accounts.index');
    }


    /**
     * Display VendorAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('vendor_account_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\VendorContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$vendor_bank_payments = \App\VendorBankPayment::where('account_number_id', $id)->get();$bank_payments = \App\BankPayment::where('vendor_account_number_id', $id)->get();

        $vendor_account = VendorAccount::findOrFail($id);

        return view('admin.vendor_accounts.show', compact('vendor_account', 'vendor_bank_payments', 'bank_payments'));
    }


    /**
     * Remove VendorAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('vendor_account_delete')) {
            return abort(401);
        }
        $vendor_account = VendorAccount::findOrFail($id);
        $vendor_account->delete();

        return redirect()->route('admin.vendor_accounts.index');
    }

    /**
     * Delete all selected VendorAccount at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('vendor_account_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = VendorAccount::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore VendorAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('vendor_account_delete')) {
            return abort(401);
        }
        $vendor_account = VendorAccount::onlyTrashed()->findOrFail($id);
        $vendor_account->restore();

        return redirect()->route('admin.vendor_accounts.index');
    }

    /**
     * Permanently delete VendorAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('vendor_account_delete')) {
            return abort(401);
        }
        $vendor_account = VendorAccount::onlyTrashed()->findOrFail($id);
        $vendor_account->forceDelete();

        return redirect()->route('admin.vendor_accounts.index');
    }

    public function download($vendor_account_id)
    {
        $vendor_account = VendorAccount::findOrFail($vendor_account_id);
        $pdf = \PDF::loadView('admin.vendor_accounts.pdf', compact('vendor_account'));
        return $pdf->stream('vendor_account.pdf');
    }
}
