@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.invoice-items.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.invoice_items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('invoice_number_id', trans('global.invoice-items.fields.invoice-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('invoice_number_id', $invoice_numbers, old('invoice_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Invoice No.</p>
                    @if($errors->has('invoice_number_id'))
                        <p class="help-block">
                            {{ $errors->first('invoice_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bill_number_id', trans('global.invoice-items.fields.bill-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('bill_number_id', $bill_numbers, old('bill_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Bill No.</p>
                    @if($errors->has('bill_number_id'))
                        <p class="help-block">
                            {{ $errors->first('bill_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('credit_note_number_id', trans('global.invoice-items.fields.credit-note-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('credit_note_number_id', $credit_note_numbers, old('credit_note_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Credit note No.</p>
                    @if($errors->has('credit_note_number_id'))
                        <p class="help-block">
                            {{ $errors->first('credit_note_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('debit_note_number_id', trans('global.invoice-items.fields.debit-note-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('debit_note_number_id', $debit_note_numbers, old('debit_note_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Debit note No.</p>
                    @if($errors->has('debit_note_number_id'))
                        <p class="help-block">
                            {{ $errors->first('debit_note_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('clearance_and_forwarding_number_id', trans('global.invoice-items.fields.clearance-and-forwarding-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('clearance_and_forwarding_number_id', $clearance_and_forwarding_numbers, old('clearance_and_forwarding_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">C&F No.</p>
                    @if($errors->has('clearance_and_forwarding_number_id'))
                        <p class="help-block">
                            {{ $errors->first('clearance_and_forwarding_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('quotation_number_id', trans('global.invoice-items.fields.quotation-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('quotation_number_id', $quotation_numbers, old('quotation_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Quotation No.</p>
                    @if($errors->has('quotation_number_id'))
                        <p class="help-block">
                            {{ $errors->first('quotation_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('item_description', trans('global.invoice-items.fields.item-description').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('unit_price', trans('global.invoice-items.fields.unit-price').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('qty', trans('global.invoice-items.fields.qty').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('total', trans('global.invoice-items.fields.total').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total', old('total'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('total'))
                        <p class="help-block">
                            {{ $errors->first('total') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

