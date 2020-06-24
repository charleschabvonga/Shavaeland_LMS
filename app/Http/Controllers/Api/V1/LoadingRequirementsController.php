<?php

namespace App\Http\Controllers\Api\V1;

use App\LoadingRequirement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadingRequirementsRequest;
use App\Http\Requests\Admin\UpdateLoadingRequirementsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadingRequirementsController extends Controller
{
    public function index()
    {
        return LoadingRequirement::all();
    }

    public function show($id)
    {
        return LoadingRequirement::findOrFail($id);
    }

    public function update(UpdateLoadingRequirementsRequest $request, $id)
    {
        $loading_requirement = LoadingRequirement::findOrFail($id);
        $loading_requirement->update($request->all());
        

        return $loading_requirement;
    }

    public function store(StoreLoadingRequirementsRequest $request)
    {
        $loading_requirement = LoadingRequirement::create($request->all());
        

        return $loading_requirement;
    }

    public function destroy($id)
    {
        $loading_requirement = LoadingRequirement::findOrFail($id);
        $loading_requirement->delete();
        return '';
    }
}
