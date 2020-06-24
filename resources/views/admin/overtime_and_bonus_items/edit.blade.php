@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.overtime-and-bonus-items.title')</h3>
    
    {!! Form::model($overtime_and_bonus_item, ['method' => 'PUT', 'route' => ['admin.overtime_and_bonus_items.update', $overtime_and_bonus_item->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item_number_id', trans('global.overtime-and-bonus-items.fields.item-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('item_number_id', $item_numbers, old('item_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Payslip No.</p>
                    @if($errors->has('item_number_id'))
                        <p class="help-block">
                            {{ $errors->first('item_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item_description', trans('global.overtime-and-bonus-items.fields.item-description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('item_description', old('item_description'), ['class' => 'form-control', 'placeholder' => 'Item description']) !!}
                    <p class="help-block">Item description</p>
                    @if($errors->has('item_description'))
                        <p class="help-block">
                            {{ $errors->first('item_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unit_price', trans('global.overtime-and-bonus-items.fields.unit-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('unit_price', old('unit_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('unit_price'))
                        <p class="help-block">
                            {{ $errors->first('unit_price') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.overtime-and-bonus-items.fields.qty').'', ['class' => 'control-label']) !!}
                    {!! Form::text('qty', old('qty'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('qty'))
                        <p class="help-block">
                            {{ $errors->first('qty') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total', trans('global.overtime-and-bonus-items.fields.total').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total', old('total'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('total'))
                        <p class="help-block">
                            {{ $errors->first('total') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unit', trans('global.overtime-and-bonus-items.fields.unit').'', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

