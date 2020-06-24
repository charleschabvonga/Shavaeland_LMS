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
                        <a href="{{ route('admin.workshops.download',$workshop->id) }}" class="btn btn btn-warning">View Workshop Inventories in PDF</a>
                    </p>

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">WORKSHOP CENTER INVENTORIES</span></h1>
                                <h4><b>Workshop Center</b>: <span style="color:red">{{ $workshop->vendor->name or '' }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Center Name</b>: <span style="color:#CE8F64">{{ $workshop->center_name  }}</span>
                            @if ($workshop->vendor->vat != '')
                                <br><b>VAT No</b>: {{ $workshop->vendor->vat or '' }}
                            @endif
                            @if ($workshop->vendor->street_address != '')
                                <br><b>Address</b>: {{ $workshop->vendor->street_address or '' }}
                            @endif
                            @if ($workshop->vendor->city != '')
                                <br>{{ $workshop->vendor->city or '' }}
                            @endif
                            @if ($workshop->vendor->country != '')
                                ,{{ $workshop->vendor->country or '' }}
                            @endif
                            @if ($workshop->vendor->zip_code != '')
                                ,{{ $workshop->vendor->zip_code or '' }}
                            @endif
                            @if ($workshop->vendor->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $workshop->vendor->phone_number_1 or '' }}
                            @endif
                            @if ($workshop->vendor->fax_number != '')
                                <br><b>Fax</b>: {{ $workshop->vendor->fax_number or '' }}
                            @endif
                            @if ($workshop->vendor->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $workshop->vendor->email or '' }}</span>
                            @endif
                            @if ($workshop->vendor->website != '')
                                <br><b>Website</b>: {{ $workshop->vendor->website or '' }}
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center"></div>

                        <div class="col-xs-4 form-group text-right">
                            <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">WORKSHOP INVENTORIES</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Part Description')</th>
                                            <th>@lang('Qty')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($workshop->inventories) > 0)
                                                @foreach ($workshop->inventories as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->part }}</td>
                                                        <td class="text-left">{{ $item->qty }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
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
                                        <legend class="text-center"><span style="color:#CE8F64">WORKSHOP PROCUREMENTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Part Description')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Unit Price')</th>
                                            <th>@lang('Total')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($workshop->purchases) > 0)
                                                @foreach ($workshop->purchases as $item)
                                                    @if ($item->transaction_type === 'Procurement')
                                                        <tr>
                                                            <td class="text-left">{{ $item->date }}</td>
                                                            <td class="text-left">{{ $item->part->part }}</td>
                                                            <td class="text-left">{{ $item->qty }}</td>
                                                            <td class="text-left">R {{ number_format($item->unit_price, 2) }}</td>
                                                            <td class="text-left">R {{ number_format($item->total, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTALS:</th>
                                                <th>R {{ number_format($workshop->total_procurements, 2) }}</th>
                                            </tr>
                                        </tfoot>
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
                                        <legend class="text-center"><span style="color:#CE8F64">WORKSHOP REQUESTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Part Description')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Unit Price')</th>
                                            <th>@lang('Total')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($workshop->purchases) > 0)
                                                @foreach ($workshop->purchases as $item)
                                                    @if ($item->transaction_type === 'Request')
                                                        <tr>
                                                            <td class="text-left">{{ $item->date }}</td>
                                                            <td class="text-left">{{ $item->part->part }}</td>
                                                            <td class="text-left">{{ $item->qty }}</td>
                                                            <td class="text-left">R {{ number_format($item->unit_price, 2) }}</td>
                                                            <td class="text-left">R {{ number_format($item->total, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTALS:</th>
                                                <th>R {{ number_format($workshop->total_requests, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#parts" aria-controls="parts" role="tab" data-toggle="tab">Stores</a></li>
    <li role="presentation" class=""><a href="#parts_acquired" aria-controls="parts_acquired" role="tab" data-toggle="tab">Procurements & requests</a></li>
    <li role="presentation" class=""><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#inhouse_job_cards" aria-controls="inhouse_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="parts">
    <table class="table table-bordered table-striped {{ count($parts) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.parts.fields.repair-center')</th>
                            <th>@lang('global.parts.fields.part')</th>
                            <th>@lang('global.parts.fields.qty')</th>
                            <th>@lang('global.parts.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($parts) > 0)
                @foreach ($parts as $part)
                    <tr data-entry-id="{{ $part->id }}">
                        <td field-key='repair_center'>{{ $part->repair_center->center_name or '' }}</td>
                                    <td field-key='part'>{{ $part->part }}</td>
                                    <td field-key='qty'>{{ $part->qty }}</td>
                                    <td field-key='status'>{{ $part->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts.restore', $part->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts.perma_del', $part->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('part_view')
                                        <a href="{{ route('admin.parts.show',[$part->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('part_edit')
                                        <a href="{{ route('admin.parts.edit',[$part->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('part_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts.destroy', $part->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="parts_acquired">
    <table class="table table-bordered table-striped {{ count($parts_acquireds) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.parts-acquired.fields.order-number')</th>
                            <th>@lang('global.parts-acquired.fields.prepared-by')</th>
                            <th>@lang('global.parts-acquired.fields.date')</th>
                            <th>@lang('global.parts-acquired.fields.transaction-type')</th>
                            <th>@lang('global.parts-acquired.fields.repair-center')</th>
                            <th>@lang('global.parts-acquired.fields.received-by')</th>
                            <th>@lang('global.parts-acquired.fields.dispatched-by')</th>
                            <th>@lang('global.parts-acquired.fields.part')</th>
                            <th>@lang('global.parts-acquired.fields.qty')</th>
                            <th>@lang('global.parts-acquired.fields.unit-price')</th>
                            <th>@lang('global.parts-acquired.fields.total')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($parts_acquireds) > 0)
                @foreach ($parts_acquireds as $parts_acquired)
                    <tr data-entry-id="{{ $parts_acquired->id }}">
                        <td field-key='order_number'>{{ $parts_acquired->order_number }}</td>
                                    <td field-key='prepared_by'>{{ $parts_acquired->prepared_by }}</td>
                                    <td field-key='date'>{{ $parts_acquired->date }}</td>
                                    <td field-key='transaction_type'>{{ $parts_acquired->transaction_type }}</td>
                                    <td field-key='repair_center'>{{ $parts_acquired->repair_center->center_name or '' }}</td>
                                    <td field-key='received_by'>{{ $parts_acquired->received_by->name or '' }}</td>
                                    <td field-key='dispatched_by'>{{ $parts_acquired->dispatched_by->name or '' }}</td>
                                    <td field-key='part'>{{ $parts_acquired->part->part or '' }}</td>
                                    <td field-key='qty'>{{ $parts_acquired->qty }}</td>
                                    <td field-key='unit_price'>{{ $parts_acquired->unit_price }}</td>
                                    <td field-key='total'>{{ $parts_acquired->total }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.restore', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.perma_del', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('parts_acquired_view')
                                        <a href="{{ route('admin.parts_acquireds.show',[$parts_acquired->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('parts_acquired_edit')
                                        <a href="{{ route('admin.parts_acquireds.edit',[$parts_acquired->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('parts_acquired_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.parts_acquireds.destroy', $parts_acquired->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="client_job_cards">
    <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <th>@lang('global.client-job-cards.fields.currency')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($client_job_cards) > 0)
                @foreach ($client_job_cards as $client_job_card)
                    <tr data-entry-id="{{ $client_job_card->id }}">
                        <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                                    <td field-key='date'>{{ $client_job_card->date }}</td>
                                    <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                                    <td field-key='status'>{{ $client_job_card->status }}</td>
                                    <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($client_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                    <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                                    <td field-key='currency'>{{ $client_job_card->currency->name or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.restore', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.perma_del', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('client_job_card_view')
                                        <a href="{{ route('admin.client_job_cards.show',[$client_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('client_job_card_edit')
                                        <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="inhouse_job_cards">
    <table class="table table-bordered table-striped {{ count($inhouse_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.inhouse-job-cards.fields.date')</th>
                            <th>@lang('global.inhouse-job-cards.fields.vehicle-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.mileage')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.inhouse-job-cards.fields.project-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.client-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-card-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.job-type')</th>
                            <th>@lang('global.inhouse-job-cards.fields.repair-center')</th>
                            <th>@lang('global.inhouse-job-cards.fields.technician')</th>
                            <th>@lang('global.inhouse-job-cards.fields.vehicle')</th>
                            <th>@lang('global.inhouse-job-cards.fields.trailer')</th>
                            <th>@lang('global.inhouse-job-cards.fields.light-vehicles')</th>
                            <th>@lang('global.inhouse-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.inhouse-job-cards.fields.road-freight-number')</th>
                            <th>@lang('global.inhouse-job-cards.fields.remarks')</th>
                            <th>@lang('global.inhouse-job-cards.fields.instructions')</th>
                            <th>@lang('global.inhouse-job-cards.fields.subtotal')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($inhouse_job_cards) > 0)
                @foreach ($inhouse_job_cards as $inhouse_job_card)
                    <tr data-entry-id="{{ $inhouse_job_card->id }}">
                        <td field-key='date'>{{ $inhouse_job_card->date }}</td>
                                    <td field-key='vehicle_type'>{{ $inhouse_job_card->vehicle_type }}</td>
                                    <td field-key='mileage'>{{ $inhouse_job_card->mileage }}</td>
                                    <td field-key='job_card_number'>{{ $inhouse_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $inhouse_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $inhouse_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client_type'>{{ $inhouse_job_card->client_type }}</td>
                                    <td field-key='job_card_type'>{{ $inhouse_job_card->job_card_type }}</td>
                                    <td field-key='job_type'>{{ $inhouse_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $inhouse_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($inhouse_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vehicle'>{{ $inhouse_job_card->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailer'>{{ $inhouse_job_card->trailer->trailer_description or '' }}</td>
                                    <td field-key='light_vehicles'>{{ $inhouse_job_card->light_vehicles->vehicle_description or '' }}</td>
                                    <td field-key='client_vehicle_reg_no'>{{ $inhouse_job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $inhouse_job_card->road_freight_number->road_freight_number or '' }}</td>
                                    <td field-key='remarks'>{!! $inhouse_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $inhouse_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $inhouse_job_card->subtotal }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.restore', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.perma_del', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('inhouse_job_card_view')
                                        <a href="{{ route('admin.inhouse_job_cards.show',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('inhouse_job_card_edit')
                                        <a href="{{ route('admin.inhouse_job_cards.edit',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('inhouse_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.inhouse_job_cards.destroy', $inhouse_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="24">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
    
                <p>&nbsp;</p>
    
                <a href="{{ route('admin.workshops.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
            </div>
        </div>
    @stop
    
    
    