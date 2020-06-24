<?php

namespace App\Http\Controllers\Api\V1;

use App\Payslip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayslipsRequest;
use App\Http\Requests\Admin\UpdatePayslipsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayslipsController extends Controller
{
    public function index()
    {
        return Payslip::all();
    }

    public function show($id)
    {
        return Payslip::findOrFail($id);
    }

    public function update(UpdatePayslipsRequest $request, $id)
    {
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

        return $payslip;
    }

    public function store(StorePayslipsRequest $request)
    {
        $payslip = Payslip::create($request->all());
        
        foreach ($request->input('deduction_items', []) as $data) {
            $payslip->deduction_items()->create($data);
        }
        foreach ($request->input('overtime_and_bonus_items', []) as $data) {
            $payslip->overtime_and_bonus_items()->create($data);
        }

        return $payslip;
    }

    public function destroy($id)
    {
        $payslip = Payslip::findOrFail($id);
        $payslip->delete();
        return '';
    }
}
