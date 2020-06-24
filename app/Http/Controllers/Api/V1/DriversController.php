<?php

namespace App\Http\Controllers\Api\V1;

use App\Driver;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDriversRequest;
use App\Http\Requests\Admin\UpdateDriversRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DriversController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Driver::all();
    }

    public function show($id)
    {
        return Driver::findOrFail($id);
    }

    public function update(UpdateDriversRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $driver = Driver::findOrFail($id);
        $driver->update($request->all());
        

        return $driver;
    }

    public function store(StoreDriversRequest $request)
    {
        $request = $this->saveFiles($request);
        $driver = Driver::create($request->all());
        

        return $driver;
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return '';
    }
}
