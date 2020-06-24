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
                                <h1><span style="color:#CE8F64">DEPARTMENT</span></h1>
                                <h4><b>Department</b>: <span style="color:red">{{ $department->dept_name }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($department->manager != '')
                                <b>Manager</b>: {{ $department->manager }}<br>
                            @endif 
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            @if ($department->street_address != '')
                                <b>Address</b>: {{ $department->street_address }}<br>
                            @endif
                            @if ($department->city != '')
                                {{ $department->city }}
                            @endif
                            @if ($department->province != '')
                                , {{ $department->province }}
                            @endif
                            @if ($department->country != '')
                                , {{ $department->country }}<br>
                            @endif
                            @if ($department->phone_no != '')
                                <b>Tel</b>: {{ $department->phone_no }}<br>
                            @endif
                            @if ($department->extension != '')
                                <b>Ext</b>: {{ $department->extension }}<br>
                            @endif
                            @if ($department->mobile_number != '')
                                <b>Ext</b>: {{ $department->mobile_number }}<br>
                            @endif
                            @if ($department->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $department->email }}</span><br>
                            @endif
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#employees" aria-controls="employees" role="tab" data-toggle="tab">Employees</a></li>
<li role="presentation" class=""><a href="#payee_accounts" aria-controls="payee_accounts" role="tab" data-toggle="tab">Employee accounts</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="employees">
<table class="table table-bordered table-striped {{ count($employees) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.employees.fields.name')</th>
                        <th>@lang('global.employees.fields.department')</th>
                        <th>@lang('global.employees.fields.position')</th>
                        <th>@lang('global.employees.fields.start-date')</th>
                        <th>@lang('global.employees.fields.end-date')</th>
                        <th>@lang('global.employees.fields.status')</th>
                        <th>@lang('global.employees.fields.street-address')</th>
                        <th>@lang('global.employees.fields.city')</th>
                        <th>@lang('global.employees.fields.province')</th>
                        <th>@lang('global.employees.fields.country')</th>
                        <th>@lang('global.employees.fields.sa-mobile')</th>
                        <th>@lang('global.employees.fields.int-mobile')</th>
                        <th>@lang('global.employees.fields.email')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($employees) > 0)
            @foreach ($employees as $employee)
                <tr data-entry-id="{{ $employee->id }}">
                    <td field-key='name'>{{ $employee->name }}</td>
                                <td field-key='department'>
                                    @foreach ($employee->department as $singleDepartment)
                                        <span class="label label-info label-many">{{ $singleDepartment->dept_name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='position'>{{ $employee->position }}</td>
                                <td field-key='start_date'>{{ $employee->start_date }}</td>
                                <td field-key='end_date'>{{ $employee->end_date }}</td>
                                <td field-key='status'>{{ $employee->status }}</td>
                                <td field-key='street_address'>{{ $employee->street_address }}</td>
                                <td field-key='city'>{{ $employee->city }}</td>
                                <td field-key='province'>{{ $employee->province }}</td>
                                <td field-key='country'>{{ $employee->country }}</td>
                                <td field-key='sa_mobile'>{{ $employee->sa_mobile }}</td>
                                <td field-key='int_mobile'>{{ $employee->int_mobile }}</td>
                                <td field-key='email'>{{ $employee->email }}</td>
                                <td field-key='upload_qualifications'>@if($employee->upload_qualifications)<a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_qualifications) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='upload_identification_docs'>@if($employee->upload_identification_docs)<a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_identification_docs) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.employees.restore', $employee->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.employees.perma_del', $employee->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('employee_view')
                                    <a href="{{ route('admin.employees.show',[$employee->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('employee_edit')
                                    <a href="{{ route('admin.employees.edit',[$employee->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('employee_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.employees.destroy', $employee->id])) !!}
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.departments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop
