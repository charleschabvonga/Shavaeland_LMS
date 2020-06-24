<?php

namespace App\Http\Controllers\Api\V1;

use App\LoadDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadDescriptionsRequest;
use App\Http\Requests\Admin\UpdateLoadDescriptionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadDescriptionsController extends Controller
{
    public function index()
    {
        return LoadDescription::all();
    }

    public function show($id)
    {
        return LoadDescription::findOrFail($id);
    }

    public function update(UpdateLoadDescriptionsRequest $request, $id)
    {
        $load_description = LoadDescription::findOrFail($id);
        $load_description->update($request->all());
        

        return $load_description;
    }

    public function store(StoreLoadDescriptionsRequest $request)
    {
        $load_description = LoadDescription::create($request->all());
        

        return $load_description;
    }

    public function destroy($id)
    {
        $load_description = LoadDescription::findOrFail($id);
        $load_description->delete();
        return '';
    }
}
