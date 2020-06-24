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
                                <h1><span style="color:#CE8F64">HORSE</span></h1>
                                <h4><b>Horse Reg No.</b>: <span style="color:red">{{ $light_vehicle->vehicle_description }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if ($light_vehicle->service_status != '')
                                <b>Service status</b>: {{ $light_vehicle->service_status }}<br>
                            @endif
                            @if ($light_vehicle->starting_mileage != '')
                                <b>Starting mileage</b>: {{ number_format($light_vehicle->starting_mileage) }} kms<br>
                            @endif
                            @if ($light_vehicle->starting_mileage != '')
                                <b>Current mileage</b>: {{ number_format($light_vehicle->mileage) }} kms<br>
                            @endif
                            @if ($light_vehicle->next_service_mileage != '')
                                <b>Next service mileage</b>: {{ number_format($light_vehicle->next_service_mileage) }} kms<br>
                            @endif
                            @if ($light_vehicle->next_service_date != '')
                                <b>Next service date</b>: {{ $light_vehicle->next_service_date }}<br>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($light_vehicle->make != '')
                                <b>Make</b>: {{ $light_vehicle->make }}<br>
                            @endif
                            @if ($light_vehicle->model != '')
                                <b>Model</b>: {{ $light_vehicle->model }}<br>
                            @endif
                            @if ($light_vehicle->chasis_number != '')
                                <b>Chasis No</b>: {{ $light_vehicle->chasis_number }}<br>
                            @endif
                            @if ($light_vehicle->engine_number != '')
                                <b>Engine No</b>: {{ $light_vehicle->engine_number }}<br>
                            @endif
                            @if ($light_vehicle->size != '' && $light_vehicle->size->size != '')
                                <b>Size</b>: {{ $light_vehicle->size->size or '' }}<br>
                            @endif
                            @if ($light_vehicle->availability != '')
                                <b>Availability</b>: {{ $light_vehicle->availability }}<br>
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            @if ($light_vehicle->purchase_date != '')
                                <b>Purchase date</b>: {{ $light_vehicle->purchase_date }}<br>
                            @endif
                            @if ($light_vehicle->purchase_price != '')
                                <b>Purchase price</b>: R {{ number_format($light_vehicle->purchase_price, 2) }}<br>
                            @endif
                            @if ($light_vehicle->salvage_value != '')
                                <b>Salvage value</b>: R {{ number_format($light_vehicle->salvage_value, 2) }}<br>
                            @endif
                            <!--@if ($light_vehicle->investment != '')
                                <br><b>Investment</b>: R {{ number_format($light_vehicle->investment, 2) }}
                                <br><b>Investment realised</b>: <span style="color:green"> R {{ number_format($light_vehicle->net_income, 2) }}</span>
                            @endif-->
                            @if ($light_vehicle->depreciation > 0)
                                <b>Depreciation</b>: <span style="color:red"> R {{ number_format($light_vehicle->depreciation, 2) }}</span><br>
                            @endif
                            @if ($light_vehicle->maintenance > 0)
                                <b>Maintenance bank</b>: R {{ number_format($light_vehicle->maintenance, 2) }}<br>
                            @endif
                            @if ($light_vehicle->tyre > 0)
                                <b>Tyre bank</b>: R {{ number_format($light_vehicle->tyre, 2) }}<br>
                            @endif
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.light_vehicles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
