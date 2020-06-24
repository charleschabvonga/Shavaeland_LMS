<?php

namespace App\Http\Controllers\Api\V1;

use App\PartsAcquired;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartsAcquiredsRequest;
use App\Http\Requests\Admin\UpdatePartsAcquiredsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PartsAcquiredsController extends Controller
{
    public function index()
    {
        return PartsAcquired::all();
    }

    public function show($id)
    {
        return PartsAcquired::findOrFail($id);
    }

    public function update(UpdatePartsAcquiredsRequest $request, $id)
    {
        $parts_acquired = PartsAcquired::findOrFail($id);
        $parts_acquired->update($request->all());
        

        return $parts_acquired;
    }

    public function store(StorePartsAcquiredsRequest $request)
    {
        $parts_acquired = PartsAcquired::create($request->all());
        

        return $parts_acquired;
    }

    public function destroy($id)
    {
        $parts_acquired = PartsAcquired::findOrFail($id);
        $parts_acquired->delete();
        return '';
    }
}
