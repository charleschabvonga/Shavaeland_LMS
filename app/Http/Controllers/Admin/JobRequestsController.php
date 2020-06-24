<?php

namespace App\Http\Controllers\Admin;

use App\JobRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobRequestsRequest;
use App\Http\Requests\Admin\UpdateJobRequestsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class JobRequestsController extends Controller
{
    /**
     * Display a listing of JobRequest.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('job_request_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('job_request_delete')) {
                return abort(401);
            }
            $job_requests = JobRequest::onlyTrashed()->get();
        } else {
            $job_requests = JobRequest::all();
        }

        return view('admin.job_requests.index', compact('job_requests'));
    }

    /**
     * Show the form for creating new JobRequest.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('job_request_create')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $workshop_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = JobRequest::$enum_vehicle_type;
        $enum_status = JobRequest::$enum_status;

        $job_request = JobRequest::all();
        $job_request_id = $job_request->pluck('id')->last();
        $job_request_number = 'JRN-'.($job_request_id + 1000);
            
        return view('admin.job_requests.create', compact('job_request_number', 'enum_vehicle_type', 'enum_status', 'project_numbers', 'workshop_managers', 'clients', 'contact_people'));
    }

    /**
     * Store a newly created JobRequest in storage.
     *
     * @param  \App\Http\Requests\StoreJobRequestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequestsRequest $request)
    {
        if (! Gate::allows('job_request_create')) {
            return abort(401);
        }
        $job_request = JobRequest::create($request->all());



        return redirect()->route('admin.job_requests.index');
    }


    /**
     * Show the form for editing JobRequest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('job_request_edit')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $workshop_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_vehicle_type = JobRequest::$enum_vehicle_type;
                    $enum_status = JobRequest::$enum_status;
            
        $job_request = JobRequest::findOrFail($id);

        return view('admin.job_requests.edit', compact('job_request', 'enum_vehicle_type', 'enum_status', 'project_numbers', 'workshop_managers', 'clients', 'contact_people'));
    }

    /**
     * Update JobRequest in storage.
     *
     * @param  \App\Http\Requests\UpdateJobRequestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequestsRequest $request, $id)
    {
        if (! Gate::allows('job_request_edit')) {
            return abort(401);
        }
        $job_request = JobRequest::findOrFail($id);
        $job_request->update($request->all());



        return redirect()->route('admin.job_requests.index');
    }


     /**
     * Display JobRequest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('job_request_view')) {
            return abort(401);
        }
        
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $workshop_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');$client_job_cards = \App\ClientJobCard::where('job_request_number_id', $id)->get();$client_job_cards = \App\ClientJobCard::where('client_vehicle_reg_no_id', $id)->get();

        $job_request = JobRequest::findOrFail($id);

        return view('admin.job_requests.show', compact('job_request', 'client_job_cards', 'client_job_cards'));
    }


    /**
     * Remove JobRequest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('job_request_delete')) {
            return abort(401);
        }
        $job_request = JobRequest::findOrFail($id);
        $job_request->delete();

        return redirect()->route('admin.job_requests.index');
    }

    /**
     * Delete all selected JobRequest at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('job_request_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = JobRequest::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore JobRequest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('job_request_delete')) {
            return abort(401);
        }
        $job_request = JobRequest::onlyTrashed()->findOrFail($id);
        $job_request->restore();

        return redirect()->route('admin.job_requests.index');
    }

    /**
     * Permanently delete JobRequest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('job_request_delete')) {
            return abort(401);
        }
        $job_request = JobRequest::onlyTrashed()->findOrFail($id);
        $job_request->forceDelete();

        return redirect()->route('admin.job_requests.index');
    }
}
