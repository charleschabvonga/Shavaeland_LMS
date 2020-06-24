<?php

namespace App\Http\Controllers\Admin;

use App\ClientJobCard;
use App\Workshop;
use App\Part;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientJobCardsRequest;
use App\Http\Requests\Admin\UpdateClientJobCardsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientJobCardsController extends Controller
{
    /**
     * Display a listing of ClientJobCard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('client_job_card_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('client_job_card_delete')) {
                return abort(401);
            }
            $client_job_cards = ClientJobCard::onlyTrashed()->get();
        } else {
            $client_job_cards = ClientJobCard::all();
        }

        return view('admin.client_job_cards.index', compact('client_job_cards'));
    }

    /**
     * Show the form for creating new ClientJobCard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('client_job_card_create')) {
            return abort(401);
        }
        
        $job_request_numbers = \App\JobRequest::get()->pluck('job_request_number', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $client_vehicle_reg_nos = \App\JobRequest::get()->pluck('vehicle_registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ClientJobCard::$enum_status;
        $enum_job_type = ClientJobCard::$enum_job_type;

        $workshops = Workshop::all();
        $parts = Part::all();
        $unit = UnitMeasurement::all();

        $job_card = ClientJobCard::all();
        $job_card_id = $job_card->pluck('id')->last();
        $job_card_number = 'CJCN-'.($job_card_id + 1000);
            
        return view('admin.client_job_cards.create', compact('unit', 'workshops', 'parts', 'job_card_number','enum_status', 'enum_job_type', 'job_request_numbers', 'project_numbers', 'clients', 'contact_people', 'repair_centers', 'technicians', 'client_vehicle_reg_nos'));
    }

    /**
     * Store a newly created ClientJobCard in storage.
     *
     * @param  \App\Http\Requests\StoreClientJobCardsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientJobCardsRequest $request)
    {
        if (! Gate::allows('client_job_card_create')) {
            return abort(401);
        }
        $client_job_card = ClientJobCard::create($request->all());
        $client_job_card->technician()->sync(array_filter((array)$request->input('technician')));

        foreach ($request->input('job_card_items', []) as $data) {
            $client_job_card->job_card_items()->create($data);
        }

        for ($i=0; $i < count($request->workshop); $i++) {
            if (isset($request->part[$i]) && isset($request->qty[$i]) && isset($request->price[$i])) {
                $client_job_card->job_card_items()->create([
                    'job_card_number_id' => $client_job_card->id,
                    'workshop' => $request->workshop[$i],
                    'part' => $request->part[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'price' => $request->price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }


        return redirect()->route('admin.client_job_cards.index');
    }


    /**
     * Show the form for editing ClientJobCard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('client_job_card_edit')) {
            return abort(401);
        }
        
        $job_request_numbers = \App\JobRequest::get()->pluck('job_request_number', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $client_vehicle_reg_nos = \App\JobRequest::get()->pluck('vehicle_registration_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = ClientJobCard::$enum_status;
                    $enum_job_type = ClientJobCard::$enum_job_type;
            
        $client_job_card = ClientJobCard::findOrFail($id);

        return view('admin.client_job_cards.edit', compact('client_job_card', 'enum_status', 'enum_job_type', 'job_request_numbers', 'project_numbers', 'clients', 'contact_people', 'repair_centers', 'technicians', 'client_vehicle_reg_nos'));
    }

    /**
     * Update ClientJobCard in storage.
     *
     * @param  \App\Http\Requests\UpdateClientJobCardsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientJobCardsRequest $request, $id)
    {
        if (! Gate::allows('client_job_card_edit')) {
            return abort(401);
        }
        $client_job_card = ClientJobCard::findOrFail($id);
        $client_job_card->update($request->all());
        $client_job_card->technician()->sync(array_filter((array)$request->input('technician')));

        $jobCardItems           = $client_job_card->job_card_items;
        $currentJobCardItemData = [];
        foreach ($request->input('job_card_items', []) as $index => $data) {
            if (is_integer($index)) {
                $client_job_card->job_card_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentJobCardItemData[$id] = $data;
            }
        }
        foreach ($jobCardItems as $item) {
            if (isset($currentJobCardItemData[$item->id])) {
                $item->update($currentJobCardItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.client_job_cards.index');
    }


    /**
     * Display ClientJobCard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('client_job_card_view')) {
            return abort(401);
        }
        
        $job_request_numbers = \App\JobRequest::get()->pluck('job_request_number', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $technicians = \App\Employee::get()->pluck('name', 'id');

        $client_vehicle_reg_nos = \App\JobRequest::get()->pluck('vehicle_registration_number', 'id')->prepend(trans('global.app_please_select'), '');$job_card_items = \App\JobCardItem::where('client_job_card_number_id', $id)->get();

        $client_job_card = ClientJobCard::findOrFail($id);

        return view('admin.client_job_cards.show', compact('client_job_card', 'job_card_items'));
    }


    /**
     * Remove ClientJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('client_job_card_delete')) {
            return abort(401);
        }
        $client_job_card = ClientJobCard::findOrFail($id);
        $client_job_card->delete();

        return redirect()->route('admin.client_job_cards.index');
    }

    /**
     * Delete all selected ClientJobCard at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('client_job_card_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ClientJobCard::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ClientJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('client_job_card_delete')) {
            return abort(401);
        }
        $client_job_card = ClientJobCard::onlyTrashed()->findOrFail($id);
        $client_job_card->restore();

        return redirect()->route('admin.client_job_cards.index');
    }

    /**
     * Permanently delete ClientJobCard from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('client_job_card_delete')) {
            return abort(401);
        }
        $client_job_card = ClientJobCard::onlyTrashed()->findOrFail($id);
        $client_job_card->forceDelete();

        return redirect()->route('admin.client_job_cards.index');
    }

    public function download($client_job_card_id)
    {
        $client_job_card = ClientJobCard::findOrFail($client_job_card_id);
        $pdf = \PDF::loadView('admin.client_job_cards.pdf', compact('client_job_card'));
        return $pdf->stream('client_job_card.pdf');
    }
}
