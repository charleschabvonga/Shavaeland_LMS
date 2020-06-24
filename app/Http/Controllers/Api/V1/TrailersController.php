<?php

namespace App\Http\Controllers\Api\V1;

use App\Trailer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrailersRequest;
use App\Http\Requests\Admin\UpdateTrailersRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TrailersController extends Controller
{
    public function index()
    {
        return Trailer::all();
    }

    public function show($id)
    {
        return Trailer::findOrFail($id);
    }

    public function update(UpdateTrailersRequest $request, $id)
    {
        $trailer = Trailer::findOrFail($id);
        $trailer->update($request->all());
        

        return $trailer;
    }

    public function store(StoreTrailersRequest $request)
    {
        $trailer = Trailer::create($request->all());
        

        return $trailer;
    }

    public function destroy($id)
    {
        $trailer = Trailer::findOrFail($id);
        $trailer->delete();
        return '';
    }
}
