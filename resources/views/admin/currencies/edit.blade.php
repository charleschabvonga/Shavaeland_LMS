@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.currency.title')</h3>
    
    {!! Form::model($currency, ['method' => 'PUT', 'route' => ['admin.currencies.update', $currency->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.currency.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                    <p class="help-block">Name</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('symbol', trans('global.currency.fields.symbol').'', ['class' => 'control-label']) !!}
                    {!! Form::text('symbol', old('symbol'), ['class' => 'form-control', 'placeholder' => 'Symbol']) !!}
                    <p class="help-block">Symbol</p>
                    @if($errors->has('symbol'))
                        <p class="help-block">
                            {{ $errors->first('symbol') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

