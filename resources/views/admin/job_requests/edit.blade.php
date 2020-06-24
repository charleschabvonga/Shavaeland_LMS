@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-requests.title')</h3>
    
    {!! Form::model($job_request, ['method' => 'PUT', 'route' => ['admin.job_requests.update', $job_request->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">JOB REQUEST</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.job-requests.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.job-requests.fields.project-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('job_request_number', trans('global.job-requests.fields.job-request-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('job_request_number', old('job_request_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('job_request_number'))
                        <p class="help-block">
                            {{ $errors->first('job_request_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.job-requests.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('workshop_manager_id', trans('global.job-requests.fields.workshop-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('workshop_manager_id', $workshop_managers, old('workshop_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('workshop_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('workshop_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.job-requests.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.job-requests.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('requested_by', trans('global.job-requests.fields.requested-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('requested_by', old('requested_by'), ['class' => 'form-control', 'placeholder' => 'Requested by', 'readonly']) !!}
                    @if($errors->has('requested_by'))
                        <p class="help-block">
                            {{ $errors->first('requested_by') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_type', trans('global.job-requests.fields.vehicle-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_type', $enum_vehicle_type, old('vehicle_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vehicle_type'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_type') }}
                        </p>
                    @endif
                    <br><br>
                    {!! Form::label('vehicle_registration_number', trans('global.job-requests.fields.vehicle-registration-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('vehicle_registration_number', old('vehicle_registration_number'), ['class' => 'form-control', 'placeholder' => 'Vehicle reg No.']) !!}
                    @if($errors->has('vehicle_registration_number'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_registration_number') }}
                        </p>
                    @endif
                    <br>
                    {!! Form::label('make', trans('global.job-requests.fields.make').'', ['class' => 'control-label']) !!}
                    {!! Form::text('make', old('make'), ['class' => 'form-control', 'placeholder' => 'Make']) !!}
                    @if($errors->has('make'))
                        <p class="help-block">
                            {{ $errors->first('make') }}
                        </p>
                    @endif
                    <br>
                    {!! Form::label('model', trans('global.job-requests.fields.model').'', ['class' => 'control-label']) !!}
                    {!! Form::text('model', old('model'), ['class' => 'form-control', 'placeholder' => 'Model']) !!}
                    @if($errors->has('model'))
                        <p class="help-block">
                            {{ $errors->first('model') }}
                        </p>
                    @endif
                </div>

                <div class="col-xs-2 form-group">
                    {!! Form::label('mileage', trans('global.job-requests.fields.mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('mileage', old('mileage'), ['class' => 'form-control', 'placeholder' => 'Mileage']) !!}
                    @if($errors->has('mileage'))
                        <p class="help-block">
                            {{ $errors->first('mileage') }}
                        </p>
                    @endif<br>
                    {!! Form::label('next_service_mileage', trans('global.job-requests.fields.next-service-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_mileage', old('next_service_mileage'), ['class' => 'form-control', 'placeholder' => '0']) !!}
                    @if($errors->has('next_service_mileage'))
                        <p class="help-block">
                            {{ $errors->first('next_service_mileage') }}
                        </p>
                    @endif<br>
                    {!! Form::label('next_service_date', trans('global.job-requests.fields.next-service-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_date', old('next_service_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('next_service_date'))
                        <p class="help-block">
                            {{ $errors->first('next_service_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('description', trans('global.job-requests.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => '']) !!}
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group"></div>
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