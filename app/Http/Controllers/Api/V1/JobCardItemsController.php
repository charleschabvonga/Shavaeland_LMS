<?php

namespace App\Http\Controllers\Api\V1;

use App\JobCardItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobCardItemsRequest;
use App\Http\Requests\Admin\UpdateJobCardItemsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class JobCardItemsController extends Controller
{
    public function index()
    {
        return JobCardItem::all();
    }

    public function show($id)
    {
        return JobCardItem::findOrFail($id);
    }

    public function update(UpdateJobCardItemsRequest $request, $id)
    {
        $job_card_item = JobCardItem::findOrFail($id);
        $job_card_item->update($request->all());
        

        return $job_card_item;
    }

    public function store(StoreJobCardItemsRequest $request)
    {
        $job_card_item = JobCardItem::create($request->all());
        

        return $job_card_item;
    }

    public function destroy($id)
    {
        $job_card_item = JobCardItem::findOrFail($id);
        $job_card_item->delete();
        return '';
    }
}
