<?php

namespace App\Http\Controllers\Api\V1;

use App\IncomeExpenseCalculator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeExpenseCalculatorsRequest;
use App\Http\Requests\Admin\UpdateIncomeExpenseCalculatorsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomeExpenseCalculatorsController extends Controller
{
    public function index()
    {
        return IncomeExpenseCalculator::all();
    }

    public function show($id)
    {
        return IncomeExpenseCalculator::findOrFail($id);
    }

    public function update(UpdateIncomeExpenseCalculatorsRequest $request, $id)
    {
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);
        $income_expense_calculator->update($request->all());
        

        return $income_expense_calculator;
    }

    public function store(StoreIncomeExpenseCalculatorsRequest $request)
    {
        $income_expense_calculator = IncomeExpenseCalculator::create($request->all());
        

        return $income_expense_calculator;
    }

    public function destroy($id)
    {
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);
        $income_expense_calculator->delete();
        return '';
    }
}
