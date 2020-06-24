<?php

namespace App\Http\Controllers\Admin;

use App\ReceivedItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreReceivedItemsRequest;
use App\Http\Requests\Admin\UpdateReceivedItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ReceivedItemsController extends Controller
{
    /**
     * Display a listing of ReceivedItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('received_item_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('received_item_delete')) {
                return abort(401);
            }
            $received_items = ReceivedItem::onlyTrashed()->get();
        } else {
            $received_items = ReceivedItem::all();
        }

        return view('admin.received_items.index', compact('received_items'));
    }

    /**
     * Show the form for creating new ReceivedItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('received_item_create')) {
            return abort(401);
        }
        
        $receipt_numbers = \App\Receiving::get()->pluck('receipt_number', 'id')->prepend(trans('global.app_please_select'), '');
        $release_numbers = \App\Releasing::get()->pluck('release_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.received_items.create', compact('receipt_numbers', 'release_numbers'));
    }

    /**
     * Store a newly created ReceivedItem in storage.
     *
     * @param  \App\Http\Requests\StoreReceivedItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReceivedItemsRequest $request)
    {
        if (! Gate::allows('received_item_create')) {
            return abort(401);
        }
        $received_item = ReceivedItem::create($request->all());



        return redirect()->route('admin.received_items.index');
    }


    /**
     * Show the form for editing ReceivedItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('received_item_edit')) {
            return abort(401);
        }
        
        $receipt_numbers = \App\Receiving::get()->pluck('receipt_number', 'id')->prepend(trans('global.app_please_select'), '');
        $release_numbers = \App\Releasing::get()->pluck('release_number', 'id')->prepend(trans('global.app_please_select'), '');

        $received_item = ReceivedItem::findOrFail($id);

        return view('admin.received_items.edit', compact('received_item', 'receipt_numbers', 'release_numbers'));
    }

    /**
     * Update ReceivedItem in storage.
     *
     * @param  \App\Http\Requests\UpdateReceivedItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReceivedItemsRequest $request, $id)
    {
        if (! Gate::allows('received_item_edit')) {
            return abort(401);
        }
        $received_item = ReceivedItem::findOrFail($id);
        $received_item->update($request->all());



        return redirect()->route('admin.received_items.index');
    }


    /**
     * Display ReceivedItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('received_item_view')) {
            return abort(401);
        }
        $received_item = ReceivedItem::findOrFail($id);

        return view('admin.received_items.show', compact('received_item'));
    }


    /**
     * Remove ReceivedItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('received_item_delete')) {
            return abort(401);
        }
        $received_item = ReceivedItem::findOrFail($id);
        $received_item->delete();

        return redirect()->route('admin.received_items.index');
    }

    /**
     * Delete all selected ReceivedItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('received_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = ReceivedItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore ReceivedItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('received_item_delete')) {
            return abort(401);
        }
        $received_item = ReceivedItem::onlyTrashed()->findOrFail($id);
        $received_item->restore();

        return redirect()->route('admin.received_items.index');
    }

    /**
     * Permanently delete ReceivedItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('received_item_delete')) {
            return abort(401);
        }
        $received_item = ReceivedItem::onlyTrashed()->findOrFail($id);
        $received_item->forceDelete();

        return redirect()->route('admin.received_items.index');
    }
}
