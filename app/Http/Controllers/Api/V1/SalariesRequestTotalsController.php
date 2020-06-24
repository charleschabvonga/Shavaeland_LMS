<?php

namespace App\Http\Controllers\Api\V1;

use App\SalariesRequestTotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSalariesRequestTotalsRequest;
use App\Http\Requests\Admin\UpdateSalariesRequestTotalsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class SalariesRequestTotalsController extends Controller
{
    public function index()
    {
        return SalariesRequestTotal::all();
    }

    public function show($id)
    {
        return SalariesRequestTotal::findOrFail($id);
    }

    public function update(UpdateSalariesRequestTotalsRequest $request, $id)
    {
        $salaries_request_total = SalariesRequestTotal::findOrFail($id);
        $salaries_request_total->update($request->all());
        

        return $salaries_request_total;
    }

    public function store(StoreSalariesRequestTotalsRequest $request)
    {
        $salaries_request_total = SalariesRequestTotal::create($request->all());
        

        return $salaries_request_total;
    }

    public function destroy($id)
    {
        $salaries_request_total = SalariesRequestTotal::findOrFail($id);
        $salaries_request_total->delete();
        return '';
    }
}
