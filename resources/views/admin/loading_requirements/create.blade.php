@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.loading-requirements.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.loading_requirements.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('loading_instruction_number_id', trans('global.loading-requirements.fields.loading-instruction-number').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('item_description', trans('global.loading-requirements.fields.item-description').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('qty', trans('global.loading-requirements.fields.qty').'', ['class' => 'control-label']) !!}
                    {!! Form::text('qty', old('qty'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('qty'))
                        <p class="help-block">
                            {{ $errors->first('qty') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

