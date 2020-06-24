@extends('layouts.app')

@section('content')
    
    {!! Form::model($income_expense_calculator, ['method' => 'PUT', 'route' => ['admin.income_expense_calculators.update', $income_expense_calculator->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">ROAD FREIGHT COST CULCULATOR</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('route_id', trans('global.income-expense-calculator.fields.route').'', ['class' => 'control-label']) !!}
                    {!! Form::select('route_id', $routes, old('route_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('route_id'))
                        <p class="help-block">
                            {{ $errors->first('route_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('distance', trans('global.income-expense-calculator.fields.distance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('distance', old('distance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('distance'))
                        <p class="help-block">
                            {{ $errors->first('distance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('load_status', trans('global.income-expense-calculator.fields.load-status').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('truck_attachment_status_id', trans('global.income-expense-calculator.fields.truck-attachment-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('truck_attachment_status_id', $truck_attachment_statuses, old('truck_attachment_status_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('truck_attachment_status_id'))
                        <p class="help-block">
                            {{ $errors->first('truck_attachment_status_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('machinery_attachment_type_id', trans('global.income-expense-calculator.fields.machinery-attachment-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('machinery_attachment_type_id', $machinery_attachment_types, old('machinery_attachment_type_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('machinery_attachment_type_id'))
                        <p class="help-block">
                            {{ $errors->first('machinery_attachment_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('size_id', trans('global.income-expense-calculator.fields.size').'', ['class' => 'control-label']) !!}
                    {!! Form::select('size_id', $sizes, old('size_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('size_id'))
                        <p class="help-block">
                            {{ $errors->first('size_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicles_id', trans('global.income-expense-calculator.fields.vehicles').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicles_id', $vehicles, old('vehicles_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vehicles_id'))
                        <p class="help-block">
                            {{ $errors->first('vehicles_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('purchase_price', trans('global.income-expense-calculator.fields.purchase-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('purchase_price', old('purchase_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('purchase_price'))
                        <p class="help-block">
                            {{ $errors->first('purchase_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('salvage_value', trans('global.income-expense-calculator.fields.salvage-value').'', ['class' => 'control-label']) !!}
                    {!! Form::text('salvage_value', old('salvage_value'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('salvage_value'))
                        <p class="help-block">
                            {{ $errors->first('salvage_value') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('avg_investment', trans('global.income-expense-calculator.fields.avg-investment').'', ['class' => 'control-label']) !!}
                    {!! Form::text('avg_investment', old('avg_investment'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('avg_investment'))
                        <p class="help-block">
                            {{ $errors->first('avg_investment') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('depreciation', trans('global.income-expense-calculator.fields.depreciation').'', ['class' => 'control-label']) !!}
                    {!! Form::text('depreciation', old('depreciation'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('depreciation'))
                        <p class="help-block">
                            {{ $errors->first('depreciation') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('insurance', trans('global.income-expense-calculator.fields.insurance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('insurance', old('insurance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('insurance'))
                        <p class="help-block">
                            {{ $errors->first('insurance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('license', trans('global.income-expense-calculator.fields.license').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('fuel_price', trans('global.income-expense-calculator.fields.fuel-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel_price', old('fuel_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('fuel_price'))
                        <p class="help-block">
                            {{ $errors->first('fuel_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel_usage', trans('global.income-expense-calculator.fields.fuel-usage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel_usage', old('fuel_usage'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('fuel_usage'))
                        <p class="help-block">
                            {{ $errors->first('fuel_usage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel', trans('global.income-expense-calculator.fields.fuel').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fuel', old('fuel'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('fuel'))
                        <p class="help-block">
                            {{ $errors->first('fuel') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fuel_consumption', trans('global.income-expense-calculator.fields.fuel-consumption').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('oil_price', trans('global.income-expense-calculator.fields.oil-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil_price', old('oil_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('oil_price'))
                        <p class="help-block">
                            {{ $errors->first('oil_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil_usage', trans('global.income-expense-calculator.fields.oil-usage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil_usage', old('oil_usage'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('oil_usage'))
                        <p class="help-block">
                            {{ $errors->first('oil_usage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil', trans('global.income-expense-calculator.fields.oil').'', ['class' => 'control-label']) !!}
                    {!! Form::text('oil', old('oil'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('oil'))
                        <p class="help-block">
                            {{ $errors->first('oil') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('oil_consumption', trans('global.income-expense-calculator.fields.oil-consumption').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('tyre_price', trans('global.income-expense-calculator.fields.tyre-price').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tyre_price', old('tyre_price'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('tyre_price'))
                        <p class="help-block">
                            {{ $errors->first('tyre_price') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('number_of_tyres', trans('global.income-expense-calculator.fields.number-of-tyres').'', ['class' => 'control-label']) !!}
                    {!! Form::text('number_of_tyres', old('number_of_tyres'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('number_of_tyres'))
                        <p class="help-block">
                            {{ $errors->first('number_of_tyres') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('tyre', trans('global.income-expense-calculator.fields.tyre').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tyre', old('tyre'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('tyre'))
                        <p class="help-block">
                            {{ $errors->first('tyre') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('repair_maintenance', trans('global.income-expense-calculator.fields.repair-maintenance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('repair_maintenance', old('repair_maintenance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('repair_maintenance'))
                        <p class="help-block">
                            {{ $errors->first('repair_maintenance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('contigency_factor', trans('global.income-expense-calculator.fields.contigency-factor').'', ['class' => 'control-label']) !!}
                    {!! Form::text('contigency_factor', old('contigency_factor'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('contigency_factor'))
                        <p class="help-block">
                            {{ $errors->first('contigency_factor') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('trip_income', trans('global.income-expense-calculator.fields.trip-income').'', ['class' => 'control-label']) !!}
                    {!! Form::text('trip_income', old('trip_income'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('trip_income'))
                        <p class="help-block">
                            {{ $errors->first('trip_income') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('other_costs', trans('global.income-expense-calculator.fields.other-costs').'', ['class' => 'control-label']) !!}
                    {!! Form::text('other_costs', old('other_costs'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('other_costs'))
                        <p class="help-block">
                            {{ $errors->first('other_costs') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('total_costs', trans('global.income-expense-calculator.fields.total-costs').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total_costs', old('total_costs'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('total_costs'))
                        <p class="help-block">
                            {{ $errors->first('total_costs') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('balance', trans('global.income-expense-calculator.fields.balance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('balance', old('balance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('balance'))
                        <p class="help-block">
                            {{ $errors->first('balance') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

