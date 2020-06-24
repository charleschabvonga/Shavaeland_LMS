@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.violations.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">TRAFFIC VIOLATION</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('citation_number', trans('global.violations.fields.citation-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('citation_number', old('citation_number'), ['class' => 'form-control', 'placeholder' => 'Citation No.', 'required' => '']) !!}
                    @if($errors->has('citation_number'))
                        <p class="help-block">
                            {{ $errors->first('citation_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('citation_date', trans('global.violations.fields.citation-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('citation_date', old('citation_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('citation_date'))
                        <p class="help-block">
                            {{ $errors->first('citation_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('employee_name_id', trans('global.violations.fields.employee-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_name_id', $employee_names, old('employee_name_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('employee_name_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_name_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_description_id', trans('global.violations.fields.vehicle-description').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_description_id', $vehicle_descriptions, old('vehicle_description_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vehicle_description_id'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_description_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('trailer_id', trans('global.violations.fields.trailer').'', ['class' => 'control-label']) !!}
                    {!! Form::select('trailer_id', $trailers, old('trailer_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('trailer_id'))
                        <p class="help-block">
                            {{ $errors->first('trailer_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('road_freight_number_id', trans('global.violations.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('description', trans('global.violations.fields.description').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Violation description', 'required' => '']) !!}
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('location_issued_address', trans('global.violations.fields.location-issued').'', ['class' => 'control-label']) !!}
                    {!! Form::text('location_issued_address', old('location_issued_address'), ['class' => 'form-control map-input', 'id' => 'location_issued-input']) !!}
                    {!! Form::hidden('location_issued_latitude', 0 , ['id' => 'location_issued-latitude']) !!}
                    {!! Form::hidden('location_issued_longitude', 0 , ['id' => 'location_issued-longitude']) !!}
                    @if($errors->has('location_issued'))
                        <p class="help-block">
                            {{ $errors->first('location_issued') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('file', trans('global.violations.fields.file').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('file', old('file')) !!}
                    {!! Form::file('file', ['class' => 'form-control']) !!}
                    {!! Form::hidden('file_max_size', 2) !!}
                    @if($errors->has('file'))
                        <p class="help-block">
                            {{ $errors->first('file') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.violations.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('amount', trans('global.violations.fields.amount').'', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
                        
            <div id="location_issued-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="location_issued-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
   <script src="/adminlte/js/mapInput.js"></script>

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