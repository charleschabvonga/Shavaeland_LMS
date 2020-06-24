@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.departments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">DEPARTMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('dept_name', trans('global.departments.fields.dept-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('dept_name', old('dept_name'), ['class' => 'form-control', 'placeholder' => 'Dept name', 'required' => '']) !!}
                    @if($errors->has('dept_name'))
                        <p class="help-block">
                            {{ $errors->first('dept_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('manager', trans('global.departments.fields.manager').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('manager', old('manager'), ['class' => 'form-control', 'placeholder' => 'Manager', 'required' => '']) !!}
                    @if($errors->has('manager'))
                        <p class="help-block">
                            {{ $errors->first('manager') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('phone_no', trans('global.departments.fields.phone-no').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_no', old('phone_no'), ['class' => 'form-control', 'placeholder' => 'Phone No.', 'required' => '']) !!}
                    @if($errors->has('phone_no'))
                        <p class="help-block">
                            {{ $errors->first('phone_no') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('extension', trans('global.departments.fields.extension').'', ['class' => 'control-label']) !!}
                    {!! Form::text('extension', old('extension'), ['class' => 'form-control', 'placeholder' => 'Ext.']) !!}
                    @if($errors->has('extension'))
                        <p class="help-block">
                            {{ $errors->first('extension') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('mobile_number', trans('global.departments.fields.mobile-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('mobile_number', old('mobile_number'), ['class' => 'form-control', 'placeholder' => 'Mobile No.']) !!}
                    @if($errors->has('mobile_number'))
                        <p class="help-block">
                            {{ $errors->first('mobile_number') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('street_address', trans('global.departments.fields.street-address').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('street_address', old('street_address'), ['class' => 'form-control', 'placeholder' => 'Street address', 'required' => '']) !!}
                    @if($errors->has('street_address'))
                        <p class="help-block">
                            {{ $errors->first('street_address') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('city', trans('global.departments.fields.city').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => 'City', 'required' => '']) !!}
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('province', trans('global.departments.fields.province').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('province', old('province'), ['class' => 'form-control', 'placeholder' => 'Province', 'required' => '']) !!}
                    @if($errors->has('province'))
                        <p class="help-block">
                            {{ $errors->first('province') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('country', trans('global.departments.fields.country').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Country', 'required' => '']) !!}
                    @if($errors->has('country'))
                        <p class="help-block">
                            {{ $errors->first('country') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('email', trans('global.departments.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email', 'required' => '']) !!}
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

