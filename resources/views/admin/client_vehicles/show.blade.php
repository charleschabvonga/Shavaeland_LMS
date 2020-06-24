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
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">CLIENT VEHICLE SERVICE HISTORY</span></h1>
                                <h4><b>Registration No</b>: <span style="color:red">{{ $client_vehicle->registration_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Service History To</b>: <span style="color:#CE8F64">{{ $client_vehicle->client->name or '' }}</span>
                            @if ($client_vehicle->client->vat != '')
                                <br><b>VAT No</b>: {{ $client_vehicle->client->vat or '' }}
                            @endif
                            @if ($client_vehicle->client->street_address != '')
                                <br><b>Address</b>: {{ $client_vehicle->client->street_address or '' }}
                            @endif
                            @if ($client_vehicle->client->city != '')
                                <br>{{ $client_vehicle->client->city or '' }}
                            @endif
                            @if ($client_vehicle->client->country != '')
                                ,{{ $client_vehicle->client->country or '' }}
                            @endif
                            @if ($client_vehicle->client->zip_code != '')
                                ,{{ $client_vehicle->client->zip_code or '' }}
                            @endif
                            @if ($client_vehicle->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $client_vehicle->client->phone_number_1 or '' }}
                            @endif
                             @if ($client_vehicle->client->fax_number != '')
                                <br><b>Fax</b>: {{ $client_vehicle->client->fax_number or '' }}
                            @endif
                            @if ($client_vehicle->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $client_vehicle->client->email or '' }}</span>
                            @endif
                            @if ($client_vehicle->client->website != '')
                                <br><b>Website</b>: {{ $client_vehicle->client->website or '' }}
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($client_vehicle->vehicle_type != '')
                                <b>Vehicle type</b>: {{ $client_vehicle->vehicle_type }}<br>
                            @endif
                            @if ($client_vehicle->make != '')
                                <b>Make</b>: {{ $client_vehicle->make }}<br>
                            @endif
                            @if ($client_vehicle->model != '')
                                <b>Model</b>: {{ $client_vehicle->model }}<br>
                            @endif
                            @if ($client_vehicle->starting_mileage != '')
                                <b>Starting mileage</b>: {{ $client_vehicle->starting_mileage }}<br>
                            @endif
                            @if ($client_vehicle->status != '')
                                <b>Status</b>: {{ $client_vehicle->status }}<br>
                            @endif  
                            @if ($client_vehicle->next_service_mileage != '')
                                <b>Next service mileage</b>: {{ number_format($client_vehicle->next_service_mileage) }} kms <br>
                            @endif
                            @if ($client_vehicle->next_service_date != '')
                                <b>Next service date</b>: {{ $client_vehicle->next_service_date }}<br>
                            @endif                          
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Service History From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">JOB CARDS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('global.job-cards.fields.job-card-number')</th>
                                            <th>@lang('global.job-cards.fields.job-type')</th>
                                            <th>@lang('global.job-cards.fields.repair-center')</th>
                                            <th>@lang('global.job-cards.fields.remarks')</th>
                                            <th>@lang('global.job-cards.fields.subtotal')</th>
                                            <th>@lang('global.job-cards.fields.status')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($job_cards as $job_card)
                                            <tr id='addr0'>
                                                <td>{{ $job_card->job_card_number }}</td>
                                                <td>{{ $job_card->job_type }}</td>
                                                <td>{{ $job_card->repair_center->center_name or '' }}</td>
                                                <td>{{ $job_card->remarks }}</td>
                                                <td>R {{ number_format($job_card->subtotal, 2) }} </td>
                                                <td>{{ $job_card->status }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>               
                    
                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#job_cards" aria-controls="job_cards" role="tab" data-toggle="tab">Job cards</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    

<div role="tabpanel" class="tab-pane active" id="job_cards">
<table class="table table-bordered table-striped {{ count($job_cards) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th width="20%">@lang('global.job-cards.fields.repair-center')</th>
            <th>@lang('global.job-cards.fields.job-card-number')</th>
            <th>@lang('global.job-cards.fields.job-type')</th>
            <th>@lang('global.job-cards.fields.client-vehicle-reg-no')</th>
            <th class="text-center">@lang('global.job-cards.fields.status')</th>
            @if( request('show_deleted') == 1 )
            <th>&nbsp;</th>
            @else
            <th>&nbsp;</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @if (count($job_cards) > 0)
            @foreach ($job_cards as $job_card)
                <tr data-entry-id="{{ $job_card->id }}">
                    <td field-key='repair_center'>{{ $job_card->repair_center->center_name or '' }}</td>
                    <td field-key='job_card_number'>{{ $job_card->job_card_number }}</td>
                    <td field-key='job_type'>{{ $job_card->job_type }}</td>
                    <td field-key='client_vehicle_reg_no'>{{ $job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                    @if($job_card->status == 'Job Ongoing')
                    <td class="label-md label-warning text-center" field-key='status'>{{ $job_card->status }}</td>
                    @endif
                    @if($job_card->status == 'Job Complete')
                    <td class="label-md label-success text-center" field-key='status'>{{ $job_card->status }}</td>
                    @endif
                    @if( request('show_deleted') == 1 )
                    <td>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.job_cards.restore', $job_card->id])) !!}
                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                        {!! Form::close() !!}
                                                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.job_cards.perma_del', $job_card->id])) !!}
                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                                                    </td>
                    @else
                    <td>
                        @can('job_card_view')
                        <a href="{{ route('admin.job_cards.show',[$job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('job_card_edit')
                        <!--a href="{{ route('admin.job_cards.edit',[$job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                        @endcan
                        @can('job_card_delete')
                        <!--{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.job_cards.destroy', $job_card->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
                        @endcan
                        <a href="{{ route('admin.job_cards.download',$job_card->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="23">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_vehicles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


