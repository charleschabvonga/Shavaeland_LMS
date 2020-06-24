@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.vendor_accounts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">VENDOR ACCOUNT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('account_number', trans('global.vendor-accounts.fields.account-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='account_number' value='{{ $account_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('account_number'))
                        <p class="help-block">
                            {{ $errors->first('account_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('vendor_id', trans('global.vendor-accounts.fields.vendor').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.vendor-accounts.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('account_manager_id', trans('global.vendor-accounts.fields.account-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('account_manager_id', $account_managers, old('account_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('account_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('account_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.vendor-accounts.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

