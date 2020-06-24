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
                                <h1><span style="color:#CE8F64">MACHINERY COST</span></h1>
                                <h4><b>Vehicle Reg</b>: <span style="color:red"> {{ $machinery_cost->vehicle_description->vehicle_description or '' }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-3 ">
                            @if ($machinery_cost->road_freight_number != '')
                                <b>Road freight No</b>: {{ $machinery_cost->road_freight_number->road_freight_number or '' }}
                            @endif
                            @if ($machinery_cost->route != '')
                                <br><b>Route</b>: {{ $machinery_cost->route->route or '' }}
                            @endif
                             @if ($machinery_cost->distance != '')
                                <br><b>Distance</b>: {{ $machinery_cost->distance }} kms
                            @endif
                            @if ($machinery_cost->return_load_status != '')
                                <br><b>Load status</b>: {{ $machinery_cost->return_load_status }}
                            @endif
                        </div>
                        
                        <div class="col-xs-6 form-group text-center">
                            @if ($machinery_cost->truck_attachment_status != '')
                                <b>Truck attachment status</b>: {{ $machinery_cost->truck_attachment_status->attachment or '' }}
                            @endif
                            @if ($machinery_cost->attachment_type != '')
                                <br><b>Machinery attachment type</b>: {{ $machinery_cost->attachment_type }}
                            @endif
                             @if ($machinery_cost->size != '')
                                <br><b>Size</b>: {{ $machinery_cost->size->size or '' }}
                            @endif
                        </div>

                        <div class="col-xs-3 form-group text-right">
                            @if ($machinery_cost->purchase_price != '')
                                <b>Purchase price</b>: R {{ number_format($machinery_cost->purchase_price, 2) }}
                            @endif
                            @if ($machinery_cost->salvage_value != '')
                                <br><b>Salvage value</b>: R {{ number_format($machinery_cost->salvage_value, 2) }}
                            @endif
                            @if ($machinery_cost->avg_investment != '')
                                <br><b>Investment</b>: R {{ number_format($machinery_cost->avg_investment, 2) }}
                            @endif
                        </div>
                    </div><br>

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
                                                <td class="text-left">R {{ number_format($machinery_cost->fuel_price, 2) }} /ltr</td>
                                                <td class="text-left"> {{ number_format($machinery_cost->fuel_usage, 2) }} ltrs/100kms</td>
                                                <td class="text-left"> {{ number_format($machinery_cost->fuel_consumption, 2) }} ltrs</td>
                                                <td class="text-left">R {{ number_format($machinery_cost->fuel, 2) }}</td>
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
                                                <td class="text-left">R {{ number_format($machinery_cost->oil_price, 2) }} /ltr</td>
                                                <td class="text-left"> {{ number_format($machinery_cost->oil_usage, 2) }} ltrs/100kms</td>
                                                <td class="text-left"> {{ number_format($machinery_cost->oil_consumption, 2) }} ltrs</td>
                                                <td class="text-left">R {{ number_format($machinery_cost->oil, 2) }}</td>
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
                                            <th>@lang('Depreciation')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">R {{ number_format($machinery_cost->tyre_price, 2) }} /tyre</td>
                                                <td class="text-left"> {{ $machinery_cost->number_of_tyres }} </td>
                                                <td class="text-left">R {{ number_format($machinery_cost->tyre, 2) }}</td>
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
                                                <td class="text-left">R {{ number_format($machinery_cost->insurance, 2) }} </td>
                                                <td class="text-left">R {{ number_format($machinery_cost->license, 2) }} </td>
                                                <td class="text-left">R {{ number_format($machinery_cost->repair_maintenance, 2) }}</td>
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
                                    <th class="text-right">Total costs excl fuel</th>
                                    <td class="text-right">{{ number_format($machinery_cost->total_costs, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

            </div>
        </div><!-- Nav tabs -->
            <p>&nbsp;</p>

            <a href="{{ route('admin.machinery_costs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


