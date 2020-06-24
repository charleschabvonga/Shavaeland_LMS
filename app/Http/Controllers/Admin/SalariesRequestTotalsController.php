<?php

namespace App\Http\Controllers\Admin;

use App\SalariesRequestTotal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSalariesRequestTotalsRequest;
use App\Http\Requests\Admin\UpdateSalariesRequestTotalsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SalariesRequestTotalsController extends Controller
{
    /**
     * Display a listing of SalariesRequestTotal.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('salaries_request_total_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('salaries_request_total_delete')) {
                return abort(401);
            }
            $salaries_request_totals = SalariesRequestTotal::onlyTrashed()->get();
        } else {
            $salaries_request_totals = SalariesRequestTotal::all();
        }

        return view('admin.salaries_request_totals.index', compact('salaries_request_totals'));
    }

    /**
     * Show the form for creating new SalariesRequestTotal.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('salaries_request_total_create')) {
            return abort(401);
        }        $enum_status = SalariesRequestTotal::$enum_status;

        $batch = SalariesRequestTotal::all();
        $batch_id = $batch->pluck('id')->last();
        $batch_number = 'PBN-'.($batch_id + 1000);
            
        return view('admin.salaries_request_totals.create', compact('batch_number', 'enum_status'));
    }

    /**
     * Store a newly created SalariesRequestTotal in storage.
     *
     * @param  \App\Http\Requests\StoreSalariesRequestTotalsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalariesRequestTotalsRequest $request)
    {
        if (! Gate::allows('salaries_request_total_create')) {
            return abort(401);
        }
        $salaries_request_total = SalariesRequestTotal::create($request->all());



        return redirect()->route('admin.salaries_request_totals.index');
    }


    /**
     * Show the form for editing SalariesRequestTotal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('salaries_request_total_edit')) {
            return abort(401);
        }        $enum_status = SalariesRequestTotal::$enum_status;
            
        $salaries_request_total = SalariesRequestTotal::findOrFail($id);

        return view('admin.salaries_request_totals.edit', compact('salaries_request_total', 'enum_status'));
    }

    /**
     * Update SalariesRequestTotal in storage.
     *
     * @param  \App\Http\Requests\UpdateSalariesRequestTotalsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalariesRequestTotalsRequest $request, $id)
    {
        if (! Gate::allows('salaries_request_total_edit')) {
            return abort(401);
        }
        $salaries_request_total = SalariesRequestTotal::findOrFail($id);
        $salaries_request_total->update($request->all());



        return redirect()->route('admin.salaries_request_totals.index');
    }


    /**
     * Display SalariesRequestTotal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('salaries_request_total_view')) {
            return abort(401);
        }
        $payslips = \App\Payslip::where('batch_number_id', $id)->get();$payee_payments = \App\PayeePayment::where('batch_number_id', $id)->get();

        $salaries_request_total = SalariesRequestTotal::findOrFail($id);

        return view('admin.salaries_request_totals.show', compact('salaries_request_total', 'payslips', 'payee_payments'));
    }


    /**
     * Remove SalariesRequestTotal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('salaries_request_total_delete')) {
            return abort(401);
        }
        $salaries_request_total = SalariesRequestTotal::findOrFail($id);
        $salaries_request_total->delete();

        return redirect()->route('admin.salaries_request_totals.index');
    }

    /**
     * Delete all selected SalariesRequestTotal at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('salaries_request_total_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = SalariesRequestTotal::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore SalariesRequestTotal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('salaries_request_total_delete')) {
            return abort(401);
        }
        $salaries_request_total = SalariesRequestTotal::onlyTrashed()->findOrFail($id);
        $salaries_request_total->restore();

        return redirect()->route('admin.salaries_request_totals.index');
    }

    /**
     * Permanently delete SalariesRequestTotal from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('salaries_request_total_delete')) {
            return abort(401);
        }
        $salaries_request_total = SalariesRequestTotal::onlyTrashed()->findOrFail($id);
        $salaries_request_total->forceDelete();

        return redirect()->route('admin.salaries_request_totals.index');
    }
}
