<?php

namespace App\Http\Controllers\Admin;

use App\LoadingRequirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadingRequirementsRequest;
use App\Http\Requests\Admin\UpdateLoadingRequirementsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadingRequirementsController extends Controller
{
    /**
     * Display a listing of LoadingRequirement.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('loading_requirement_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('loading_requirement_delete')) {
                return abort(401);
            }
            $loading_requirements = LoadingRequirement::onlyTrashed()->get();
        } else {
            $loading_requirements = LoadingRequirement::all();
        }

        return view('admin.loading_requirements.index', compact('loading_requirements'));
    }

    /**
     * Show the form for creating new LoadingRequirement.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('loading_requirement_create')) {
            return abort(401);
        }
        
        $loading_instruction_numbers = \App\LoadingInstruction::get()->pluck('loading_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.loading_requirements.create', compact('loading_instruction_numbers'));
    }

    /**
     * Store a newly created LoadingRequirement in storage.
     *
     * @param  \App\Http\Requests\StoreLoadingRequirementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoadingRequirementsRequest $request)
    {
        if (! Gate::allows('loading_requirement_create')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::create($request->all());



        return redirect()->route('admin.loading_requirements.index');
    }


    /**
     * Show the form for editing LoadingRequirement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('loading_requirement_edit')) {
            return abort(401);
        }
        
        $loading_instruction_numbers = \App\LoadingInstruction::get()->pluck('loading_instruction_number', 'id')->prepend(trans('global.app_please_select'), '');

        $loading_requirement = LoadingRequirement::findOrFail($id);

        return view('admin.loading_requirements.edit', compact('loading_requirement', 'loading_instruction_numbers'));
    }

    /**
     * Update LoadingRequirement in storage.
     *
     * @param  \App\Http\Requests\UpdateLoadingRequirementsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLoadingRequirementsRequest $request, $id)
    {
        if (! Gate::allows('loading_requirement_edit')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::findOrFail($id);
        $loading_requirement->update($request->all());



        return redirect()->route('admin.loading_requirements.index');
    }


    /**
     * Display LoadingRequirement.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('loading_requirement_view')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::findOrFail($id);

        return view('admin.loading_requirements.show', compact('loading_requirement'));
    }


    /**
     * Remove LoadingRequirement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('loading_requirement_delete')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::findOrFail($id);
        $loading_requirement->delete();

        return redirect()->route('admin.loading_requirements.index');
    }

    /**
     * Delete all selected LoadingRequirement at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('loading_requirement_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = LoadingRequirement::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore LoadingRequirement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('loading_requirement_delete')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::onlyTrashed()->findOrFail($id);
        $loading_requirement->restore();

        return redirect()->route('admin.loading_requirements.index');
    }

    /**
     * Permanently delete LoadingRequirement from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('loading_requirement_delete')) {
            return abort(401);
        }
        $loading_requirement = LoadingRequirement::onlyTrashed()->findOrFail($id);
        $loading_requirement->forceDelete();

        return redirect()->route('admin.loading_requirements.index');
    }
}
