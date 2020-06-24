<?php

namespace App\Http\Controllers\Admin;

use App\EmergencyContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmergencyContactsRequest;
use App\Http\Requests\Admin\UpdateEmergencyContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class EmergencyContactsController extends Controller
{
    /**
     * Display a listing of EmergencyContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('emergency_contact_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('emergency_contact_delete')) {
                return abort(401);
            }
            $emergency_contacts = EmergencyContact::onlyTrashed()->get();
        } else {
            $emergency_contacts = EmergencyContact::all();
        }

        return view('admin.emergency_contacts.index', compact('emergency_contacts'));
    }

    /**
     * Show the form for creating new EmergencyContact.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('emergency_contact_create')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.emergency_contacts.create', compact('employee_names'));
    }

    /**
     * Store a newly created EmergencyContact in storage.
     *
     * @param  \App\Http\Requests\StoreEmergencyContactsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmergencyContactsRequest $request)
    {
        if (! Gate::allows('emergency_contact_create')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::create($request->all());



        return redirect()->route('admin.emergency_contacts.index');
    }


    /**
     * Show the form for editing EmergencyContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('emergency_contact_edit')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $emergency_contact = EmergencyContact::findOrFail($id);

        return view('admin.emergency_contacts.edit', compact('emergency_contact', 'employee_names'));
    }

    /**
     * Update EmergencyContact in storage.
     *
     * @param  \App\Http\Requests\UpdateEmergencyContactsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmergencyContactsRequest $request, $id)
    {
        if (! Gate::allows('emergency_contact_edit')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::findOrFail($id);
        $emergency_contact->update($request->all());



        return redirect()->route('admin.emergency_contacts.index');
    }


    /**
     * Display EmergencyContact.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('emergency_contact_view')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::findOrFail($id);

        return view('admin.emergency_contacts.show', compact('emergency_contact'));
    }


    /**
     * Remove EmergencyContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('emergency_contact_delete')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::findOrFail($id);
        $emergency_contact->delete();

        return redirect()->route('admin.emergency_contacts.index');
    }

    /**
     * Delete all selected EmergencyContact at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('emergency_contact_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = EmergencyContact::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore EmergencyContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('emergency_contact_delete')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::onlyTrashed()->findOrFail($id);
        $emergency_contact->restore();

        return redirect()->route('admin.emergency_contacts.index');
    }

    /**
     * Permanently delete EmergencyContact from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('emergency_contact_delete')) {
            return abort(401);
        }
        $emergency_contact = EmergencyContact::onlyTrashed()->findOrFail($id);
        $emergency_contact->forceDelete();

        return redirect()->route('admin.emergency_contacts.index');
    }
}
