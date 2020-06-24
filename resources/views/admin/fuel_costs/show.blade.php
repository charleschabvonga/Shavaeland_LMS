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
                                <h1><span style="color:#CE8F64">FUEL PURCHASE</span></h1>
                                <h4><b>Receipt No</b>: <span style="color:red">{{ $fuel_cost->receipt_number }}</span></h4>                               
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($fuel_cost->vehicle != '')
                                <b>Horse reg No.</b>: {{ $fuel_cost->vehicle->vehicle_description or '' }}<br>
                            @endif
                        </div>
                        <div class="col-xs-4 text-right"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">ROAD FREIGHT FUEL PURCHASE</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Road freight No')</th>
                                            <th>@lang('Description')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Cost')</th>
                                            <th>@lang('Total')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left"> {{ $fuel_cost->road_freight_number->road_freight_number or ''}} </td>
                                                <td class="text-left"> {{ $fuel_cost->description }} </td>
                                                <td class="text-left"> {{ number_format($fuel_cost->qty, 2) }} ltrs</td>
                                                <td class="text-left">R {{ number_format($fuel_cost->cost, 2) }} </td>
                                                <td class="text-left">R {{ number_format($fuel_cost->total, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.fuel_costs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


