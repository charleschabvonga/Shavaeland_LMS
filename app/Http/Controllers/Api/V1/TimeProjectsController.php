<?php

namespace App\Http\Controllers\Api\V1;

use App\TimeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTimeProjectsRequest;
use App\Http\Requests\Admin\UpdateTimeProjectsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TimeProjectsController extends Controller
{
    public function index()
    {
        return TimeProject::all();
    }

    public function show($id)
    {
        return TimeProject::findOrFail($id);
    }

    public function update(UpdateTimeProjectsRequest $request, $id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->update($request->all());
        
        $clientContacts           = $time_project->client_contacts;
        $currentClientContactData = [];
        foreach ($request->input('client_contacts', []) as $index => $data) {
            if (is_integer($index)) {
                $time_project->client_contacts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentClientContactData[$id] = $data;
            }
        }
        foreach ($clientContacts as $item) {
            if (isset($currentClientContactData[$item->id])) {
                $item->update($currentClientContactData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $time_project;
    }

    public function store(StoreTimeProjectsRequest $request)
    {
        $time_project = TimeProject::create($request->all());
        
        foreach ($request->input('client_contacts', []) as $data) {
            $time_project->client_contacts()->create($data);
        }

        return $time_project;
    }

    public function destroy($id)
    {
        $time_project = TimeProject::findOrFail($id);
        $time_project->delete();
        return '';
    }
}
