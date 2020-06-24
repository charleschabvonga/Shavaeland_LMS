<?php

namespace App\Http\Controllers\Admin;

use App\DrugTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDrugTestsRequest;
use App\Http\Requests\Admin\UpdateDrugTestsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DrugTestsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of DrugTest.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('drug_test_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('drug_test_delete')) {
                return abort(401);
            }
            $drug_tests = DrugTest::onlyTrashed()->get();
        } else {
            $drug_tests = DrugTest::all();
        }

        return view('admin.drug_tests.index', compact('drug_tests'));
    }

    /**
     * Show the form for creating new DrugTest.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('drug_test_create')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $drug_test = DrugTest::all();
        $drug_test_id = $drug_test->pluck('id')->last();
        $drug_test_number = 'DTN-'.($drug_test_id + 1000);

        return view('admin.drug_tests.create', compact('drug_test_number', 'employee_names'));
    }

    /**
     * Store a newly created DrugTest in storage.
     *
     * @param  \App\Http\Requests\StoreDrugTestsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDrugTestsRequest $request)
    {
        if (! Gate::allows('drug_test_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $drug_test = DrugTest::create($request->all());


        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $drug_test->id;
            $file->save();
        }

        return redirect()->route('admin.drug_tests.index');
    }


    /**
     * Show the form for editing DrugTest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('drug_test_edit')) {
            return abort(401);
        }
        
        $employee_names = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');

        $drug_test = DrugTest::findOrFail($id);

        return view('admin.drug_tests.edit', compact('drug_test', 'employee_names'));
    }

    /**
     * Update DrugTest in storage.
     *
     * @param  \App\Http\Requests\UpdateDrugTestsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDrugTestsRequest $request, $id)
    {
        if (! Gate::allows('drug_test_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $drug_test = DrugTest::findOrFail($id);
        $drug_test->update($request->all());


        $media = [];
        foreach ($request->input('file_id', []) as $index => $id) {
            $model          = config('laravel-medialibrary.media_model');
            $file           = $model::find($id);
            $file->model_id = $drug_test->id;
            $file->save();
            $media[] = $file->toArray();
        }
        $drug_test->updateMedia($media, 'file');

        return redirect()->route('admin.drug_tests.index');
    }


    /**
     * Display DrugTest.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('drug_test_view')) {
            return abort(401);
        }
        $drug_test = DrugTest::findOrFail($id);

        return view('admin.drug_tests.show', compact('drug_test'));
    }


    /**
     * Remove DrugTest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('drug_test_delete')) {
            return abort(401);
        }
        $drug_test = DrugTest::findOrFail($id);
        $drug_test->deletePreservingMedia();

        return redirect()->route('admin.drug_tests.index');
    }

    /**
     * Delete all selected DrugTest at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('drug_test_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = DrugTest::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->deletePreservingMedia();
            }
        }
    }


    /**
     * Restore DrugTest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('drug_test_delete')) {
            return abort(401);
        }
        $drug_test = DrugTest::onlyTrashed()->findOrFail($id);
        $drug_test->restore();

        return redirect()->route('admin.drug_tests.index');
    }

    /**
     * Permanently delete DrugTest from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('drug_test_delete')) {
            return abort(401);
        }
        $drug_test = DrugTest::onlyTrashed()->findOrFail($id);
        $drug_test->forceDelete();

        return redirect()->route('admin.drug_tests.index');
    }
}
