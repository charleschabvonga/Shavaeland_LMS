@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.currency.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.currency.fields.name')</th>
                            <td field-key='name'>{{ $currency->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.currency.fields.symbol')</th>
                            <td field-key='symbol'>{{ $currency->symbol }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#quotation" aria-controls="quotation" role="tab" data-toggle="tab">Quotations</a></li>
<li role="presentation" class=""><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
<li role="presentation" class=""><a href="#purchase_orders" aria-controls="purchase_orders" role="tab" data-toggle="tab">Purchase orders</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="quotation">
<table class="table table-bordered table-striped {{ count($quotations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.quotation.fields.client')</th>
                        <th>@lang('global.quotation.fields.contact-person')</th>
                        <th>@lang('global.quotation.fields.sales-person')</th>
                        <th>@lang('global.quotation.fields.quotation-number')</th>
                        <th>@lang('global.quotation.fields.date')</th>
                        <th>@lang('global.quotation.fields.due-date')</th>
                        <th>@lang('global.quotation.fields.status')</th>
                        <th>@lang('global.quotation.fields.subtotal')</th>
                        <th>@lang('global.quotation.fields.vat')</th>
                        <th>@lang('global.quotation.fields.vat-amount')</th>
                        <th>@lang('global.quotation.fields.total-amount')</th>
                        <th>@lang('global.quotation.fields.prepared-by')</th>
                        <th>@lang('global.quotation.fields.currency')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($quotations) > 0)
            @foreach ($quotations as $quotation)
                <tr data-entry-id="{{ $quotation->id }}">
                    <td field-key='client'>{{ $quotation->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $quotation->contact_person->contact_name or '' }}</td>
                                <td field-key='sales_person'>{{ $quotation->sales_person->name or '' }}</td>
                                <td field-key='quotation_number'>{{ $quotation->quotation_number }}</td>
                                <td field-key='date'>{{ $quotation->date }}</td>
                                <td field-key='due_date'>{{ $quotation->due_date }}</td>
                                <td field-key='status'>{{ $quotation->status }}</td>
                                <td field-key='subtotal'>{{ $quotation->subtotal }}</td>
                                <td field-key='vat'>{{ $quotation->vat }}</td>
                                <td field-key='vat_amount'>{{ $quotation->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $quotation->total_amount }}</td>
                                <td field-key='prepared_by'>{{ $quotation->prepared_by }}</td>
                                <td field-key='currency'>{{ $quotation->currency->name or '' }}</td>
                                                                <td>
                                    @can('quotation_view')
                                    <a href="{{ route('admin.quotations.show',[$quotation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('quotation_edit')
                                    <a href="{{ route('admin.quotations.edit',[$quotation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('quotation_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.quotations.destroy', $quotation->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="18">@lang('global.app_no_entries_in_table')</td>
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
<div role="tabpanel" class="tab-pane " id="purchase_orders">
<table class="table table-bordered table-striped {{ count($purchase_orders) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.purchase-orders.fields.vendor')</th>
                        <th>@lang('global.purchase-orders.fields.contact-person')</th>
                        <th>@lang('global.purchase-orders.fields.buyer')</th>
                        <th>@lang('global.purchase-orders.fields.purchase-order-number')</th>
                        <th>@lang('global.purchase-orders.fields.date')</th>
                        <th>@lang('global.purchase-orders.fields.request-date')</th>
                        <th>@lang('global.purchase-orders.fields.procurement-date')</th>
                        <th>@lang('global.purchase-orders.fields.subtotal')</th>
                        <th>@lang('global.purchase-orders.fields.status')</th>
                        <th>@lang('global.purchase-orders.fields.vat')</th>
                        <th>@lang('global.purchase-orders.fields.vat-amount')</th>
                        <th>@lang('global.purchase-orders.fields.total-amount')</th>
                        <th>@lang('global.purchase-orders.fields.prepared-by')</th>
                        <th>@lang('global.purchase-orders.fields.requested-by')</th>
                        <th>@lang('global.purchase-orders.fields.hod')</th>
                        <th>@lang('global.purchase-orders.fields.gm')</th>
                        <th>@lang('global.purchase-orders.fields.accounts')</th>
                        <th>@lang('global.purchase-orders.fields.currency')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($purchase_orders) > 0)
            @foreach ($purchase_orders as $purchase_order)
                <tr data-entry-id="{{ $purchase_order->id }}">
                    <td field-key='vendor'>{{ $purchase_order->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $purchase_order->contact_person->contact_name or '' }}</td>
                                <td field-key='buyer'>{{ $purchase_order->buyer->name or '' }}</td>
                                <td field-key='purchase_order_number'>{{ $purchase_order->purchase_order_number }}</td>
                                <td field-key='date'>{{ $purchase_order->date }}</td>
                                <td field-key='request_date'>{{ $purchase_order->request_date }}</td>
                                <td field-key='procurement_date'>{{ $purchase_order->procurement_date }}</td>
                                <td field-key='subtotal'>{{ $purchase_order->subtotal }}</td>
                                <td field-key='status'>{{ $purchase_order->status }}</td>
                                <td field-key='vat'>{{ $purchase_order->vat }}</td>
                                <td field-key='vat_amount'>{{ $purchase_order->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $purchase_order->total_amount }}</td>
                                <td field-key='prepared_by'>{{ $purchase_order->prepared_by }}</td>
                                <td field-key='requested_by'>{{ $purchase_order->requested_by }}</td>
                                <td field-key='hod'>{{ Form::checkbox("hod", 1, $purchase_order->hod == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='gm'>{{ Form::checkbox("gm", 1, $purchase_order->gm == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='accounts'>{{ Form::checkbox("accounts", 1, $purchase_order->accounts == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='currency'>{{ $purchase_order->currency->name or '' }}</td>
                                                                <td>
                                    @can('purchase_order_view')
                                    <a href="{{ route('admin.purchase_orders.show',[$purchase_order->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('purchase_order_edit')
                                    <a href="{{ route('admin.purchase_orders.edit',[$purchase_order->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('purchase_order_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.purchase_orders.destroy', $purchase_order->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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

            <a href="{{ route('admin.currencies.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


