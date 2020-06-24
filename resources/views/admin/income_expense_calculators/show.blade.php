@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">ROAD FREIGHT COST CULCULATOR</span></h1>
                                <h4><b>Vehicle Reg</b>: <span style="color:red"> {{ $income_expense_calculator->vehicles->vehicle_description }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-3 ">
                            @if ($income_expense_calculator->route != '')
                                <b>Route</b>: {{ $income_expense_calculator->route->route or '' }}
                            @endif
                             @if ($income_expense_calculator->distance != '')
                                <br><b>Distance</b>: {{ $income_expense_calculator->distance }} kms
                            @endif
                            @if ($income_expense_calculator->load_status != '')
                                <br><b>Load status</b>: {{ $income_expense_calculator->load_status }}
                            @endif
                        </div>
                        
                        <div class="col-xs-6 form-group text-center">
                            @if ($income_expense_calculator->truck_attachment_status != '')
                                <b>Truck attachment status</b>: {{ $income_expense_calculator->truck_attachment_status->attachment or '' }}
                            @endif
                            @if ($income_expense_calculator->machinery_attachment_type != '')
                                <br><b>Machinery attachment type</b>: {{ $income_expense_calculator->machinery_attachment_type->machinery_type or '' }}
                            @endif
                             @if ($income_expense_calculator->size != '')
                                <br><b>Size</b>: {{ $income_expense_calculator->size->size or '' }}
                            @endif
                        </div>

                        <div class="col-xs-3 form-group text-right">
                            @if ($income_expense_calculator->purchase_price != '')
                                <b>Purchase price</b>: R {{ number_format($income_expense_calculator->purchase_price, 2) }}
                            @endif
                            @if ($income_expense_calculator->salvage_value != '')
                                <br><b>Salvage value</b>: R {{ number_format($income_expense_calculator->salvage_value, 2) }}
                            @endif
                            @if ($income_expense_calculator->avg_investment != '')
                                <br><b>Investment</b>: R {{ number_format($income_expense_calculator->avg_investment, 2) }}
                            @endif
                             @if ($income_expense_calculator->depreciation != '')
                                <br><b>Depreciation</b>: R {{ number_format($income_expense_calculator->depreciation, 2) }}
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">FUEL COSTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Fuel price')</th>
                                            <th>@lang('Fuel usage')</th>
                                            <th>@lang('Fuel consumption')</th>
                                            <th>@lang('Fuel cost')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->fuel_price, 2) }} /ltr</td>
                                                <td class="text-left"> {{ number_format($income_expense_calculator->fuel_usage, 2) }} ltrs/100kms</td>
                                                <td class="text-left"> {{ number_format($income_expense_calculator->fuel_consumption, 2) }} ltrs</td>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->fuel, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">OIL COSTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Oil price')</th>
                                            <th>@lang('Oil usage')</th>
                                            <th>@lang('Oil consumption')</th>
                                            <th>@lang('Oil cost')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->oil_price, 2) }} /ltr</td>
                                                <td class="text-left"> {{ number_format($income_expense_calculator->oil_usage, 2) }} ltrs/100kms</td>
                                                <td class="text-left"> {{ number_format($income_expense_calculator->oil_consumption, 2) }} ltrs</td>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->oil, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">TYRE COSTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Price')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Expected depreciation')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->tyre_price, 2) }} /tyre</td>
                                                <td class="text-left"> {{ $income_expense_calculator->number_of_tyres }} </td>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->tyre, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">CONTIGENCY COSTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Insurance')</th>
                                            <th>@lang('License')</th>
                                            <th>@lang('Repair & maintenance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->insurance, 2) }} </td>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->license, 2) }} </td>
                                                <td class="text-left">R {{ number_format($income_expense_calculator->repair_maintenance, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="pull-right col-md-4">
                            <table class="table">
                                <tr>
                                    <th class="text-right">Income</th>
                                    <td class="text-right">R {{ number_format($income_expense_calculator->trip_income, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Machine costs</th>
                                    <td class="text-right">R {{ number_format($income_expense_calculator->total_costs, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Other costs</th>
                                    <td class="text-right">R {{ number_format($income_expense_calculator->other_costs, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-right">R {{ number_format($income_expense_calculator->balance, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.income_expense_calculators.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


