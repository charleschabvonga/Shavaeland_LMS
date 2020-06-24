<?php

namespace App\Http\Controllers\Api\V1;

use App\VendorBankPayment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorBankPaymentsRequest;
use App\Http\Requests\Admin\UpdateVendorBankPaymentsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorBankPaymentsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return VendorBankPayment::all();
    }

    public function show($id)
    {
        return VendorBankPayment::findOrFail($id);
    }

    public function update(UpdateVendorBankPaymentsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);
        $vendor_bank_payment->update($request->all());
        

        return $vendor_bank_payment;
    }

    public function store(StoreVendorBankPaymentsRequest $request)
    {
        $request = $this->saveFiles($request);
        $vendor_bank_payment = VendorBankPayment::create($request->all());
        

        return $vendor_bank_payment;
    }

    public function destroy($id)
    {
        $vendor_bank_payment = VendorBankPayment::findOrFail($id);
        $vendor_bank_payment->delete();
        return '';
    }
}
