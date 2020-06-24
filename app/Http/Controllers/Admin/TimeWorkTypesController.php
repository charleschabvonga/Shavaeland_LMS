<?php

namespace App\Http\Controllers\Admin;

use App\TimeWorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeWorkTypesRequest;
use App\Http\Requests\Admin\UpdateTimeWorkTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TimeWorkTypesController extends Controller
{
    /**
     * Display a listing of TimeWorkType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('time_work_type_access')) {
            return abort(401);
        }


                $time_work_types = TimeWorkType::all();

        return view('admin.time_work_types.index', compact('time_work_types'));
    }

    /**
     * Show the form for creating new TimeWorkType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('time_work_type_create')) {
            return abort(401);
        }
        return view('admin.time_work_types.create');
    }

    /**
     * Store a newly created TimeWorkType in storage.
     *
     * @param  \App\Http\Requests\StoreTimeWorkTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeWorkTypesRequest $request)
    {
        if (! Gate::allows('time_work_type_create')) {
            return abort(401);
        }
        $time_work_type = TimeWorkType::create($request->all());



        return redirect()->route('admin.time_work_types.index');
    }


    /**
     * Show the form for editing TimeWorkType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('time_work_type_edit')) {
            return abort(401);
        }
        $time_work_type = TimeWorkType::findOrFail($id);

        return view('admin.time_work_types.edit', compact('time_work_type'));
    }

    /**
     * Update TimeWorkType in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeWorkTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeWorkTypesRequest $request, $id)
    {
        if (! Gate::allows('time_work_type_edit')) {
            return abort(401);
        }
        $time_work_type = TimeWorkType::findOrFail($id);
        $time_work_type->update($request->all());



        return redirect()->route('admin.time_work_types.index');
    }


    /**
     * Display TimeWorkType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('time_work_type_view')) {
            return abort(401);
        }
        $time_entries = \App\TimeEntry::where('work_type_id', $id)->get();$income_categories = \App\IncomeCategory::where('project_type_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('transaction_type_id', $id)->get();$expenses = \App\Expense::where('transaction_type_id', $id)->get();$incomes = \App\Income::where('project_type_id', $id)->get();

        $time_work_type = TimeWorkType::findOrFail($id);

        return view('admin.time_work_types.show', compact('time_work_type', 'time_entries', 'income_categories', 'expense_categories', 'expenses', 'incomes'));
    }


    /**
     * Remove TimeWorkType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('time_work_type_delete')) {
            return abort(401);
        }
        $time_work_type = TimeWorkType::findOrFail($id);
        $time_work_type->delete();

        return redirect()->route('admin.time_work_types.index');
    }

    /**
     * Delete all selected TimeWorkType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('time_work_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TimeWorkType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
