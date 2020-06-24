<?php

namespace App\Http\Controllers\Admin;

use App\TimeProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeProjectsRequest;
use App\Http\Requests\Admin\UpdateTimeProjectsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TimeProjectsController extends Controller
{
    /**
     * Display a listing of TimeProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('time_project_access')) {
            return abort(401);
        }


                $time_projects = TimeProject::all();

        return view('admin.time_projects.index', compact('time_projects'));
    }

    /**
     * Show the form for creating new TimeProject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('time_project_create')) {
            return abort(401);
        }        $enum_client_type = TimeProject::$enum_client_type;
            
        return view('admin.time_projects.create', compact('enum_client_type'));
    }

    /**
     * Store a newly created TimeProject in storage.
     *
     * @param  \App\Http\Requests\StoreTimeProjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeProjectsRequest $request)
    {
        if (! Gate::allows('time_project_create')) {
            return abort(401);
        }
        $time_project = TimeProject::create($request->all());

        foreach ($request->input('client_contacts', []) as $data) {
            $time_project->client_contacts()->create($data);
        }


        return redirect()->route('admin.time_projects.index');
    }


    /**
     * Show the form for editing TimeProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('time_project_edit')) {
            return abort(401);
        }        $enum_client_type = TimeProject::$enum_client_type;
            
        $time_project = TimeProject::findOrFail($id);

        return view('admin.time_projects.edit', compact('time_project', 'enum_client_type'));
    }

    /**
     * Update TimeProject in storage.
     *
     * @param  \App\Http\Requests\UpdateTimeProjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTimeProjectsRequest $request, $id)
    {
        if (! Gate::allows('time_project_edit')) {
            return abort(401);
        }
        $time_project = TimeProject::findOrFail($id);
        $time_project->update($request->all());

        $clientContacts           = $time_project->client_contacts;
        $currentClientContactData = [];
        foreach ($request->input('client_contacts', []) as $index => $data) {
            if (is_integer($index)) {
                $time_project->client_contacts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentClientContactData[$id] = $data;
            }
        }
        foreach ($clientContacts as $item) {
            if (isset($currentClientContactData[$item->id])) {
                $item->update($currentClientContactData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.time_projects.index');
    }


    /**
     * Display TimeProject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('time_project_view')) {
            return abort(401);
        }
        $client_contacts = \App\ClientContact::where('company_name_id', $id)->get();$client_accounts = \App\ClientAccount::where('client_id', $id)->get();$quotations = \App\Quotation::where('client_id', $id)->get();$client_vehicles = \App\ClientVehicle::where('client_id', $id)->get();$schedule_of_services = \App\ScheduleOfService::where('client_id', $id)->get();$air_freights = \App\AirFreight::where('client_id', $id)->get();$sea_freights = \App\SeaFreight::where('client_id', $id)->get();$rail_freights = \App\RailFreight::where('client_id', $id)->get();$time_entries = \App\TimeEntry::where('client_id', $id)->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('client_id', $id)->get();$road_freights = \App\RoadFreight::where('client_id', $id)->get();$job_requests = \App\JobRequest::where('client_id', $id)->get();$client_job_cards = \App\ClientJobCard::where('client_id', $id)->get();$releasings = \App\Releasing::where('client_id', $id)->get();$receivings = \App\Receiving::where('client_id', $id)->get();$bank_payments = \App\BankPayment::where('client_id', $id)->get();$income_categories = \App\IncomeCategory::where('client_id', $id)->get();$credit_notes = \App\CreditNote::where('client_id', $id)->get();$incomes = \App\Income::where('client_id', $id)->get();$vendor_bank_payments = \App\VendorBankPayment::where('client_id', $id)->get();$expenses = \App\Expense::where('client_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('client_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('client_id', $id)->get();

        $time_project = TimeProject::findOrFail($id);

        return view('admin.time_projects.show', compact('time_project', 'client_contacts', 'client_accounts', 'quotations', 'client_vehicles', 'schedule_of_services', 'air_freights', 'sea_freights', 'rail_freights', 'time_entries', 'clearance_and_forwardings', 'road_freights', 'job_requests', 'client_job_cards', 'releasings', 'receivings', 'bank_payments', 'income_categories', 'credit_notes', 'incomes', 'vendor_bank_payments', 'expenses', 'delivery_instructions', 'loading_instructions'));
    }


    /**
     * Remove TimeProject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('time_project_delete')) {
            return abort(401);
        }
        $time_project = TimeProject::findOrFail($id);
        $time_project->delete();

        return redirect()->route('admin.time_projects.index');
    }

    /**
     * Delete all selected TimeProject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('time_project_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TimeProject::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
