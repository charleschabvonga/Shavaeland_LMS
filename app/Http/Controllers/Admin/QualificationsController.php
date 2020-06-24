<?php

namespace App\Http\Controllers\Admin;

use App\Qualification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQualificationsRequest;
use App\Http\Requests\Admin\UpdateQualificationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class QualificationsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Qualification.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('qualification_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('qualification_delete')) {
                return abort(401);
            }
            $qualifications = Qualification::onlyTrashed()->get();
        } else {
            $qualifications = Qualification::all();
        }

        return view('admin.qualifications.index', compact('qualifications'));
    }

    /**
     * Show the form for creating new Qualification.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('qualification_create')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.qualifications.create', compact('employee_names'));
    }

    /**
     * Store a newly created Qualification in storage.
     *
     * @param  \App\Http\Requests\StoreQualificationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQualificationsRequest $request)
    {
        if (! Gate::allows('qualification_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $qualification = Qualification::create($request->all());


        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $qualification->id;
            $file->save();
        }

        return redirect()->route('admin.qualifications.index');
    }


    /**
     * Show the form for editing Qualification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('qualification_edit')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $qualification = Qualification::findOrFail($id);

        return view('admin.qualifications.edit', compact('qualification', 'employee_names'));
    }

    /**
     * Update Qualification in storage.
     *
     * @param  \App\Http\Requests\UpdateQualificationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQualificationsRequest $request, $id)
    {
        if (! Gate::allows('qualification_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $qualification = Qualification::findOrFail($id);
        $qualification->update($request->all());


        $media = [];
        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $qualification->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $qualification->updateMedia($media, 'file');

        return redirect()->route('admin.qualifications.index');
    }


    /**
     * Display Qualification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('qualification_view')) {
            return abort(401);
        }
        $qualification = Qualification::findOrFail($id);

        return view('admin.qualifications.show', compact('qualification'));
    }


    /**
     * Remove Qualification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('qualification_delete')) {
            return abort(401);
        }
        $qualification = Qualification::findOrFail($id);
        $qualification->deletePreservingMedia();

        return redirect()->route('admin.qualifications.index');
    }

    /**
     * Delete all selected Qualification at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('qualification_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Qualification::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore Qualification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('qualification_delete')) {
            return abort(401);
        }
        $qualification = Qualification::onlyTrashed()->findOrFail($id);
        $qualification->restore();

        return redirect()->route('admin.qualifications.index');
    }

    /**
     * Permanently delete Qualification from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('qualification_delete')) {
            return abort(401);
        }
        $qualification = Qualification::onlyTrashed()->findOrFail($id);
        $qualification->forceDelete();

        return redirect()->route('admin.qualifications.index');
    }
}
