<?php

namespace App\Http\Controllers\Api\V1;

use App\MachinerySize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachinerySizesRequest;
use App\Http\Requests\Admin\UpdateMachinerySizesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachinerySizesController extends Controller
{
    public function index()
    {
        return MachinerySize::all();
    }

    public function show($id)
    {
        return MachinerySize::findOrFail($id);
    }

    public function update(UpdateMachinerySizesRequest $request, $id)
    {
        $machinery_size = MachinerySize::findOrFail($id);
        $machinery_size->update($request->all());
        

        return $machinery_size;
    }

    public function store(StoreMachinerySizesRequest $request)
    {
        $machinery_size = MachinerySize::create($request->all());
        

        return $machinery_size;
    }

    public function destroy($id)
    {
        $machinery_size = MachinerySize::findOrFail($id);
        $machinery_size->delete();
        return '';
    }
}
