<?php

namespace App\Http\Controllers\Api\V1;

use App\Part;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePartsRequest;
use App\Http\Requests\Admin\UpdatePartsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PartsController extends Controller
{
    public function index()
    {
        return Part::all();
    }

    public function show($id)
    {
        return Part::findOrFail($id);
    }

    public function update(UpdatePartsRequest $request, $id)
    {
        $part = Part::findOrFail($id);
        $part->update($request->all());
        

        return $part;
    }

    public function store(StorePartsRequest $request)
    {
        $part = Part::create($request->all());
        

        return $part;
    }

    public function destroy($id)
    {
        $part = Part::findOrFail($id);
        $part->delete();
        return '';
    }
}
