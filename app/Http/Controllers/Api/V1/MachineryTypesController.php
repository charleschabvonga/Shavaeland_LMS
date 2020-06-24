<?php

namespace App\Http\Controllers\Api\V1;

use App\MachineryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachineryTypesRequest;
use App\Http\Requests\Admin\UpdateMachineryTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachineryTypesController extends Controller
{
    public function index()
    {
        return MachineryType::all();
    }

    public function show($id)
    {
        return MachineryType::findOrFail($id);
    }

    public function update(UpdateMachineryTypesRequest $request, $id)
    {
        $machinery_type = MachineryType::findOrFail($id);
        $machinery_type->update($request->all());
        

        return $machinery_type;
    }

    public function store(StoreMachineryTypesRequest $request)
    {
        $machinery_type = MachineryType::create($request->all());
        

        return $machinery_type;
    }

    public function destroy($id)
    {
        $machinery_type = MachineryType::findOrFail($id);
        $machinery_type->delete();
        return '';
    }
}
