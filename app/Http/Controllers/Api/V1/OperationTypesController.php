<?php

namespace App\Http\Controllers\Api\V1;

use App\OperationType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOperationTypesRequest;
use App\Http\Requests\Admin\UpdateOperationTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class OperationTypesController extends Controller
{
    public function index()
    {
        return OperationType::all();
    }

    public function show($id)
    {
        return OperationType::findOrFail($id);
    }

    public function update(UpdateOperationTypesRequest $request, $id)
    {
        $operation_type = OperationType::findOrFail($id);
        $operation_type->update($request->all());
        

        return $operation_type;
    }

    public function store(StoreOperationTypesRequest $request)
    {
        $operation_type = OperationType::create($request->all());
        

        return $operation_type;
    }

    public function destroy($id)
    {
        $operation_type = OperationType::findOrFail($id);
        $operation_type->delete();
        return '';
    }
}
