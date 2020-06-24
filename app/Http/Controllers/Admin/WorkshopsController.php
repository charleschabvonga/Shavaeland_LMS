<?php

namespace App\Http\Controllers\Admin;

use App\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkshopsRequest;
use App\Http\Requests\Admin\UpdateWorkshopsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WorkshopsController extends Controller
{
    /**
     * Display a listing of Workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('workshop_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('workshop_delete')) {
                return abort(401);
            }
            $workshops = Workshop::onlyTrashed()->get();
        } else {
            $workshops = Workshop::all();
        }

        return view('admin.workshops.index', compact('workshops'));
    }

    /**
     * Show the form for creating new Workshop.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('workshop_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.workshops.create', compact('vendors'));
    }

    /**
     * Store a newly created Workshop in storage.
     *
     * @param  \App\Http\Requests\StoreWorkshopsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkshopsRequest $request)
    {
        if (! Gate::allows('workshop_create')) {
            return abort(401);
        }
        $workshop = Workshop::create($request->all());



        return redirect()->route('admin.workshops.index');
    }


    /**
     * Show the form for editing Workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('workshop_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $workshop = Workshop::findOrFail($id);

        return view('admin.workshops.edit', compact('workshop', 'vendors'));
    }

    /**
     * Update Workshop in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkshopsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkshopsRequest $request, $id)
    {
        if (! Gate::allows('workshop_edit')) {
            return abort(401);
        }
        $workshop = Workshop::findOrFail($id);
        $workshop->update($request->all());



        return redirect()->route('admin.workshops.index');
    }


    /**
     * Display Workshop.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('workshop_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$parts = \App\Part::where('repair_center_id', $id)->get();$parts_acquireds = \App\PartsAcquired::where('repair_center_id', $id)->get();$client_job_cards = \App\ClientJobCard::where('repair_center_id', $id)->get();$inhouse_job_cards = \App\InhouseJobCard::where('repair_center_id', $id)->get();

        $workshop = Workshop::findOrFail($id);

        return view('admin.workshops.show', compact('workshop', 'parts', 'parts_acquireds', 'client_job_cards', 'inhouse_job_cards'));
    }


    /**
     * Remove Workshop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('workshop_delete')) {
            return abort(401);
        }
        $workshop = Workshop::findOrFail($id);
        $workshop->delete();

        return redirect()->route('admin.workshops.index');
    }

    /**
     * Delete all selected Workshop at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('workshop_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Workshop::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Workshop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('workshop_delete')) {
            return abort(401);
        }
        $workshop = Workshop::onlyTrashed()->findOrFail($id);
        $workshop->restore();

        return redirect()->route('admin.workshops.index');
    }

    /**
     * Permanently delete Workshop from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('workshop_delete')) {
            return abort(401);
        }
        $workshop = Workshop::onlyTrashed()->findOrFail($id);
        $workshop->forceDelete();

        return redirect()->route('admin.workshops.index');
    }

    public function download($workshop_id)
    {
        $workshop = Workshop::findOrFail($workshop_id);
        $pdf = \PDF::loadView('admin.workshop.pdf', compact('workshop'));
        return $pdf->stream('workshop.pdf');
    }
}
