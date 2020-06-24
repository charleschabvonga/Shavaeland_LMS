@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.machinery_costs.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">MACHINERY COST</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('road_freight_number_id', trans('global.machinery-costs.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('route_id', trans('global.machinery-costs.fields.route').'', ['class' => 'control-label']) !!}
                    {!! Form::select('route_id', $routes, old('route_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('route_id'))
                        <p class="help-block">
                            {{ $errors->first('route_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('distance', trans('global.machinery-costs.fields.distance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('distance', old('distance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('distance'))
                        <p class="help-block">
                            {{ $errors->first('distance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('load_status', trans('global.machinery-costs.fields.load-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('load_status', $enum_load_status, old('load_status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('load_status'))
                        <p class="help-block">
                            {{ $errors->first('load_status') }}
                        </p>
                    @endif
                </div>
            </div>         
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('truck_attachment_status_id', trans('global.machinery-costs.fields.truck-attachment-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('truck_attachment_status_id', $truck_attachment_statuses, old('truck_attachment_status_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('truck_attachment_status_id'))
                        <p class="help-block">
                            {{ $errors->first('truck_attachment_status_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('attachment_type', trans('global.machinery-costs.fields.machinery-attachment-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('attachment_type', $enum_attachment_type, old('attachment_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('attachment_type'))
                        <p class="help-block">
                            {{ $errors->first('attachment_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('size_id', trans('global.machinery-costs.fields.size').'', ['class' => 'control-label']) !!}
                    {!! Form::select('size_id', $sizes, old('size_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('size_id'))
                        <p class="help-block">
                            {{ $errors->first('size_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_description_id', trans('global.machinery-costs.fields.vehicle-description').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_description_id', $vehicle_descriptions, old('vehicle_description_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vehicle_description_id'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_description_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('purchase_price', trans('global.machinery-costs.fields.purchase-price').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='purchase_price' value='{{ $purchase_price }}' class="form-control" required/></td>
                    @if($errors->has('purchase_price'))
                        <p class="help-block">
                            {{ $errors->first('purchase_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('salvage_value', trans('global.machinery-costs.fields.salvage-value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('salvage_value', old('salvage_value'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('salvage_value'))
                        <p class="help-block">
                            {{ $errors->first('salvage_value') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('avg_investment', trans('global.machinery-costs.fields.avg-investment').'', ['class' => 'control-label']) !!}
                    {!! Form::text('avg_investment', old('avg_investment'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('avg_investment'))
                        <p class="help-block">
                            {{ $errors->first('avg_investment') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('depreciation', trans('global.machinery-costs.fields.depreciation').'', ['class' => 'control-label']) !!}
                    {!! Form::text('depreciation', old('depreciation'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('depreciation'))
                        <p class="help-block">
                            {{ $errors->first('depreciation') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('insurance', trans('global.machinery-costs.fields.insurance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('insurance', old('insurance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('insurance'))
                        <p class="help-block">
                            {{ $errors->first('insurance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('license', trans('global.machinery-costs.fields.license').'', ['class' => 'control-label']) !!}
                    {!! Form::text('license', old('license'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('license'))
                        <p class="help-block">
                            {{ $errors->first('license') }}
                        </p>
                    @endif
                </div>
            </div>
           
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel_price', trans('global.machinery-costs.fields.fuel-price').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='fuel_price' value='{{ number_format($fuel_price, 2) }}' class="form-control" required/></td>
                    @if($errors->has('fuel_price'))
                        <p class="help-block">
                            {{ $errors->first('fuel_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel_usage', trans('global.machinery-costs.fields.fuel-usage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel_usage', old('fuel_usage'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('fuel_usage'))
                        <p class="help-block">
                            {{ $errors->first('fuel_usage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel', trans('global.machinery-costs.fields.fuel').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel', old('fuel'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('fuel'))
                        <p class="help-block">
                            {{ $errors->first('fuel') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel_consumption', trans('global.machinery-costs.fields.fuel-consumption').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel_consumption', old('fuel_consumption'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('fuel_consumption'))
                        <p class="help-block">
                            {{ $errors->first('fuel_consumption') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil_price', trans('global.machinery-costs.fields.oil-price').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='oil_price' value='{{ $oil_price }}' class="form-control" required/></td>
                    @if($errors->has('oil_price'))
                        <p class="help-block">
                            {{ $errors->first('oil_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil_usage', trans('global.machinery-costs.fields.oil-usage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil_usage', old('oil_usage'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('oil_usage'))
                        <p class="help-block">
                            {{ $errors->first('oil_usage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil', trans('global.machinery-costs.fields.oil').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil', old('oil'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('oil'))
                        <p class="help-block">
                            {{ $errors->first('oil') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil_consumption', trans('global.machinery-costs.fields.oil-consumption').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil_consumption', old('oil_consumption'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('oil_consumption'))
                        <p class="help-block">
                            {{ $errors->first('oil_consumption') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('tyre_price', trans('global.machinery-costs.fields.tyre-price').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='tyre_price' value='{{ $tyre_price }}' class="form-control" required/></td>
                    @if($errors->has('tyre_price'))
                        <p class="help-block">
                            {{ $errors->first('tyre_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('number_of_tyres', trans('global.machinery-costs.fields.number-of-tyres').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='number_of_tyres' value='{{ $number_of_tyres }}' class="form-control" required/></td>
                    @if($errors->has('number_of_tyres'))
                        <p class="help-block">
                            {{ $errors->first('number_of_tyres') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('tyre', trans('global.machinery-costs.fields.tyre').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tyre', old('tyre'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('tyre'))
                        <p class="help-block">
                            {{ $errors->first('tyre') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('repair_maintenance', trans('global.machinery-costs.fields.repair-maintenance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('repair_maintenance', old('repair_maintenance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('repair_maintenance'))
                        <p class="help-block">
                            {{ $errors->first('repair_maintenance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('contigency_factor', trans('global.machinery-costs.fields.contigency-factor').'', ['class' => 'control-label']) !!}
                    {!! Form::text('contigency_factor', old('contigency_factor'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('contigency_factor'))
                        <p class="help-block">
                            {{ $errors->first('contigency_factor') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('total_costs', trans('global.machinery-costs.fields.total-costs').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total_costs', old('total_costs'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('total_costs'))
                        <p class="help-block">
                            {{ $errors->first('total_costs') }}
                        </p>
                    @endif
                </div>
            </div>
                                    
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $("#selectbtn-machinery").click(function(){
            $("#selectall-machinery > option").prop("selected","selected");
            $("#selectall-machinery").trigger("change");
        });
        $("#deselectbtn-machinery").click(function(){
            $("#selectall-machinery > option").prop("selected","");
            $("#selectall-machinery").trigger("change");
        });
    </script>
@stop