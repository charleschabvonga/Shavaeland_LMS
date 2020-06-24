<?php

namespace App\Http\Controllers\Admin;

use App\NonMachineCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreNonMachineCostsRequest;
use App\Http\Requests\Admin\UpdateNonMachineCostsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class NonMachineCostsController extends Controller
{
    /**
     * Display a listing of NonMachineCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('non_machine_cost_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('non_machine_cost_delete')) {
                return abort(401);
            }
            $non_machine_costs = NonMachineCost::onlyTrashed()->get();
        } else {
            $non_machine_costs = NonMachineCost::all();
        }

        return view('admin.non_machine_costs.index', compact('non_machine_costs'));
    }

    /**
     * Show the form for creating new NonMachineCost.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('non_machine_cost_create')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.non_machine_costs.create', compact('road_freight_numbers'));
    }

    /**
     * Store a newly created NonMachineCost in storage.
     *
     * @param  \App\Http\Requests\StoreNonMachineCostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNonMachineCostsRequest $request)
    {
        if (! Gate::allows('non_machine_cost_create')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::create($request->all());



        return redirect()->route('admin.non_machine_costs.index');
    }


    /**
     * Show the form for editing NonMachineCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('non_machine_cost_edit')) {
            return abort(401);
        }
        
        $road_freight_numbers = \App\RoadFreight::get()->pluck('road_freight_number', 'id')->prepend(trans('global.app_please_select'), '');

        $non_machine_cost = NonMachineCost::findOrFail($id);

        return view('admin.non_machine_costs.edit', compact('non_machine_cost', 'road_freight_numbers'));
    }

    /**
     * Update NonMachineCost in storage.
     *
     * @param  \App\Http\Requests\UpdateNonMachineCostsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNonMachineCostsRequest $request, $id)
    {
        if (! Gate::allows('non_machine_cost_edit')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::findOrFail($id);
        $non_machine_cost->update($request->all());



        return redirect()->route('admin.non_machine_costs.index');
    }


    /**
     * Display NonMachineCost.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('non_machine_cost_view')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::findOrFail($id);

        return view('admin.non_machine_costs.show', compact('non_machine_cost'));
    }


    /**
     * Remove NonMachineCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('non_machine_cost_delete')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::findOrFail($id);
        $non_machine_cost->delete();

        return redirect()->route('admin.non_machine_costs.index');
    }

    /**
     * Delete all selected NonMachineCost at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('non_machine_cost_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = NonMachineCost::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore NonMachineCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('non_machine_cost_delete')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::onlyTrashed()->findOrFail($id);
        $non_machine_cost->restore();

        return redirect()->route('admin.non_machine_costs.index');
    }

    /**
     * Permanently delete NonMachineCost from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('non_machine_cost_delete')) {
            return abort(401);
        }
        $non_machine_cost = NonMachineCost::onlyTrashed()->findOrFail($id);
        $non_machine_cost->forceDelete();

        return redirect()->route('admin.non_machine_costs.index');
    }
}
