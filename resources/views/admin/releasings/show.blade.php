@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <p class='pull-right'>
                        <a href="{{ route('admin.releasings.download',$releasing->id) }}" class="btn btn btn-warning">View Collection Note in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">COLLECTION NOTE</span></h1>
                                <h4><b>Goods Collection No</b>: <span style="color:red">{{ $releasing->release_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Collection Note To</b>: <span style="color:#CE8F64">{{ $releasing->client->name or '' }}</span>
                            @if ($releasing->client->vat != '')
                                <br><b>VAT No</b>: {{ $releasing->client->vat or '' }}
                            @endif
                            @if ($releasing->client->street_address != '')
                                <br><b>Address</b>: {{ $releasing->client->street_address or '' }}
                            @endif
                            @if ($releasing->client->city != '')
                                <br>{{ $releasing->client->city or '' }}
                            @endif
                            @if ($releasing->client->country != '')
                                , {{ $releasing->client->country or '' }}
                            @endif
                            @if ($releasing->client->zip_code != '')
                                ,{{ $releasing->client->zip_code or '' }}
                            @endif
                            @if ($releasing->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $releasing->client->phone_number_1 or '' }}
                            @endif
                             @if ($releasing->client->fax_number != '')
                                <br><b>Fax</b>: {{ $releasing->client->fax_number or '' }}
                            @endif
                            @if ($releasing->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $releasing->client->email or '' }}</span>
                            @endif
                            @if ($releasing->client->website != '')
                                <br><b>Website</b>: {{ $releasing->client->website or '' }}
                            @endif
                            @if ($releasing->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $releasing->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($releasing->contact_person != '' && $releasing->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $releasing->contact_person->phone_number or '' }}
                            @endif
                            @if ($releasing->contact_person != '' && $releasing->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $releasing->contact_person->email or '' }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Date</b>: {{ $releasing->date }}<br>
                            @if ($releasing->project_number != '')
                                <b>Project No</b>: {{ $releasing->project_number->operation_number or '' }}<br>
                            @endif
                            @if ($releasing->warehouse != '')
                                <b>Warehouse</b>: {{ $releasing->warehouse->center_name or '' }}<br>
                            @endif
                            @if ($releasing->released_by != '')
                                <b>Released by</b>: {{ $releasing->released_by->name or '' }}<br>
                            @endif
                            @if ($releasing->released_by != '' && $releasing->released_by->phone_number != '')
                                <b>Tel</b>: {{ $releasing->released_by->phone_number or '' }}<br>
                            @endif
                            @if ($releasing->released_by != '' && $releasing->released_by->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $releasing->released_by->email or '' }}</span><br>
                            @endif
                            @if ($releasing->prepared_by != '')
                                <br><b>Processed by</b>: <span style="color:#CE8F64">{{ $releasing->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Collection Note From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($releasing->project_manager != '')
                                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $releasing->project_manager->name or '' }}</span>
                            @endif<br>
                            @if ($releasing->project_manager != '')
                                <b>Tel</b>: {{ $releasing->project_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($releasing->project_manager != '')
                                <b>Email</b>: <span style="color:blue">{{ $releasing->project_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>


                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">WAREHOUSE COLLECTED GOODS</span></legend>
                                        <thead>
                                        <tr>
                                            <th width="5%" class="text-center">@lang('#')</th>
                                            <th>@lang('global.received-items.fields.item')</th>
                                            <th width="15%" class="text-center">@lang('global.received-items.fields.qty')</th>
                                            <th width="15%" class="text-center">@lang('global.received-items.fields.area')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($releasing->received_items as $item)
                                            <tr id='addr0'>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $item->item }}</td>
                                                <td class="text-center">{{ $item->qty }}</td>
                                                <td class="text-center">{{ number_format($item->area, 2) }} m<sup>2</sup> </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="pull-right col-md-4">
                                            <table class="table">
                                                <tr>
                                                    <th class="text-right" width="51%">Total Area Covered</th>
                                                    <td class="text-center"> {{ number_format($releasing->area_coverd, 2) }} m<sup>2</sup> </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.releasings.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
