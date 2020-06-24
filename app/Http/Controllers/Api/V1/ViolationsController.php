<?php

namespace App\Http\Controllers\Api\V1;

use App\Violation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreViolationsRequest;
use App\Http\Requests\Admin\UpdateViolationsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ViolationsController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Violation::all();
    }

    public function show($id)
    {
        return Violation::findOrFail($id);
    }

    public function update(UpdateViolationsRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $violation = Violation::findOrFail($id);
        $violation->update($request->all());
        

        return $violation;
    }

    public function store(StoreViolationsRequest $request)
    {
        $request = $this->saveFiles($request);
        $violation = Violation::create($request->all());
        

        return $violation;
    }

    public function destroy($id)
    {
        $violation = Violation::findOrFail($id);
        $violation->delete();
        return '';
    }
}
