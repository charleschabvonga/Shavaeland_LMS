@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deduction-items.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.deduction_items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item_number_id', trans('global.deduction-items.fields.item-number').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('item_description', trans('global.deduction-items.fields.item-description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('item_description', old('item_description'), ['class' => 'form-control', 'placeholder' => 'Enter the item decription']) !!}
                    <p class="help-block">Enter the item decription</p>
                    @if($errors->has('item_description'))
                        <p class="help-block">
                            {{ $errors->first('item_description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unit_price', trans('global.deduction-items.fields.unit-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('unit_price', old('unit_price'), ['class' => 'form-control', 'placeholder' => 'Enter the unit price']) !!}
                    <p class="help-block">Enter the unit price</p>
                    @if($errors->has('unit_price'))
                        <p class="help-block">
                            {{ $errors->first('unit_price') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.deduction-items.fields.qty').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('total', trans('global.deduction-items.fields.total').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total', old('total'), ['class' => 'form-control', 'placeholder' => 'Enter the total']) !!}
                    <p class="help-block">Enter the total</p>
                    @if($errors->has('total'))
                        <p class="help-block">
                            {{ $errors->first('total') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('unit', trans('global.deduction-items.fields.unit').'', ['class' => 'control-label']) !!}
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

