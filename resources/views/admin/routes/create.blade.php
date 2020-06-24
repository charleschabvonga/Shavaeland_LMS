@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.route.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.routes.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('route', trans('global.route.fields.route').'', ['class' => 'control-label']) !!}
                    {!! Form::text('route', old('route'), ['class' => 'form-control', 'placeholder' => 'Route']) !!}
                    <p class="help-block">Route</p>
                    @if($errors->has('route'))
                        <p class="help-block">
                            {{ $errors->first('route') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('distance', trans('global.route.fields.distance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('distance', old('distance'), ['class' => 'form-control', 'placeholder' => 'Distance']) !!}
                    <p class="help-block">Distance</p>
                    @if($errors->has('distance'))
                        <p class="help-block">
                            {{ $errors->first('distance') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

