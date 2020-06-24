<?php

namespace App\Http\Controllers\Api\V1;

use App\PayeeAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePayeeAccountsRequest;
use App\Http\Requests\Admin\UpdatePayeeAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class PayeeAccountsController extends Controller
{
    public function index()
    {
        return PayeeAccount::all();
    }

    public function show($id)
    {
        return PayeeAccount::findOrFail($id);
    }

    public function update(UpdatePayeeAccountsRequest $request, $id)
    {
        $payee_account = PayeeAccount::findOrFail($id);
        $payee_account->update($request->all());
        

        return $payee_account;
    }

    public function store(StorePayeeAccountsRequest $request)
    {
        $payee_account = PayeeAccount::create($request->all());
        

        return $payee_account;
    }

    public function destroy($id)
    {
        $payee_account = PayeeAccount::findOrFail($id);
        $payee_account->delete();
        return '';
    }
}
