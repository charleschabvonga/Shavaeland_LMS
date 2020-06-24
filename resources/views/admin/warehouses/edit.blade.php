@extends('layouts.app')

@section('content')
    
    {!! Form::model($warehouse, ['method' => 'PUT', 'route' => ['admin.warehouses.update', $warehouse->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">WAREHOUSE CENTER</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('vendor_id', trans('global.warehouse.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('center_name', trans('global.warehouse.fields.center-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('center_name', old('center_name'), ['class' => 'form-control', 'placeholder' => 'Center name', 'required' => '']) !!}
                    @if($errors->has('center_name'))
                        <p class="help-block">
                            {{ $errors->first('center_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('available_space', trans('global.warehouse.fields.available-space').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('available_space', old('available_space'), ['class' => 'form-control', 'placeholder' => '0.00', 'required' => '']) !!}
                    @if($errors->has('available_space'))
                        <p class="help-block">
                            {{ $errors->first('available_space') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('square_meters', trans('global.warehouse.fields.square-meters').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('square_meters', old('square_meters'), ['class' => 'form-control', 'placeholder' => '0.00', 'required' => '']) !!}
                    @if($errors->has('square_meters'))
                        <p class="help-block">
                            {{ $errors->first('square_meters') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

