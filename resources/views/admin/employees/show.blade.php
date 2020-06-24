@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">EMPLOYEE</span></h1>
                                <h4><b>Name</b>: <span style="color:red">{{ $employee->name }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($employee->department != '')
                                <b>Department</b>:
                                @foreach ($employee->department as $singleDepartment)
                                    <span class="label label-info label-many">{{ $singleDepartment->dept_name }}</span>
                                @endforeach
                            @endif
                            @if ($employee->position != '')
                                <br><b>Position</b>: {{ $employee->position }}
                            @endif
                            @if ($employee->start_date != '')
                                <br><b>Start date</b>: {{ $employee->start_date }}
                            @endif
                            @if ($employee->end_date != '')
                                <br><b>End date</b>: {{ $employee->end_date }}
                            @endif
                            @if ($employee->status != '')
                                <br><b>Status</b>: {{ $employee->status }}
                            @endif

                            @if($employee->upload_qualifications)
                                <br><b>Qualifications</b>:<a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_qualifications) }}" target="_blank">Download file</a>
                            @endif</td>
                        
                            @if($employee->upload_identification_docs)
                                <br><b>Identifications</b>:<a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_identification_docs) }}" target="_blank">Download file</a>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            @if ($employee->street_address != '')
                                <b>Address</b>: {{ $employee->street_address }}
                            @endif
                            @if ($employee->city != '')
                                <br> {{ $employee->city }}
                            @endif
                            @if ($employee->province != '')
                                , {{ $employee->province }}
                            @endif
                            @if ($employee->country != '')
                                , {{ $employee->country }}
                            @endif
                            @if ($employee->sa_mobile != '')
                                <br><b>Tel</b>: {{ $employee->sa_mobile }}
                            @endif
                            @if ($employee->sa_mobile != '')
                                <br><b>Tel</b>: {{ $employee->int_mobile }}
                            @endif
                            @if ($employee->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $employee->email }}</span>
                            @endif
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#violations" aria-controls="violations" role="tab" data-toggle="tab">Traffic Violations</a></li>
    <li role="presentation" class=""><a href="#payee_accounts" aria-controls="payee_accounts" role="tab" data-toggle="tab">Employee accounts</a></li>
    <li role="presentation" class=""><a href="#qualifications" aria-controls="qualifications" role="tab" data-toggle="tab">Qualifications</a></li>
    <li role="presentation" class=""><a href="#emergency_contacts" aria-controls="emergency_contacts" role="tab" data-toggle="tab">Emergency contacts</a></li>
    <li role="presentation" class=""><a href="#identifications" aria-controls="identifications" role="tab" data-toggle="tab">Identifications</a></li>
    <li role="presentation" class=""><a href="#beneficiary_details" aria-controls="beneficiary_details" role="tab" data-toggle="tab">Beneficiary details</a></li>
    <li role="presentation" class=""><a href="#drug_tests" aria-controls="drug_tests" role="tab" data-toggle="tab">Drug tests</a></li>
    <li role="presentation" class=""><a href="#payee_payments" aria-controls="payee_payments" role="tab" data-toggle="tab">Payslip payments</a></li>
    <li role="presentation" class=""><a href="#vendor_accounts" aria-controls="vendor_accounts" role="tab" data-toggle="tab">Vendor accounts</a></li>
    <li role="presentation" class=""><a href="#job_requests" aria-controls="job_requests" role="tab" data-toggle="tab">Job requests</a></li>
    <li role="presentation" class=""><a href="#client_accounts" aria-controls="client_accounts" role="tab" data-toggle="tab">Client accounts</a></li>
    <li role="presentation" class=""><a href="#quotation" aria-controls="quotation" role="tab" data-toggle="tab">Quotations</a></li>
    <li role="presentation" class=""><a href="#purchase_orders" aria-controls="purchase_orders" role="tab" data-toggle="tab">Purchase orders</a></li>
    <li role="presentation" class=""><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
    <li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
    <li role="presentation" class=""><a href="#payslips" aria-controls="payslips" role="tab" data-toggle="tab">Payslips</a></li>
    <li role="presentation" class=""><a href="#parts_acquired" aria-controls="parts_acquired" role="tab" data-toggle="tab">Procurements & requests</a></li>
    <li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
    <li role="presentation" class=""><a href="#parts_acquired" aria-controls="parts_acquired" role="tab" data-toggle="tab">Procurements & requests</a></li>
    <li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
    <li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
    <li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
    <li role="presentation" class=""><a href="#payee_accounts" aria-controls="payee_accounts" role="tab" data-toggle="tab">Employee accounts</a></li>
    <li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
    <li role="presentation" class=""><a href="#clearance_and_forwarding" aria-controls="clearance_and_forwarding" role="tab" data-toggle="tab">Clearance & forwarding</a></li>
    <li role="presentation" class=""><a href="#releasing" aria-controls="releasing" role="tab" data-toggle="tab">Goods collections</a></li>
    <li role="presentation" class=""><a href="#receiving" aria-controls="receiving" role="tab" data-toggle="tab">Goods Receipts</a></li>
    <li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
    <li role="presentation" class=""><a href="#income_category" aria-controls="income_category" role="tab" data-toggle="tab">Client tax invoices</a></li>
    <li role="presentation" class=""><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Credit notes</a></li>
    <li role="presentation" class=""><a href="#releasing" aria-controls="releasing" role="tab" data-toggle="tab">Goods collections</a></li>
    <li role="presentation" class=""><a href="#receiving" aria-controls="receiving" role="tab" data-toggle="tab">Goods Receipts</a></li>
    <li role="presentation" class=""><a href="#expense_category" aria-controls="expense_category" role="tab" data-toggle="tab">Vendor tax invoices</a></li>
    <li role="presentation" class=""><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#inhouse_job_cards" aria-controls="inhouse_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
    <li role="presentation" class=""><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="violations">
    <table class="table table-bordered table-striped {{ count($violations) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.violations.fields.employee-name')</th>
                            <th>@lang('global.violations.fields.vehicle-description')</th>
                            <th>@lang('global.violations.fields.trailer')</th>
                            <th>@lang('global.violations.fields.road-freight-number')</th>
                            <th>@lang('global.violations.fields.citation-number')</th>
                            <th>@lang('global.violations.fields.citation-date')</th>
                            <th>@lang('global.violations.fields.description')</th>
                            <th>@lang('global.violations.fields.location-issued')</th>
                            <th>@lang('global.violations.fields.status')</th>
                            <th>@lang('global.violations.fields.amount')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($violations) > 0)
                @foreach ($violations as $violation)
                    <tr data-entry-id="{{ $violation->id }}">
                        <td field-key='employee_name'>{{ $violation->employee_name->name or '' }}</td>
                                    <td field-key='vehicle_description'>{{ $violation->vehicle_description->vehicle_description or '' }}</td>
                                    <td field-key='trailer'>{{ $violation->trailer->trailer_description or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $violation->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='citation_number'>{{ $violation->citation_number }}</td>
                                    <td field-key='citation_date'>{{ $violation->citation_date }}</td>
                                    <td field-key='description'>{{ $violation->description }}</td>
                                    <td field-key='location_issued'>{{ $violation->location_issued_address }}</td>
                                    <td field-key='file'>@if($violation->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $violation->file) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='status'>{{ $violation->status }}</td>
                                    <td field-key='amount'>{{ $violation->amount }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.violations.restore', $violation->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.violations.perma_del', $violation->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('violation_view')
                                        <a href="{{ route('admin.violations.show',[$violation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('violation_edit')
                                        <a href="{{ route('admin.violations.edit',[$violation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('violation_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.violations.destroy', $violation->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="payee_accounts">
    <table class="table table-bordered table-striped {{ count($payee_accounts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.payee-accounts.fields.employee')</th>
                            <th>@lang('global.payee-accounts.fields.bank')</th>
                            <th>@lang('global.payee-accounts.fields.account-number')</th>
                            <th>@lang('global.payee-accounts.fields.branch-code')</th>
                            <th>@lang('global.payee-accounts.fields.branch')</th>
                            <th>@lang('global.payee-accounts.fields.department')</th>
                            <th>@lang('global.payee-accounts.fields.position')</th>
                            <th>@lang('global.payee-accounts.fields.status')</th>
                            <th>@lang('global.payee-accounts.fields.pymt-measurement-type')</th>
                            <th>@lang('global.payee-accounts.fields.wage-rate')</th>
                            <th>@lang('global.payee-accounts.fields.pension-rate')</th>
                            <th>@lang('global.payee-accounts.fields.overtime-rate')</th>
                            <th>@lang('global.payee-accounts.fields.public-holiday-rate')</th>
                            <th>@lang('global.payee-accounts.fields.medical-aid')</th>
                            <th>@lang('global.payee-accounts.fields.sales-rate')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($payee_accounts) > 0)
                @foreach ($payee_accounts as $payee_account)
                    <tr data-entry-id="{{ $payee_account->id }}">
                        <td field-key='employee'>{{ $payee_account->employee->name or '' }}</td>
                                    <td field-key='bank'>{{ $payee_account->bank }}</td>
                                    <td field-key='account_number'>{{ $payee_account->account_number }}</td>
                                    <td field-key='branch_code'>{{ $payee_account->branch_code }}</td>
                                    <td field-key='branch'>{{ $payee_account->branch }}</td>
                                    <td field-key='department'>{{ $payee_account->department->dept_name or '' }}</td>
                                    <td field-key='position'>{{ $payee_account->position->position or '' }}</td>
                                    <td field-key='status'>{{ $payee_account->status }}</td>
                                    <td field-key='pymt_measurement_type'>{{ $payee_account->pymt_measurement_type }}</td>
                                    <td field-key='wage_rate'>{{ $payee_account->wage_rate }}</td>
                                    <td field-key='pension_rate'>{{ $payee_account->pension_rate }}</td>
                                    <td field-key='overtime_rate'>{{ $payee_account->overtime_rate }}</td>
                                    <td field-key='public_holiday_rate'>{{ $payee_account->public_holiday_rate }}</td>
                                    <td field-key='medical_aid'>{{ $payee_account->medical_aid }}</td>
                                    <td field-key='sales_rate'>{{ $payee_account->sales_rate }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.restore', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.perma_del', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('payee_account_view')
                                        <a href="{{ route('admin.payee_accounts.show',[$payee_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('payee_account_edit')
                                        <a href="{{ route('admin.payee_accounts.edit',[$payee_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('payee_account_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.destroy', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="20">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="qualifications">
    <table class="table table-bordered table-striped {{ count($qualifications) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.qualifications.fields.institution')</th>
                            <th>@lang('global.qualifications.fields.description')</th>
                            <th>@lang('global.qualifications.fields.date-obtained')</th>
                            <th>@lang('global.qualifications.fields.expiry-date')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($qualifications) > 0)
                @foreach ($qualifications as $qualification)
                    <tr data-entry-id="{{ $qualification->id }}">
                        <td field-key='file'>@if($qualification->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $qualification->file) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='institution'>{{ $qualification->institution }}</td>
                                    <td field-key='description'>{{ $qualification->description }}</td>
                                    <td field-key='date_obtained'>{{ $qualification->date_obtained }}</td>
                                    <td field-key='expiry_date'>{{ $qualification->expiry_date }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.qualifications.restore', $qualification->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.qualifications.perma_del', $qualification->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('qualification_view')
                                        <a href="{{ route('admin.qualifications.show',[$qualification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('qualification_edit')
                                        <a href="{{ route('admin.qualifications.edit',[$qualification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('qualification_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.qualifications.destroy', $qualification->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="emergency_contacts">
    <table class="table table-bordered table-striped {{ count($emergency_contacts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.emergency-contacts.fields.name')</th>
                            <th>@lang('global.emergency-contacts.fields.phone1')</th>
                            <th>@lang('global.emergency-contacts.fields.phone')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($emergency_contacts) > 0)
                @foreach ($emergency_contacts as $emergency_contact)
                    <tr data-entry-id="{{ $emergency_contact->id }}">
                        <td field-key='name'>{{ $emergency_contact->name }}</td>
                                    <td field-key='phone1'>{{ $emergency_contact->phone1 }}</td>
                                    <td field-key='phone'>{{ $emergency_contact->phone }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.emergency_contacts.restore', $emergency_contact->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.emergency_contacts.perma_del', $emergency_contact->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('emergency_contact_view')
                                        <a href="{{ route('admin.emergency_contacts.show',[$emergency_contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('emergency_contact_edit')
                                        <a href="{{ route('admin.emergency_contacts.edit',[$emergency_contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('emergency_contact_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.emergency_contacts.destroy', $emergency_contact->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="identifications">
    <table class="table table-bordered table-striped {{ count($identifications) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.identifications.fields.id-type')</th>
                            <th>@lang('global.identifications.fields.id-number')</th>
                            <th>@lang('global.identifications.fields.date-of-birth')</th>
                            <th>@lang('global.identifications.fields.date-obtained')</th>
                            <th>@lang('global.identifications.fields.expiry-date')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($identifications) > 0)
                @foreach ($identifications as $identification)
                    <tr data-entry-id="{{ $identification->id }}">
                        <td field-key='id_type'>{{ $identification->id_type }}</td>
                                    <td field-key='id_number'>{{ $identification->id_number }}</td>
                                    <td field-key='date_of_birth'>{{ $identification->date_of_birth }}</td>
                                    <td field-key='identification'>@if($identification->identification)<a href="{{ asset(env('UPLOAD_PATH').'/' . $identification->identification) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='date_obtained'>{{ $identification->date_obtained }}</td>
                                    <td field-key='expiry_date'>{{ $identification->expiry_date }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.identifications.restore', $identification->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.identifications.perma_del', $identification->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('identification_view')
                                        <a href="{{ route('admin.identifications.show',[$identification->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('identification_edit')
                                        <a href="{{ route('admin.identifications.edit',[$identification->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('identification_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.identifications.destroy', $identification->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="beneficiary_details">
    <table class="table table-bordered table-striped {{ count($beneficiary_details) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.beneficiary-details.fields.beneficiary-name')</th>
                            <th>@lang('global.beneficiary-details.fields.id-number')</th>
                            <th>@lang('global.beneficiary-details.fields.address')</th>
                            <th>@lang('global.beneficiary-details.fields.phone1')</th>
                            <th>@lang('global.beneficiary-details.fields.phone')</th>
                            <th>@lang('global.beneficiary-details.fields.allocation-percentage')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($beneficiary_details) > 0)
                @foreach ($beneficiary_details as $beneficiary_detail)
                    <tr data-entry-id="{{ $beneficiary_detail->id }}">
                        <td field-key='beneficiary_name'>{{ $beneficiary_detail->beneficiary_name }}</td>
                                    <td field-key='id_number'>{{ $beneficiary_detail->id_number }}</td>
                                    <td field-key='address'>{{ $beneficiary_detail->address }}</td>
                                    <td field-key='phone1'>{{ $beneficiary_detail->phone1 }}</td>
                                    <td field-key='phone'>{{ $beneficiary_detail->phone }}</td>
                                    <td field-key='allocation_percentage'>{{ $beneficiary_detail->allocation_percentage }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.beneficiary_details.restore', $beneficiary_detail->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.beneficiary_details.perma_del', $beneficiary_detail->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('beneficiary_detail_view')
                                        <a href="{{ route('admin.beneficiary_details.show',[$beneficiary_detail->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('beneficiary_detail_edit')
                                        <a href="{{ route('admin.beneficiary_details.edit',[$beneficiary_detail->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('beneficiary_detail_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.beneficiary_details.destroy', $beneficiary_detail->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="drug_tests">
    <table class="table table-bordered table-striped {{ count($drug_tests) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.drug-tests.fields.drug-test-number')</th>
                            <th>@lang('global.drug-tests.fields.employee-name')</th>
                            <th>@lang('global.drug-tests.fields.last-annual-drug-test')</th>
                            <th>@lang('global.drug-tests.fields.last-random-drug-test')</th>
                            <th>@lang('global.drug-tests.fields.last-physical-exam-date')</th>
                            <th>@lang('global.drug-tests.fields.description')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($drug_tests) > 0)
                @foreach ($drug_tests as $drug_test)
                    <tr data-entry-id="{{ $drug_test->id }}">
                        <td field-key='drug_test_number'>{{ $drug_test->drug_test_number }}</td>
                                    <td field-key='employee_name'>{{ $drug_test->employee_name->name or '' }}</td>
                                    <td field-key='last_annual_drug_test'>{{ $drug_test->last_annual_drug_test }}</td>
                                    <td field-key='last_random_drug_test'>{{ $drug_test->last_random_drug_test }}</td>
                                    <td field-key='last_physical_exam_date'>{{ $drug_test->last_physical_exam_date }}</td>
                                    <td field-key='description'>{!! $drug_test->description !!}</td>
                                    <td field-key='file'>@if($drug_test->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $drug_test->file) }}" target="_blank">Download file</a>@endif</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drug_tests.restore', $drug_test->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drug_tests.perma_del', $drug_test->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('drug_test_view')
                                        <a href="{{ route('admin.drug_tests.show',[$drug_test->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('drug_test_edit')
                                        <a href="{{ route('admin.drug_tests.edit',[$drug_test->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('drug_test_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drug_tests.destroy', $drug_test->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="payee_payments">
    <table class="table table-bordered table-striped {{ count($payee_payments) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.payee-payments.fields.entry-date')</th>
                            <th>@lang('global.payee-payments.fields.employee')</th>
                            <th>@lang('global.payee-payments.fields.payslip-number')</th>
                            <th>@lang('global.payee-payments.fields.batch-number')</th>
                            <th>@lang('global.payee-payments.fields.withdrawal-transaction-number')</th>
                            <th>@lang('global.payee-payments.fields.payee-account-number')</th>
                            <th>@lang('global.payee-payments.fields.payee-payment-number')</th>
                            <th>@lang('global.payee-payments.fields.payment-mode')</th>
                            <th>@lang('global.payee-payments.fields.amount')</th>
                            <th>@lang('global.payee-payments.fields.prepared-by')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($payee_payments) > 0)
                @foreach ($payee_payments as $payee_payment)
                    <tr data-entry-id="{{ $payee_payment->id }}">
                        <td field-key='entry_date'>{{ $payee_payment->entry_date }}</td>
                                    <td field-key='employee'>{{ $payee_payment->employee->name or '' }}</td>
                                    <td field-key='payslip_number'>{{ $payee_payment->payslip_number->payslip_number or '' }}</td>
                                    <td field-key='batch_number'>{{ $payee_payment->batch_number->batch_number or '' }}</td>
                                    <td field-key='withdrawal_transaction_number'>{{ $payee_payment->withdrawal_transaction_number->payment_number or '' }}</td>
                                    <td field-key='payee_account_number'>{{ $payee_payment->payee_account_number->account_number or '' }}</td>
                                    <td field-key='payee_payment_number'>{{ $payee_payment->payee_payment_number }}</td>
                                    <td field-key='payment_mode'>{{ $payee_payment->payment_mode }}</td>
                                    <td field-key='amount'>{{ $payee_payment->amount }}</td>
                                    <td field-key='prepared_by'>{{ $payee_payment->prepared_by }}</td>
                                                                    <td>
                                        @can('payee_payment_view')
                                        <a href="{{ route('admin.payee_payments.show',[$payee_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('payee_payment_edit')
                                        <a href="{{ route('admin.payee_payments.edit',[$payee_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('payee_payment_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_payments.destroy', $payee_payment->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="15">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="vendor_accounts">
    <table class="table table-bordered table-striped {{ count($vendor_accounts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.vendor-accounts.fields.vendor')</th>
                            <th>@lang('global.vendor-accounts.fields.contact-person')</th>
                            <th>@lang('global.vendor-accounts.fields.account-manager')</th>
                            <th>@lang('global.vendor-accounts.fields.account-number')</th>
                            <th>@lang('global.vendor-accounts.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($vendor_accounts) > 0)
                @foreach ($vendor_accounts as $vendor_account)
                    <tr data-entry-id="{{ $vendor_account->id }}">
                        <td field-key='vendor'>{{ $vendor_account->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $vendor_account->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $vendor_account->account_manager->name or '' }}</td>
                                    <td field-key='account_number'>{{ $vendor_account->account_number }}</td>
                                    <td field-key='status'>{{ $vendor_account->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vendor_accounts.restore', $vendor_account->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vendor_accounts.perma_del', $vendor_account->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('vendor_account_view')
                                        <a href="{{ route('admin.vendor_accounts.show',[$vendor_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('vendor_account_edit')
                                        <a href="{{ route('admin.vendor_accounts.edit',[$vendor_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('vendor_account_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vendor_accounts.destroy', $vendor_account->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="job_requests">
    <table class="table table-bordered table-striped {{ count($job_requests) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.job-requests.fields.project-number')</th>
                            <th>@lang('global.job-requests.fields.description')</th>
                            <th>@lang('global.job-requests.fields.workshop-manager')</th>
                            <th>@lang('global.job-requests.fields.job-request-number')</th>
                            <th>@lang('global.job-requests.fields.requested-by')</th>
                            <th>@lang('global.job-requests.fields.client')</th>
                            <th>@lang('global.job-requests.fields.contact-person')</th>
                            <th>@lang('global.job-requests.fields.date')</th>
                            <th>@lang('global.job-requests.fields.vehicle-type')</th>
                            <th>@lang('global.job-requests.fields.vehicle-registration-number')</th>
                            <th>@lang('global.job-requests.fields.make')</th>
                            <th>@lang('global.job-requests.fields.model')</th>
                            <th>@lang('global.job-requests.fields.mileage')</th>
                            <th>@lang('global.job-requests.fields.next-service-mileage')</th>
                            <th>@lang('global.job-requests.fields.next-service-date')</th>
                            <th>@lang('global.job-requests.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($job_requests) > 0)
                @foreach ($job_requests as $job_request)
                    <tr data-entry-id="{{ $job_request->id }}">
                        <td field-key='project_number'>{{ $job_request->project_number->operation_number or '' }}</td>
                                    <td field-key='description'>{!! $job_request->description !!}</td>
                                    <td field-key='workshop_manager'>{{ $job_request->workshop_manager->name or '' }}</td>
                                    <td field-key='job_request_number'>{{ $job_request->job_request_number }}</td>
                                    <td field-key='requested_by'>{{ $job_request->requested_by }}</td>
                                    <td field-key='client'>{{ $job_request->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $job_request->contact_person->contact_name or '' }}</td>
                                    <td field-key='date'>{{ $job_request->date }}</td>
                                    <td field-key='vehicle_type'>{{ $job_request->vehicle_type }}</td>
                                    <td field-key='vehicle_registration_number'>{{ $job_request->vehicle_registration_number }}</td>
                                    <td field-key='make'>{{ $job_request->make }}</td>
                                    <td field-key='model'>{{ $job_request->model }}</td>
                                    <td field-key='mileage'>{{ $job_request->mileage }}</td>
                                    <td field-key='next_service_mileage'>{{ $job_request->next_service_mileage }}</td>
                                    <td field-key='next_service_date'>{{ $job_request->next_service_date }}</td>
                                    <td field-key='status'>{{ $job_request->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.restore', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.perma_del', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('job_request_view')
                                        <a href="{{ route('admin.job_requests.show',[$job_request->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('job_request_edit')
                                        <a href="{{ route('admin.job_requests.edit',[$job_request->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('job_request_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.destroy', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="client_accounts">
    <table class="table table-bordered table-striped {{ count($client_accounts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-accounts.fields.client')</th>
                            <th>@lang('global.client-accounts.fields.contact-person')</th>
                            <th>@lang('global.client-accounts.fields.account-manager')</th>
                            <th>@lang('global.client-accounts.fields.account-number')</th>
                            <th>@lang('global.client-accounts.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($client_accounts) > 0)
                @foreach ($client_accounts as $client_account)
                    <tr data-entry-id="{{ $client_account->id }}">
                        <td field-key='client'>{{ $client_account->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_account->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $client_account->account_manager->name or '' }}</td>
                                    <td field-key='account_number'>{{ $client_account->account_number }}</td>
                                    <td field-key='status'>{{ $client_account->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_accounts.restore', $client_account->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_accounts.perma_del', $client_account->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('client_account_view')
                                        <a href="{{ route('admin.client_accounts.show',[$client_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('client_account_edit')
                                        <a href="{{ route('admin.client_accounts.edit',[$client_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_account_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_accounts.destroy', $client_account->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="quotation">
    <table class="table table-bordered table-striped {{ count($quotations) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.quotation.fields.client')</th>
                            <th>@lang('global.quotation.fields.contact-person')</th>
                            <th>@lang('global.quotation.fields.sales-person')</th>
                            <th>@lang('global.quotation.fields.quotation-number')</th>
                            <th>@lang('global.quotation.fields.date')</th>
                            <th>@lang('global.quotation.fields.due-date')</th>
                            <th>@lang('global.quotation.fields.status')</th>
                            <th>@lang('global.quotation.fields.subtotal')</th>
                            <th>@lang('global.quotation.fields.vat')</th>
                            <th>@lang('global.quotation.fields.vat-amount')</th>
                            <th>@lang('global.quotation.fields.total-amount')</th>
                            <th>@lang('global.quotation.fields.prepared-by')</th>
                            <th>@lang('global.quotation.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($quotations) > 0)
                @foreach ($quotations as $quotation)
                    <tr data-entry-id="{{ $quotation->id }}">
                        <td field-key='client'>{{ $quotation->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $quotation->contact_person->contact_name or '' }}</td>
                                    <td field-key='sales_person'>{{ $quotation->sales_person->name or '' }}</td>
                                    <td field-key='quotation_number'>{{ $quotation->quotation_number }}</td>
                                    <td field-key='date'>{{ $quotation->date }}</td>
                                    <td field-key='due_date'>{{ $quotation->due_date }}</td>
                                    <td field-key='status'>{{ $quotation->status }}</td>
                                    <td field-key='subtotal'>{{ $quotation->subtotal }}</td>
                                    <td field-key='vat'>{{ $quotation->vat }}</td>
                                    <td field-key='vat_amount'>{{ $quotation->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $quotation->total_amount }}</td>
                                    <td field-key='prepared_by'>{{ $quotation->prepared_by }}</td>
                                    <td field-key='currency'>{{ $quotation->currency->name or '' }}</td>
                                                                    <td>
                                        @can('quotation_view')
                                        <a href="{{ route('admin.quotations.show',[$quotation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('quotation_edit')
                                        <a href="{{ route('admin.quotations.edit',[$quotation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('quotation_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.quotations.destroy', $quotation->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="purchase_orders">
    <table class="table table-bordered table-striped {{ count($purchase_orders) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.purchase-orders.fields.vendor')</th>
                            <th>@lang('global.purchase-orders.fields.contact-person')</th>
                            <th>@lang('global.purchase-orders.fields.buyer')</th>
                            <th>@lang('global.purchase-orders.fields.purchase-order-number')</th>
                            <th>@lang('global.purchase-orders.fields.date')</th>
                            <th>@lang('global.purchase-orders.fields.request-date')</th>
                            <th>@lang('global.purchase-orders.fields.procurement-date')</th>
                            <th>@lang('global.purchase-orders.fields.subtotal')</th>
                            <th>@lang('global.purchase-orders.fields.status')</th>
                            <th>@lang('global.purchase-orders.fields.vat')</th>
                            <th>@lang('global.purchase-orders.fields.vat-amount')</th>
                            <th>@lang('global.purchase-orders.fields.total-amount')</th>
                            <th>@lang('global.purchase-orders.fields.prepared-by')</th>
                            <th>@lang('global.purchase-orders.fields.requested-by')</th>
                            <th>@lang('global.purchase-orders.fields.hod')</th>
                            <th>@lang('global.purchase-orders.fields.gm')</th>
                            <th>@lang('global.purchase-orders.fields.accounts')</th>
                            <th>@lang('global.purchase-orders.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($purchase_orders) > 0)
                @foreach ($purchase_orders as $purchase_order)
                    <tr data-entry-id="{{ $purchase_order->id }}">
                        <td field-key='vendor'>{{ $purchase_order->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $purchase_order->contact_person->contact_name or '' }}</td>
                                    <td field-key='buyer'>{{ $purchase_order->buyer->name or '' }}</td>
                                    <td field-key='purchase_order_number'>{{ $purchase_order->purchase_order_number }}</td>
                                    <td field-key='date'>{{ $purchase_order->date }}</td>
                                    <td field-key='request_date'>{{ $purchase_order->request_date }}</td>
                                    <td field-key='procurement_date'>{{ $purchase_order->procurement_date }}</td>
                                    <td field-key='subtotal'>{{ $purchase_order->subtotal }}</td>
                                    <td field-key='status'>{{ $purchase_order->status }}</td>
                                    <td field-key='vat'>{{ $purchase_order->vat }}</td>
                                    <td field-key='vat_amount'>{{ $purchase_order->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $purchase_order->total_amount }}</td>
                                    <td field-key='prepared_by'>{{ $purchase_order->prepared_by }}</td>
                                    <td field-key='requested_by'>{{ $purchase_order->requested_by }}</td>
                                    <td field-key='hod'>{{ Form::checkbox("hod", 1, $purchase_order->hod == 1 ? true : false, ["disabled"]) }}</td>
                                    <td field-key='gm'>{{ Form::checkbox("gm", 1, $purchase_order->gm == 1 ? true : false, ["disabled"]) }}</td>
                                    <td field-key='accounts'>{{ Form::checkbox("accounts", 1, $purchase_order->accounts == 1 ? true : false, ["disabled"]) }}</td>
                                    <td field-key='currency'>{{ $purchase_order->currency->name or '' }}</td>
                                                                    <td>
                                        @can('purchase_order_view')
                                        <a href="{{ route('admin.purchase_orders.show',[$purchase_order->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('purchase_order_edit')
                                        <a href="{{ route('admin.purchase_orders.edit',[$purchase_order->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('purchase_order_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.purchase_orders.destroy', $purchase_order->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="loading_instruction">
    <table class="table table-bordered table-striped {{ count($loading_instructions) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.loading-instruction.fields.road-freight-number')</th>
                            <th>@lang('global.loading-instruction.fields.freight-contract-type')</th>
                            <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                            <th>@lang('global.loading-instruction.fields.driver')</th>
                            <th>@lang('global.loading-instruction.fields.vehicle')</th>
                            <th>@lang('global.loading-instruction.fields.trailers')</th>
                            <th>@lang('global.loading-instruction.fields.vendor')</th>
                            <th>@lang('global.loading-instruction.fields.vendor-driver')</th>
                            <th>@lang('global.loading-instruction.fields.vendor-vehicle-description')</th>
                            <th>@lang('global.loading-instruction.fields.order-number')</th>
                            <th>@lang('global.loading-instruction.fields.client')</th>
                            <th>@lang('global.loading-instruction.fields.contact-person')</th>
                            <th>@lang('global.loading-instruction.fields.project-manager')</th>
                            <th>@lang('global.loading-instruction.fields.pick-up-company-name')</th>
                            <th>@lang('global.loading-instruction.fields.pickup-address')</th>
                            <th>@lang('global.loading-instruction.fields.pickup-date-time')</th>
                            <th>@lang('global.loading-instruction.fields.prepared-by')</th>
                            <th>@lang('global.loading-instruction.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($loading_instructions) > 0)
                @foreach ($loading_instructions as $loading_instruction)
                    <tr data-entry-id="{{ $loading_instruction->id }}">
                        <td field-key='road_freight_number'>{{ $loading_instruction->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='freight_contract_type'>{{ $loading_instruction->freight_contract_type }}</td>
                                    <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                    <td field-key='driver'>{{ $loading_instruction->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $loading_instruction->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($loading_instruction->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor'>{{ $loading_instruction->vendor->name or '' }}</td>
                                    <td field-key='vendor_driver'>{{ $loading_instruction->vendor_driver->name or '' }}</td>
                                    <td field-key='vendor_vehicle_description'>
                                        @foreach ($loading_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                            <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='order_number'>{{ $loading_instruction->order_number }}</td>
                                    <td field-key='client'>{{ $loading_instruction->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $loading_instruction->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $loading_instruction->project_manager->name or '' }}</td>
                                    <td field-key='pick_up_company_name'>{{ $loading_instruction->pick_up_company_name }}</td>
                                    <td field-key='pickup_address'>{{ $loading_instruction->pickup_address_address }}</td>
                                    <td field-key='pickup_date_time'>{{ $loading_instruction->pickup_date_time }}</td>
                                    <td field-key='prepared_by'>{{ $loading_instruction->prepared_by }}</td>
                                    <td field-key='status'>{{ $loading_instruction->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.restore', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.perma_del', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('loading_instruction_view')
                                        <a href="{{ route('admin.loading_instructions.show',[$loading_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('loading_instruction_edit')
                                        <a href="{{ route('admin.loading_instructions.edit',[$loading_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('loading_instruction_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.destroy', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="delivery_instruction">
    <table class="table table-bordered table-striped {{ count($delivery_instructions) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.delivery-instruction.fields.road-freight-number')</th>
                            <th>@lang('global.delivery-instruction.fields.freight-contract-type')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-instruction-number')</th>
                            <th>@lang('global.delivery-instruction.fields.driver')</th>
                            <th>@lang('global.delivery-instruction.fields.vehicle')</th>
                            <th>@lang('global.delivery-instruction.fields.trailers')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor-driver')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor-vehicle-description')</th>
                            <th>@lang('global.delivery-instruction.fields.order-number')</th>
                            <th>@lang('global.delivery-instruction.fields.client')</th>
                            <th>@lang('global.delivery-instruction.fields.contact-person')</th>
                            <th>@lang('global.delivery-instruction.fields.project-manager')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-company-name')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-address')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-date-time')</th>
                            <th>@lang('global.delivery-instruction.fields.prepared-by')</th>
                            <th>@lang('global.delivery-instruction.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($delivery_instructions) > 0)
                @foreach ($delivery_instructions as $delivery_instruction)
                    <tr data-entry-id="{{ $delivery_instruction->id }}">
                        <td field-key='road_freight_number'>{{ $delivery_instruction->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='freight_contract_type'>{{ $delivery_instruction->freight_contract_type }}</td>
                                    <td field-key='delivery_instruction_number'>{{ $delivery_instruction->delivery_instruction_number }}</td>
                                    <td field-key='driver'>{{ $delivery_instruction->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $delivery_instruction->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($delivery_instruction->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor'>{{ $delivery_instruction->vendor->name or '' }}</td>
                                    <td field-key='vendor_driver'>{{ $delivery_instruction->vendor_driver->name or '' }}</td>
                                    <td field-key='vendor_vehicle_description'>
                                        @foreach ($delivery_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                            <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='order_number'>{{ $delivery_instruction->order_number }}</td>
                                    <td field-key='client'>{{ $delivery_instruction->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $delivery_instruction->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $delivery_instruction->project_manager->name or '' }}</td>
                                    <td field-key='delivery_company_name'>{{ $delivery_instruction->delivery_company_name }}</td>
                                    <td field-key='delivery_address'>{{ $delivery_instruction->delivery_address_address }}</td>
                                    <td field-key='delivery_date_time'>{{ $delivery_instruction->delivery_date_time }}</td>
                                    <td field-key='prepared_by'>{{ $delivery_instruction->prepared_by }}</td>
                                    <td field-key='status'>{{ $delivery_instruction->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.restore', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.perma_del', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('delivery_instruction_view')
                                        <a href="{{ route('admin.delivery_instructions.show',[$delivery_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('delivery_instruction_edit')
                                        <a href="{{ route('admin.delivery_instructions.edit',[$delivery_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('delivery_instruction_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.destroy', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="payslips">
    <table class="table table-bordered table-striped {{ count($payslips) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.payslips.fields.date')</th>
                            <th>@lang('global.payslips.fields.starting-date')</th>
                            <th>@lang('global.payslips.fields.ending-date')</th>
                            <th>@lang('global.payslips.fields.employee')</th>
                            <th>@lang('global.payslips.fields.batch-number')</th>
                            <th>@lang('global.payslips.fields.account-number')</th>
                            <th>@lang('global.payslips.fields.payslip-number')</th>
                            <th>@lang('global.payslips.fields.status')</th>
                            <th>@lang('global.payslips.fields.overtime-and-bonus-total')</th>
                            <th>@lang('global.payslips.fields.deductions-total')</th>
                            <th>@lang('global.payslips.fields.gross')</th>
                            <th>@lang('global.payslips.fields.income-tax')</th>
                            <th>@lang('global.payslips.fields.income-tax-amount')</th>
                            <th>@lang('global.payslips.fields.net-income')</th>
                            <th>@lang('global.payslips.fields.paid-to-date')</th>
                            <th>@lang('global.payslips.fields.balance')</th>
                            <th>@lang('global.payslips.fields.prepared-by')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($payslips) > 0)
                @foreach ($payslips as $payslip)
                    <tr data-entry-id="{{ $payslip->id }}">
                        <td field-key='date'>{{ $payslip->date }}</td>
                                    <td field-key='starting_date'>{{ $payslip->starting_date }}</td>
                                    <td field-key='ending_date'>{{ $payslip->ending_date }}</td>
                                    <td field-key='employee'>{{ $payslip->employee->name or '' }}</td>
                                    <td field-key='batch_number'>{{ $payslip->batch_number->batch_number or '' }}</td>
                                    <td field-key='account_number'>{{ $payslip->account_number->account_number or '' }}</td>
                                    <td field-key='payslip_number'>{{ $payslip->payslip_number }}</td>
                                    <td field-key='status'>{{ $payslip->status }}</td>
                                    <td field-key='overtime_and_bonus_total'>{{ $payslip->overtime_and_bonus_total }}</td>
                                    <td field-key='deductions_total'>{{ $payslip->deductions_total }}</td>
                                    <td field-key='gross'>{{ $payslip->gross }}</td>
                                    <td field-key='income_tax'>{{ $payslip->income_tax }}</td>
                                    <td field-key='income_tax_amount'>{{ $payslip->income_tax_amount }}</td>
                                    <td field-key='net_income'>{{ $payslip->net_income }}</td>
                                    <td field-key='paid_to_date'>{{ $payslip->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $payslip->balance }}</td>
                                    <td field-key='prepared_by'>{{ $payslip->prepared_by }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payslips.restore', $payslip->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payslips.perma_del', $payslip->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('payslip_view')
                                        <a href="{{ route('admin.payslips.show',[$payslip->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('payslip_edit')
                                        <a href="{{ route('admin.payslips.edit',[$payslip->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('payslip_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payslips.destroy', $payslip->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="22">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="parts_acquired">
    <table class="table table-bordered table-striped {{ count($parts_acquireds) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.parts-acquired.fields.order-number')</th>
                            <th>@lang('global.parts-acquired.fields.prepared-by')</th>
                            <th>@lang('global.parts-acquired.fields.date')</th>
                            <th>@lang('global.parts-acquired.fields.transaction-type')</th>
                            <th>@lang('global.parts-acquired.fields.repair-center')</th>
                            <th>@lang('global.parts-acquired.fields.received-by')</th>
                            <th>@lang('global.parts-acquired.fields.dispatched-by')</th>
                            <th>@lang('global.parts-acquired.fields.part')</th>
                            <th>@lang('global.parts-acquired.fields.qty')</th>
                            <th>@lang('global.parts-acquired.fields.unit-price')</th>
                            <th>@lang('global.parts-acquired.fields.total')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($parts_acquireds) > 0)
                @foreach ($parts_acquireds as $parts_acquired)
                    <tr data-entry-id="{{ $parts_acquired->id }}">
                        <td field-key='order_number'>{{ $parts_acquired->order_number }}</td>
                                    <td field-key='prepared_by'>{{ $parts_acquired->prepared_by }}</td>
                                    <td field-key='date'>{{ $parts_acquired->date }}</td>
                                    <td field-key='transaction_type'>{{ $parts_acquired->transaction_type }}</td>
                                    <td field-key='repair_center'>{{ $parts_acquired->repair_center->center_name or '' }}</td>
                                    <td field-key='received_by'>{{ $parts_acquired->received_by->name or '' }}</td>
                                    <td field-key='dispatched_by'>{{ $parts_acquired->dispatched_by->name or '' }}</td>
                                    <td field-key='part'>{{ $parts_acquired->part->part or '' }}</td>
                                    <td field-key='qty'>{{ $parts_acquired->qty }}</td>
                                    <td field-key='unit_price'>{{ $parts_acquired->unit_price }}</td>
                                    <td field-key='total'>{{ $parts_acquired->total }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.restore', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.perma_del', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('parts_acquired_view')
                                        <a href="{{ route('admin.parts_acquireds.show',[$parts_acquired->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('parts_acquired_edit')
                                        <a href="{{ route('admin.parts_acquireds.edit',[$parts_acquired->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('parts_acquired_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.destroy', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="road_freights">
    <table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.road-freights.fields.project-number')</th>
                            <th>@lang('global.road-freights.fields.road-freight-number')</th>
                            <th>@lang('global.road-freights.fields.freight-contract-type')</th>
                            <th>@lang('global.road-freights.fields.route')</th>
                            <th>@lang('global.road-freights.fields.client')</th>
                            <th>@lang('global.road-freights.fields.contact-person')</th>
                            <th>@lang('global.road-freights.fields.project-manager')</th>
                            <th>@lang('global.road-freights.fields.driver')</th>
                            <th>@lang('global.road-freights.fields.vehicle')</th>
                            <th>@lang('global.road-freights.fields.trailers')</th>
                            <th>@lang('global.road-freights.fields.subcontractor-number')</th>
                            <th>@lang('global.road-freights.fields.vendor')</th>
                            <th>@lang('global.road-freights.fields.vendor-contact-person')</th>
                            <th>@lang('global.road-freights.fields.vendor-drivers')</th>
                            <th>@lang('global.road-freights.fields.vendor-vehicles')</th>
                            <th>@lang('global.road-freights.fields.road-freight-income')</th>
                            <th>@lang('global.road-freights.fields.road-freight-expenses')</th>
                            <th>@lang('global.road-freights.fields.machinery-costs')</th>
                            <th>@lang('global.road-freights.fields.breakdown')</th>
                            <th>@lang('global.road-freights.fields.total-expenses')</th>
                            <th>@lang('global.road-freights.fields.net-income')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($road_freights) > 0)
                @foreach ($road_freights as $road_freight)
                    <tr data-entry-id="{{ $road_freight->id }}">
                        <td field-key='project_number'>{{ $road_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                    <td field-key='freight_contract_type'>{{ $road_freight->freight_contract_type }}</td>
                                    <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                    <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $road_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $road_freight->project_manager->name or '' }}</td>
                                    <td field-key='driver'>{{ $road_freight->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $road_freight->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($road_freight->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='subcontractor_number'>{{ $road_freight->subcontractor_number->subcontractor_number or '' }}</td>
                                    <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                    <td field-key='vendor_contact_person'>{{ $road_freight->vendor_contact_person->contact_name or '' }}</td>
                                    <td field-key='vendor_drivers'>
                                        @foreach ($road_freight->vendor_drivers as $singleVendorDrivers)
                                            <span class="label label-info label-many">{{ $singleVendorDrivers->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor_vehicles'>
                                        @foreach ($road_freight->vendor_vehicles as $singleVendorVehicles)
                                            <span class="label label-info label-many">{{ $singleVendorVehicles->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='road_freight_income'>{{ $road_freight->road_freight_income }}</td>
                                    <td field-key='road_freight_expenses'>{{ $road_freight->road_freight_expenses }}</td>
                                    <td field-key='machinery_costs'>{{ $road_freight->machinery_costs }}</td>
                                    <td field-key='breakdown'>{{ $road_freight->breakdown }}</td>
                                    <td field-key='total_expenses'>{{ $road_freight->total_expenses }}</td>
                                    <td field-key='net_income'>{{ $road_freight->net_income }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.restore', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.perma_del', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('road_freight_view')
                                        <a href="{{ route('admin.road_freights.show',[$road_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('road_freight_edit')
                                        <a href="{{ route('admin.road_freights.edit',[$road_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('road_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.destroy', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="26">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="parts_acquired">
    <table class="table table-bordered table-striped {{ count($parts_acquireds) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.parts-acquired.fields.order-number')</th>
                            <th>@lang('global.parts-acquired.fields.prepared-by')</th>
                            <th>@lang('global.parts-acquired.fields.date')</th>
                            <th>@lang('global.parts-acquired.fields.transaction-type')</th>
                            <th>@lang('global.parts-acquired.fields.repair-center')</th>
                            <th>@lang('global.parts-acquired.fields.received-by')</th>
                            <th>@lang('global.parts-acquired.fields.dispatched-by')</th>
                            <th>@lang('global.parts-acquired.fields.part')</th>
                            <th>@lang('global.parts-acquired.fields.qty')</th>
                            <th>@lang('global.parts-acquired.fields.unit-price')</th>
                            <th>@lang('global.parts-acquired.fields.total')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($parts_acquireds) > 0)
                @foreach ($parts_acquireds as $parts_acquired)
                    <tr data-entry-id="{{ $parts_acquired->id }}">
                        <td field-key='order_number'>{{ $parts_acquired->order_number }}</td>
                                    <td field-key='prepared_by'>{{ $parts_acquired->prepared_by }}</td>
                                    <td field-key='date'>{{ $parts_acquired->date }}</td>
                                    <td field-key='transaction_type'>{{ $parts_acquired->transaction_type }}</td>
                                    <td field-key='repair_center'>{{ $parts_acquired->repair_center->center_name or '' }}</td>
                                    <td field-key='received_by'>{{ $parts_acquired->received_by->name or '' }}</td>
                                    <td field-key='dispatched_by'>{{ $parts_acquired->dispatched_by->name or '' }}</td>
                                    <td field-key='part'>{{ $parts_acquired->part->part or '' }}</td>
                                    <td field-key='qty'>{{ $parts_acquired->qty }}</td>
                                    <td field-key='unit_price'>{{ $parts_acquired->unit_price }}</td>
                                    <td field-key='total'>{{ $parts_acquired->total }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.restore', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.perma_del', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('parts_acquired_view')
                                        <a href="{{ route('admin.parts_acquireds.show',[$parts_acquired->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('parts_acquired_edit')
                                        <a href="{{ route('admin.parts_acquireds.edit',[$parts_acquired->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('parts_acquired_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.destroy', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="air_freight">
    <table class="table table-bordered table-striped {{ count($air_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.air-freight.fields.project-number')</th>
                            <th>@lang('global.air-freight.fields.air-freight-number')</th>
                            <th>@lang('global.air-freight.fields.client')</th>
                            <th>@lang('global.air-freight.fields.contact-person')</th>
                            <th>@lang('global.air-freight.fields.airline-or-agent')</th>
                            <th>@lang('global.air-freight.fields.airline-or-agent-contact')</th>
                            <th>@lang('global.air-freight.fields.project-manager')</th>
                            <th>@lang('global.air-freight.fields.flight-number')</th>
                            <th>@lang('global.air-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($air_freights) > 0)
                @foreach ($air_freights as $air_freight)
                    <tr data-entry-id="{{ $air_freight->id }}">
                        <td field-key='project_number'>{{ $air_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='air_freight_number'>{{ $air_freight->air_freight_number }}</td>
                                    <td field-key='client'>{{ $air_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $air_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='airline_or_agent'>
                                        @foreach ($air_freight->airline_or_agent as $singleAirlineOrAgent)
                                            <span class="label label-info label-many">{{ $singleAirlineOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='airline_or_agent_contact'>{{ $air_freight->airline_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $air_freight->project_manager->name or '' }}</td>
                                    <td field-key='flight_number'>{{ $air_freight->flight_number }}</td>
                                    <td field-key='route'>{{ $air_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.restore', $air_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.perma_del', $air_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('air_freight_view')
                                        <a href="{{ route('admin.air_freights.show',[$air_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('air_freight_edit')
                                        <a href="{{ route('admin.air_freights.edit',[$air_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('air_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.destroy', $air_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="14">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="sea_freight">
    <table class="table table-bordered table-striped {{ count($sea_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.sea-freight.fields.project-number')</th>
                            <th>@lang('global.sea-freight.fields.sea-freight-number')</th>
                            <th>@lang('global.sea-freight.fields.client')</th>
                            <th>@lang('global.sea-freight.fields.contact-person')</th>
                            <th>@lang('global.sea-freight.fields.shipper-or-agent')</th>
                            <th>@lang('global.sea-freight.fields.shipper-or-agent-contact')</th>
                            <th>@lang('global.sea-freight.fields.project-manager')</th>
                            <th>@lang('global.sea-freight.fields.voyage-number')</th>
                            <th>@lang('global.sea-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($sea_freights) > 0)
                @foreach ($sea_freights as $sea_freight)
                    <tr data-entry-id="{{ $sea_freight->id }}">
                        <td field-key='project_number'>{{ $sea_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='sea_freight_number'>{{ $sea_freight->sea_freight_number }}</td>
                                    <td field-key='client'>{{ $sea_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $sea_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='shipper__or_agent'>
                                        @foreach ($sea_freight->shipper__or_agent as $singleShipperOrAgent)
                                            <span class="label label-info label-many">{{ $singleShipperOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='shipper_or_agent_contact'>{{ $sea_freight->shipper_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $sea_freight->project_manager->name or '' }}</td>
                                    <td field-key='voyage_number'>{{ $sea_freight->voyage_number }}</td>
                                    <td field-key='route'>{{ $sea_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.restore', $sea_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.perma_del', $sea_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('sea_freight_view')
                                        <a href="{{ route('admin.sea_freights.show',[$sea_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('sea_freight_edit')
                                        <a href="{{ route('admin.sea_freights.edit',[$sea_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('sea_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.destroy', $sea_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="14">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="rail_freight">
    <table class="table table-bordered table-striped {{ count($rail_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.rail-freight.fields.project-number')</th>
                            <th>@lang('global.rail-freight.fields.rail-freight-number')</th>
                            <th>@lang('global.rail-freight.fields.client')</th>
                            <th>@lang('global.rail-freight.fields.contact-person')</th>
                            <th>@lang('global.rail-freight.fields.railline-or-agent')</th>
                            <th>@lang('global.rail-freight.fields.railline-or-agent-contact')</th>
                            <th>@lang('global.rail-freight.fields.project-manager')</th>
                            <th>@lang('global.rail-freight.fields.trip-number')</th>
                            <th>@lang('global.rail-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($rail_freights) > 0)
                @foreach ($rail_freights as $rail_freight)
                    <tr data-entry-id="{{ $rail_freight->id }}">
                        <td field-key='project_number'>{{ $rail_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='rail_freight_number'>{{ $rail_freight->rail_freight_number }}</td>
                                    <td field-key='client'>{{ $rail_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $rail_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='railline_or_agent'>
                                        @foreach ($rail_freight->railline_or_agent as $singleRaillineOrAgent)
                                            <span class="label label-info label-many">{{ $singleRaillineOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='railline_or_agent_contact'>{{ $rail_freight->railline_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $rail_freight->project_manager->name or '' }}</td>
                                    <td field-key='trip_number'>{{ $rail_freight->trip_number }}</td>
                                    <td field-key='route'>{{ $rail_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.restore', $rail_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.perma_del', $rail_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('rail_freight_view')
                                        <a href="{{ route('admin.rail_freights.show',[$rail_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('rail_freight_edit')
                                        <a href="{{ route('admin.rail_freights.edit',[$rail_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('rail_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.destroy', $rail_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="14">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="payee_accounts">
    <table class="table table-bordered table-striped {{ count($payee_accounts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.payee-accounts.fields.employee')</th>
                            <th>@lang('global.payee-accounts.fields.bank')</th>
                            <th>@lang('global.payee-accounts.fields.account-number')</th>
                            <th>@lang('global.payee-accounts.fields.branch-code')</th>
                            <th>@lang('global.payee-accounts.fields.branch')</th>
                            <th>@lang('global.payee-accounts.fields.department')</th>
                            <th>@lang('global.payee-accounts.fields.position')</th>
                            <th>@lang('global.payee-accounts.fields.status')</th>
                            <th>@lang('global.payee-accounts.fields.pymt-measurement-type')</th>
                            <th>@lang('global.payee-accounts.fields.wage-rate')</th>
                            <th>@lang('global.payee-accounts.fields.pension-rate')</th>
                            <th>@lang('global.payee-accounts.fields.overtime-rate')</th>
                            <th>@lang('global.payee-accounts.fields.public-holiday-rate')</th>
                            <th>@lang('global.payee-accounts.fields.medical-aid')</th>
                            <th>@lang('global.payee-accounts.fields.sales-rate')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($payee_accounts) > 0)
                @foreach ($payee_accounts as $payee_account)
                    <tr data-entry-id="{{ $payee_account->id }}">
                        <td field-key='employee'>{{ $payee_account->employee->name or '' }}</td>
                                    <td field-key='bank'>{{ $payee_account->bank }}</td>
                                    <td field-key='account_number'>{{ $payee_account->account_number }}</td>
                                    <td field-key='branch_code'>{{ $payee_account->branch_code }}</td>
                                    <td field-key='branch'>{{ $payee_account->branch }}</td>
                                    <td field-key='department'>{{ $payee_account->department->dept_name or '' }}</td>
                                    <td field-key='position'>{{ $payee_account->position->position or '' }}</td>
                                    <td field-key='status'>{{ $payee_account->status }}</td>
                                    <td field-key='pymt_measurement_type'>{{ $payee_account->pymt_measurement_type }}</td>
                                    <td field-key='wage_rate'>{{ $payee_account->wage_rate }}</td>
                                    <td field-key='pension_rate'>{{ $payee_account->pension_rate }}</td>
                                    <td field-key='overtime_rate'>{{ $payee_account->overtime_rate }}</td>
                                    <td field-key='public_holiday_rate'>{{ $payee_account->public_holiday_rate }}</td>
                                    <td field-key='medical_aid'>{{ $payee_account->medical_aid }}</td>
                                    <td field-key='sales_rate'>{{ $payee_account->sales_rate }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.restore', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.perma_del', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('payee_account_view')
                                        <a href="{{ route('admin.payee_accounts.show',[$payee_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('payee_account_edit')
                                        <a href="{{ route('admin.payee_accounts.edit',[$payee_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('payee_account_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.payee_accounts.destroy', $payee_account->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="20">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="road_freights">
    <table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.road-freights.fields.project-number')</th>
                            <th>@lang('global.road-freights.fields.road-freight-number')</th>
                            <th>@lang('global.road-freights.fields.freight-contract-type')</th>
                            <th>@lang('global.road-freights.fields.route')</th>
                            <th>@lang('global.road-freights.fields.client')</th>
                            <th>@lang('global.road-freights.fields.contact-person')</th>
                            <th>@lang('global.road-freights.fields.project-manager')</th>
                            <th>@lang('global.road-freights.fields.driver')</th>
                            <th>@lang('global.road-freights.fields.vehicle')</th>
                            <th>@lang('global.road-freights.fields.trailers')</th>
                            <th>@lang('global.road-freights.fields.subcontractor-number')</th>
                            <th>@lang('global.road-freights.fields.vendor')</th>
                            <th>@lang('global.road-freights.fields.vendor-contact-person')</th>
                            <th>@lang('global.road-freights.fields.vendor-drivers')</th>
                            <th>@lang('global.road-freights.fields.vendor-vehicles')</th>
                            <th>@lang('global.road-freights.fields.road-freight-income')</th>
                            <th>@lang('global.road-freights.fields.road-freight-expenses')</th>
                            <th>@lang('global.road-freights.fields.machinery-costs')</th>
                            <th>@lang('global.road-freights.fields.breakdown')</th>
                            <th>@lang('global.road-freights.fields.total-expenses')</th>
                            <th>@lang('global.road-freights.fields.net-income')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($road_freights) > 0)
                @foreach ($road_freights as $road_freight)
                    <tr data-entry-id="{{ $road_freight->id }}">
                        <td field-key='project_number'>{{ $road_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                    <td field-key='freight_contract_type'>{{ $road_freight->freight_contract_type }}</td>
                                    <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                    <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $road_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $road_freight->project_manager->name or '' }}</td>
                                    <td field-key='driver'>{{ $road_freight->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $road_freight->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($road_freight->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='subcontractor_number'>{{ $road_freight->subcontractor_number->subcontractor_number or '' }}</td>
                                    <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                    <td field-key='vendor_contact_person'>{{ $road_freight->vendor_contact_person->contact_name or '' }}</td>
                                    <td field-key='vendor_drivers'>
                                        @foreach ($road_freight->vendor_drivers as $singleVendorDrivers)
                                            <span class="label label-info label-many">{{ $singleVendorDrivers->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor_vehicles'>
                                        @foreach ($road_freight->vendor_vehicles as $singleVendorVehicles)
                                            <span class="label label-info label-many">{{ $singleVendorVehicles->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='road_freight_income'>{{ $road_freight->road_freight_income }}</td>
                                    <td field-key='road_freight_expenses'>{{ $road_freight->road_freight_expenses }}</td>
                                    <td field-key='machinery_costs'>{{ $road_freight->machinery_costs }}</td>
                                    <td field-key='breakdown'>{{ $road_freight->breakdown }}</td>
                                    <td field-key='total_expenses'>{{ $road_freight->total_expenses }}</td>
                                    <td field-key='net_income'>{{ $road_freight->net_income }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.restore', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.perma_del', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('road_freight_view')
                                        <a href="{{ route('admin.road_freights.show',[$road_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('road_freight_edit')
                                        <a href="{{ route('admin.road_freights.edit',[$road_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('road_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.destroy', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="26">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="clearance_and_forwarding">
    <table class="table table-bordered table-striped {{ count($clearance_and_forwardings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.clearance-and-forwarding.fields.project-number')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.clearance-and-forwarding-number')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.border-post')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.client')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.contact-person')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.agent')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.agent-contact')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.project-manager')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($clearance_and_forwardings) > 0)
                @foreach ($clearance_and_forwardings as $clearance_and_forwarding)
                    <tr data-entry-id="{{ $clearance_and_forwarding->id }}">
                        <td field-key='project_number'>{{ $clearance_and_forwarding->project_number->operation_number or '' }}</td>
                                    <td field-key='clearance_and_forwarding_number'>{{ $clearance_and_forwarding->clearance_and_forwarding_number }}</td>
                                    <td field-key='border_post'>{{ $clearance_and_forwarding->border_post }}</td>
                                    <td field-key='client'>{{ $clearance_and_forwarding->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $clearance_and_forwarding->contact_person->contact_name or '' }}</td>
                                    <td field-key='agent'>{{ $clearance_and_forwarding->agent->name or '' }}</td>
                                    <td field-key='agent_contact'>{{ $clearance_and_forwarding->agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $clearance_and_forwarding->project_manager->name or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.restore', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.perma_del', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('clearance_and_forwarding_view')
                                        <a href="{{ route('admin.clearance_and_forwardings.show',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('clearance_and_forwarding_edit')
                                        <a href="{{ route('admin.clearance_and_forwardings.edit',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('clearance_and_forwarding_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.destroy', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="13">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="releasing">
    <table class="table table-bordered table-striped {{ count($releasings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.releasing.fields.date')</th>
                            <th>@lang('global.releasing.fields.project-number')</th>
                            <th>@lang('global.releasing.fields.warehouse')</th>
                            <th>@lang('global.releasing.fields.release-number')</th>
                            <th>@lang('global.releasing.fields.prepared-by')</th>
                            <th>@lang('global.releasing.fields.client')</th>
                            <th>@lang('global.releasing.fields.contact-person')</th>
                            <th>@lang('global.releasing.fields.released-by')</th>
                            <th>@lang('global.releasing.fields.project-manager')</th>
                            <th>@lang('global.releasing.fields.area-coverd')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($releasings) > 0)
                @foreach ($releasings as $releasing)
                    <tr data-entry-id="{{ $releasing->id }}">
                        <td field-key='date'>{{ $releasing->date }}</td>
                                    <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $releasing->warehouse->center_name or '' }}</td>
                                    <td field-key='release_number'>{{ $releasing->release_number }}</td>
                                    <td field-key='prepared_by'>{{ $releasing->prepared_by }}</td>
                                    <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $releasing->contact_person->contact_name or '' }}</td>
                                    <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $releasing->project_manager->name or '' }}</td>
                                    <td field-key='area_coverd'>{{ $releasing->area_coverd }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.restore', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.perma_del', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('releasing_view')
                                        <a href="{{ route('admin.releasings.show',[$releasing->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('releasing_edit')
                                        <a href="{{ route('admin.releasings.edit',[$releasing->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('releasing_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.destroy', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="15">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="receiving">
    <table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.receiving.fields.date')</th>
                            <th>@lang('global.receiving.fields.project-number')</th>
                            <th>@lang('global.receiving.fields.warehouse')</th>
                            <th>@lang('global.receiving.fields.receipt-number')</th>
                            <th>@lang('global.receiving.fields.prepared-by')</th>
                            <th>@lang('global.receiving.fields.client')</th>
                            <th>@lang('global.receiving.fields.contact-person')</th>
                            <th>@lang('global.receiving.fields.received-by')</th>
                            <th>@lang('global.receiving.fields.project-manager')</th>
                            <th>@lang('global.receiving.fields.rate')</th>
                            <th>@lang('global.receiving.fields.days')</th>
                            <th>@lang('global.receiving.fields.total-area-coverd')</th>
                            <th>@lang('global.receiving.fields.total-amount')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($receivings) > 0)
                @foreach ($receivings as $receiving)
                    <tr data-entry-id="{{ $receiving->id }}">
                        <td field-key='date'>{{ $receiving->date }}</td>
                                    <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $receiving->warehouse->center_name or '' }}</td>
                                    <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                    <td field-key='prepared_by'>{{ $receiving->prepared_by }}</td>
                                    <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $receiving->contact_person->contact_name or '' }}</td>
                                    <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $receiving->project_manager->name or '' }}</td>
                                    <td field-key='rate'>{{ $receiving->rate }}</td>
                                    <td field-key='days'>{{ $receiving->days }}</td>
                                    <td field-key='total_area_coverd'>{{ $receiving->total_area_coverd }}</td>
                                    <td field-key='total_amount'>{{ $receiving->total_amount }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.restore', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('receiving_view')
                                        <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('receiving_edit')
                                        <a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('receiving_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.destroy', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="debit_notes">
    <table class="table table-bordered table-striped {{ count($debit_notes) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.debit-notes.fields.date')</th>
                            <th>@lang('global.debit-notes.fields.refund-type')</th>
                            <th>@lang('global.debit-notes.fields.credit-note-payment-number')</th>
                            <th>@lang('global.debit-notes.fields.transaction-number')</th>
                            <th>@lang('global.debit-notes.fields.credit-note-number')</th>
                            <th>@lang('global.debit-notes.fields.withdrawal-transaction-number')</th>
                            <th>@lang('global.debit-notes.fields.vendor')</th>
                            <th>@lang('global.debit-notes.fields.contact-person')</th>
                            <th>@lang('global.debit-notes.fields.account-manager')</th>
                            <th>@lang('global.debit-notes.fields.prepared-by')</th>
                            <th>@lang('global.debit-notes.fields.debit-note-number')</th>
                            <th>@lang('global.debit-notes.fields.status')</th>
                            <th>@lang('global.debit-notes.fields.subtotal')</th>
                            <th>@lang('global.debit-notes.fields.vat')</th>
                            <th>@lang('global.debit-notes.fields.vat-amount')</th>
                            <th>@lang('global.debit-notes.fields.total-amount')</th>
                            <th>@lang('global.debit-notes.fields.paid-to-date')</th>
                            <th>@lang('global.debit-notes.fields.balance')</th>
                            <th>@lang('global.debit-notes.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($debit_notes) > 0)
                @foreach ($debit_notes as $debit_note)
                    <tr data-entry-id="{{ $debit_note->id }}">
                        <td field-key='date'>{{ $debit_note->date }}</td>
                                    <td field-key='refund_type'>{{ $debit_note->refund_type }}</td>
                                    <td field-key='credit_note_payment_number'>{{ $debit_note->credit_note_payment_number->payment_number or '' }}</td>
                                    <td field-key='transaction_number'>{{ $debit_note->transaction_number->operation_number or '' }}</td>
                                    <td field-key='credit_note_number'>{{ $debit_note->credit_note_number->credit_note_number or '' }}</td>
                                    <td field-key='withdrawal_transaction_number'>{{ $debit_note->withdrawal_transaction_number->payment_number or '' }}</td>
                                    <td field-key='vendor'>{{ $debit_note->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $debit_note->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $debit_note->account_manager->name or '' }}</td>
                                    <td field-key='prepared_by'>{{ $debit_note->prepared_by }}</td>
                                    <td field-key='debit_note_number'>{{ $debit_note->debit_note_number }}</td>
                                    <td field-key='status'>{{ $debit_note->status }}</td>
                                    <td field-key='subtotal'>{{ $debit_note->subtotal }}</td>
                                    <td field-key='vat'>{{ $debit_note->vat }}</td>
                                    <td field-key='vat_amount'>{{ $debit_note->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $debit_note->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $debit_note->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $debit_note->balance }}</td>
                                    <td field-key='currency'>{{ $debit_note->currency->name or '' }}</td>
                                                                    <td>
                                        @can('debit_note_view')
                                        <a href="{{ route('admin.debit_notes.show',[$debit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('debit_note_edit')
                                        <a href="{{ route('admin.debit_notes.edit',[$debit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('debit_note_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.debit_notes.destroy', $debit_note->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="24">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="income_category">
    <table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.income-category.fields.project-type')</th>
                            <th>@lang('global.income-category.fields.project-number')</th>
                            <th>@lang('global.income-category.fields.entry-date')</th>
                            <th>@lang('global.income-category.fields.due-date')</th>
                            <th>@lang('global.income-category.fields.prepared-by')</th>
                            <th>@lang('global.income-category.fields.invoice-number')</th>
                            <th>@lang('global.income-category.fields.client')</th>
                            <th>@lang('global.income-category.fields.contact-person')</th>
                            <th>@lang('global.income-category.fields.account-manager')</th>
                            <th>@lang('global.income-category.fields.quotation-number')</th>
                            <th>@lang('global.income-category.fields.sales-order-number')</th>
                            <th>@lang('global.income-category.fields.status')</th>
                            <th>@lang('global.income-category.fields.subtotal')</th>
                            <th>@lang('global.income-category.fields.percent-discount')</th>
                            <th>@lang('global.income-category.fields.discount-amount')</th>
                            <th>@lang('global.income-category.fields.discounted-subtotal')</th>
                            <th>@lang('global.income-category.fields.vat')</th>
                            <th>@lang('global.income-category.fields.vat-amount')</th>
                            <th>@lang('global.income-category.fields.total-amount')</th>
                            <th>@lang('global.income-category.fields.paid-to-date')</th>
                            <th>@lang('global.income-category.fields.balance')</th>
                            <th>@lang('global.income-category.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($income_categories) > 0)
                @foreach ($income_categories as $income_category)
                    <tr data-entry-id="{{ $income_category->id }}">
                        <td field-key='project_type'>{{ $income_category->project_type->name or '' }}</td>
                                    <td field-key='project_number'>{{ $income_category->project_number->operation_number or '' }}</td>
                                    <td field-key='entry_date'>{{ $income_category->entry_date }}</td>
                                    <td field-key='due_date'>{{ $income_category->due_date }}</td>
                                    <td field-key='prepared_by'>{{ $income_category->prepared_by }}</td>
                                    <td field-key='invoice_number'>{{ $income_category->invoice_number }}</td>
                                    <td field-key='client'>{{ $income_category->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $income_category->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $income_category->account_manager->name or '' }}</td>
                                    <td field-key='quotation_number'>{{ $income_category->quotation_number->quotation_number or '' }}</td>
                                    <td field-key='sales_order_number'>{{ $income_category->sales_order_number }}</td>
                                    <td field-key='status'>{{ $income_category->status }}</td>
                                    <td field-key='subtotal'>{{ $income_category->subtotal }}</td>
                                    <td field-key='percent_discount'>{{ $income_category->percent_discount }}</td>
                                    <td field-key='discount_amount'>{{ $income_category->discount_amount }}</td>
                                    <td field-key='discounted_subtotal'>{{ $income_category->discounted_subtotal }}</td>
                                    <td field-key='vat'>{{ $income_category->vat }}</td>
                                    <td field-key='vat_amount'>{{ $income_category->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $income_category->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $income_category->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $income_category->balance }}</td>
                                    <td field-key='currency'>{{ $income_category->currency->name or '' }}</td>
                                                                    <td>
                                        @can('income_category_view')
                                        <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('income_category_edit')
                                        <a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('income_category_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="27">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="credit_note">
    <table class="table table-bordered table-striped {{ count($credit_notes) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.credit-note.fields.date')</th>
                            <th>@lang('global.credit-note.fields.refund-type')</th>
                            <th>@lang('global.credit-note.fields.invoice-payment-number')</th>
                            <th>@lang('global.credit-note.fields.project-number')</th>
                            <th>@lang('global.credit-note.fields.invoice-number')</th>
                            <th>@lang('global.credit-note.fields.bank-reference')</th>
                            <th>@lang('global.credit-note.fields.client')</th>
                            <th>@lang('global.credit-note.fields.contact-person')</th>
                            <th>@lang('global.credit-note.fields.account-manager')</th>
                            <th>@lang('global.credit-note.fields.prepared-by')</th>
                            <th>@lang('global.credit-note.fields.credit-note-number')</th>
                            <th>@lang('global.credit-note.fields.status')</th>
                            <th>@lang('global.credit-note.fields.terms-and-conditions')</th>
                            <th>@lang('global.credit-note.fields.subtotal')</th>
                            <th>@lang('global.credit-note.fields.vat')</th>
                            <th>@lang('global.credit-note.fields.vat-amount')</th>
                            <th>@lang('global.credit-note.fields.total-amount')</th>
                            <th>@lang('global.credit-note.fields.paid-to-date')</th>
                            <th>@lang('global.credit-note.fields.balance')</th>
                            <th>@lang('global.credit-note.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($credit_notes) > 0)
                @foreach ($credit_notes as $credit_note)
                    <tr data-entry-id="{{ $credit_note->id }}">
                        <td field-key='date'>{{ $credit_note->date }}</td>
                                    <td field-key='refund_type'>{{ $credit_note->refund_type }}</td>
                                    <td field-key='invoice_payment_number'>{{ $credit_note->invoice_payment_number->payment_number or '' }}</td>
                                    <td field-key='project_number'>{{ $credit_note->project_number->operation_number or '' }}</td>
                                    <td field-key='invoice_number'>{{ $credit_note->invoice_number->invoice_number or '' }}</td>
                                    <td field-key='bank_reference'>{{ $credit_note->bank_reference->payment_number or '' }}</td>
                                    <td field-key='client'>{{ $credit_note->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $credit_note->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $credit_note->account_manager->name or '' }}</td>
                                    <td field-key='prepared_by'>{{ $credit_note->prepared_by }}</td>
                                    <td field-key='credit_note_number'>{{ $credit_note->credit_note_number }}</td>
                                    <td field-key='status'>{{ $credit_note->status }}</td>
                                    <td field-key='terms_and_conditions'>{!! $credit_note->terms_and_conditions !!}</td>
                                    <td field-key='subtotal'>{{ $credit_note->subtotal }}</td>
                                    <td field-key='vat'>{{ $credit_note->vat }}</td>
                                    <td field-key='vat_amount'>{{ $credit_note->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $credit_note->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $credit_note->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $credit_note->balance }}</td>
                                    <td field-key='currency'>{{ $credit_note->currency->name or '' }}</td>
                                                                    <td>
                                        @can('credit_note_view')
                                        <a href="{{ route('admin.credit_notes.show',[$credit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('credit_note_edit')
                                        <a href="{{ route('admin.credit_notes.edit',[$credit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('credit_note_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.credit_notes.destroy', $credit_note->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="25">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="releasing">
    <table class="table table-bordered table-striped {{ count($releasings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.releasing.fields.date')</th>
                            <th>@lang('global.releasing.fields.project-number')</th>
                            <th>@lang('global.releasing.fields.warehouse')</th>
                            <th>@lang('global.releasing.fields.release-number')</th>
                            <th>@lang('global.releasing.fields.prepared-by')</th>
                            <th>@lang('global.releasing.fields.client')</th>
                            <th>@lang('global.releasing.fields.contact-person')</th>
                            <th>@lang('global.releasing.fields.released-by')</th>
                            <th>@lang('global.releasing.fields.project-manager')</th>
                            <th>@lang('global.releasing.fields.area-coverd')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($releasings) > 0)
                @foreach ($releasings as $releasing)
                    <tr data-entry-id="{{ $releasing->id }}">
                        <td field-key='date'>{{ $releasing->date }}</td>
                                    <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $releasing->warehouse->center_name or '' }}</td>
                                    <td field-key='release_number'>{{ $releasing->release_number }}</td>
                                    <td field-key='prepared_by'>{{ $releasing->prepared_by }}</td>
                                    <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $releasing->contact_person->contact_name or '' }}</td>
                                    <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $releasing->project_manager->name or '' }}</td>
                                    <td field-key='area_coverd'>{{ $releasing->area_coverd }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.restore', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.perma_del', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('releasing_view')
                                        <a href="{{ route('admin.releasings.show',[$releasing->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('releasing_edit')
                                        <a href="{{ route('admin.releasings.edit',[$releasing->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('releasing_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.destroy', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="15">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="receiving">
    <table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.receiving.fields.date')</th>
                            <th>@lang('global.receiving.fields.project-number')</th>
                            <th>@lang('global.receiving.fields.warehouse')</th>
                            <th>@lang('global.receiving.fields.receipt-number')</th>
                            <th>@lang('global.receiving.fields.prepared-by')</th>
                            <th>@lang('global.receiving.fields.client')</th>
                            <th>@lang('global.receiving.fields.contact-person')</th>
                            <th>@lang('global.receiving.fields.received-by')</th>
                            <th>@lang('global.receiving.fields.project-manager')</th>
                            <th>@lang('global.receiving.fields.rate')</th>
                            <th>@lang('global.receiving.fields.days')</th>
                            <th>@lang('global.receiving.fields.total-area-coverd')</th>
                            <th>@lang('global.receiving.fields.total-amount')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($receivings) > 0)
                @foreach ($receivings as $receiving)
                    <tr data-entry-id="{{ $receiving->id }}">
                        <td field-key='date'>{{ $receiving->date }}</td>
                                    <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $receiving->warehouse->center_name or '' }}</td>
                                    <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                    <td field-key='prepared_by'>{{ $receiving->prepared_by }}</td>
                                    <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $receiving->contact_person->contact_name or '' }}</td>
                                    <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $receiving->project_manager->name or '' }}</td>
                                    <td field-key='rate'>{{ $receiving->rate }}</td>
                                    <td field-key='days'>{{ $receiving->days }}</td>
                                    <td field-key='total_area_coverd'>{{ $receiving->total_area_coverd }}</td>
                                    <td field-key='total_amount'>{{ $receiving->total_amount }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.restore', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('receiving_view')
                                        <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('receiving_edit')
                                        <a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('receiving_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.destroy', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="expense_category">
    <table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.expense-category.fields.transaction-type')</th>
                            <th>@lang('global.expense-category.fields.transaction-number')</th>
                            <th>@lang('global.expense-category.fields.entry-date')</th>
                            <th>@lang('global.expense-category.fields.due-date')</th>
                            <th>@lang('global.expense-category.fields.prepared-by')</th>
                            <th>@lang('global.expense-category.fields.credit-note-number')</th>
                            <th>@lang('global.expense-category.fields.vendor')</th>
                            <th>@lang('global.expense-category.fields.contact-person')</th>
                            <th>@lang('global.expense-category.fields.account-manager')</th>
                            <th>@lang('global.expense-category.fields.purchase-order-number')</th>
                            <th>@lang('global.expense-category.fields.vendor-purchase-order-number')</th>
                            <th>@lang('global.expense-category.fields.upload-document')</th>
                            <th>@lang('global.expense-category.fields.status')</th>
                            <th>@lang('global.expense-category.fields.terms-and-conditions')</th>
                            <th>@lang('global.expense-category.fields.subtotal')</th>
                            <th>@lang('global.expense-category.fields.percent-discount')</th>
                            <th>@lang('global.expense-category.fields.discount-amount')</th>
                            <th>@lang('global.expense-category.fields.discounted-subtotal')</th>
                            <th>@lang('global.expense-category.fields.vat')</th>
                            <th>@lang('global.expense-category.fields.vat-amount')</th>
                            <th>@lang('global.expense-category.fields.total-amount')</th>
                            <th>@lang('global.expense-category.fields.paid-to-date')</th>
                            <th>@lang('global.expense-category.fields.balance')</th>
                            <th>@lang('global.expense-category.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($expense_categories) > 0)
                @foreach ($expense_categories as $expense_category)
                    <tr data-entry-id="{{ $expense_category->id }}">
                        <td field-key='transaction_type'>{{ $expense_category->transaction_type->name or '' }}</td>
                                    <td field-key='transaction_number'>{{ $expense_category->transaction_number->operation_number or '' }}</td>
                                    <td field-key='entry_date'>{{ $expense_category->entry_date }}</td>
                                    <td field-key='due_date'>{{ $expense_category->due_date }}</td>
                                    <td field-key='prepared_by'>{{ $expense_category->prepared_by }}</td>
                                    <td field-key='credit_note_number'>{{ $expense_category->credit_note_number }}</td>
                                    <td field-key='vendor'>{{ $expense_category->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $expense_category->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $expense_category->account_manager->name or '' }}</td>
                                    <td field-key='purchase_order_number'>{{ $expense_category->purchase_order_number->purchase_order_number or '' }}</td>
                                    <td field-key='vendor_purchase_order_number'>{{ $expense_category->vendor_purchase_order_number }}</td>
                                    <td field-key='upload_document'>@if($expense_category->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $expense_category->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='status'>{{ $expense_category->status }}</td>
                                    <td field-key='terms_and_conditions'>{!! $expense_category->terms_and_conditions !!}</td>
                                    <td field-key='subtotal'>{{ $expense_category->subtotal }}</td>
                                    <td field-key='percent_discount'>{{ $expense_category->percent_discount }}</td>
                                    <td field-key='discount_amount'>{{ $expense_category->discount_amount }}</td>
                                    <td field-key='discounted_subtotal'>{{ $expense_category->discounted_subtotal }}</td>
                                    <td field-key='vat'>{{ $expense_category->vat }}</td>
                                    <td field-key='vat_amount'>{{ $expense_category->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $expense_category->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $expense_category->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $expense_category->balance }}</td>
                                    <td field-key='currency'>{{ $expense_category->currency->name or '' }}</td>
                                                                    <td>
                                        @can('expense_category_view')
                                        <a href="{{ route('admin.expense_categories.show',[$expense_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('expense_category_edit')
                                        <a href="{{ route('admin.expense_categories.edit',[$expense_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('expense_category_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.expense_categories.destroy', $expense_category->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="29">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="client_job_cards">
    <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <th>@lang('global.client-job-cards.fields.currency')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($client_job_cards) > 0)
                @foreach ($client_job_cards as $client_job_card)
                    <tr data-entry-id="{{ $client_job_card->id }}">
                        <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                                    <td field-key='date'>{{ $client_job_card->date }}</td>
                                    <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                                    <td field-key='status'>{{ $client_job_card->status }}</td>
                                    <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($client_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                    <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                                    <td field-key='currency'>{{ $client_job_card->currency->name or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.restore', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.perma_del', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('client_job_card_view')
                                        <a href="{{ route('admin.client_job_cards.show',[$client_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('client_job_card_edit')
                                        <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="inhouse_job_cards">
    <table class="table table-bordered table-striped {{ count($inhouse_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.inhouse-job-cards.fields.date')</th>
                            <th>@lang('global.inhouse-job-cards.fields.vehicle-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.mileage')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.inhouse-job-cards.fields.project-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.client-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-card-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.repair-center')</th>
                            <th>@lang('global.inhouse-job-cards.fields.technician')</th>
                            <th>@lang('global.inhouse-job-cards.fields.vehicle')</th>
                            <th>@lang('global.inhouse-job-cards.fields.trailer')</th>
                            <th>@lang('global.inhouse-job-cards.fields.light-vehicles')</th>
                            <th>@lang('global.inhouse-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.inhouse-job-cards.fields.road-freight-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.remarks')</th>
                            <th>@lang('global.inhouse-job-cards.fields.instructions')</th>
                            <th>@lang('global.inhouse-job-cards.fields.subtotal')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($inhouse_job_cards) > 0)
                @foreach ($inhouse_job_cards as $inhouse_job_card)
                    <tr data-entry-id="{{ $inhouse_job_card->id }}">
                        <td field-key='date'>{{ $inhouse_job_card->date }}</td>
                                    <td field-key='vehicle_type'>{{ $inhouse_job_card->vehicle_type }}</td>
                                    <td field-key='mileage'>{{ $inhouse_job_card->mileage }}</td>
                                    <td field-key='job_card_number'>{{ $inhouse_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $inhouse_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $inhouse_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client_type'>{{ $inhouse_job_card->client_type }}</td>
                                    <td field-key='job_card_type'>{{ $inhouse_job_card->job_card_type }}</td>
                                    <td field-key='job_type'>{{ $inhouse_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $inhouse_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($inhouse_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vehicle'>{{ $inhouse_job_card->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailer'>{{ $inhouse_job_card->trailer->trailer_description or '' }}</td>
                                    <td field-key='light_vehicles'>{{ $inhouse_job_card->light_vehicles->vehicle_description or '' }}</td>
                                    <td field-key='client_vehicle_reg_no'>{{ $inhouse_job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $inhouse_job_card->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='remarks'>{!! $inhouse_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $inhouse_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $inhouse_job_card->subtotal }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.restore', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.perma_del', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('inhouse_job_card_view')
                                        <a href="{{ route('admin.inhouse_job_cards.show',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('inhouse_job_card_edit')
                                        <a href="{{ route('admin.inhouse_job_cards.edit',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('inhouse_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.destroy', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="24">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="delivery_instruction">
    <table class="table table-bordered table-striped {{ count($delivery_instructions) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.delivery-instruction.fields.road-freight-number')</th>
                            <th>@lang('global.delivery-instruction.fields.freight-contract-type')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-instruction-number')</th>
                            <th>@lang('global.delivery-instruction.fields.driver')</th>
                            <th>@lang('global.delivery-instruction.fields.vehicle')</th>
                            <th>@lang('global.delivery-instruction.fields.trailers')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor-driver')</th>
                            <th>@lang('global.delivery-instruction.fields.vendor-vehicle-description')</th>
                            <th>@lang('global.delivery-instruction.fields.order-number')</th>
                            <th>@lang('global.delivery-instruction.fields.client')</th>
                            <th>@lang('global.delivery-instruction.fields.contact-person')</th>
                            <th>@lang('global.delivery-instruction.fields.project-manager')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-company-name')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-address')</th>
                            <th>@lang('global.delivery-instruction.fields.delivery-date-time')</th>
                            <th>@lang('global.delivery-instruction.fields.prepared-by')</th>
                            <th>@lang('global.delivery-instruction.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($delivery_instructions) > 0)
                @foreach ($delivery_instructions as $delivery_instruction)
                    <tr data-entry-id="{{ $delivery_instruction->id }}">
                        <td field-key='road_freight_number'>{{ $delivery_instruction->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='freight_contract_type'>{{ $delivery_instruction->freight_contract_type }}</td>
                                    <td field-key='delivery_instruction_number'>{{ $delivery_instruction->delivery_instruction_number }}</td>
                                    <td field-key='driver'>{{ $delivery_instruction->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $delivery_instruction->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($delivery_instruction->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor'>{{ $delivery_instruction->vendor->name or '' }}</td>
                                    <td field-key='vendor_driver'>{{ $delivery_instruction->vendor_driver->name or '' }}</td>
                                    <td field-key='vendor_vehicle_description'>
                                        @foreach ($delivery_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                            <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='order_number'>{{ $delivery_instruction->order_number }}</td>
                                    <td field-key='client'>{{ $delivery_instruction->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $delivery_instruction->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $delivery_instruction->project_manager->name or '' }}</td>
                                    <td field-key='delivery_company_name'>{{ $delivery_instruction->delivery_company_name }}</td>
                                    <td field-key='delivery_address'>{{ $delivery_instruction->delivery_address_address }}</td>
                                    <td field-key='delivery_date_time'>{{ $delivery_instruction->delivery_date_time }}</td>
                                    <td field-key='prepared_by'>{{ $delivery_instruction->prepared_by }}</td>
                                    <td field-key='status'>{{ $delivery_instruction->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.restore', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.perma_del', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('delivery_instruction_view')
                                        <a href="{{ route('admin.delivery_instructions.show',[$delivery_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('delivery_instruction_edit')
                                        <a href="{{ route('admin.delivery_instructions.edit',[$delivery_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('delivery_instruction_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.delivery_instructions.destroy', $delivery_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="loading_instruction">
    <table class="table table-bordered table-striped {{ count($loading_instructions) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.loading-instruction.fields.road-freight-number')</th>
                            <th>@lang('global.loading-instruction.fields.freight-contract-type')</th>
                            <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                            <th>@lang('global.loading-instruction.fields.driver')</th>
                            <th>@lang('global.loading-instruction.fields.vehicle')</th>
                            <th>@lang('global.loading-instruction.fields.trailers')</th>
                            <th>@lang('global.loading-instruction.fields.vendor')</th>
                            <th>@lang('global.loading-instruction.fields.vendor-driver')</th>
                            <th>@lang('global.loading-instruction.fields.vendor-vehicle-description')</th>
                            <th>@lang('global.loading-instruction.fields.order-number')</th>
                            <th>@lang('global.loading-instruction.fields.client')</th>
                            <th>@lang('global.loading-instruction.fields.contact-person')</th>
                            <th>@lang('global.loading-instruction.fields.project-manager')</th>
                            <th>@lang('global.loading-instruction.fields.pick-up-company-name')</th>
                            <th>@lang('global.loading-instruction.fields.pickup-address')</th>
                            <th>@lang('global.loading-instruction.fields.pickup-date-time')</th>
                            <th>@lang('global.loading-instruction.fields.prepared-by')</th>
                            <th>@lang('global.loading-instruction.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($loading_instructions) > 0)
                @foreach ($loading_instructions as $loading_instruction)
                    <tr data-entry-id="{{ $loading_instruction->id }}">
                        <td field-key='road_freight_number'>{{ $loading_instruction->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='freight_contract_type'>{{ $loading_instruction->freight_contract_type }}</td>
                                    <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                    <td field-key='driver'>{{ $loading_instruction->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $loading_instruction->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($loading_instruction->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor'>{{ $loading_instruction->vendor->name or '' }}</td>
                                    <td field-key='vendor_driver'>{{ $loading_instruction->vendor_driver->name or '' }}</td>
                                    <td field-key='vendor_vehicle_description'>
                                        @foreach ($loading_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                            <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='order_number'>{{ $loading_instruction->order_number }}</td>
                                    <td field-key='client'>{{ $loading_instruction->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $loading_instruction->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $loading_instruction->project_manager->name or '' }}</td>
                                    <td field-key='pick_up_company_name'>{{ $loading_instruction->pick_up_company_name }}</td>
                                    <td field-key='pickup_address'>{{ $loading_instruction->pickup_address_address }}</td>
                                    <td field-key='pickup_date_time'>{{ $loading_instruction->pickup_date_time }}</td>
                                    <td field-key='prepared_by'>{{ $loading_instruction->prepared_by }}</td>
                                    <td field-key='status'>{{ $loading_instruction->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.restore', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.perma_del', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('loading_instruction_view')
                                        <a href="{{ route('admin.loading_instructions.show',[$loading_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('loading_instruction_edit')
                                        <a href="{{ route('admin.loading_instructions.edit',[$loading_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('loading_instruction_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.loading_instructions.destroy', $loading_instruction->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
    
                <p>&nbsp;</p>
    
                <a href="{{ route('admin.employees.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
            </div>
        </div>
    @stop
    
    @section('javascript')
        @parent
    
        <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
        <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
        <script>
            $(function(){
                moment.updateLocale('{{ App::getLocale() }}', {
                    week: { dow: 1 } // Monday is the first day of the week
                });
                
                $('.date').datetimepicker({
                    format: "{{ config('app.date_format_moment') }}",
                    locale: "{{ App::getLocale() }}",
                });
                
            });
        </script>
                
    @stop
    