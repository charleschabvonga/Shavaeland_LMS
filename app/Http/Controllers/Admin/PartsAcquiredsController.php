<?php

namespace App\Http\Controllers\Admin;

use App\PartsAcquired;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartsAcquiredsRequest;
use App\Http\Requests\Admin\UpdatePartsAcquiredsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PartsAcquiredsController extends Controller
{
    /**
     * Display a listing of PartsAcquired.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('parts_acquired_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('parts_acquired_delete')) {
                return abort(401);
            }
            $parts_acquireds = PartsAcquired::onlyTrashed()->get();
        } else {
            $parts_acquireds = PartsAcquired::all();
        }

        return view('admin.parts_acquireds.index', compact('parts_acquireds'));
    }

    /**
     * Show the form for creating new PartsAcquired.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('parts_acquired_create')) {
            return abort(401);
        }
        
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $parts = \App\Part::get()->pluck('part', 'id')->prepend(trans('global.app_please_select'), '');
        $received_by = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $dispatched_by = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $units = \App\UnitMeasurement::get()->pluck('measurement_type', 'id')->prepend(trans('global.app_please_select'), '');

        $enum_transaction_type = PartsAcquired::$enum_transaction_type;

        $order = PartsAcquired::all();
        $order_id = $order->pluck('id')->last();
        $order_number = 'PON-'.($order_id + 1000);

        return view('admin.parts_acquireds.create', compact('units','order_number', 'received_by', 'dispatched_by', 'repair_centers', 'parts', 'enum_transaction_type'));
    }

    /**
     * Store a newly created PartsAcquired in storage.
     *
     * @param  \App\Http\Requests\StorePartsAcquiredsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartsAcquiredsRequest $request)
    {
        if (! Gate::allows('parts_acquired_create')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::create($request->all());



        return redirect()->route('admin.parts_acquireds.index');
    }


    /**
     * Show the form for editing PartsAcquired.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('parts_acquired_edit')) {
            return abort(401);
        }
        
        $repair_centers = \App\Workshop::get()->pluck('center_name', 'id')->prepend(trans('global.app_please_select'), '');
        $parts = \App\Part::get()->pluck('part', 'id')->prepend(trans('global.app_please_select'), '');
        $received_by = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $dispatched_by = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $units = \App\UnitMeasurement::get()->pluck('measurement_type', 'id')->prepend(trans('global.app_please_select'), '');

        $parts_acquired = PartsAcquired::findOrFail($id);

        $enum_transaction_type = PartsAcquired::$enum_transaction_type;

        return view('admin.parts_acquireds.edit', compact('units', 'received_by', 'dispatched_by', 'parts_acquired', 'repair_centers', 'parts', 'enum_transaction_type'));
    }

    /**
     * Update PartsAcquired in storage.
     *
     * @param  \App\Http\Requests\UpdatePartsAcquiredsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePartsAcquiredsRequest $request, $id)
    {
        if (! Gate::allows('parts_acquired_edit')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::findOrFail($id);
        $parts_acquired->update($request->all());



        return redirect()->route('admin.parts_acquireds.index');
    }


    /**
     * Display PartsAcquired.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('parts_acquired_view')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::findOrFail($id);

        return view('admin.parts_acquireds.show', compact('parts_acquired'));
    }


    /**
     * Remove PartsAcquired from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('parts_acquired_delete')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::findOrFail($id);
        $parts_acquired->delete();

        return redirect()->route('admin.parts_acquireds.index');
    }

    /**
     * Delete all selected PartsAcquired at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('parts_acquired_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = PartsAcquired::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore PartsAcquired from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('parts_acquired_delete')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::onlyTrashed()->findOrFail($id);
        $parts_acquired->restore();

        return redirect()->route('admin.parts_acquireds.index');
    }

    /**
     * Permanently delete PartsAcquired from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('parts_acquired_delete')) {
            return abort(401);
        }
        $parts_acquired = PartsAcquired::onlyTrashed()->findOrFail($id);
        $parts_acquired->forceDelete();

        return redirect()->route('admin.parts_acquireds.index');
    }
}
