@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.parts.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PARTS & ACCESSORIES INVENTORIES</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.parts.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('repair_center_id', trans('global.parts.fields.repair-center').'', ['class' => 'control-label']) !!}
                    {!! Form::select('repair_center_id', $repair_centers, old('repair_center_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('repair_center_id'))
                        <p class="help-block">
                            {{ $errors->first('repair_center_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-5 form-group">
                    {!! Form::label('part', trans('global.parts.fields.part').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('part', old('part'), ['class' => 'form-control', 'placeholder' => 'Part', 'required' => '']) !!}
                    @if($errors->has('part'))
                        <p class="help-block">
                            {{ $errors->first('part') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('qty', trans('global.parts.fields.qty').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('qty', old('qty'), ['class' => 'form-control', 'placeholder' => '0.00', 'required' => '']) !!}
                    @if($errors->has('qty'))
                        <p class="help-block">
                            {{ $errors->first('qty') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('unit_id', trans('global.parts.fields.unit').'', ['class' => 'control-label']) !!}
                    {!! Form::select('unit_id', $units, old('unit_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('unit_id'))
                        <p class="help-block">
                            {{ $errors->first('unit_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

