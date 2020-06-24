<?php

namespace App\Http\Controllers\Api\V1;

use App\ClientAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientAccountsRequest;
use App\Http\Requests\Admin\UpdateClientAccountsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientAccountsController extends Controller
{
    public function index()
    {
        return ClientAccount::all();
    }

    public function show($id)
    {
        return ClientAccount::findOrFail($id);
    }

    public function update(UpdateClientAccountsRequest $request, $id)
    {
        $client_account = ClientAccount::findOrFail($id);
        $client_account->update($request->all());
        

        return $client_account;
    }

    public function store(StoreClientAccountsRequest $request)
    {
        $client_account = ClientAccount::create($request->all());
        

        return $client_account;
    }

    public function destroy($id)
    {
        $client_account = ClientAccount::findOrFail($id);
        $client_account->delete();
        return '';
    }
}
