<?php

namespace App\Http\Controllers\Admin;

use App\DeductionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeductionItemsRequest;
use App\Http\Requests\Admin\UpdateDeductionItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DeductionItemsController extends Controller
{
    /**
     * Display a listing of DeductionItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('deduction_item_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('deduction_item_delete')) {
                return abort(401);
            }
            $deduction_items = DeductionItem::onlyTrashed()->get();
        } else {
            $deduction_items = DeductionItem::all();
        }

        return view('admin.deduction_items.index', compact('deduction_items'));
    }

    /**
     * Show the form for creating new DeductionItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('deduction_item_create')) {
            return abort(401);
        }
        
        $item_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.deduction_items.create', compact('item_numbers'));
    }

    /**
     * Store a newly created DeductionItem in storage.
     *
     * @param  \App\Http\Requests\StoreDeductionItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeductionItemsRequest $request)
    {
        if (! Gate::allows('deduction_item_create')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::create($request->all());



        return redirect()->route('admin.deduction_items.index');
    }


    /**
     * Show the form for editing DeductionItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('deduction_item_edit')) {
            return abort(401);
        }
        
        $item_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');

        $deduction_item = DeductionItem::findOrFail($id);

        return view('admin.deduction_items.edit', compact('deduction_item', 'item_numbers'));
    }

    /**
     * Update DeductionItem in storage.
     *
     * @param  \App\Http\Requests\UpdateDeductionItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeductionItemsRequest $request, $id)
    {
        if (! Gate::allows('deduction_item_edit')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::findOrFail($id);
        $deduction_item->update($request->all());



        return redirect()->route('admin.deduction_items.index');
    }


    /**
     * Display DeductionItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('deduction_item_view')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::findOrFail($id);

        return view('admin.deduction_items.show', compact('deduction_item'));
    }


    /**
     * Remove DeductionItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('deduction_item_delete')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::findOrFail($id);
        $deduction_item->delete();

        return redirect()->route('admin.deduction_items.index');
    }

    /**
     * Delete all selected DeductionItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('deduction_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DeductionItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore DeductionItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('deduction_item_delete')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::onlyTrashed()->findOrFail($id);
        $deduction_item->restore();

        return redirect()->route('admin.deduction_items.index');
    }

    /**
     * Permanently delete DeductionItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('deduction_item_delete')) {
            return abort(401);
        }
        $deduction_item = DeductionItem::onlyTrashed()->findOrFail($id);
        $deduction_item->forceDelete();

        return redirect()->route('admin.deduction_items.index');
    }
}
