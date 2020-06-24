<?php

namespace App\Http\Controllers\Api\V1;

use App\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployeesRequest;
use App\Http\Requests\Admin\UpdateEmployeesRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class EmployeesController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Employee::all();
    }

    public function show($id)
    {
        return Employee::findOrFail($id);
    }

    public function update(UpdateEmployeesRequest $request, $id)
    {
        $request = $this->saveFiles($request);
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        
        $qualifications           = $employee->qualifications;
        $currentQualificationData = [];
        foreach ($request->input('qualifications', []) as $index => $data) {
            if (is_integer($index)) {
                $employee->qualifications()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentQualificationData[$id] = $data;
            }
        }
        foreach ($qualifications as $item) {
            if (isset($currentQualificationData[$item->id])) {
                $item->update($currentQualificationData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $emergencyContacts           = $employee->emergency_contacts;
        $currentEmergencyContactData = [];
        foreach ($request->input('emergency_contacts', []) as $index => $data) {
            if (is_integer($index)) {
                $employee->emergency_contacts()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentEmergencyContactData[$id] = $data;
            }
        }
        foreach ($emergencyContacts as $item) {
            if (isset($currentEmergencyContactData[$item->id])) {
                $item->update($currentEmergencyContactData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $identifications           = $employee->identifications;
        $currentIdentificationData = [];
        foreach ($request->input('identifications', []) as $index => $data) {
            if (is_integer($index)) {
                $employee->identifications()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentIdentificationData[$id] = $data;
            }
        }
        foreach ($identifications as $item) {
            if (isset($currentIdentificationData[$item->id])) {
                $item->update($currentIdentificationData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $beneficiaryDetails           = $employee->beneficiary_details;
        $currentBeneficiaryDetailData = [];
        foreach ($request->input('beneficiary_details', []) as $index => $data) {
            if (is_integer($index)) {
                $employee->beneficiary_details()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentBeneficiaryDetailData[$id] = $data;
            }
        }
        foreach ($beneficiaryDetails as $item) {
            if (isset($currentBeneficiaryDetailData[$item->id])) {
                $item->update($currentBeneficiaryDetailData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $employee;
    }

    public function store(StoreEmployeesRequest $request)
    {
        $request = $this->saveFiles($request);
        $employee = Employee::create($request->all());
        
        foreach ($request->input('qualifications', []) as $data) {
            $employee->qualifications()->create($data);
        }
        foreach ($request->input('emergency_contacts', []) as $data) {
            $employee->emergency_contacts()->create($data);
        }
        foreach ($request->input('identifications', []) as $data) {
            $employee->identifications()->create($data);
        }
        foreach ($request->input('beneficiary_details', []) as $data) {
            $employee->beneficiary_details()->create($data);
        }

        return $employee;
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return '';
    }
}
