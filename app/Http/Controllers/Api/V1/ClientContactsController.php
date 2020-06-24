<?php

namespace App\Http\Controllers\Api\V1;

use App\ClientContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientContactsRequest;
use App\Http\Requests\Admin\UpdateClientContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientContactsController extends Controller
{
    public function index()
    {
        return ClientContact::all();
    }

    public function show($id)
    {
        return ClientContact::findOrFail($id);
    }

    public function update(UpdateClientContactsRequest $request, $id)
    {
        $client_contact = ClientContact::findOrFail($id);
        $client_contact->update($request->all());
        

        return $client_contact;
    }

    public function store(StoreClientContactsRequest $request)
    {
        $client_contact = ClientContact::create($request->all());
        

        return $client_contact;
    }

    public function destroy($id)
    {
        $client_contact = ClientContact::findOrFail($id);
        $client_contact->delete();
        return '';
    }
}
