@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-card-items.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.job_card_items.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('job_card_items_id', trans('global.job-card-items.fields.job-card-items').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_card_items_id', $job_card_items, old('job_card_items_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Job card No.</p>
                    @if($errors->has('job_card_items_id'))
                        <p class="help-block">
                            {{ $errors->first('job_card_items_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_job_card_number_id', trans('global.job-card-items.fields.client-job-card-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_job_card_number_id', $client_job_card_numbers, old('client_job_card_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Client job card No.</p>
                    @if($errors->has('client_job_card_number_id'))
                        <p class="help-block">
                            {{ $errors->first('client_job_card_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('workshop', trans('global.job-card-items.fields.workshop').'', ['class' => 'control-label']) !!}
                    {!! Form::text('workshop', old('workshop'), ['class' => 'form-control', 'placeholder' => 'Workshop']) !!}
                    <p class="help-block">Workshop</p>
                    @if($errors->has('workshop'))
                        <p class="help-block">
                            {{ $errors->first('workshop') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('part', trans('global.job-card-items.fields.part').'', ['class' => 'control-label']) !!}
                    {!! Form::text('part', old('part'), ['class' => 'form-control', 'placeholder' => 'Enter the part']) !!}
                    <p class="help-block">Enter the part</p>
                    @if($errors->has('part'))
                        <p class="help-block">
                            {{ $errors->first('part') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('price', trans('global.job-card-items.fields.price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('price', old('price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('price'))
                        <p class="help-block">
                            {{ $errors->first('price') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('qty', trans('global.job-card-items.fields.qty').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('unit', trans('global.job-card-items.fields.unit').'', ['class' => 'control-label']) !!}
                    {!! Form::text('unit', old('unit'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('unit'))
                        <p class="help-block">
                            {{ $errors->first('unit') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total', trans('global.job-card-items.fields.total').'', ['class' => 'control-label']) !!}
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

