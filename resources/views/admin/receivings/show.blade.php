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
                        <a href="{{ route('admin.receivings.download',$receiving->id) }}" class="btn btn btn-warning">View Receipt Note in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">RECEIPT NOTE</span></h1>
                                <h4><b>Goods Receipt No</b>: <span style="color:red">{{ $receiving->receipt_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Goods Receipt To</b>: <span style="color:#CE8F64">{{ $receiving->client->name or '' }}</span>
                            @if ($receiving->client->vat != '')
                                <br><b>VAT No</b>: {{ $receiving->client->vat or '' }}
                            @endif
                            @if ($receiving->client->street_address != '')
                                <br><b>Address</b>: {{ $receiving->client->street_address or '' }}
                            @endif
                            @if ($receiving->client->city != '')
                                <br>{{ $receiving->client->city or '' }}
                            @endif
                            @if ($receiving->client->country != '')
                                , {{ $receiving->client->country or '' }}
                            @endif
                            @if ($receiving->client->zip_code != '')
                                ,{{ $receiving->client->zip_code or '' }}
                            @endif
                            @if ($receiving->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $receiving->client->phone_number_1 or '' }}
                            @endif
                             @if ($receiving->client->fax_number != '')
                                <br><b>Fax</b>: {{ $receiving->client->fax_number or '' }}
                            @endif
                            @if ($receiving->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $receiving->client->email or '' }}</span>
                            @endif
                            @if ($receiving->client->website != '')
                                <br><b>Website</b>: {{ $receiving->client->website or '' }}
                            @endif
                            @if ($receiving->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $receiving->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($receiving->contact_person != '' && $receiving->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $receiving->contact_person->phone_number or '' }}
                            @endif
                            @if ($receiving->contact_person != '' && $receiving->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $receiving->contact_person->email or '' }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Date</b>: {{ $receiving->date }}<br>
                            @if ($receiving->project_number != '')
                                <b>Project No</b>: {{ $receiving->project_number->operation_number or '' }}<br>
                            @endif
                            @if ($receiving->warehouse != '')
                                <b>Warehouse</b>: {{ $receiving->warehouse->center_name or '' }}<br>
                            @endif
                            @if ($receiving->received_by != '')
                                <b>Received by</b>: {{ $receiving->received_by->name or '' }}<br>
                            @endif
                            @if ($receiving->received_by != '' && $receiving->received_by->phone_number != '')
                                <b>Tel</b>: {{ $receiving->received_by->phone_number or '' }}<br>
                            @endif
                            @if ($receiving->received_by != '' && $receiving->received_by->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $receiving->received_by->email or '' }}</span><br>
                            @endif
                            @if ($receiving->prepared_by != '')
                                <br><b>Processed by</b>: <span style="color:#CE8F64">{{ $receiving->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Goods Receipt From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($receiving->project_manager != '')
                                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $receiving->project_manager->name or '' }}</span>
                            @endif<br>
                            @if ($receiving->project_manager != '')
                                <b>Tel</b>: {{ $receiving->project_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($receiving->project_manager != '')
                                <b>Email</b>: <span style="color:blue">{{ $receiving->project_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">WAREHOUSE RECEIVED GOODS</span></legend>
                                        <thead>
                                        <tr>
                                            <th class="text-center" width="25%">@lang('global.receiving.fields.rate')</th>
                                            <th class="text-center" width="25%">@lang('global.receiving.fields.number-of-days')</th>
                                            <th class="text-center" width="25%">@lang('global.receiving.fields.total-area-coverd')</th>
                                            <th class="text-center" width="25%">@lang('global.receiving.fields.total-amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr id='addr0'>
                                                <td class="text-center">R {{ number_format($receiving->rate, 2) }}</td>
                                                <td class="text-center">{{ $receiving->days }} days</td>
                                                <td class="text-center">{{ number_format($receiving->total_area_coverd, 2) }} m<sup>2</sup></td>
                                                <td class="text-center">R {{ number_format($receiving->total_amount, 2) }} </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">WAREHOUSE RECEIVED GOODS</span></legend>
                                        <thead>
                                        <tr>
                                            <th width="5%" class="text-center">@lang('#')</th>
                                            <th>@lang('global.received-items.fields.item')</th>
                                            <th width="25%" class="text-center">@lang('global.received-items.fields.qty')</th>
                                            <th width="25%" class="text-center">@lang('global.received-items.fields.area')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($receiving->received_items as $item)
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
                                                    <td class="text-center"> {{ number_format($receiving->total_area_coverd, 2) }} m<sup>2</sup> </td>
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

            <a href="{{ route('admin.receivings.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


