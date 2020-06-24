<?php

namespace App\Http\Controllers\Admin;

use App\Trailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailersRequest;
use App\Http\Requests\Admin\UpdateTrailersRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailersController extends Controller
{
    /**
     * Display a listing of Trailer.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('trailer_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('trailer_delete')) {
                return abort(401);
            }
            $trailers = Trailer::onlyTrashed()->get();
        } else {
            $trailers = Trailer::all();
        }

        return view('admin.trailers.index', compact('trailers'));
    }

    /**
     * Show the form for creating new Trailer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('trailer_create')) {
            return abort(401);
        }
        
        $trailer_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_availability = Trailer::$enum_availability;
                    $enum_service_status = Trailer::$enum_service_status;
            
        return view('admin.trailers.create', compact('enum_availability', 'enum_service_status', 'trailer_types'));
    }

    /**
     * Store a newly created Trailer in storage.
     *
     * @param  \App\Http\Requests\StoreTrailersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrailersRequest $request)
    {
        if (! Gate::allows('trailer_create')) {
            return abort(401);
        }
        $trailer = Trailer::create($request->all());



        return redirect()->route('admin.trailers.index');
    }


    /**
     * Show the form for editing Trailer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('trailer_edit')) {
            return abort(401);
        }
        
        $trailer_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_availability = Trailer::$enum_availability;
                    $enum_service_status = Trailer::$enum_service_status;
            
        $trailer = Trailer::findOrFail($id);

        return view('admin.trailers.edit', compact('trailer', 'enum_availability', 'enum_service_status', 'trailer_types'));
    }

    /**
     * Update Trailer in storage.
     *
     * @param  \App\Http\Requests\UpdateTrailersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrailersRequest $request, $id)
    {
        if (! Gate::allows('trailer_edit')) {
            return abort(401);
        }
        $trailer = Trailer::findOrFail($id);
        $trailer->update($request->all());



        return redirect()->route('admin.trailers.index');
    }


    /**
     * Display Trailer.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('trailer_view')) {
            return abort(401);
        }
        
        $trailer_types = \App\MachineryType::get()->pluck('machinery_type', 'id')->prepend(trans('global.app_please_select'), '');$loading_instructions = \App\LoadingInstruction::whereHas('trailers',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$delivery_instructions = \App\DeliveryInstruction::whereHas('trailers',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$road_freights = \App\RoadFreight::whereHas('trailers',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();

        $trailer = Trailer::findOrFail($id);

        return view('admin.trailers.show', compact('trailer', 'loading_instructions', 'delivery_instructions', 'road_freights'));
    }


    /**
     * Remove Trailer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('trailer_delete')) {
            return abort(401);
        }
        $trailer = Trailer::findOrFail($id);
        $trailer->delete();

        return redirect()->route('admin.trailers.index');
    }

    /**
     * Delete all selected Trailer at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('trailer_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Trailer::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Trailer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('trailer_delete')) {
            return abort(401);
        }
        $trailer = Trailer::onlyTrashed()->findOrFail($id);
        $trailer->restore();

        return redirect()->route('admin.trailers.index');
    }

    /**
     * Permanently delete Trailer from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('trailer_delete')) {
            return abort(401);
        }
        $trailer = Trailer::onlyTrashed()->findOrFail($id);
        $trailer->forceDelete();

        return redirect()->route('admin.trailers.index');
    }
}
