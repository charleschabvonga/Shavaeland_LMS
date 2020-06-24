<?php

namespace App\Http\Controllers\Admin;

use App\OvertimeAndBonusItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOvertimeAndBonusItemsRequest;
use App\Http\Requests\Admin\UpdateOvertimeAndBonusItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OvertimeAndBonusItemsController extends Controller
{
    /**
     * Display a listing of OvertimeAndBonusItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('overtime_and_bonus_item_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('overtime_and_bonus_item_delete')) {
                return abort(401);
            }
            $overtime_and_bonus_items = OvertimeAndBonusItem::onlyTrashed()->get();
        } else {
            $overtime_and_bonus_items = OvertimeAndBonusItem::all();
        }

        return view('admin.overtime_and_bonus_items.index', compact('overtime_and_bonus_items'));
    }

    /**
     * Show the form for creating new OvertimeAndBonusItem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('overtime_and_bonus_item_create')) {
            return abort(401);
        }
        
        $item_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.overtime_and_bonus_items.create', compact('item_numbers'));
    }

    /**
     * Store a newly created OvertimeAndBonusItem in storage.
     *
     * @param  \App\Http\Requests\StoreOvertimeAndBonusItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOvertimeAndBonusItemsRequest $request)
    {
        if (! Gate::allows('overtime_and_bonus_item_create')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::create($request->all());



        return redirect()->route('admin.overtime_and_bonus_items.index');
    }


    /**
     * Show the form for editing OvertimeAndBonusItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('overtime_and_bonus_item_edit')) {
            return abort(401);
        }
        
        $item_numbers = \App\Payslip::get()->pluck('payslip_number', 'id')->prepend(trans('global.app_please_select'), '');

        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);

        return view('admin.overtime_and_bonus_items.edit', compact('overtime_and_bonus_item', 'item_numbers'));
    }

    /**
     * Update OvertimeAndBonusItem in storage.
     *
     * @param  \App\Http\Requests\UpdateOvertimeAndBonusItemsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOvertimeAndBonusItemsRequest $request, $id)
    {
        if (! Gate::allows('overtime_and_bonus_item_edit')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);
        $overtime_and_bonus_item->update($request->all());



        return redirect()->route('admin.overtime_and_bonus_items.index');
    }


    /**
     * Display OvertimeAndBonusItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('overtime_and_bonus_item_view')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);

        return view('admin.overtime_and_bonus_items.show', compact('overtime_and_bonus_item'));
    }


    /**
     * Remove OvertimeAndBonusItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('overtime_and_bonus_item_delete')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::findOrFail($id);
        $overtime_and_bonus_item->delete();

        return redirect()->route('admin.overtime_and_bonus_items.index');
    }

    /**
     * Delete all selected OvertimeAndBonusItem at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('overtime_and_bonus_item_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = OvertimeAndBonusItem::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore OvertimeAndBonusItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('overtime_and_bonus_item_delete')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::onlyTrashed()->findOrFail($id);
        $overtime_and_bonus_item->restore();

        return redirect()->route('admin.overtime_and_bonus_items.index');
    }

    /**
     * Permanently delete OvertimeAndBonusItem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('overtime_and_bonus_item_delete')) {
            return abort(401);
        }
        $overtime_and_bonus_item = OvertimeAndBonusItem::onlyTrashed()->findOrFail($id);
        $overtime_and_bonus_item->forceDelete();

        return redirect()->route('admin.overtime_and_bonus_items.index');
    }
}
