@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.truck-attachment-status.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.truck_attachment_statuses.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('attachment', trans('global.truck-attachment-status.fields.attachment').'', ['class' => 'control-label']) !!}
                    {!! Form::text('attachment', old('attachment'), ['class' => 'form-control', 'placeholder' => 'Attachment']) !!}
                    <p class="help-block">Attachment</p>
                    @if($errors->has('attachment'))
                        <p class="help-block">
                            {{ $errors->first('attachment') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

