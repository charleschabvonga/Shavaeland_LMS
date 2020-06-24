@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.non-machine-costs.title')</h3>
    
    {!! Form::model($non_machine_cost, ['method' => 'PUT', 'route' => ['admin.non_machine_costs.update', $non_machine_cost->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('road_freight_number_id', trans('global.non-machine-costs.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Road freight No.</p>
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item_description', trans('global.non-machine-costs.fields.item-description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('item_description', old('item_description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('item_description'))
                        <p class="help-block">
                            {{ $errors->first('item_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.non-machine-costs.fields.qty').'', ['class' => 'control-label']) !!}
                    {!! Form::text('qty', old('qty'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('qty'))
                        <p class="help-block">
                            {{ $errors->first('qty') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cost', trans('global.non-machine-costs.fields.cost').'', ['class' => 'control-label']) !!}
                    {!! Form::text('cost', old('cost'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cost'))
                        <p class="help-block">
                            {{ $errors->first('cost') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total', trans('global.non-machine-costs.fields.total').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total', old('total'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('total'))
                        <p class="help-block">
                            {{ $errors->first('total') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

