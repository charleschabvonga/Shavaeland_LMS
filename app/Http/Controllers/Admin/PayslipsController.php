<?php

namespace App\Http\Controllers\Admin;

use App\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayslipsRequest;
use App\Http\Requests\Admin\UpdatePayslipsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayslipsController extends Controller
{
    /**
     * Display a listing of Payslip.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('payslip_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('payslip_delete')) {
                return abort(401);
            }
            $payslips = Payslip::onlyTrashed()->get();
        } else {
            $payslips = Payslip::all();
        }

        return view('admin.payslips.index', compact('payslips'));
    }

    /**
     * Show the form for creating new Payslip.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('payslip_create')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $batch_numbers = \App\SalariesRequestTotal::get()->pluck('batch_number', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\PayeeAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Payslip::$enum_status;

        $payslip = Payslip::all();
        $payslip_id = $payslip->pluck('id')->last();
        $payslip_number = 'PSN-'.($payslip_id + 1000);
            
        return view('admin.payslips.create', compact('payslip_number', 'enum_status', 'employees', 'batch_numbers', 'account_numbers'));
    }

    /**
     * Store a newly created Payslip in storage.
     *
     * @param  \App\Http\Requests\StorePayslipsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePayslipsRequest $request)
    {
        if (! Gate::allows('payslip_create')) {
            return abort(401);
        }
        $payslip = Payslip::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty1[$i]) && isset($request->unit_price1[$i])) {
                $payslip->overtime_and_bonus_items()->create([
                    'payslip_number_id' => $payslip->id,
                    'item_description' => $request->item_description1[$i],
                    'qty' => $request->qty1[$i],
                    'unit_price' => $request->unit_price1[$i],
                    'total' => $request->total1[$i]
                ]);
            }
        }

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty2[$i]) && isset($request->unit_price2[$i])) {
                $payslip->deduction_items()->create([
                    'payslip_number_id' => $payslip->id,
                    'item_description' => $request->item_description2[$i],
                    'qty' => $request->qty2[$i],
                    'unit_price' => $request->unit_price2[$i],
                    'total' => $request->total2[$i]
                ]);
            }
        }

        return redirect()->route('admin.payslips.index');
    }


    /**
     * Show the form for editing Payslip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('payslip_edit')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $batch_numbers = \App\SalariesRequestTotal::get()->pluck('batch_number', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\PayeeAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Payslip::$enum_status;
            
        $payslip = Payslip::findOrFail($id);

        return view('admin.payslips.edit', compact('payslip', 'enum_status', 'employees', 'batch_numbers', 'account_numbers'));
    }

    /**
     * Update Payslip in storage.
     *
     * @param  \App\Http\Requests\UpdatePayslipsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePayslipsRequest $request, $id)
    {
        if (! Gate::allows('payslip_edit')) {
            return abort(401);
        }
        $payslip = Payslip::findOrFail($id);
        $payslip->update($request->all());

        $deductionItems           = $payslip->deduction_items;
        $currentDeductionItemData = [];
        foreach ($request->input('deduction_items', []) as $index => $data) {
            if (is_integer($index)) {
                $payslip->deduction_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentDeductionItemData[$id] = $data;
            }
        }
        foreach ($deductionItems as $item) {
            if (isset($currentDeductionItemData[$item->id])) {
                $item->update($currentDeductionItemData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $overtimeAndBonusItems           = $payslip->overtime_and_bonus_items;
        $currentOvertimeAndBonusItemData = [];
        foreach ($request->input('overtime_and_bonus_items', []) as $index => $data) {
            if (is_integer($index)) {
                $payslip->overtime_and_bonus_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentOvertimeAndBonusItemData[$id] = $data;
            }
        }
        foreach ($overtimeAndBonusItems as $item) {
            if (isset($currentOvertimeAndBonusItemData[$item->id])) {
                $item->update($currentOvertimeAndBonusItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.payslips.index');
    }


    /**
     * Display Payslip.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('payslip_view')) {
            return abort(401);
        }
        
        $employees = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $batch_numbers = \App\SalariesRequestTotal::get()->pluck('batch_number', 'id')->prepend(trans('global.app_please_select'), '');
        $account_numbers = \App\PayeeAccount::get()->pluck('account_number', 'id')->prepend(trans('global.app_please_select'), '');$deduction_items = \App\DeductionItem::where('item_number_id', $id)->get();$overtime_and_bonus_items = \App\OvertimeAndBonusItem::where('item_number_id', $id)->get();$payee_payments = \App\PayeePayment::where('payslip_number_id', $id)->get();

        $payslip = Payslip::findOrFail($id);

        return view('admin.payslips.show', compact('payslip', 'deduction_items', 'overtime_and_bonus_items', 'payee_payments'));
    }


    /**
     * Remove Payslip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('payslip_delete')) {
            return abort(401);
        }
        $payslip = Payslip::findOrFail($id);
        $payslip->delete();

        return redirect()->route('admin.payslips.index');
    }

    /**
     * Delete all selected Payslip at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('payslip_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Payslip::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Payslip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('payslip_delete')) {
            return abort(401);
        }
        $payslip = Payslip::onlyTrashed()->findOrFail($id);
        $payslip->restore();

        return redirect()->route('admin.payslips.index');
    }

    /**
     * Permanently delete Payslip from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('payslip_delete')) {
            return abort(401);
        }
        $payslip = Payslip::onlyTrashed()->findOrFail($id);
        $payslip->forceDelete();

        return redirect()->route('admin.payslips.index');
    }

    public function download($payslip_id)
    {
        $payslip = Payslip::findOrFail($payslip_id);
        $pdf = \PDF::loadView('admin.payslip.pdf', compact('payslip'));
        return $pdf->stream('payslip.pdf');
    }
}