@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.vendor-contacts.title')</h3>
    
    {!! Form::model($vendor_contact, ['method' => 'PUT', 'route' => ['admin.vendor_contacts.update', $vendor_contact->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('company_name_id', trans('global.vendor-contacts.fields.company-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('company_name_id', $company_names, old('company_name_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Company name</p>
                    @if($errors->has('company_name_id'))
                        <p class="help-block">
                            {{ $errors->first('company_name_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_name', trans('global.vendor-contacts.fields.contact-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('contact_name', old('contact_name'), ['class' => 'form-control', 'placeholder' => 'Contact name']) !!}
                    <p class="help-block">Contact name</p>
                    @if($errors->has('contact_name'))
                        <p class="help-block">
                            {{ $errors->first('contact_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('phone_number', trans('global.vendor-contacts.fields.phone-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number', old('phone_number'), ['class' => 'form-control', 'placeholder' => 'Phone No.']) !!}
                    <p class="help-block">Phone No.</p>
                    @if($errors->has('phone_number'))
                        <p class="help-block">
                            {{ $errors->first('phone_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('global.vendor-contacts.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    <p class="help-block">Email</p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

