<?php

namespace App\Http\Controllers\Api\V1;

use App\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomesRequest;
use App\Http\Requests\Admin\UpdateIncomesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomesController extends Controller
{
    public function index()
    {
        return Income::all();
    }

    public function show($id)
    {
        return Income::findOrFail($id);
    }

    public function update(UpdateIncomesRequest $request, $id)
    {
        $income = Income::findOrFail($id);
        $income->update($request->all());
        

        return $income;
    }

    public function store(StoreIncomesRequest $request)
    {
        $income = Income::create($request->all());
        

        return $income;
    }

    public function destroy($id)
    {
        $income = Income::findOrFail($id);
        $income->delete();
        return '';
    }
}
