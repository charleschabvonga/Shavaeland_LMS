<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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

    /**
     * Display a listing of Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('employee_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('employee_delete')) {
                return abort(401);
            }
            $employees = Employee::onlyTrashed()->get();
        } else {
            $employees = Employee::all();
        }

        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating new Employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        
        $departments = \App\Department::get()->pluck('dept_name', 'id');

        $enum_position = Employee::$enum_position;
                    $enum_status = Employee::$enum_status;
            
        return view('admin.employees.create', compact('enum_position', 'enum_status', 'departments'));
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeesRequest $request)
    {
        if (! Gate::allows('employee_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $employee = Employee::create($request->all());
        $employee->department()->sync(array_filter((array)$request->input('department')));

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


        return redirect()->route('admin.employees.index');
    }


    /**
     * Show the form for editing Employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        
        $departments = \App\Department::get()->pluck('dept_name', 'id');

        $enum_position = Employee::$enum_position;
                    $enum_status = Employee::$enum_status;
            
        $employee = Employee::findOrFail($id);

        return view('admin.employees.edit', compact('employee', 'enum_position', 'enum_status', 'departments'));
    }

    /**
     * Update Employee in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request, $id)
    {
        if (! Gate::allows('employee_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        $employee->department()->sync(array_filter((array)$request->input('department')));

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


        return redirect()->route('admin.employees.index');
    }


    /**
     * Display Employee.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('employee_view')) {
            return abort(401);
        }
        
        $departments = \App\Department::get()->pluck('dept_name', 'id');
$violations = \App\Violation::where('employee_name_id', $id)->get();$payee_accounts = \App\PayeeAccount::where('employee_id', $id)->get();$qualifications = \App\Qualification::where('employee_name_id', $id)->get();$emergency_contacts = \App\EmergencyContact::where('employee_name_id', $id)->get();$identifications = \App\Identification::where('employee_name_id', $id)->get();$beneficiary_details = \App\BeneficiaryDetail::where('employee_name_id', $id)->get();$drug_tests = \App\DrugTest::where('employee_name_id', $id)->get();$payee_payments = \App\PayeePayment::where('employee_id', $id)->get();$vendor_accounts = \App\VendorAccount::where('account_manager_id', $id)->get();$job_requests = \App\JobRequest::where('workshop_manager_id', $id)->get();$client_accounts = \App\ClientAccount::where('account_manager_id', $id)->get();$quotations = \App\Quotation::where('sales_person_id', $id)->get();$purchase_orders = \App\PurchaseOrder::where('buyer_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('driver_id', $id)->get();$delivery_instructions = \App\DeliveryInstruction::where('driver_id', $id)->get();$payslips = \App\Payslip::where('employee_id', $id)->get();$parts_acquireds = \App\PartsAcquired::where('received_by_id', $id)->get();$road_freights = \App\RoadFreight::where('project_manager_id', $id)->get();$parts_acquireds = \App\PartsAcquired::where('dispatched_by_id', $id)->get();$air_freights = \App\AirFreight::where('project_manager_id', $id)->get();$sea_freights = \App\SeaFreight::where('project_manager_id', $id)->get();$rail_freights = \App\RailFreight::where('project_manager_id', $id)->get();$payee_accounts = \App\PayeeAccount::where('position_id', $id)->get();$road_freights = \App\RoadFreight::where('driver_id', $id)->get();$clearance_and_forwardings = \App\ClearanceAndForwarding::where('project_manager_id', $id)->get();$releasings = \App\Releasing::where('released_by_id', $id)->get();$receivings = \App\Receiving::where('received_by_id', $id)->get();$debit_notes = \App\DebitNote::where('account_manager_id', $id)->get();$income_categories = \App\IncomeCategory::where('account_manager_id', $id)->get();$credit_notes = \App\CreditNote::where('account_manager_id', $id)->get();$releasings = \App\Releasing::where('project_manager_id', $id)->get();$receivings = \App\Receiving::where('project_manager_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('account_manager_id', $id)->get();$client_job_cards = \App\ClientJobCard::whereHas('technician',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$inhouse_job_cards = \App\InhouseJobCard::whereHas('technician',
                    function ($query) use ($id) {
                        $query->where('id', $id);
                    })->get();$delivery_instructions = \App\DeliveryInstruction::where('project_manager_id', $id)->get();$loading_instructions = \App\LoadingInstruction::where('project_manager_id', $id)->get();$inhouse_job_cards = \App\InhouseJobCard::where('workshop_manager_id', $id)->get();

        $employee = Employee::findOrFail($id);

        return view('admin.employees.show', compact('employee', 'violations', 'payee_accounts', 'qualifications', 'emergency_contacts', 'identifications', 'beneficiary_details', 'drug_tests', 'payee_payments', 'vendor_accounts', 'job_requests', 'client_accounts', 'quotations', 'purchase_orders', 'loading_instructions', 'delivery_instructions', 'payslips', 'parts_acquireds', 'road_freights', 'parts_acquireds', 'air_freights', 'sea_freights', 'rail_freights', 'payee_accounts', 'road_freights', 'clearance_and_forwardings', 'releasings', 'receivings', 'debit_notes', 'income_categories', 'credit_notes', 'releasings', 'receivings', 'expense_categories', 'client_job_cards', 'inhouse_job_cards', 'delivery_instructions', 'loading_instructions', 'inhouse_job_cards'));
    }


    /**
     * Remove Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('admin.employees.index');
    }

    /**
     * Delete all selected Employee at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Employee::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::onlyTrashed()->findOrFail($id);
        $employee->restore();

        return redirect()->route('admin.employees.index');
    }

    /**
     * Permanently delete Employee from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('employee_delete')) {
            return abort(401);
        }
        $employee = Employee::onlyTrashed()->findOrFail($id);
        $employee->forceDelete();

        return redirect()->route('admin.employees.index');
    }
}
