@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.payee_accounts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">EMPLOYEE ACCOUNT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('employee_id', trans('global.payee-accounts.fields.employee').'', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_id', $employees, old('employee_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.payee-accounts.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('position_id', trans('global.payee-accounts.fields.position').'', ['class' => 'control-label']) !!}
                    {!! Form::select('position_id', $positions, old('position_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('position_id'))
                        <p class="help-block">
                            {{ $errors->first('position_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group pull-right">
                    {!! Form::label('department_id', trans('global.payee-accounts.fields.department').'', ['class' => 'control-label']) !!}
                    {!! Form::select('department_id', $departments, old('department_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('department_id'))
                        <p class="help-block">
                            {{ $errors->first('department_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('bank', trans('global.payee-accounts.fields.bank').'', ['class' => 'control-label']) !!}
                    {!! Form::text('bank', old('bank'), ['class' => 'form-control', 'placeholder' => 'Bank name']) !!}
                    @if($errors->has('bank'))
                        <p class="help-block">
                            {{ $errors->first('bank') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('branch_code', trans('global.payee-accounts.fields.branch-code').'', ['class' => 'control-label']) !!}
                    {!! Form::text('branch_code', old('branch_code'), ['class' => 'form-control', 'placeholder' => 'Branch code']) !!}
                    @if($errors->has('branch_code'))
                        <p class="help-block">
                            {{ $errors->first('branch_code') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('branch', trans('global.payee-accounts.fields.branch').'', ['class' => 'control-label']) !!}
                    {!! Form::text('branch', old('branch'), ['class' => 'form-control', 'placeholder' => 'Branch']) !!}
                    @if($errors->has('branch'))
                        <p class="help-block">
                            {{ $errors->first('branch') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('account_number', trans('global.payee-accounts.fields.account-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='account_number' value='{{ $account_number }}' class="form-control" required/></td>
                    @if($errors->has('account_number'))
                        <p class="help-block">
                            {{ $errors->first('account_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('pymt_measurement_type', trans('global.payee-accounts.fields.pymt-measurement-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('pymt_measurement_type', $enum_pymt_measurement_type, old('pymt_measurement_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('pymt_measurement_type'))
                        <p class="help-block">
                            {{ $errors->first('pymt_measurement_type') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">PAYMENT RATES</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.payee-accounts.fields.wage-rate')</th>
                            <th>@lang('global.payee-accounts.fields.pension-rate')</th>
                            <th>@lang('global.payee-accounts.fields.overtime-rate')</th>
                            <th>@lang('global.payee-accounts.fields.public-holiday-rate')</th>
                            <th>@lang('global.payee-accounts.fields.medical-aid')</th>
                            <th>@lang('global.payee-accounts.fields.sales-rate')</th>
                        </tr>
                        </thead>
                        <tbody id="non-machine-costs">
                            <td>
                                {!! Form::text('wage_rate', old('wage_rate'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('wage_rate'))
                                    <p class="help-block">
                                        {{ $errors->first('wage_rate') }}
                                    </p>
                                @endif
                            </td>
                            <td>
                                {!! Form::text('pension_rate', old('pension_rate'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('pension_rate'))
                                    <p class="help-block">
                                        {{ $errors->first('pension_rate') }}
                                    </p>
                                @endif
                            </td>
                            <td>
                                {!! Form::text('overtime_rate', old('overtime_rate'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('overtime_rate'))
                                    <p class="help-block">
                                        {{ $errors->first('overtime_rate') }}
                                    </p>
                                @endif
                            </td>
                            <td>
                                {!! Form::text('public_holiday_rate', old('public_holiday_rate'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('public_holiday_rate'))
                                    <p class="help-block">
                                        {{ $errors->first('public_holiday_rate') }}
                                    </p>
                                @endif
                            </td>
                            <td>
                                {!! Form::text('medical_aid', old('medical_aid'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('medical_aid'))
                                    <p class="help-block">
                                        {{ $errors->first('medical_aid') }}
                                    </p>
                                @endif
                            </td>
                            <td>
                                {!! Form::text('sales_rate', old('sales_rate'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                                @if($errors->has('sales_rate'))
                                    <p class="help-block">
                                        {{ $errors->first('sales_rate') }}
                                    </p>
                                @endif
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

