<?php

namespace App\Http\Controllers\Api\V1;

use App\Warehouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWarehousesRequest;
use App\Http\Requests\Admin\UpdateWarehousesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WarehousesController extends Controller
{
    public function index()
    {
        return Warehouse::all();
    }

    public function show($id)
    {
        return Warehouse::findOrFail($id);
    }

    public function update(UpdateWarehousesRequest $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());
        

        return $warehouse;
    }

    public function store(StoreWarehousesRequest $request)
    {
        $warehouse = Warehouse::create($request->all());
        

        return $warehouse;
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return '';
    }
}
