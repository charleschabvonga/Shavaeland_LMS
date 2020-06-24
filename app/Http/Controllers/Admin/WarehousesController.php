<?php

namespace App\Http\Controllers\Admin;

use App\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWarehousesRequest;
use App\Http\Requests\Admin\UpdateWarehousesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WarehousesController extends Controller
{
    /**
     * Display a listing of Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('warehouse_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('warehouse_delete')) {
                return abort(401);
            }
            $warehouses = Warehouse::onlyTrashed()->get();
        } else {
            $warehouses = Warehouse::all();
        }

        return view('admin.warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating new Warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('warehouse_create')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.warehouses.create', compact('vendors'));
    }

    /**
     * Store a newly created Warehouse in storage.
     *
     * @param  \App\Http\Requests\StoreWarehousesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehousesRequest $request)
    {
        if (! Gate::allows('warehouse_create')) {
            return abort(401);
        }
        $warehouse = Warehouse::create($request->all());



        return redirect()->route('admin.warehouses.index');
    }


    /**
     * Show the form for editing Warehouse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('warehouse_edit')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $warehouse = Warehouse::findOrFail($id);

        return view('admin.warehouses.edit', compact('warehouse', 'vendors'));
    }

    /**
     * Update Warehouse in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehousesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehousesRequest $request, $id)
    {
        if (! Gate::allows('warehouse_edit')) {
            return abort(401);
        }
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());



        return redirect()->route('admin.warehouses.index');
    }


    /**
     * Display Warehouse.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('warehouse_view')) {
            return abort(401);
        }
        
        $vendors = \App\Vendor::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $releasings = \App\Releasing::where('warehouse_id', $id)->get();
        $receivings = \App\Receiving::where('warehouse_id', $id)->get();

        $warehouse = Warehouse::findOrFail($id);

        return view('admin.warehouses.show', compact('warehouse', 'releasings', 'receivings'));
    }


    /**
     * Remove Warehouse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('warehouse_delete')) {
            return abort(401);
        }
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        return redirect()->route('admin.warehouses.index');
    }

    /**
     * Delete all selected Warehouse at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('warehouse_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Warehouse::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Warehouse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('warehouse_delete')) {
            return abort(401);
        }
        $warehouse = Warehouse::onlyTrashed()->findOrFail($id);
        $warehouse->restore();

        return redirect()->route('admin.warehouses.index');
    }

    /**
     * Permanently delete Warehouse from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('warehouse_delete')) {
            return abort(401);
        }
        $warehouse = Warehouse::onlyTrashed()->findOrFail($id);
        $warehouse->forceDelete();

        return redirect()->route('admin.warehouses.index');
    }

    public function download($warehouse_id)
    {
        $warehouse = Warehouse::findOrFail($warehouse_id);
        $pdf = \PDF::loadView('admin.warehouse.pdf', compact('warehouse'));
        return $pdf->stream('warehouse.pdf');
    }
}
