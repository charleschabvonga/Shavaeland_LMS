<?php

namespace App\Http\Controllers\Api\V1;

use App\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoutesRequest;
use App\Http\Requests\Admin\UpdateRoutesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoutesController extends Controller
{
    public function index()
    {
        return Route::all();
    }

    public function show($id)
    {
        return Route::findOrFail($id);
    }

    public function update(UpdateRoutesRequest $request, $id)
    {
        $route = Route::findOrFail($id);
        $route->update($request->all());
        

        return $route;
    }

    public function store(StoreRoutesRequest $request)
    {
        $route = Route::create($request->all());
        

        return $route;
    }

    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();
        return '';
    }
}
