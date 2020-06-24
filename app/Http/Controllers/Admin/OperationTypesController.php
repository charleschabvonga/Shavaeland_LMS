<?php

namespace App\Http\Controllers\Admin;

use App\OperationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOperationTypesRequest;
use App\Http\Requests\Admin\UpdateOperationTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OperationTypesController extends Controller
{
    /**
     * Display a listing of OperationType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('operation_type_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('operation_type_delete')) {
                return abort(401);
            }
            $operation_types = OperationType::onlyTrashed()->get();
        } else {
            $operation_types = OperationType::all();
        }

        return view('admin.operation_types.index', compact('operation_types'));
    }

    /**
     * Show the form for creating new OperationType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('operation_type_create')) {
            return abort(401);
        }
        return view('admin.operation_types.create');
    }

    /**
     * Store a newly created OperationType in storage.
     *
     * @param  \App\Http\Requests\StoreOperationTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperationTypesRequest $request)
    {
        if (! Gate::allows('operation_type_create')) {
            return abort(401);
        }
        $operation_type = OperationType::create($request->all());



        return redirect()->route('admin.operation_types.index');
    }


    /**
     * Show the form for editing OperationType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('operation_type_edit')) {
            return abort(401);
        }
        $operation_type = OperationType::findOrFail($id);

        return view('admin.operation_types.edit', compact('operation_type'));
    }

    /**
     * Update OperationType in storage.
     *
     * @param  \App\Http\Requests\UpdateOperationTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOperationTypesRequest $request, $id)
    {
        if (! Gate::allows('operation_type_edit')) {
            return abort(401);
        }
        $operation_type = OperationType::findOrFail($id);
        $operation_type->update($request->all());



        return redirect()->route('admin.operation_types.index');
    }


    /**
     * Display OperationType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('operation_type_view')) {
            return abort(401);
        }
        $time_work_types = \App\TimeWorkType::where('operation_type_id', $id)->get();$time_entries = \App\TimeEntry::where('operation_type_id', $id)->get();$expenses = \App\Expense::where('operation_type_id', $id)->get();$incomes = \App\Income::where('operation_type_id', $id)->get();

        $operation_type = OperationType::findOrFail($id);

        return view('admin.operation_types.show', compact('operation_type', 'time_work_types', 'time_entries', 'expenses', 'incomes'));
    }


    /**
     * Remove OperationType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('operation_type_delete')) {
            return abort(401);
        }
        $operation_type = OperationType::findOrFail($id);
        $operation_type->delete();

        return redirect()->route('admin.operation_types.index');
    }

    /**
     * Delete all selected OperationType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('operation_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = OperationType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore OperationType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('operation_type_delete')) {
            return abort(401);
        }
        $operation_type = OperationType::onlyTrashed()->findOrFail($id);
        $operation_type->restore();

        return redirect()->route('admin.operation_types.index');
    }

    /**
     * Permanently delete OperationType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('operation_type_delete')) {
            return abort(401);
        }
        $operation_type = OperationType::onlyTrashed()->findOrFail($id);
        $operation_type->forceDelete();

        return redirect()->route('admin.operation_types.index');
    }
}
