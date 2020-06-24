<?php

namespace App\Http\Controllers\Admin;

use App\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoutesRequest;
use App\Http\Requests\Admin\UpdateRoutesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoutesController extends Controller
{
    /**
     * Display a listing of Route.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('route_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('route_delete')) {
                return abort(401);
            }
            $routes = Route::onlyTrashed()->get();
        } else {
            $routes = Route::all();
        }

        return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating new Route.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('route_create')) {
            return abort(401);
        }
        return view('admin.routes.create');
    }

    /**
     * Store a newly created Route in storage.
     *
     * @param  \App\Http\Requests\StoreRoutesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoutesRequest $request)
    {
        if (! Gate::allows('route_create')) {
            return abort(401);
        }
        $route = Route::create($request->all());



        return redirect()->route('admin.routes.index');
    }


    /**
     * Show the form for editing Route.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('route_edit')) {
            return abort(401);
        }
        $route = Route::findOrFail($id);

        return view('admin.routes.edit', compact('route'));
    }

    /**
     * Update Route in storage.
     *
     * @param  \App\Http\Requests\UpdateRoutesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoutesRequest $request, $id)
    {
        if (! Gate::allows('route_edit')) {
            return abort(401);
        }
        $route = Route::findOrFail($id);
        $route->update($request->all());



        return redirect()->route('admin.routes.index');
    }


    /**
     * Display Route.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('route_view')) {
            return abort(401);
        }
        $road_freights = \App\RoadFreight::where('route_id', $id)->get();$income_expense_calculators = \App\IncomeExpenseCalculator::where('route_id', $id)->get();$income_expense_calculators = \App\IncomeExpenseCalculator::where('distance_id', $id)->get();$machinery_costs = \App\MachineryCost::where('route_id', $id)->get();$machinery_costs = \App\MachineryCost::where('distance_id', $id)->get();$air_freights = \App\AirFreight::where('route_id', $id)->get();$sea_freights = \App\SeaFreight::where('route_id', $id)->get();$rail_freights = \App\RailFreight::where('route_id', $id)->get();

        $route = Route::findOrFail($id);

        return view('admin.routes.show', compact('route', 'road_freights', 'income_expense_calculators', 'income_expense_calculators', 'machinery_costs', 'machinery_costs', 'air_freights', 'sea_freights', 'rail_freights'));
    }


    /**
     * Remove Route from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('route_delete')) {
            return abort(401);
        }
        $route = Route::findOrFail($id);
        $route->delete();

        return redirect()->route('admin.routes.index');
    }

    /**
     * Delete all selected Route at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('route_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Route::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Route from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('route_delete')) {
            return abort(401);
        }
        $route = Route::onlyTrashed()->findOrFail($id);
        $route->restore();

        return redirect()->route('admin.routes.index');
    }

    /**
     * Permanently delete Route from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('route_delete')) {
            return abort(401);
        }
        $route = Route::onlyTrashed()->findOrFail($id);
        $route->forceDelete();

        return redirect()->route('admin.routes.index');
    }
}
