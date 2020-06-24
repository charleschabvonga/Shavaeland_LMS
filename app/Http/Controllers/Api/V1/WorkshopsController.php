<?php

namespace App\Http\Controllers\Api\V1;

use App\Workshop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreWorkshopsRequest;
use App\Http\Requests\Admin\UpdateWorkshopsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class WorkshopsController extends Controller
{
    public function index()
    {
        return Workshop::all();
    }

    public function show($id)
    {
        return Workshop::findOrFail($id);
    }

    public function update(UpdateWorkshopsRequest $request, $id)
    {
        $workshop = Workshop::findOrFail($id);
        $workshop->update($request->all());
        

        return $workshop;
    }

    public function store(StoreWorkshopsRequest $request)
    {
        $workshop = Workshop::create($request->all());
        

        return $workshop;
    }

    public function destroy($id)
    {
        $workshop = Workshop::findOrFail($id);
        $workshop->delete();
        return '';
    }
}
