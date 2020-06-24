<?php

namespace App\Http\Controllers\Admin;

use App\PayeeAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayeeAccountsRequest;
use App\Http\Requests\Admin\UpdatePayeeAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayeeAccountsController extends Controller
{
    /**
     * Display a listing of PayeeAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payee_account_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('payee_account_delete')) {
                return abort(401);
            }
            $payee_accounts = PayeeAccount::onlyTrashed()->get();
        } else {
            $payee_accounts = PayeeAccount::all();
        }

        return view('admin.payee_accounts.index', compact('payee_accounts'));
    }

    /**
     * Show the form for creating new PayeeAccount.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payee_account_create')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $departments = \App\Department::get()->pluck('dept_name', 'id')->prepend(trans('global.app_please_select'), '');
        $positions = \App\Employee::get()->pluck('position', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = PayeeAccount::$enum_status;
        $enum_pymt_measurement_type = PayeeAccount::$enum_pymt_measurement_type;

        $account = PayeeAccount::all();
        $account_id = $account->pluck('id')->last();
        $account_number = 'EAN-'.($account_id + 1000);
            
        return view('admin.payee_accounts.create', compact('account_number', 'enum_status', 'enum_pymt_measurement_type', 'employees', 'departments', 'positions'));
    }

    /**
     * Store a newly created PayeeAccount in storage.
     *
     * @param  \App\Http\Requests\StorePayeeAccountsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayeeAccountsRequest $request)
    {
        if (! Gate::allows('payee_account_create')) {
            return abort(401);
        }
        $payee_account = PayeeAccount::create($request->all());



        return redirect()->route('admin.payee_accounts.index');
    }


    /**
     * Show the form for editing PayeeAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payee_account_edit')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $departments = \App\Department::get()->pluck('dept_name', 'id')->prepend(trans('global.app_please_select'), '');
        $positions = \App\Employee::get()->pluck('position', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = PayeeAccount::$enum_status;
        $enum_pymt_measurement_type = PayeeAccount::$enum_pymt_measurement_type;
            
        $payee_account = PayeeAccount::findOrFail($id);

        return view('admin.payee_accounts.edit', compact('payee_account', 'enum_status', 'enum_pymt_measurement_type', 'employees', 'departments', 'positions'));
    }

    /**
     * Update PayeeAccount in storage.
     *
     * @param  \App\Http\Requests\UpdatePayeeAccountsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayeeAccountsRequest $request, $id)
    {
        if (! Gate::allows('payee_account_edit')) {
            return abort(401);
        }
        $payee_account = PayeeAccount::findOrFail($id);
        $payee_account->update($request->all());



        return redirect()->route('admin.payee_accounts.index');
    }


    /**
     * Display PayeeAccount.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payee_account_view')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $departments = \App\Department::get()->pluck('dept_name', 'id')->prepend(trans('global.app_please_select'), '');
        $positions = \App\Employee::get()->pluck('position', 'id')->prepend(trans('global.app_please_select'), '');$payslips = \App\Payslip::where('account_number_id', $id)->get();$payee_payments = \App\PayeePayment::where('payee_account_number_id', $id)->get();

        $payee_account = PayeeAccount::findOrFail($id);

        return view('admin.payee_accounts.show', compact('payee_account', 'payslips', 'payee_payments'));
    }


    /**
     * Remove PayeeAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payee_account_delete')) {
            return abort(401);
        }
        $payee_account = PayeeAccount::findOrFail($id);
        $payee_account->delete();

        return redirect()->route('admin.payee_accounts.index');
    }

    /**
     * Delete all selected PayeeAccount at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payee_account_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PayeeAccount::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore PayeeAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('payee_account_delete')) {
            return abort(401);
        }
        $payee_account = PayeeAccount::onlyTrashed()->findOrFail($id);
        $payee_account->restore();

        return redirect()->route('admin.payee_accounts.index');
    }

    /**
     * Permanently delete PayeeAccount from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('payee_account_delete')) {
            return abort(401);
        }
        $payee_account = PayeeAccount::onlyTrashed()->findOrFail($id);
        $payee_account->forceDelete();

        return redirect()->route('admin.payee_accounts.index');
    }
}
