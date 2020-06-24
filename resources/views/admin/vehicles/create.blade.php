@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.vehicles.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">HORSES</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_description', trans('global.vehicles.fields.vehicle-description').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('vehicle_description', old('vehicle_description'), ['class' => 'form-control', 'placeholder' => 'Registration No.', 'required' => '']) !!}
                    @if($errors->has('vehicle_description'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_description') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('make', trans('global.vehicles.fields.make').'', ['class' => 'control-label']) !!}
                    {!! Form::text('make', old('make'), ['class' => 'form-control', 'placeholder' => 'Make']) !!}
                    @if($errors->has('make'))
                        <p class="help-block">
                            {{ $errors->first('make') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('model', trans('global.vehicles.fields.model').'', ['class' => 'control-label']) !!}
                    {!! Form::text('model', old('model'), ['class' => 'form-control', 'placeholder' => 'Model']) !!}
                    @if($errors->has('model'))
                        <p class="help-block">
                            {{ $errors->first('model') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('purchase_date', trans('global.vehicles.fields.purchase-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('purchase_date', old('purchase_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('purchase_date'))
                        <p class="help-block">
                            {{ $errors->first('purchase_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('purchase_price', trans('global.vehicles.fields.purchase-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('purchase_price', old('purchase_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('purchase_price'))
                        <p class="help-block">
                            {{ $errors->first('purchase_price') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('chasis_number', trans('global.vehicles.fields.chasis-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('chasis_number', old('chasis_number'), ['class' => 'form-control', 'placeholder' => 'Chasis No.']) !!}
                    @if($errors->has('chasis_number'))
                        <p class="help-block">
                            {{ $errors->first('chasis_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('engine_number', trans('global.vehicles.fields.engine-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('engine_number', old('engine_number'), ['class' => 'form-control', 'placeholder' => 'Engine No.']) !!}
                    @if($errors->has('engine_number'))
                        <p class="help-block">
                            {{ $errors->first('engine_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('size_id', trans('global.vehicles.fields.size').'', ['class' => 'control-label']) !!}
                    {!! Form::select('size_id', $sizes, old('size_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('size_id'))
                        <p class="help-block">
                            {{ $errors->first('size_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('starting_mileage', trans('global.vehicles.fields.starting-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('starting_mileage', old('starting_mileage'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('starting_mileage'))
                        <p class="help-block">
                            {{ $errors->first('starting_mileage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('next_service_mileage', trans('global.vehicles.fields.next-service-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_mileage', old('next_service_mileage'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('next_service_mileage'))
                        <p class="help-block">
                            {{ $errors->first('next_service_mileage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('next_service_date', trans('global.vehicles.fields.next-service-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_date', old('next_service_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('next_service_date'))
                        <p class="help-block">
                            {{ $errors->first('next_service_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('service_status', trans('global.vehicles.fields.service-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('service_status', $enum_service_status, old('service_status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('service_status'))
                        <p class="help-block">
                            {{ $errors->first('service_status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('availability', trans('global.vehicles.fields.availability').'', ['class' => 'control-label']) !!}
                    {!! Form::select('availability', $enum_availability, old('availability'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('availability'))
                        <p class="help-block">
                            {{ $errors->first('availability') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('salvage_value', trans('global.vehicles.fields.salvage-value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('salvage_value', old('salvage_value'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('salvage_value'))
                        <p class="help-block">
                            {{ $errors->first('salvage_value') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('investment', trans('global.vehicles.fields.investment').'', ['class' => 'control-label']) !!}
                    {!! Form::text('investment', old('investment'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('investment'))
                        <p class="help-block">
                            {{ $errors->first('investment') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('depreciation', trans('global.vehicles.fields.depreciation').'', ['class' => 'control-label']) !!}
                    {!! Form::text('depreciation', old('depreciation'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('depreciation'))
                        <p class="help-block">
                            {{ $errors->first('depreciation') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('maintenance', trans('global.vehicles.fields.maintenance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('maintenance', old('maintenance'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('maintenance'))
                        <p class="help-block">
                            {{ $errors->first('maintenance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('tyre', trans('global.vehicles.fields.tyre').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tyre', old('tyre'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('tyre'))
                        <p class="help-block">
                            {{ $errors->first('tyre') }}
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