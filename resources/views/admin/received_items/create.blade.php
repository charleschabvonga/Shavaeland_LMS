@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.received-items.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.received_items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('receipt_number_id', trans('global.received-items.fields.receipt-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('receipt_number_id', $receipt_numbers, old('receipt_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Receipt No.</p>
                    @if($errors->has('receipt_number_id'))
                        <p class="help-block">
                            {{ $errors->first('receipt_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('release_number_id', trans('global.received-items.fields.release-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('release_number_id', $release_numbers, old('release_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Release No.</p>
                    @if($errors->has('release_number_id'))
                        <p class="help-block">
                            {{ $errors->first('release_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item', trans('global.received-items.fields.item').'', ['class' => 'control-label']) !!}
                    {!! Form::text('item', old('item'), ['class' => 'form-control', 'placeholder' => 'Enter the item']) !!}
                    <p class="help-block">Enter the item</p>
                    @if($errors->has('item'))
                        <p class="help-block">
                            {{ $errors->first('item') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.received-items.fields.qty').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('area', trans('global.received-items.fields.area').'', ['class' => 'control-label']) !!}
                    {!! Form::text('area', old('area'), ['class' => 'form-control', 'placeholder' => 'Enter the area']) !!}
                    <p class="help-block">Enter the area</p>
                    @if($errors->has('area'))
                        <p class="help-block">
                            {{ $errors->first('area') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unit', trans('global.received-items.fields.unit').'', ['class' => 'control-label']) !!}
                    {!! Form::text('unit', old('unit'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('unit'))
                        <p class="help-block">
                            {{ $errors->first('unit') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

