<?php

namespace App\Http\Controllers\Api\V1;

use App\TruckAttachmentStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTruckAttachmentStatusesRequest;
use App\Http\Requests\Admin\UpdateTruckAttachmentStatusesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TruckAttachmentStatusesController extends Controller
{
    public function index()
    {
        return TruckAttachmentStatus::all();
    }

    public function show($id)
    {
        return TruckAttachmentStatus::findOrFail($id);
    }

    public function update(UpdateTruckAttachmentStatusesRequest $request, $id)
    {
        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);
        $truck_attachment_status->update($request->all());
        

        return $truck_attachment_status;
    }

    public function store(StoreTruckAttachmentStatusesRequest $request)
    {
        $truck_attachment_status = TruckAttachmentStatus::create($request->all());
        

        return $truck_attachment_status;
    }

    public function destroy($id)
    {
        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);
        $truck_attachment_status->delete();
        return '';
    }
}
