<?php

namespace App\Http\Controllers\Admin;

use App\MachinerySize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachinerySizesRequest;
use App\Http\Requests\Admin\UpdateMachinerySizesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachinerySizesController extends Controller
{
    /**
     * Display a listing of MachinerySize.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('machinery_size_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('machinery_size_delete')) {
                return abort(401);
            }
            $machinery_sizes = MachinerySize::onlyTrashed()->get();
        } else {
            $machinery_sizes = MachinerySize::all();
        }

        return view('admin.machinery_sizes.index', compact('machinery_sizes'));
    }

    /**
     * Show the form for creating new MachinerySize.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('machinery_size_create')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.machinery_sizes.create', compact('attachments'));
    }

    /**
     * Store a newly created MachinerySize in storage.
     *
     * @param  \App\Http\Requests\StoreMachinerySizesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMachinerySizesRequest $request)
    {
        if (! Gate::allows('machinery_size_create')) {
            return abort(401);
        }
        $machinery_size = MachinerySize::create($request->all());



        return redirect()->route('admin.machinery_sizes.index');
    }


    /**
     * Show the form for editing MachinerySize.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('machinery_size_edit')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');

        $machinery_size = MachinerySize::findOrFail($id);

        return view('admin.machinery_sizes.edit', compact('machinery_size', 'attachments'));
    }

    /**
     * Update MachinerySize in storage.
     *
     * @param  \App\Http\Requests\UpdateMachinerySizesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMachinerySizesRequest $request, $id)
    {
        if (! Gate::allows('machinery_size_edit')) {
            return abort(401);
        }
        $machinery_size = MachinerySize::findOrFail($id);
        $machinery_size->update($request->all());



        return redirect()->route('admin.machinery_sizes.index');
    }


    /**
     * Display MachinerySize.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('machinery_size_view')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');$income_expense_calculators = \App\IncomeExpenseCalculator::where('size_id', $id)->get();$machinery_costs = \App\MachineryCost::where('size_id', $id)->get();$vehicles = \App\Vehicle::where('size_id', $id)->get();$light_vehicles = \App\LightVehicle::where('size_id', $id)->get();

        $machinery_size = MachinerySize::findOrFail($id);

        return view('admin.machinery_sizes.show', compact('machinery_size', 'income_expense_calculators', 'machinery_costs', 'vehicles', 'light_vehicles'));
    }


    /**
     * Remove MachinerySize from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('machinery_size_delete')) {
            return abort(401);
        }
        $machinery_size = MachinerySize::findOrFail($id);
        $machinery_size->delete();

        return redirect()->route('admin.machinery_sizes.index');
    }

    /**
     * Delete all selected MachinerySize at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('machinery_size_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = MachinerySize::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore MachinerySize from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('machinery_size_delete')) {
            return abort(401);
        }
        $machinery_size = MachinerySize::onlyTrashed()->findOrFail($id);
        $machinery_size->restore();

        return redirect()->route('admin.machinery_sizes.index');
    }

    /**
     * Permanently delete MachinerySize from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('machinery_size_delete')) {
            return abort(401);
        }
        $machinery_size = MachinerySize::onlyTrashed()->findOrFail($id);
        $machinery_size->forceDelete();

        return redirect()->route('admin.machinery_sizes.index');
    }
}
