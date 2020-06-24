<?php

namespace App\Http\Controllers\Admin;

use App\IncomeExpenseCalculator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeExpenseCalculatorsRequest;
use App\Http\Requests\Admin\UpdateIncomeExpenseCalculatorsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomeExpenseCalculatorsController extends Controller
{
    /**
     * Display a listing of IncomeExpenseCalculator.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('income_expense_calculator_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('income_expense_calculator_delete')) {
                return abort(401);
            }
            $income_expense_calculators = IncomeExpenseCalculator::onlyTrashed()->get();
        } else {
            $income_expense_calculators = IncomeExpenseCalculator::all();
        }

        return view('admin.income_expense_calculators.index', compact('income_expense_calculators'));
    }

    /**
     * Show the form for creating new IncomeExpenseCalculator.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('income_expense_calculator_create')) {
            return abort(401);
        }
        
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        //$distances = \App\Route::get()->pluck('distance', 'id')->prepend(trans('global.app_please_select'), '');
        $truck_attachment_statuses = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');
        $machinery_attachment_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_load_status = IncomeExpenseCalculator::$enum_load_status;

        $fuel_price = 17.81;
        $oil_price = 85.00;
        $tyre_price = 2500.00;
        $number_of_tyres = 6;
            
        return view('admin.income_expense_calculators.create', compact('tyre_price', 'number_of_tyres', 'fuel_price', 'oil_price', 'enum_load_status', 'routes', 'truck_attachment_statuses', 'machinery_attachment_types', 'sizes', 'vehicles'));
    }

    /**
     * Store a newly created IncomeExpenseCalculator in storage.
     *
     * @param  \App\Http\Requests\StoreIncomeExpenseCalculatorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomeExpenseCalculatorsRequest $request)
    {
        if (! Gate::allows('income_expense_calculator_create')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::create($request->all());



        return redirect()->route('admin.income_expense_calculators.index');
    }


    /**
     * Show the form for editing IncomeExpenseCalculator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('income_expense_calculator_edit')) {
            return abort(401);
        }
        
        $routes = \App\Route::get()->pluck('route', 'id')->prepend(trans('global.app_please_select'), '');
        //$distances = \App\Route::get()->pluck('distance', 'id')->prepend(trans('global.app_please_select'), '');
        $truck_attachment_statuses = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');
        $machinery_attachment_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $sizes = \App\MachinerySize::get()->pluck('size', 'id')->prepend(trans('global.app_please_select'), '');
        $vehicles = \App\Vehicle::get()->pluck('vehicle_description', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_load_status = IncomeExpenseCalculator::$enum_load_status;
            
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);

        return view('admin.income_expense_calculators.edit', compact('income_expense_calculator', 'enum_load_status', 'routes', 'truck_attachment_statuses', 'machinery_attachment_types', 'sizes', 'vehicles'));
    }

    /**
     * Update IncomeExpenseCalculator in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomeExpenseCalculatorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomeExpenseCalculatorsRequest $request, $id)
    {
        if (! Gate::allows('income_expense_calculator_edit')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);
        $income_expense_calculator->update($request->all());



        return redirect()->route('admin.income_expense_calculators.index');
    }


    /**
     * Display IncomeExpenseCalculator.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('income_expense_calculator_view')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);

        return view('admin.income_expense_calculators.show', compact('income_expense_calculator'));
    }


    /**
     * Remove IncomeExpenseCalculator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('income_expense_calculator_delete')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::findOrFail($id);
        $income_expense_calculator->delete();

        return redirect()->route('admin.income_expense_calculators.index');
    }

    /**
     * Delete all selected IncomeExpenseCalculator at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('income_expense_calculator_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = IncomeExpenseCalculator::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore IncomeExpenseCalculator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('income_expense_calculator_delete')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::onlyTrashed()->findOrFail($id);
        $income_expense_calculator->restore();

        return redirect()->route('admin.income_expense_calculators.index');
    }

    /**
     * Permanently delete IncomeExpenseCalculator from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('income_expense_calculator_delete')) {
            return abort(401);
        }
        $income_expense_calculator = IncomeExpenseCalculator::onlyTrashed()->findOrFail($id);
        $income_expense_calculator->forceDelete();

        return redirect()->route('admin.income_expense_calculators.index');
    }
}
