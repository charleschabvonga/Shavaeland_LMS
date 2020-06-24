<?php

namespace App\Http\Controllers\Api\V1;

use App\ClientJobCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClientJobCardsRequest;
use App\Http\Requests\Admin\UpdateClientJobCardsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClientJobCardsController extends Controller
{
    public function index()
    {
        return ClientJobCard::all();
    }

    public function show($id)
    {
        return ClientJobCard::findOrFail($id);
    }

    public function update(UpdateClientJobCardsRequest $request, $id)
    {
        $client_job_card = ClientJobCard::findOrFail($id);
        $client_job_card->update($request->all());
        

        return $client_job_card;
    }

    public function store(StoreClientJobCardsRequest $request)
    {
        $client_job_card = ClientJobCard::create($request->all());
        

        return $client_job_card;
    }

    public function destroy($id)
    {
        $client_job_card = ClientJobCard::findOrFail($id);
        $client_job_card->delete();
        return '';
    }
}
