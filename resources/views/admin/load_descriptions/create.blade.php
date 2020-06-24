@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.load-descriptions.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.load_descriptions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.load-descriptions.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Item description']) !!}
                    <p class="help-block">Item description</p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.load-descriptions.fields.qty').'', ['class' => 'control-label']) !!}
                    {!! Form::text('qty', old('qty'), ['class' => 'form-control', 'placeholder' => 'Qty']) !!}
                    <p class="help-block">Qty</p>
                    @if($errors->has('qty'))
                        <p class="help-block">
                            {{ $errors->first('qty') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('weight_volume', trans('global.load-descriptions.fields.weight-volume').'', ['class' => 'control-label']) !!}
                    {!! Form::text('weight_volume', old('weight_volume'), ['class' => 'form-control', 'placeholder' => 'Weight/Volume']) !!}
                    <p class="help-block">Weight/Volume</p>
                    @if($errors->has('weight_volume'))
                        <p class="help-block">
                            {{ $errors->first('weight_volume') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('loading_instruction_number_id', trans('global.load-descriptions.fields.loading-instruction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('loading_instruction_number_id', $loading_instruction_numbers, old('loading_instruction_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Loading instruction No.</p>
                    @if($errors->has('loading_instruction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('loading_instruction_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('delivery_instruction_number_id', trans('global.load-descriptions.fields.delivery-instruction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('delivery_instruction_number_id', $delivery_instruction_numbers, old('delivery_instruction_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Delivery instruction No.</p>
                    @if($errors->has('delivery_instruction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('delivery_instruction_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('air_freight_number_id', trans('global.load-descriptions.fields.air-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('air_freight_number_id', $air_freight_numbers, old('air_freight_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Air freight No.</p>
                    @if($errors->has('air_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('air_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('rail_freight_number_id', trans('global.load-descriptions.fields.rail-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('rail_freight_number_id', $rail_freight_numbers, old('rail_freight_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Rail freight No.</p>
                    @if($errors->has('rail_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('rail_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sea_freight_number_id', trans('global.load-descriptions.fields.sea-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('sea_freight_number_id', $sea_freight_numbers, old('sea_freight_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Sea freight No.</p>
                    @if($errors->has('sea_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('sea_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

