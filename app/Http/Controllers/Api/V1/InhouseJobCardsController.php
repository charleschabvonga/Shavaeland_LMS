<?php

namespace App\Http\Controllers\Api\V1;

use App\InhouseJobCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreInhouseJobCardsRequest;
use App\Http\Requests\Admin\UpdateInhouseJobCardsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class InhouseJobCardsController extends Controller
{
    public function index()
    {
        return InhouseJobCard::all();
    }

    public function show($id)
    {
        return InhouseJobCard::findOrFail($id);
    }

    public function update(UpdateInhouseJobCardsRequest $request, $id)
    {
        $inhouse_job_card = InhouseJobCard::findOrFail($id);
        $inhouse_job_card->update($request->all());
        

        return $inhouse_job_card;
    }

    public function store(StoreInhouseJobCardsRequest $request)
    {
        $inhouse_job_card = InhouseJobCard::create($request->all());
        

        return $inhouse_job_card;
    }

    public function destroy($id)
    {
        $inhouse_job_card = InhouseJobCard::findOrFail($id);
        $inhouse_job_card->delete();
        return '';
    }
}
