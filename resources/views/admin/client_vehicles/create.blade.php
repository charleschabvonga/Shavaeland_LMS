@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.client_vehicles.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">CLIENT VEHICLE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.client-vehicle.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('model', trans('global.client-vehicle.fields.model').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('model', old('model'), ['class' => 'form-control', 'placeholder' => 'model', 'required' => '']) !!}
                    @if($errors->has('model'))
                        <p class="help-block">
                            {{ $errors->first('model') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('make', trans('global.client-vehicle.fields.make').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('make', old('make'), ['class' => 'form-control', 'placeholder' => 'Make', 'required' => '']) !!}
                    @if($errors->has('make'))
                        <p class="help-block">
                            {{ $errors->first('make') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('vehicle_type', trans('global.client-vehicle.fields.vehicle-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_type', $enum_vehicle_type, old('vehicle_type'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vehicle_type'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('registration_number', trans('global.client-vehicle.fields.registration-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('registration_number', old('registration_number'), ['class' => 'form-control', 'placeholder' => 'Vehicle reg No.', 'required' => '']) !!}
                    @if($errors->has('registration_number'))
                        <p class="help-block">
                            {{ $errors->first('registration_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.client-vehicle.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('next_service_date', trans('global.vehicles.fields.next-service-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_date', old('next_service_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('next_service_date'))
                        <p class="help-block">
                            {{ $errors->first('next_service_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('next_service_mileage', trans('global.vehicles.fields.next-service-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_mileage', old('next_service_mileage'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('next_service_mileage'))
                        <p class="help-block">
                            {{ $errors->first('next_service_mileage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('starting_mileage', trans('global.client-vehicle.fields.starting-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('starting_mileage', old('starting_mileage'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('starting_mileage'))
                        <p class="help-block">
                            {{ $errors->first('starting_mileage') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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