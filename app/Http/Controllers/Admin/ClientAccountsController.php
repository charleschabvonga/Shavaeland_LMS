<?php

namespace App\Http\Controllers\Admin;

use App\ClientAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientAccountsRequest;
use App\Http\Requests\Admin\UpdateClientAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientAccountsController extends Controller
{
    /**
     * Display a listing of ClientAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_account_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_account_delete')) {
                return abort(401);
            }
            $client_accounts = ClientAccount::onlyTrashed()->get();
        } else {
            $client_accounts = ClientAccount::all();
        }

        return view('admin.client_accounts.index', compact('client_accounts'));
    }

    /**
     * Show the form for creating new ClientAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_account_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ClientAccount::$enum_status; 

        $account = ClientAccount::all();
        $account_id = $account->pluck('id')->last();
        $account_number = 'CACC-'.($account_id + 1000); 
            
        return view('admin.client_accounts.create', compact('account_number', 'enum_status', 'clients', 'contact_people', 'account_managers'));
    }

    /**
     * Store a newly created ClientAccount in storage.
     *
     * @param  \App\Http\Requests\StoreClientAccountsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientAccountsRequest $request)
    {
        if (! Gate::allows('client_account_create')) {
            return abort(401);
        }
        $client_account = ClientAccount::create($request->all());



        return redirect()->route('admin.client_accounts.index');
    }


    /**
     * Show the form for editing ClientAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_account_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ClientAccount::$enum_status;
            
        $client_account = ClientAccount::findOrFail($id);

        return view('admin.client_accounts.edit', compact('client_account', 'enum_status', 'clients', 'contact_people', 'account_managers'));
    }

    /**
     * Update ClientAccount in storage.
     *
     * @param  \App\Http\Requests\UpdateClientAccountsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientAccountsRequest $request, $id)
    {
        if (! Gate::allows('client_account_edit')) {
            return abort(401);
        }
        $client_account = ClientAccount::findOrFail($id);
        $client_account->update($request->all());



        return redirect()->route('admin.client_accounts.index');
    }


    /**
     * Display ClientAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_account_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$bank_payments = \App\BankPayment::where('account_number_id', $id)->get();$vendor_bank_payments = \App\VendorBankPayment::where('client_account_number_id', $id)->get();

        $client_account = ClientAccount::findOrFail($id);

        return view('admin.client_accounts.show', compact('client_account', 'bank_payments', 'vendor_bank_payments'));
    }


    /**
     * Remove ClientAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_account_delete')) {
            return abort(401);
        }
        $client_account = ClientAccount::findOrFail($id);
        $client_account->delete();

        return redirect()->route('admin.client_accounts.index');
    }

    /**
     * Delete all selected ClientAccount at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_account_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientAccount::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ClientAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('client_account_delete')) {
            return abort(401);
        }
        $client_account = ClientAccount::onlyTrashed()->findOrFail($id);
        $client_account->restore();

        return redirect()->route('admin.client_accounts.index');
    }

    /**
     * Permanently delete ClientAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('client_account_delete')) {
            return abort(401);
        }
        $client_account = ClientAccount::onlyTrashed()->findOrFail($id);
        $client_account->forceDelete();

        return redirect()->route('admin.client_accounts.index');
    }

    public function download($client_account_id)
    {
        $client_account = ClientAccount::findOrFail($client_account_id);
        $pdf = \PDF::loadView('admin.client_accounts.pdf', compact('client_account'));
        return $pdf->stream('client_account.pdf');
    }
}
