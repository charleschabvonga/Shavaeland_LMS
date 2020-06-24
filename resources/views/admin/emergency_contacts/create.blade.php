@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.emergency-contacts.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.emergency_contacts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('employee_name_id', trans('global.emergency-contacts.fields.employee-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_name_id', $employee_names, old('employee_name_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Employee name</p>
                    @if($errors->has('employee_name_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_name_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.emergency-contacts.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Contact name']) !!}
                    <p class="help-block">Contact name</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone1', trans('global.emergency-contacts.fields.phone1').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone1', old('phone1'), ['class' => 'form-control', 'placeholder' => 'Phone No. 1']) !!}
                    <p class="help-block">Phone No. 1</p>
                    @if($errors->has('phone1'))
                        <p class="help-block">
                            {{ $errors->first('phone1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone', trans('global.emergency-contacts.fields.phone').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Phone No. 2']) !!}
                    <p class="help-block">Phone No. 2</p>
                    @if($errors->has('phone'))
                        <p class="help-block">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

