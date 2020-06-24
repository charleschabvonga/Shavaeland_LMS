@extends('layouts.app')

@section('content')
    
    {!! Form::model($driver, ['method' => 'PUT', 'route' => ['admin.drivers.update', $driver->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">VENDOR DRIVERS</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('vendor_id', trans('global.drivers.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('subcontractor_number_id', trans('global.drivers.fields.subcontractor-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('subcontractor_number_id', $subcontractor_numbers, old('subcontractor_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('subcontractor_number_id'))
                        <p class="help-block">
                            {{ $errors->first('subcontractor_number_id') }}
                        </p>
                    @endif
                </div> 
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.drivers.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('name', trans('global.drivers.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('date_of_birth', trans('global.drivers.fields.date-of-birth').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date_of_birth', old('date_of_birth'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('date_of_birth'))
                        <p class="help-block">
                            {{ $errors->first('date_of_birth') }}
                        </p>
                    @endif
                </div> 
                <div class="col-xs-2 form-group">
                    {!! Form::label('sa_phone_number', trans('global.drivers.fields.sa-phone-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('sa_phone_number', old('sa_phone_number'), ['class' => 'form-control', 'placeholder' => 'SA Phone No.', 'required' => '']) !!}
                    @if($errors->has('sa_phone_number'))
                        <p class="help-block">
                            {{ $errors->first('sa_phone_number') }}
                        </p>
                    @endif
                </div> 
                <div class="col-xs-2 form-group">
                    {!! Form::label('int_phone_number', trans('global.drivers.fields.int-phone-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('int_phone_number', old('int_phone_number'), ['class' => 'form-control', 'placeholder' => 'Int phone No.', 'required' => '']) !!}
                    @if($errors->has('int_phone_number'))
                        <p class="help-block">
                            {{ $errors->first('int_phone_number') }}
                        </p>
                    @endif
                </div>          
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('drivers_license_number', trans('global.drivers.fields.drivers-license-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('drivers_license_number', old('drivers_license_number'), ['class' => 'form-control', 'placeholder' => 'Drivers license No.', 'required' => '']) !!}
                    @if($errors->has('drivers_license_number'))
                        <p class="help-block">
                            {{ $errors->first('drivers_license_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('drivers_license', trans('global.drivers.fields.drivers-license').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('drivers_license', old('drivers_license')) !!}
                    @if ($driver->drivers_license)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_license) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('drivers_license', ['class' => 'form-control']) !!}
                    {!! Form::hidden('drivers_license_max_size', 2) !!}
                    @if($errors->has('drivers_license'))
                        <p class="help-block">
                            {{ $errors->first('drivers_license') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('drivers_license_expiry_date', trans('global.drivers.fields.drivers-license-expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('drivers_license_expiry_date', old('drivers_license_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('drivers_license_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('drivers_license_expiry_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('drivers_passport_number', trans('global.drivers.fields.drivers-passport-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('drivers_passport_number', old('drivers_passport_number'), ['class' => 'form-control', 'placeholder' => 'Driver passport No.', 'required' => '']) !!}
                    @if($errors->has('drivers_passport_number'))
                        <p class="help-block">
                            {{ $errors->first('drivers_passport_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('drivers_passport', trans('global.drivers.fields.drivers-passport').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('drivers_passport', old('drivers_passport')) !!}
                    @if ($driver->drivers_passport)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_passport) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('drivers_passport', ['class' => 'form-control']) !!}
                    {!! Form::hidden('drivers_passport_max_size', 2) !!}
                    @if($errors->has('drivers_passport'))
                        <p class="help-block">
                            {{ $errors->first('drivers_passport') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('passport_expiry_date', trans('global.drivers.fields.passport-expiry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('passport_expiry_date', old('passport_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('passport_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('passport_expiry_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('retest_number', trans('global.drivers.fields.retest-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('retest_number', old('retest_number'), ['class' => 'form-control', 'placeholder' => 'Retest No.']) !!}
                    @if($errors->has('retest_number'))
                        <p class="help-block">
                            {{ $errors->first('retest_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('retest', trans('global.drivers.fields.retest').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('retest', old('retest')) !!}
                    @if ($driver->retest)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->retest) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('retest', ['class' => 'form-control']) !!}
                    {!! Form::hidden('retest_max_size', 2) !!}
                    @if($errors->has('retest'))
                        <p class="help-block">
                            {{ $errors->first('retest') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('retest_expiry_date', trans('global.drivers.fields.retest-expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('retest_expiry_date', old('retest_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('retest_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('retest_expiry_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('int_drivers_license_no', trans('global.drivers.fields.int-drivers-license-no').'', ['class' => 'control-label']) !!}
                    {!! Form::text('int_drivers_license_no', old('int_drivers_license_no'), ['class' => 'form-control', 'placeholder' => 'Int drivers license No.']) !!}
                    @if($errors->has('int_drivers_license_no'))
                        <p class="help-block">
                            {{ $errors->first('int_drivers_license_no') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('int_drivers_license', trans('global.drivers.fields.int-drivers-license').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('int_drivers_license', old('int_drivers_license')) !!}
                    @if ($driver->int_drivers_license)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->int_drivers_license) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('int_drivers_license', ['class' => 'form-control']) !!}
                    {!! Form::hidden('int_drivers_license_max_size', 2) !!}
                    @if($errors->has('int_drivers_license'))
                        <p class="help-block">
                            {{ $errors->first('int_drivers_license') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('int_drivers_license_expiry_date', trans('global.drivers.fields.int-drivers-license-expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('int_drivers_license_expiry_date', old('int_drivers_license_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('int_drivers_license_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('int_drivers_license_expiry_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                {!! Form::label('police_clearance', trans('global.drivers.fields.police-clearance').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('police_clearance', old('police_clearance')) !!}
                    @if ($driver->police_clearance)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->police_clearance) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('police_clearance', ['class' => 'form-control']) !!}
                    {!! Form::hidden('police_clearance_max_size', 2) !!}
                    @if($errors->has('police_clearance'))
                        <p class="help-block">
                            {{ $errors->first('police_clearance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('police_clearance_expiry_date', trans('global.drivers.fields.police-clearance-expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('police_clearance_expiry_date', old('police_clearance_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('police_clearance_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('police_clearance_expiry_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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