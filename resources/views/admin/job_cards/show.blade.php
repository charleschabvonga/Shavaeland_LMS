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
                        <a href="{{ route('admin.job_cards.download',$job_card->id) }}" class="btn btn btn-warning">View Job Card in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">JOB CARD</span></h1>
                                <h4><b>Job Card No</b>: <span style="color:red">{{ $job_card->job_card_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Job Card To</b>: <span style="color:#CE8F64">{{ $job_card->client->name or '' }}</span>
                            @if ($job_card->client->vat != '')
                                <br><b>VAT No</b>: {{ $job_card->client->vat or '' }}
                            @endif
                            @if ($job_card->client->street_address != '')
                                <br><b>Address</b>: {{ $job_card->client->street_address or '' }}
                            @endif
                            @if ($job_card->client->city != '')
                                <br>{{ $job_card->client->city or '' }}
                            @endif
                            @if ($job_card->client->country != '')
                                ,{{ $job_card->client->country or '' }}
                            @endif
                            @if ($job_card->client->zip_code != '')
                                ,{{ $job_card->client->zip_code or '' }}
                            @endif
                            @if ($job_card->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $job_card->client->phone_number_1 or '' }}
                            @endif
                             @if ($job_card->client->fax_number != '')
                                <br><b>Fax</b>: {{ $job_card->client->fax_number or '' }}
                            @endif
                            @if ($job_card->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $job_card->client->email or '' }}</span>
                            @endif
                            @if ($job_card->client->website != '')
                                <br><b>Website</b>: {{ $job_card->client->website or '' }}
                            @endif
                            @if ($job_card->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $job_card->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($job_card->contact_person != '' && $job_card->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $job_card->contact_person->phone_number or '' }}
                            @endif
                            @if ($job_card->contact_person != '' && $job_card->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $job_card->contact_person->email or '' }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center"> 
                            @if ( $job_card->project_number != '')
                                <b>Project No</b>: {{ $job_card->project_number->operation_number or '' }}<br>
                            @endif
                            @if ( $job_card->date != '')
                                <b>Date</b>: {{ $job_card->date }}<br>
                            @endif
                            @if ( $job_card->job_type != '')
                                <b>Job type</b>: {{ $job_card->job_type }}<br>
                            @endif                           
                            @if ( $job_card->road_freight_number != '')
                                <b>Road freight No</b>: {{ $job_card->road_freight_number->road_freight_number or '' }}<br>
                            @endif
                            @if ( $job_card->vehicle_type != '')
                                <b>Vehicle type</b>: {{ $job_card->vehicle_type }}<br>
                            @endif
                            @if ( $job_card->client_vehicle_reg_no != '')
                                <b>Vehicle reg No.</b>: {{ $job_card->client_vehicle_reg_no->registration_number or '' }}<br>
                            @endif
                            @if ( $job_card->vehicle != '')
                                <b>Vehicle reg No.</b>: {{ $job_card->vehicle->vehicle_description or '' }}<br>
                            @endif
                            <b>Status</b>: {{ $job_card->status }}<br>
                            @if ( $job_card->vehicle != '')
                                <b>Technician(s)</b>: @foreach ($job_card->technician as $singleTechnician)
                                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                                        @endforeach<br>
                            @endif
                            @if ($job_card->prepared_by != '')
                                <br><b>Processed by</b>: <span style="color:#CE8F64">{{ $job_card->prepared_by }}</span>
                            @endif
                            
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Job Card From</b>: <span style="color:#CE8F64">{{ $job_card->repair_center->center_name or '' }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($job_card->workshop_manager != '')
                                <b>Workshop Manager</b>: <span style="color:#CE8F64">{{ $job_card->workshop_manager->name or '' }}</span>
                            @endif<br>
                            @if ($job_card->workshop_manager != '' && $job_card->workshop_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $job_card->workshop_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($job_card->workshop_manager != '' && $job_card->workshop_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $job_card->workshop_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                    <legend class="text-center"><span style="color:#CE8F64">JOB CARD INSTRUCTIONS</span></legend> 
                                        <div class="col-xs-12 form-group">
                                            {{ $job_card->remarks }}
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                    <legend class="text-center"><span style="color:#CE8F64">JOB CARD REMARKS</span></legend>
                                        <div class="col-xs-12 form-group">
                                            {{ $job_card->instructions }}
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped " id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Job Card Items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">@lang('#')</th>
                            <th>@lang('global.job-card-items.fields.part')</th>
                            <th width="13%" class="text-center">@lang('global.job-card-items.fields.qty')</th>
                            <th class="text-center" width="13%">@lang('global.job-card-items.fields.price')</th>
                            <th class="text-center" width="13%">@lang('global.job-card-items.fields.total')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($job_card->job_card_items as $item)
                            <tr id='addr0'>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $item->part }}</td>
                                <td class="text-center">{{ $item->qty }}</td>
                                <td class="text-center">R {{ number_format($item->price, 2) }}</td>
                                <td class="text-center">R {{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="pull-right col-md-3">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="45%">Sub Total</th>
                                    <td class="text-center">R {{ number_format($job_card->subtotal, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue workshops are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <a href="{{ route('admin.job_cards.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>

@stop


