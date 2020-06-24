<?php

namespace App\Http\Controllers\Admin;

use App\LoadDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadDescriptionsRequest;
use App\Http\Requests\Admin\UpdateLoadDescriptionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadDescriptionsController extends Controller
{
    /**
     * Display a listing of LoadDescription.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('load_description_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('load_description_delete')) {
                return abort(401);
            }
            $load_descriptions = LoadDescription::onlyTrashed()->get();
        } else {
            $load_descriptions = LoadDescription::all();
        }

        return view('admin.load_descriptions.index', compact('load_descriptions'));
    }

    /**
     * Show the form for creating new LoadDescription.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('load_description_create')) {
            return abort(401);
        }
        
        $loading_instruction_numbers = \App\LoadingInstruction::get()->pluck('loading_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');
        $delivery_instruction_numbers = \App\DeliveryInstruction::get()->pluck('delivery_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');
        $air_freight_numbers = \App\AirFreight::get()->pluck('air_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $rail_freight_numbers = \App\RailFreight::get()->pluck('rail_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $sea_freight_numbers = \App\SeaFreight::get()->pluck('sea_freight_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.load_descriptions.create', compact('loading_instruction_numbers', 'delivery_instruction_numbers', 'air_freight_numbers', 'rail_freight_numbers', 'sea_freight_numbers'));
    }

    /**
     * Store a newly created LoadDescription in storage.
     *
     * @param  \App\Http\Requests\StoreLoadDescriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoadDescriptionsRequest $request)
    {
        if (! Gate::allows('load_description_create')) {
            return abort(401);
        }
        $load_description = LoadDescription::create($request->all());



        return redirect()->route('admin.load_descriptions.index');
    }


    /**
     * Show the form for editing LoadDescription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('load_description_edit')) {
            return abort(401);
        }
        
        $loading_instruction_numbers = \App\LoadingInstruction::get()->pluck('loading_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');
        $delivery_instruction_numbers = \App\DeliveryInstruction::get()->pluck('delivery_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');
        $air_freight_numbers = \App\AirFreight::get()->pluck('air_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $rail_freight_numbers = \App\RailFreight::get()->pluck('rail_freight_number', 'id')->prepend(trans('global.app_please_select'), '');
        $sea_freight_numbers = \App\SeaFreight::get()->pluck('sea_freight_number', 'id')->prepend(trans('global.app_please_select'), '');

        $load_description = LoadDescription::findOrFail($id);

        return view('admin.load_descriptions.edit', compact('load_description', 'loading_instruction_numbers', 'delivery_instruction_numbers', 'air_freight_numbers', 'rail_freight_numbers', 'sea_freight_numbers'));
    }

    /**
     * Update LoadDescription in storage.
     *
     * @param  \App\Http\Requests\UpdateLoadDescriptionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoadDescriptionsRequest $request, $id)
    {
        if (! Gate::allows('load_description_edit')) {
            return abort(401);
        }
        $load_description = LoadDescription::findOrFail($id);
        $load_description->update($request->all());



        return redirect()->route('admin.load_descriptions.index');
    }


    /**
     * Display LoadDescription.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('load_description_view')) {
            return abort(401);
        }
        $load_description = LoadDescription::findOrFail($id);

        return view('admin.load_descriptions.show', compact('load_description'));
    }


    /**
     * Remove LoadDescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('load_description_delete')) {
            return abort(401);
        }
        $load_description = LoadDescription::findOrFail($id);
        $load_description->delete();

        return redirect()->route('admin.load_descriptions.index');
    }

    /**
     * Delete all selected LoadDescription at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('load_description_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = LoadDescription::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore LoadDescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('load_description_delete')) {
            return abort(401);
        }
        $load_description = LoadDescription::onlyTrashed()->findOrFail($id);
        $load_description->restore();

        return redirect()->route('admin.load_descriptions.index');
    }

    /**
     * Permanently delete LoadDescription from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('load_description_delete')) {
            return abort(401);
        }
        $load_description = LoadDescription::onlyTrashed()->findOrFail($id);
        $load_description->forceDelete();

        return redirect()->route('admin.load_descriptions.index');
    }
}
