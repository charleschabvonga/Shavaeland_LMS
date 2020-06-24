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
                                <img src="{{ config('invoices.logo_file') }}" />
                                @if($parts_acquired->transaction_type == 'Procurement')
                                <h1><span style="color:#CE8F64">PART/ACCESSORY PROCUREMENT</span></h1>
                                @endif
                                @if($parts_acquired->transaction_type == 'Request')
                                <h1><span style="color:#CE8F64">PART/ACCESSORY REQUEST</span></h1>
                                @endif                                
                                <h4><b>Order No</b>: <span style="color:red">{{ $parts_acquired->order_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if($parts_acquired->transaction_type == 'Procurement')
                            <b>Procurement date</b>: {{ $parts_acquired->date }} <br>
                            @endif
                            @if($parts_acquired->transaction_type == 'Request')
                            <b>Request date</b>: {{ $parts_acquired->date }} <br>
                            @endif 
                            <b>Center name</b>: {{ $parts_acquired->repair_center->center_name or '' }} <br>
                            <b>Received by</b>: {{ $parts_acquired->received_by->name or '' }} <br>
                            @if($parts_acquired->dispatched_by != '')
                            <b>Dispatched by</b>: {{ $parts_acquired->dispatched_by->name or '' }} <br>
                            @endif
                            <b>Processed by</b>: {{ $parts_acquired->prepared_by }} <br>
                        </div>

                        <div class="col-xs-4 form-group text-right"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PART/ACCESSORY ITEM</span></legend>
                                        <thead>
                                            <tr>
                                                <th >@lang('global.parts-acquired.fields.part')</th>
                                                <th width="15%" class="text-center">@lang('global.parts-acquired.fields.qty')</th>
                                                <th width="15%">@lang('global.parts-acquired.fields.unit')</th>
                                                <th width="15%">@lang('global.parts-acquired.fields.unit-price')</th>
                                                <th width="15%">@lang('global.parts-acquired.fields.total')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-left">{{ $parts_acquired->part->part or '' }}</td>
                                                <td class="text-center">{{ $parts_acquired->qty }}</td>
                                                <td class="text-left">{{ $parts_acquired->unit->measurement_type or '' }}</td>
                                                <td class="text-left">R {{ number_format($parts_acquired->unit_price, 2) }}</td>
                                                <td class="text-left">R {{ number_format($parts_acquired->total, 2) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
            <a href="{{ route('admin.parts_acquireds.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
