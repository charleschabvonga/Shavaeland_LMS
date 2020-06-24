<?php

namespace App\Http\Controllers\Api\V1;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrenciesRequest;
use App\Http\Requests\Admin\UpdateCurrenciesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CurrenciesController extends Controller
{
    public function index()
    {
        return Currency::all();
    }

    public function show($id)
    {
        return Currency::findOrFail($id);
    }

    public function update(UpdateCurrenciesRequest $request, $id)
    {
        $currency = Currency::findOrFail($id);
        $currency->update($request->all());
        

        return $currency;
    }

    public function store(StoreCurrenciesRequest $request)
    {
        $currency = Currency::create($request->all());
        

        return $currency;
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return '';
    }
}
