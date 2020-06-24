<?php

namespace App\Http\Controllers\Api\V1;

use App\JobRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreJobRequestsRequest;
use App\Http\Requests\Admin\UpdateJobRequestsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class JobRequestsController extends Controller
{
    public function index()
    {
        return JobRequest::all();
    }

    public function show($id)
    {
        return JobRequest::findOrFail($id);
    }

    public function update(UpdateJobRequestsRequest $request, $id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_request->update($request->all());
        

        return $job_request;
    }

    public function store(StoreJobRequestsRequest $request)
    {
        $job_request = JobRequest::create($request->all());
        

        return $job_request;
    }

    public function destroy($id)
    {
        $job_request = JobRequest::findOrFail($id);
        $job_request->delete();
        return '';
    }
}
