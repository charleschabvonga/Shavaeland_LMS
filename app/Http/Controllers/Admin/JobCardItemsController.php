<?php

namespace App\Http\Controllers\Admin;

use App\JobCardItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobCardItemsRequest;
use App\Http\Requests\Admin\UpdateJobCardItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class JobCardItemsController extends Controller
{
    /**
     * Display a listing of JobCardItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('job_card_item_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('job_card_item_delete')) {
                return abort(401);
            }
            $job_card_items = JobCardItem::onlyTrashed()->get();
        } else {
            $job_card_items = JobCardItem::all();
        }

        return view('admin.job_card_items.index', compact('job_card_items'));
    }

    /**
     * Show the form for creating new JobCardItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('job_card_item_create')) {
            return abort(401);
        }
        
        $job_card_items = \App\InhouseJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');
        $client_job_card_numbers = \App\ClientJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.job_card_items.create', compact('job_card_items', 'client_job_card_numbers'));
    }

    /**
     * Store a newly created JobCardItem in storage.
     *
     * @param  \App\Http\Requests\StoreJobCardItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobCardItemsRequest $request)
    {
        if (! Gate::allows('job_card_item_create')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::create($request->all());



        return redirect()->route('admin.job_card_items.index');
    }


    /**
     * Show the form for editing JobCardItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('job_card_item_edit')) {
            return abort(401);
        }
        
        $job_card_items = \App\InhouseJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');
        $client_job_card_numbers = \App\ClientJobCard::get()->pluck('job_card_number', 'id')->prepend(trans('global.app_please_select'), '');

        $job_card_item = JobCardItem::findOrFail($id);

        return view('admin.job_card_items.edit', compact('job_card_item', 'job_card_items', 'client_job_card_numbers'));
    }

    /**
     * Update JobCardItem in storage.
     *
     * @param  \App\Http\Requests\UpdateJobCardItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobCardItemsRequest $request, $id)
    {
        if (! Gate::allows('job_card_item_edit')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::findOrFail($id);
        $job_card_item->update($request->all());



        return redirect()->route('admin.job_card_items.index');
    }


    /**
     * Display JobCardItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('job_card_item_view')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::findOrFail($id);

        return view('admin.job_card_items.show', compact('job_card_item'));
    }


    /**
     * Remove JobCardItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('job_card_item_delete')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::findOrFail($id);
        $job_card_item->delete();

        return redirect()->route('admin.job_card_items.index');
    }

    /**
     * Delete all selected JobCardItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('job_card_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = JobCardItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore JobCardItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('job_card_item_delete')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::onlyTrashed()->findOrFail($id);
        $job_card_item->restore();

        return redirect()->route('admin.job_card_items.index');
    }

    /**
     * Permanently delete JobCardItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('job_card_item_delete')) {
            return abort(401);
        }
        $job_card_item = JobCardItem::onlyTrashed()->findOrFail($id);
        $job_card_item->forceDelete();

        return redirect()->route('admin.job_card_items.index');
    }
}
