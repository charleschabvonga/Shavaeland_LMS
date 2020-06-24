<?php

namespace App\Http\Controllers\Api\V1;

use App\VendorAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreVendorAccountsRequest;
use App\Http\Requests\Admin\UpdateVendorAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class VendorAccountsController extends Controller
{
    public function index()
    {
        return VendorAccount::all();
    }

    public function show($id)
    {
        return VendorAccount::findOrFail($id);
    }

    public function update(UpdateVendorAccountsRequest $request, $id)
    {
        $vendor_account = VendorAccount::findOrFail($id);
        $vendor_account->update($request->all());
        

        return $vendor_account;
    }

    public function store(StoreVendorAccountsRequest $request)
    {
        $vendor_account = VendorAccount::create($request->all());
        

        return $vendor_account;
    }

    public function destroy($id)
    {
        $vendor_account = VendorAccount::findOrFail($id);
        $vendor_account->delete();
        return '';
    }
}
