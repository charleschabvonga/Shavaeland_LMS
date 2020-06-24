<?php

namespace App\Http\Controllers\Api\V1;

use App\DrugTest;
use Illuminate\Http\Request;
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

    public function index()
    {
        return DrugTest::all();
    }

    public function show($id)
    {
        return DrugTest::findOrFail($id);
    }

    public function update(UpdateDrugTestsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $drug_test = DrugTest::findOrFail($id);
        $drug_test->update($request->all());
        

        return $drug_test;
    }

    public function store(StoreDrugTestsRequest $request)
    {
        $request = $this->saveFiles($request);
        $drug_test = DrugTest::create($request->all());
        

        return $drug_test;
    }

    public function destroy($id)
    {
        $drug_test = DrugTest::findOrFail($id);
        $drug_test->delete();
        return '';
    }
}
