<?php

namespace App\Http\Controllers\Api\V1;

use App\BankPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBankPaymentsRequest;
use App\Http\Requests\Admin\UpdateBankPaymentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class BankPaymentsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return BankPayment::all();
    }

    public function show($id)
    {
        return BankPayment::findOrFail($id);
    }

    public function update(UpdateBankPaymentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $bank_payment = BankPayment::findOrFail($id);
        $bank_payment->update($request->all());
        

        return $bank_payment;
    }

    public function store(StoreBankPaymentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $bank_payment = BankPayment::create($request->all());
        

        return $bank_payment;
    }

    public function destroy($id)
    {
        $bank_payment = BankPayment::findOrFail($id);
        $bank_payment->delete();
        return '';
    }
}
