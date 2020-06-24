@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.comments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">COMMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', trans('global.comments.fields.name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                    <p class="help-block">Name</p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('global.comments.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    <p class="help-block">Email</p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('comments', trans('global.comments.fields.comments').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('comments', old('comments'), ['class' => 'form-control ', 'placeholder' => 'Comments']) !!}
                    <p class="help-block">Comments</p>
                    @if($errors->has('comments'))
                        <p class="help-block">
                            {{ $errors->first('comments') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

