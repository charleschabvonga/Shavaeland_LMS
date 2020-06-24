<?php

namespace App\Http\Controllers\Api\V1;

use App\PayeePayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayeePaymentsRequest;
use App\Http\Requests\Admin\UpdatePayeePaymentsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayeePaymentsController extends Controller
{
    public function index()
    {
        return PayeePayment::all();
    }

    public function show($id)
    {
        return PayeePayment::findOrFail($id);
    }

    public function update(UpdatePayeePaymentsRequest $request, $id)
    {
        $payee_payment = PayeePayment::findOrFail($id);
        $payee_payment->update($request->all());
        

        return $payee_payment;
    }

    public function store(StorePayeePaymentsRequest $request)
    {
        $payee_payment = PayeePayment::create($request->all());
        

        return $payee_payment;
    }

    public function destroy($id)
    {
        $payee_payment = PayeePayment::findOrFail($id);
        $payee_payment->delete();
        return '';
    }
}
