<?php

namespace App\Http\Controllers\Admin;

use App\Identification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIdentificationsRequest;
use App\Http\Requests\Admin\UpdateIdentificationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IdentificationsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Identification.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('identification_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('identification_delete')) {
                return abort(401);
            }
            $identifications = Identification::onlyTrashed()->get();
        } else {
            $identifications = Identification::all();
        }

        return view('admin.identifications.index', compact('identifications'));
    }

    /**
     * Show the form for creating new Identification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('identification_create')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.identifications.create', compact('employee_names'));
    }

    /**
     * Store a newly created Identification in storage.
     *
     * @param  \App\Http\Requests\StoreIdentificationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIdentificationsRequest $request)
    {
        if (! Gate::allows('identification_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $identification = Identification::create($request->all());


        foreach ($request->input('identification_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $identification->id;
            $file->save();
        }

        return redirect()->route('admin.identifications.index');
    }


    /**
     * Show the form for editing Identification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('identification_edit')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $identification = Identification::findOrFail($id);

        return view('admin.identifications.edit', compact('identification', 'employee_names'));
    }

    /**
     * Update Identification in storage.
     *
     * @param  \App\Http\Requests\UpdateIdentificationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIdentificationsRequest $request, $id)
    {
        if (! Gate::allows('identification_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $identification = Identification::findOrFail($id);
        $identification->update($request->all());


        $media = [];
        foreach ($request->input('identification_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $identification->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $identification->updateMedia($media, 'identification');

        return redirect()->route('admin.identifications.index');
    }


    /**
     * Display Identification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('identification_view')) {
            return abort(401);
        }
        $identification = Identification::findOrFail($id);

        return view('admin.identifications.show', compact('identification'));
    }


    /**
     * Remove Identification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('identification_delete')) {
            return abort(401);
        }
        $identification = Identification::findOrFail($id);
        $identification->deletePreservingMedia();

        return redirect()->route('admin.identifications.index');
    }

    /**
     * Delete all selected Identification at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('identification_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Identification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Identification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('identification_delete')) {
            return abort(401);
        }
        $identification = Identification::onlyTrashed()->findOrFail($id);
        $identification->restore();

        return redirect()->route('admin.identifications.index');
    }

    /**
     * Permanently delete Identification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('identification_delete')) {
            return abort(401);
        }
        $identification = Identification::onlyTrashed()->findOrFail($id);
        $identification->forceDelete();

        return redirect()->route('admin.identifications.index');
    }
}
