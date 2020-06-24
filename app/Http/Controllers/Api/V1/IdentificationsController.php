<?php

namespace App\Http\Controllers\Api\V1;

use App\Identification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIdentificationsRequest;
use App\Http\Requests\Admin\UpdateIdentificationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IdentificationsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Identification::all();
    }

    public function show($id)
    {
        return Identification::findOrFail($id);
    }

    public function update(UpdateIdentificationsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $identification = Identification::findOrFail($id);
        $identification->update($request->all());
        

        return $identification;
    }

    public function store(StoreIdentificationsRequest $request)
    {
        $request = $this->saveFiles($request);
        $identification = Identification::create($request->all());
        

        return $identification;
    }

    public function destroy($id)
    {
        $identification = Identification::findOrFail($id);
        $identification->delete();
        return '';
    }
}
