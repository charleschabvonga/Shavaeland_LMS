<?php

namespace App\Http\Controllers\Api\V1;

use App\EmergencyContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmergencyContactsRequest;
use App\Http\Requests\Admin\UpdateEmergencyContactsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class EmergencyContactsController extends Controller
{
    public function index()
    {
        return EmergencyContact::all();
    }

    public function show($id)
    {
        return EmergencyContact::findOrFail($id);
    }

    public function update(UpdateEmergencyContactsRequest $request, $id)
    {
        $emergency_contact = EmergencyContact::findOrFail($id);
        $emergency_contact->update($request->all());
        

        return $emergency_contact;
    }

    public function store(StoreEmergencyContactsRequest $request)
    {
        $emergency_contact = EmergencyContact::create($request->all());
        

        return $emergency_contact;
    }

    public function destroy($id)
    {
        $emergency_contact = EmergencyContact::findOrFail($id);
        $emergency_contact->delete();
        return '';
    }
}
