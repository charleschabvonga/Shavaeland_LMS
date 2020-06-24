<?php

namespace App\Http\Controllers\Api\V1;

use App\Qualification;
use Illuminate\Http\Request;
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

    public function index()
    {
        return Qualification::all();
    }

    public function show($id)
    {
        return Qualification::findOrFail($id);
    }

    public function update(UpdateQualificationsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $qualification = Qualification::findOrFail($id);
        $qualification->update($request->all());
        

        return $qualification;
    }

    public function store(StoreQualificationsRequest $request)
    {
        $request = $this->saveFiles($request);
        $qualification = Qualification::create($request->all());
        

        return $qualification;
    }

    public function destroy($id)
    {
        $qualification = Qualification::findOrFail($id);
        $qualification->delete();
        return '';
    }
}
