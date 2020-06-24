<?php

namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeEntriesRequest;
use App\Http\Requests\Admin\UpdateTimeEntriesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TimeEntriesController extends Controller
{
    /**
     * Display a listing of TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('time_entry_access')) {
            return abort(401);
        }


                $time_entries = TimeEntry::all();

        return view('admin.time_entries.index', compact('time_entries'));
    }

    /**
     * Show the form for creating new TimeEntry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('time_entry_create')) {
            return abort(401);
        }
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = TimeEntry::$enum_status;

        $operation = TimeEntry::all();
        $operation_id = $operation->pluck('id')->last();
        $operation_number = 'PRO-'.($operation_id + 1000);
            
        return view('admin.time_entries.create', compact('operation_number', 'enum_status', 'work_types', 'clients'));
    }

    /**
     * Store a newly created TimeEntry in storage.
     *
     * @param  \App\Http\Requests\StoreTimeEntriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeEntriesRequest $request)
    {
        if (! Gate::allows('time_entry_create')) {
            return abort(401);
        }
        $time_entry = TimeEntry::create($request->all());
        $time_entry->work_type()->sync(array_filter((array)$request->input('work_type')));



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Show the form for editing TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = TimeEntry::$enum_status;
            
        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.edit', compact('time_entry', 'enum_status', 'work_types', 'clients'));
    }

    /**
     * Update TimeEntry in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeEntriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeEntriesRequest $request, $id)
    {
        if (! Gate::allows('time_entry_edit')) {
            return abort(401);
        }
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->update($request->all());
        $time_entry->work_type()->sync(array_filter((array)$request->input('work_type')));



        return redirect()->route('admin.time_entries.index');
    }


    /**
     * Display TimeEntry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('time_entry_view')) {
            return abort(401);
        }
        
        $work_types = \App\TimeWorkType::get()->pluck('name', 'id');

        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$job_requests = \App\JobRequest::where('project_number_id', $id)->get();$air_freights = \App\AirFreight::where('project_number_id', $id)->get();$sea_freights = \App\SeaFreight::where('project_number_id', $id)->get();$rail_freights = \App\RailFreight::where('project_number_id', $id)->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('project_number_id', $id)->get();$road_freights = \App\RoadFreight::where('project_number_id', $id)->get();$income_categories = \App\IncomeCategory::where('project_number_id', $id)->get();$releasings = \App\Releasing::where('project_number_id', $id)->get();$receivings = \App\Receiving::where('project_number_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('transaction_number_id', $id)->get();$debit_notes = \App\DebitNote::where('transaction_number_id', $id)->get();$credit_notes = \App\CreditNote::where('project_number_id', $id)->get();$client_job_cards = \App\ClientJobCard::where('project_number_id', $id)->get();$inhouse_job_cards = \App\InhouseJobCard::where('project_number_id', $id)->get();$expenses = \App\Expense::where('transaction_number_id', $id)->get();$incomes = \App\Income::where('project_number_id', $id)->get();

        $time_entry = TimeEntry::findOrFail($id);

        return view('admin.time_entries.show', compact('time_entry', 'job_requests', 'air_freights', 'sea_freights', 'rail_freights', 'clearance_and_forwardings', 'road_freights', 'income_categories', 'releasings', 'receivings', 'expense_categories', 'debit_notes', 'credit_notes', 'client_job_cards', 'inhouse_job_cards', 'expenses', 'incomes'));
    }


    /**
     * Remove TimeEntry from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('time_entry_delete')) {
            return abort(401);
        }
        $time_entry = TimeEntry::findOrFail($id);
        $time_entry->delete();

        return redirect()->route('admin.time_entries.index');
    }

    /**
     * Delete all selected TimeEntry at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('time_entry_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TimeEntry::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
