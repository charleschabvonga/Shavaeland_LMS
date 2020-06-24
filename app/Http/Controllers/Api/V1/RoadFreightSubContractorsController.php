<?php

namespace App\Http\Controllers\Api\V1;

use App\RoadFreightSubContractor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRoadFreightSubContractorsRequest;
use App\Http\Requests\Admin\UpdateRoadFreightSubContractorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class RoadFreightSubContractorsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return RoadFreightSubContractor::all();
    }

    public function show($id)
    {
        return RoadFreightSubContractor::findOrFail($id);
    }

    public function update(UpdateRoadFreightSubContractorsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);
        $road_freight_sub_contractor->update($request->all());
        

        return $road_freight_sub_contractor;
    }

    public function store(StoreRoadFreightSubContractorsRequest $request)
    {
        $request = $this->saveFiles($request);
        $road_freight_sub_contractor = RoadFreightSubContractor::create($request->all());
        

        return $road_freight_sub_contractor;
    }

    public function destroy($id)
    {
        $road_freight_sub_contractor = RoadFreightSubContractor::findOrFail($id);
        $road_freight_sub_contractor->delete();
        return '';
    }
}
