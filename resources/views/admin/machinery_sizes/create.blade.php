@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.machinery-size.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.machinery_sizes.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('size', trans('global.machinery-size.fields.size').'', ['class' => 'control-label']) !!}
                    {!! Form::text('size', old('size'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('size'))
                        <p class="help-block">
                            {{ $errors->first('size') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attachment_id', trans('global.machinery-size.fields.attachment').'', ['class' => 'control-label']) !!}
                    {!! Form::select('attachment_id', $attachments, old('attachment_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Attachment</p>
                    @if($errors->has('attachment_id'))
                        <p class="help-block">
                            {{ $errors->first('attachment_id') }}
                        </p>
                    @endif
                </div>
            </div>
                        
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

