@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.unit-measurements.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.unit_measurements.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('measurement_type', trans('global.unit-measurements.fields.measurement-type').'', ['class' => 'control-label']) !!}
                    {!! Form::text('measurement_type', old('measurement_type'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('measurement_type'))
                        <p class="help-block">
                            {{ $errors->first('measurement_type') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

