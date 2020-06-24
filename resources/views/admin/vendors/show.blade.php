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
                                <h1><span style="color:#CE8F64">VENDOR</span></h1>
                                @if ($vendor->vendor_type == 'Supplier')
                                <h4><b>Supplier</b>: <span style="color:#CE8F64">{{ $vendor->name }}</span></h4>
                                @endif
                                @if ($vendor->vendor_type == 'Department')
                                <h4><b>Department</b>: <span style="color:#CE8F64">{{ $vendor->name }}</span></h4>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if ($vendor->street_address != '')
                                <br><b>Address</b>: {{ $vendor->street_address or '' }}
                            @endif
                            @if ($vendor->city != '')
                                <br>{{ $vendor->city or '' }}
                            @endif
                             @if ($vendor->province != '')
                                , {{ $vendor->province or '' }}
                            @endif
                            @if ($vendor->country != '')
                                , {{ $vendor->country or '' }}
                            @endif
                            @if ($vendor->postal_code != '')
                                , {{ $vendor->postal_code }}
                            @endif
                            @if ($vendor->phone_number_1 != '')
                                <br><b>Tel 1</b>: {{ $vendor->phone_number_1 or '' }}
                            @endif
                            @if ($vendor->phone_number_2 != '')
                                <br><b>Tel 2</b>: {{ $vendor->phone_number_2 or '' }}
                            @endif
                            @if ($vendor->fax_number != '')
                                <br><b>Fax</b>: {{ $vendor->fax_number }}
                            @endif
                            @if ($vendor->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $vendor->email }}</span>
                            @endif
                            @if ($vendor->website != '')
                                <br><b>Website</b>: {{ $vendor->website }}
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">                           
                            @if ($vendor->vat != '')
                                <br><b>VAT No</b>: {{ $vendor->vat }}
                            @endif
                            @if ($vendor->company_registration_number != '')
                                <br><b>Registration No</b>: {{ $vendor->company_registration_number }}
                                <br><b>Registration documents</b>: 
                                @foreach($vendor->getMedia('company_registration') as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }}</a>
                                @endforeach
                            <br><b>Company proof of residence</b>: 
                                @foreach($vendor->getMedia('company_proof_of_residents') as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }}</a>
                                @endforeach
                            @endif
                            @if ($vendor->tax_clearance_number != '')
                                <br><b>Tax clearance No</b>: {{ $vendor->tax_clearance_number }}
                            @endif
                            @if ($vendor->tax_clearance_expiration_date != '')
                                <br><b>Tax clearance epiry date</b>: {{ $vendor->tax_clearance_expiration_date }}
                            @endif
                            @if ($vendor->tax_clearance_number != '')
                                <br><b>Tax clearance No</b>: 
                                @foreach($vendor->getMedia('tax_clearance') as $media)
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }}</a>
                                @endforeach
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            @if ($vendor->directors_name != '')
                                <br><b>Director's name</b>: {{ $vendor->directors_name }}
                            @endif
                            @if ($vendor->director_id_number != '')
                                <br><b>Directors ID No</b>: {{ $vendor->director_id_number }}
                            @endif
                            @if ($vendor->directors_name != '')
                                <br><b>Directors proof of residence</b>: <br>
                                @foreach($vendor->getMedia('directors_proof_of_residence') as $media)
                                        <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }}</a>
                                @endforeach
                            @endif
                        </div>
                    </div>                   
 
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#vendor_accounts" aria-controls="vendor_accounts" role="tab" data-toggle="tab">Vendor accounts</a></li>
<li role="presentation" class=""><a href="#vendor_contacts" aria-controls="vendor_contacts" role="tab" data-toggle="tab">Vendor contacts</a></li>
<li role="presentation" class=""><a href="#workshop" aria-controls="workshop" role="tab" data-toggle="tab">Workshop centers</a></li>
<li role="presentation" class=""><a href="#warehouse" aria-controls="warehouse" role="tab" data-toggle="tab">Warehouses</a></li>
<li role="presentation" class=""><a href="#purchase_orders" aria-controls="purchase_orders" role="tab" data-toggle="tab">Purchase orders</a></li>
<li role="presentation" class=""><a href="#drivers" aria-controls="drivers" role="tab" data-toggle="tab">Transporter drivers</a></li>
<li role="presentation" class=""><a href="#vehicle_sc" aria-controls="vehicle_sc" role="tab" data-toggle="tab">Transporter vehicles</a></li>
<li role="presentation" class=""><a href="#road_freight_sub_contractors" aria-controls="road_freight_sub_contractors" role="tab" data-toggle="tab">Transporter requirements</a></li>
<li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
<li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
<li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
<li role="presentation" class=""><a href="#clearance_and_forwarding" aria-controls="clearance_and_forwarding" role="tab" data-toggle="tab">Clearance & forwarding</a></li>
<li role="presentation" class=""><a href="#vendor_bank_payments" aria-controls="vendor_bank_payments" role="tab" data-toggle="tab">Outbound deposits</a></li>
<li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
<li role="presentation" class=""><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
<li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
<li role="presentation" class=""><a href="#expense_category" aria-controls="expense_category" role="tab" data-toggle="tab">Tax invoices</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Credit note pymts</a></li>
<li role="presentation" class=""><a href="#bank_payments" aria-controls="bank_payments" role="tab" data-toggle="tab">Inbound deposits</a></li>
<li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Invoice/Debit note pymts</a></li>
<li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="vendor_accounts">
<table class="table table-bordered table-striped {{ count($vendor_accounts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vendor-accounts.fields.vendor')</th>
                        <th>@lang('global.vendor-accounts.fields.contact-person')</th>
                        <th>@lang('global.vendor-accounts.fields.account-manager')</th>
                        <th>@lang('global.vendor-accounts.fields.account-number')</th>
                        <th>@lang('global.vendor-accounts.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($vendor_accounts) > 0)
            @foreach ($vendor_accounts as $vendor_account)
                <tr data-entry-id="{{ $vendor_account->id }}">
                    <td field-key='vendor'>{{ $vendor_account->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $vendor_account->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $vendor_account->account_manager->name or '' }}</td>
                                <td field-key='account_number'>{{ $vendor_account->account_number }}</td>
                                <td field-key='status'>{{ $vendor_account->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_accounts.restore', $vendor_account->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_accounts.perma_del', $vendor_account->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('vendor_account_view')
                                    <a href="{{ route('admin.vendor_accounts.show',[$vendor_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vendor_account_edit')
                                    <a href="{{ route('admin.vendor_accounts.edit',[$vendor_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vendor_account_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_accounts.destroy', $vendor_account->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="vendor_contacts">
<table class="table table-bordered table-striped {{ count($vendor_contacts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vendor-contacts.fields.contact-name')</th>
                        <th>@lang('global.vendor-contacts.fields.phone-number')</th>
                        <th>@lang('global.vendor-contacts.fields.email')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($vendor_contacts) > 0)
            @foreach ($vendor_contacts as $vendor_contact)
                <tr data-entry-id="{{ $vendor_contact->id }}">
                    <td field-key='contact_name'>{{ $vendor_contact->contact_name }}</td>
                                <td field-key='phone_number'>{{ $vendor_contact->phone_number }}</td>
                                <td field-key='email'>{{ $vendor_contact->email }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_contacts.restore', $vendor_contact->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_contacts.perma_del', $vendor_contact->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('vendor_contact_view')
                                    <a href="{{ route('admin.vendor_contacts.show',[$vendor_contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vendor_contact_edit')
                                    <a href="{{ route('admin.vendor_contacts.edit',[$vendor_contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vendor_contact_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_contacts.destroy', $vendor_contact->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="workshop">
<table class="table table-bordered table-striped {{ count($workshops) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.workshop.fields.vendor')</th>
                        <th>@lang('global.workshop.fields.center-name')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($workshops) > 0)
            @foreach ($workshops as $workshop)
                <tr data-entry-id="{{ $workshop->id }}">
                    <td field-key='vendor'>{{ $workshop->vendor->name or '' }}</td>
                                <td field-key='center_name'>{{ $workshop->center_name }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workshops.restore', $workshop->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workshops.perma_del', $workshop->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('workshop_view')
                                    <a href="{{ route('admin.workshops.show',[$workshop->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('workshop_edit')
                                    <a href="{{ route('admin.workshops.edit',[$workshop->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('workshop_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.workshops.destroy', $workshop->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="warehouse">
<table class="table table-bordered table-striped {{ count($warehouses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.warehouse.fields.vendor')</th>
                        <th>@lang('global.warehouse.fields.center-name')</th>
                        <th>@lang('global.warehouse.fields.square-meters')</th>
                        <th>@lang('global.warehouse.fields.available-space')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($warehouses) > 0)
            @foreach ($warehouses as $warehouse)
                <tr data-entry-id="{{ $warehouse->id }}">
                    <td field-key='vendor'>{{ $warehouse->vendor->name or '' }}</td>
                                <td field-key='center_name'>{{ $warehouse->center_name }}</td>
                                <td field-key='square_meters'>{{ $warehouse->square_meters }}</td>
                                <td field-key='available_space'>{{ $warehouse->available_space }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.restore', $warehouse->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.perma_del', $warehouse->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('warehouse_view')
                                    <a href="{{ route('admin.warehouses.show',[$warehouse->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('warehouse_edit')
                                    <a href="{{ route('admin.warehouses.edit',[$warehouse->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('warehouse_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.destroy', $warehouse->id])) !!}
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
                <td colspan="22">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="drivers">
<table class="table table-bordered table-striped {{ count($drivers) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.drivers.fields.vendor')</th>
                        <th>@lang('global.drivers.fields.subcontractor-number')</th>
                        <th>@lang('global.drivers.fields.name')</th>
                        <th>@lang('global.drivers.fields.date-of-birth')</th>
                        <th>@lang('global.drivers.fields.drivers-license-number')</th>
                        <th>@lang('global.drivers.fields.drivers-license-expiry-date')</th>
                        <th>@lang('global.drivers.fields.int-drivers-license-no')</th>
                        <th>@lang('global.drivers.fields.int-drivers-license')</th>
                        <th>@lang('global.drivers.fields.int-drivers-license-expiry-date')</th>
                        <th>@lang('global.drivers.fields.drivers-passport-number')</th>
                        <th>@lang('global.drivers.fields.passport-expiry-date')</th>
                        <th>@lang('global.drivers.fields.sa-phone-number')</th>
                        <th>@lang('global.drivers.fields.int-phone-number')</th>
                        <th>@lang('global.drivers.fields.police-clearance-expiry-date')</th>
                        <th>@lang('global.drivers.fields.retest-number')</th>
                        <th>@lang('global.drivers.fields.retest')</th>
                        <th>@lang('global.drivers.fields.retest-expiry-date')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($drivers) > 0)
            @foreach ($drivers as $driver)
                <tr data-entry-id="{{ $driver->id }}">
                    <td field-key='vendor'>{{ $driver->vendor->name or '' }}</td>
                                <td field-key='subcontractor_number'>{{ $driver->subcontractor_number->subcontractor_number or '' }}</td>
                                <td field-key='name'>{{ $driver->name }}</td>
                                <td field-key='date_of_birth'>{{ $driver->date_of_birth }}</td>
                                <td field-key='drivers_license_number'>{{ $driver->drivers_license_number }}</td>
                                <td field-key='drivers_license'>@if($driver->drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_license) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='drivers_license_expiry_date'>{{ $driver->drivers_license_expiry_date }}</td>
                                <td field-key='int_drivers_license_no'>{{ $driver->int_drivers_license_no }}</td>
                                <td field-key='int_drivers_license'>@if($driver->int_drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->int_drivers_license) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='int_drivers_license_expiry_date'>{{ $driver->int_drivers_license_expiry_date }}</td>
                                <td field-key='drivers_passport_number'>{{ $driver->drivers_passport_number }}</td>
                                <td field-key='drivers_passport'>@if($driver->drivers_passport)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_passport) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='passport_expiry_date'>{{ $driver->passport_expiry_date }}</td>
                                <td field-key='sa_phone_number'>{{ $driver->sa_phone_number }}</td>
                                <td field-key='int_phone_number'>{{ $driver->int_phone_number }}</td>
                                <td field-key='police_clearance_expiry_date'>{{ $driver->police_clearance_expiry_date }}</td>
                                <td field-key='police_clearance'>@if($driver->police_clearance)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->police_clearance) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='retest_number'>{{ $driver->retest_number }}</td>
                                <td field-key='retest'>@if($driver->retest)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->retest) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='retest_expiry_date'>{{ $driver->retest_expiry_date }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drivers.restore', $driver->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drivers.perma_del', $driver->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('driver_view')
                                    <a href="{{ route('admin.drivers.show',[$driver->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('driver_edit')
                                    <a href="{{ route('admin.drivers.edit',[$driver->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('driver_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drivers.destroy', $driver->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="25">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="vehicle_sc">
<table class="table table-bordered table-striped {{ count($vehicle_scs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vehicle-sc.fields.vendor')</th>
                        <th>@lang('global.vehicle-sc.fields.subcontractor-number')</th>
                        <th>@lang('global.vehicle-sc.fields.vehicle-type')</th>
                        <th>@lang('global.vehicle-sc.fields.make')</th>
                        <th>@lang('global.vehicle-sc.fields.model')</th>
                        <th>@lang('global.vehicle-sc.fields.registration-number')</th>
                        <th>@lang('global.vehicle-sc.fields.certificate-of-registration')</th>
                        <th>@lang('global.vehicle-sc.fields.certificate-of-fitness-number')</th>
                        <th>@lang('global.vehicle-sc.fields.tracker-pin-details')</th>
                        <th>@lang('global.vehicle-sc.fields.tracker-password')</th>
                        <th>@lang('global.vehicle-sc.fields.expiration-date')</th>
                        <th>@lang('global.vehicle-sc.fields.service-history-reports')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($vehicle_scs) > 0)
            @foreach ($vehicle_scs as $vehicle_sc)
                <tr data-entry-id="{{ $vehicle_sc->id }}">
                    <td field-key='vendor'>{{ $vehicle_sc->vendor->name or '' }}</td>
                                <td field-key='subcontractor_number'>{{ $vehicle_sc->subcontractor_number->subcontractor_number or '' }}</td>
                                <td field-key='vehicle_type'>{{ $vehicle_sc->vehicle_type }}</td>
                                <td field-key='make'>{{ $vehicle_sc->make }}</td>
                                <td field-key='model'>{{ $vehicle_sc->model }}</td>
                                <td field-key='registration_number'>{{ $vehicle_sc->registration_number }}</td>
                                <td field-key='certificate_of_registration'>@if($vehicle_sc->certificate_of_registration)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_registration) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='certificate_of_fitness_number'>{{ $vehicle_sc->certificate_of_fitness_number }}</td>
                                <td field-key='certificate_of_fitness'>@if($vehicle_sc->certificate_of_fitness)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_fitness) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='tracker_pin_details'>{{ $vehicle_sc->tracker_pin_details }}</td>
                                <td field-key='tracker_password'>{{ $vehicle_sc->tracker_password }}</td>
                                <td field-key='expiration_date'>{{ $vehicle_sc->expiration_date }}</td>
                                <td field-key='service_history_reports'>@if($vehicle_sc->service_history_reports)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->service_history_reports) }}" target="_blank">Download file</a>@endif</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.restore', $vehicle_sc->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.perma_del', $vehicle_sc->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('vehicle_sc_view')
                                    <a href="{{ route('admin.vehicle_scs.show',[$vehicle_sc->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vehicle_sc_edit')
                                    <a href="{{ route('admin.vehicle_scs.edit',[$vehicle_sc->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vehicle_sc_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.destroy', $vehicle_sc->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
<div role="tabpanel" class="tab-pane " id="road_freight_sub_contractors">
<table class="table table-bordered table-striped {{ count($road_freight_sub_contractors) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.road-freight-sub-contractors.fields.subcontractor-number')</th>
                        <th>@lang('global.road-freight-sub-contractors.fields.git-cover-number')</th>
                        <th>@lang('global.road-freight-sub-contractors.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($road_freight_sub_contractors) > 0)
            @foreach ($road_freight_sub_contractors as $road_freight_sub_contractor)
                <tr data-entry-id="{{ $road_freight_sub_contractor->id }}">
                    <td field-key='subcontractor_number'>{{ $road_freight_sub_contractor->subcontractor_number }}</td>
                                <td field-key='git_cover_number'>{{ $road_freight_sub_contractor->git_cover_number }}</td>
                                <td field-key='git_cover'>@if($road_freight_sub_contractor->git_cover)<a href="{{ asset(env('UPLOAD_PATH').'/' . $road_freight_sub_contractor->git_cover) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='status'>{{ $road_freight_sub_contractor->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.restore', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.perma_del', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('road_freight_sub_contractor_view')
                                    <a href="{{ route('admin.road_freight_sub_contractors.show',[$road_freight_sub_contractor->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('road_freight_sub_contractor_edit')
                                    <a href="{{ route('admin.road_freight_sub_contractors.edit',[$road_freight_sub_contractor->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('road_freight_sub_contractor_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.destroy', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="air_freight">
<table class="table table-bordered table-striped {{ count($air_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.air-freight.fields.project-number')</th>
                        <th>@lang('global.air-freight.fields.air-freight-number')</th>
                        <th>@lang('global.air-freight.fields.client')</th>
                        <th>@lang('global.air-freight.fields.contact-person')</th>
                        <th>@lang('global.air-freight.fields.airline-or-agent')</th>
                        <th>@lang('global.air-freight.fields.airline-or-agent-contact')</th>
                        <th>@lang('global.air-freight.fields.project-manager')</th>
                        <th>@lang('global.air-freight.fields.flight-number')</th>
                        <th>@lang('global.air-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($air_freights) > 0)
            @foreach ($air_freights as $air_freight)
                <tr data-entry-id="{{ $air_freight->id }}">
                    <td field-key='project_number'>{{ $air_freight->project_number->operation_number or '' }}</td>
                                <td field-key='air_freight_number'>{{ $air_freight->air_freight_number }}</td>
                                <td field-key='client'>{{ $air_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $air_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='airline_or_agent'>
                                    @foreach ($air_freight->airline_or_agent as $singleAirlineOrAgent)
                                        <span class="label label-info label-many">{{ $singleAirlineOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='airline_or_agent_contact'>{{ $air_freight->airline_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $air_freight->project_manager->name or '' }}</td>
                                <td field-key='flight_number'>{{ $air_freight->flight_number }}</td>
                                <td field-key='route'>{{ $air_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.restore', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.perma_del', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('air_freight_view')
                                    <a href="{{ route('admin.air_freights.show',[$air_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('air_freight_edit')
                                    <a href="{{ route('admin.air_freights.edit',[$air_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('air_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.destroy', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="sea_freight">
<table class="table table-bordered table-striped {{ count($sea_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.sea-freight.fields.project-number')</th>
                        <th>@lang('global.sea-freight.fields.sea-freight-number')</th>
                        <th>@lang('global.sea-freight.fields.client')</th>
                        <th>@lang('global.sea-freight.fields.contact-person')</th>
                        <th>@lang('global.sea-freight.fields.shipper-or-agent')</th>
                        <th>@lang('global.sea-freight.fields.shipper-or-agent-contact')</th>
                        <th>@lang('global.sea-freight.fields.project-manager')</th>
                        <th>@lang('global.sea-freight.fields.voyage-number')</th>
                        <th>@lang('global.sea-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($sea_freights) > 0)
            @foreach ($sea_freights as $sea_freight)
                <tr data-entry-id="{{ $sea_freight->id }}">
                    <td field-key='project_number'>{{ $sea_freight->project_number->operation_number or '' }}</td>
                                <td field-key='sea_freight_number'>{{ $sea_freight->sea_freight_number }}</td>
                                <td field-key='client'>{{ $sea_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $sea_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='shipper__or_agent'>
                                    @foreach ($sea_freight->shipper__or_agent as $singleShipperOrAgent)
                                        <span class="label label-info label-many">{{ $singleShipperOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='shipper_or_agent_contact'>{{ $sea_freight->shipper_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $sea_freight->project_manager->name or '' }}</td>
                                <td field-key='voyage_number'>{{ $sea_freight->voyage_number }}</td>
                                <td field-key='route'>{{ $sea_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.restore', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.perma_del', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('sea_freight_view')
                                    <a href="{{ route('admin.sea_freights.show',[$sea_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('sea_freight_edit')
                                    <a href="{{ route('admin.sea_freights.edit',[$sea_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('sea_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.destroy', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="rail_freight">
<table class="table table-bordered table-striped {{ count($rail_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.rail-freight.fields.project-number')</th>
                        <th>@lang('global.rail-freight.fields.rail-freight-number')</th>
                        <th>@lang('global.rail-freight.fields.client')</th>
                        <th>@lang('global.rail-freight.fields.contact-person')</th>
                        <th>@lang('global.rail-freight.fields.railline-or-agent')</th>
                        <th>@lang('global.rail-freight.fields.railline-or-agent-contact')</th>
                        <th>@lang('global.rail-freight.fields.project-manager')</th>
                        <th>@lang('global.rail-freight.fields.trip-number')</th>
                        <th>@lang('global.rail-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($rail_freights) > 0)
            @foreach ($rail_freights as $rail_freight)
                <tr data-entry-id="{{ $rail_freight->id }}">
                    <td field-key='project_number'>{{ $rail_freight->project_number->operation_number or '' }}</td>
                                <td field-key='rail_freight_number'>{{ $rail_freight->rail_freight_number }}</td>
                                <td field-key='client'>{{ $rail_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $rail_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='railline_or_agent'>
                                    @foreach ($rail_freight->railline_or_agent as $singleRaillineOrAgent)
                                        <span class="label label-info label-many">{{ $singleRaillineOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='railline_or_agent_contact'>{{ $rail_freight->railline_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $rail_freight->project_manager->name or '' }}</td>
                                <td field-key='trip_number'>{{ $rail_freight->trip_number }}</td>
                                <td field-key='route'>{{ $rail_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.restore', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.perma_del', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('rail_freight_view')
                                    <a href="{{ route('admin.rail_freights.show',[$rail_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('rail_freight_edit')
                                    <a href="{{ route('admin.rail_freights.edit',[$rail_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('rail_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.destroy', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="clearance_and_forwarding">
<table class="table table-bordered table-striped {{ count($clearance_and_forwardings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.clearance-and-forwarding.fields.project-number')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.clearance-and-forwarding-number')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.border-post')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.client')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.contact-person')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.agent')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.agent-contact')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.project-manager')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($clearance_and_forwardings) > 0)
            @foreach ($clearance_and_forwardings as $clearance_and_forwarding)
                <tr data-entry-id="{{ $clearance_and_forwarding->id }}">
                    <td field-key='project_number'>{{ $clearance_and_forwarding->project_number->operation_number or '' }}</td>
                                <td field-key='clearance_and_forwarding_number'>{{ $clearance_and_forwarding->clearance_and_forwarding_number }}</td>
                                <td field-key='border_post'>{{ $clearance_and_forwarding->border_post }}</td>
                                <td field-key='client'>{{ $clearance_and_forwarding->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $clearance_and_forwarding->contact_person->contact_name or '' }}</td>
                                <td field-key='agent'>{{ $clearance_and_forwarding->agent->name or '' }}</td>
                                <td field-key='agent_contact'>{{ $clearance_and_forwarding->agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $clearance_and_forwarding->project_manager->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.restore', $clearance_and_forwarding->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.perma_del', $clearance_and_forwarding->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('clearance_and_forwarding_view')
                                    <a href="{{ route('admin.clearance_and_forwardings.show',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('clearance_and_forwarding_edit')
                                    <a href="{{ route('admin.clearance_and_forwardings.edit',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('clearance_and_forwarding_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.destroy', $clearance_and_forwarding->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="vendor_bank_payments">
<table class="table table-bordered table-striped {{ count($vendor_bank_payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vendor-bank-payments.fields.entry-date')</th>
                        <th>@lang('global.vendor-bank-payments.fields.withdrawer')</th>
                        <th>@lang('global.vendor-bank-payments.fields.payment-mode')</th>
                        <th>@lang('global.vendor-bank-payments.fields.prepared-by')</th>
                        <th>@lang('global.vendor-bank-payments.fields.payment-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.vendor')</th>
                        <th>@lang('global.vendor-bank-payments.fields.account-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.client')</th>
                        <th>@lang('global.vendor-bank-payments.fields.client-account-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.credit-note-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.amount')</th>
                        <th>@lang('global.vendor-bank-payments.fields.balance')</th>
                        <th>@lang('global.vendor-bank-payments.fields.upload-document')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($vendor_bank_payments) > 0)
            @foreach ($vendor_bank_payments as $vendor_bank_payment)
                <tr data-entry-id="{{ $vendor_bank_payment->id }}">
                    <td field-key='entry_date'>{{ $vendor_bank_payment->entry_date }}</td>
                                <td field-key='withdrawer'>{{ $vendor_bank_payment->withdrawer }}</td>
                                <td field-key='payment_mode'>{{ $vendor_bank_payment->payment_mode }}</td>
                                <td field-key='prepared_by'>{{ $vendor_bank_payment->prepared_by }}</td>
                                <td field-key='payment_number'>{{ $vendor_bank_payment->payment_number }}</td>
                                <td field-key='vendor'>{{ $vendor_bank_payment->vendor->name or '' }}</td>
                                <td field-key='account_number'>{{ $vendor_bank_payment->account_number->account_number or '' }}</td>
                                <td field-key='client'>{{ $vendor_bank_payment->client->name or '' }}</td>
                                <td field-key='client_account_number'>{{ $vendor_bank_payment->client_account_number->account_number or '' }}</td>
                                <td field-key='credit_note_number'>{{ $vendor_bank_payment->credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='amount'>{{ $vendor_bank_payment->amount }}</td>
                                <td field-key='balance'>{{ $vendor_bank_payment->balance }}</td>
                                <td field-key='upload_document'>@if($vendor_bank_payment->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vendor_bank_payment->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                                                <td>
                                    @can('vendor_bank_payment_view')
                                    <a href="{{ route('admin.vendor_bank_payments.show',[$vendor_bank_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vendor_bank_payment_edit')
                                    <a href="{{ route('admin.vendor_bank_payments.edit',[$vendor_bank_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vendor_bank_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_bank_payments.destroy', $vendor_bank_payment->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="debit_notes">
<table class="table table-bordered table-striped {{ count($debit_notes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.debit-notes.fields.date')</th>
                        <th>@lang('global.debit-notes.fields.refund-type')</th>
                        <th>@lang('global.debit-notes.fields.credit-note-payment-number')</th>
                        <th>@lang('global.debit-notes.fields.transaction-number')</th>
                        <th>@lang('global.debit-notes.fields.credit-note-number')</th>
                        <th>@lang('global.debit-notes.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.debit-notes.fields.vendor')</th>
                        <th>@lang('global.debit-notes.fields.contact-person')</th>
                        <th>@lang('global.debit-notes.fields.account-manager')</th>
                        <th>@lang('global.debit-notes.fields.prepared-by')</th>
                        <th>@lang('global.debit-notes.fields.debit-note-number')</th>
                        <th>@lang('global.debit-notes.fields.status')</th>
                        <th>@lang('global.debit-notes.fields.subtotal')</th>
                        <th>@lang('global.debit-notes.fields.vat')</th>
                        <th>@lang('global.debit-notes.fields.vat-amount')</th>
                        <th>@lang('global.debit-notes.fields.total-amount')</th>
                        <th>@lang('global.debit-notes.fields.paid-to-date')</th>
                        <th>@lang('global.debit-notes.fields.balance')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($debit_notes) > 0)
            @foreach ($debit_notes as $debit_note)
                <tr data-entry-id="{{ $debit_note->id }}">
                    <td field-key='date'>{{ $debit_note->date }}</td>
                                <td field-key='refund_type'>{{ $debit_note->refund_type }}</td>
                                <td field-key='credit_note_payment_number'>{{ $debit_note->credit_note_payment_number->payment_number or '' }}</td>
                                <td field-key='transaction_number'>{{ $debit_note->transaction_number->operation_number or '' }}</td>
                                <td field-key='credit_note_number'>{{ $debit_note->credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $debit_note->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='vendor'>{{ $debit_note->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $debit_note->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $debit_note->account_manager->name or '' }}</td>
                                <td field-key='prepared_by'>{{ $debit_note->prepared_by }}</td>
                                <td field-key='debit_note_number'>{{ $debit_note->debit_note_number }}</td>
                                <td field-key='status'>{{ $debit_note->status }}</td>
                                <td field-key='subtotal'>{{ $debit_note->subtotal }}</td>
                                <td field-key='vat'>{{ $debit_note->vat }}</td>
                                <td field-key='vat_amount'>{{ $debit_note->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $debit_note->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $debit_note->paid_to_date }}</td>
                                <td field-key='balance'>{{ $debit_note->balance }}</td>
                                                                <td>
                                    @can('debit_note_view')
                                    <a href="{{ route('admin.debit_notes.show',[$debit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('debit_note_edit')
                                    <a href="{{ route('admin.debit_notes.edit',[$debit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('debit_note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.debit_notes.destroy', $debit_note->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="loading_instruction">
<table class="table table-bordered table-striped {{ count($loading_instructions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.loading-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.loading-instruction.fields.freight-contract-type')</th>
                        <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                        <th>@lang('global.loading-instruction.fields.driver')</th>
                        <th>@lang('global.loading-instruction.fields.vehicle')</th>
                        <th>@lang('global.loading-instruction.fields.trailers')</th>
                        <th>@lang('global.loading-instruction.fields.vendor')</th>
                        <th>@lang('global.loading-instruction.fields.vendor-driver')</th>
                        <th>@lang('global.loading-instruction.fields.vendor-vehicle-description')</th>
                        <th>@lang('global.loading-instruction.fields.order-number')</th>
                        <th>@lang('global.loading-instruction.fields.client')</th>
                        <th>@lang('global.loading-instruction.fields.contact-person')</th>
                        <th>@lang('global.loading-instruction.fields.project-manager')</th>
                        <th>@lang('global.loading-instruction.fields.pick-up-company-name')</th>
                        <th>@lang('global.loading-instruction.fields.pickup-address')</th>
                        <th>@lang('global.loading-instruction.fields.pickup-date-time')</th>
                        <th>@lang('global.loading-instruction.fields.prepared-by')</th>
                        <th>@lang('global.loading-instruction.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($loading_instructions) > 0)
            @foreach ($loading_instructions as $loading_instruction)
                <tr data-entry-id="{{ $loading_instruction->id }}">
                    <td field-key='road_freight_number'>{{ $loading_instruction->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='freight_contract_type'>{{ $loading_instruction->freight_contract_type }}</td>
                                <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                <td field-key='driver'>{{ $loading_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle'>{{ $loading_instruction->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailers'>
                                    @foreach ($loading_instruction->trailers as $singleTrailers)
                                        <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor'>{{ $loading_instruction->vendor->name or '' }}</td>
                                <td field-key='vendor_driver'>{{ $loading_instruction->vendor_driver->name or '' }}</td>
                                <td field-key='vendor_vehicle_description'>
                                    @foreach ($loading_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='order_number'>{{ $loading_instruction->order_number }}</td>
                                <td field-key='client'>{{ $loading_instruction->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $loading_instruction->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $loading_instruction->project_manager->name or '' }}</td>
                                <td field-key='pick_up_company_name'>{{ $loading_instruction->pick_up_company_name }}</td>
                                <td field-key='pickup_address'>{{ $loading_instruction->pickup_address_address }}</td>
                                <td field-key='pickup_date_time'>{{ $loading_instruction->pickup_date_time }}</td>
                                <td field-key='prepared_by'>{{ $loading_instruction->prepared_by }}</td>
                                <td field-key='status'>{{ $loading_instruction->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.restore', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.perma_del', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('loading_instruction_view')
                                    <a href="{{ route('admin.loading_instructions.show',[$loading_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('loading_instruction_edit')
                                    <a href="{{ route('admin.loading_instructions.edit',[$loading_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('loading_instruction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.destroy', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
<div role="tabpanel" class="tab-pane " id="delivery_instruction">
<table class="table table-bordered table-striped {{ count($delivery_instructions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.delivery-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.delivery-instruction.fields.freight-contract-type')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-instruction-number')</th>
                        <th>@lang('global.delivery-instruction.fields.driver')</th>
                        <th>@lang('global.delivery-instruction.fields.vehicle')</th>
                        <th>@lang('global.delivery-instruction.fields.trailers')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor-driver')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor-vehicle-description')</th>
                        <th>@lang('global.delivery-instruction.fields.order-number')</th>
                        <th>@lang('global.delivery-instruction.fields.client')</th>
                        <th>@lang('global.delivery-instruction.fields.contact-person')</th>
                        <th>@lang('global.delivery-instruction.fields.project-manager')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-company-name')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-address')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-date-time')</th>
                        <th>@lang('global.delivery-instruction.fields.prepared-by')</th>
                        <th>@lang('global.delivery-instruction.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($delivery_instructions) > 0)
            @foreach ($delivery_instructions as $delivery_instruction)
                <tr data-entry-id="{{ $delivery_instruction->id }}">
                    <td field-key='road_freight_number'>{{ $delivery_instruction->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='freight_contract_type'>{{ $delivery_instruction->freight_contract_type }}</td>
                                <td field-key='delivery_instruction_number'>{{ $delivery_instruction->delivery_instruction_number }}</td>
                                <td field-key='driver'>{{ $delivery_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle'>{{ $delivery_instruction->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailers'>
                                    @foreach ($delivery_instruction->trailers as $singleTrailers)
                                        <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor'>{{ $delivery_instruction->vendor->name or '' }}</td>
                                <td field-key='vendor_driver'>{{ $delivery_instruction->vendor_driver->name or '' }}</td>
                                <td field-key='vendor_vehicle_description'>
                                    @foreach ($delivery_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='order_number'>{{ $delivery_instruction->order_number }}</td>
                                <td field-key='client'>{{ $delivery_instruction->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $delivery_instruction->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $delivery_instruction->project_manager->name or '' }}</td>
                                <td field-key='delivery_company_name'>{{ $delivery_instruction->delivery_company_name }}</td>
                                <td field-key='delivery_address'>{{ $delivery_instruction->delivery_address_address }}</td>
                                <td field-key='delivery_date_time'>{{ $delivery_instruction->delivery_date_time }}</td>
                                <td field-key='prepared_by'>{{ $delivery_instruction->prepared_by }}</td>
                                <td field-key='status'>{{ $delivery_instruction->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.restore', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.perma_del', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('delivery_instruction_view')
                                    <a href="{{ route('admin.delivery_instructions.show',[$delivery_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('delivery_instruction_edit')
                                    <a href="{{ route('admin.delivery_instructions.edit',[$delivery_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delivery_instruction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.destroy', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
<div role="tabpanel" class="tab-pane " id="expense_category">
<table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.expense-category.fields.transaction-type')</th>
                        <th>@lang('global.expense-category.fields.transaction-number')</th>
                        <th>@lang('global.expense-category.fields.entry-date')</th>
                        <th>@lang('global.expense-category.fields.due-date')</th>
                        <th>@lang('global.expense-category.fields.prepared-by')</th>
                        <th>@lang('global.expense-category.fields.credit-note-number')</th>
                        <th>@lang('global.expense-category.fields.vendor')</th>
                        <th>@lang('global.expense-category.fields.contact-person')</th>
                        <th>@lang('global.expense-category.fields.account-manager')</th>
                        <th>@lang('global.expense-category.fields.purchase-order-number')</th>
                        <th>@lang('global.expense-category.fields.vendor-purchase-order-number')</th>
                        <th>@lang('global.expense-category.fields.upload-document')</th>
                        <th>@lang('global.expense-category.fields.status')</th>
                        <th>@lang('global.expense-category.fields.terms-and-conditions')</th>
                        <th>@lang('global.expense-category.fields.subtotal')</th>
                        <th>@lang('global.expense-category.fields.percent-discount')</th>
                        <th>@lang('global.expense-category.fields.discount-amount')</th>
                        <th>@lang('global.expense-category.fields.discounted-subtotal')</th>
                        <th>@lang('global.expense-category.fields.vat')</th>
                        <th>@lang('global.expense-category.fields.vat-amount')</th>
                        <th>@lang('global.expense-category.fields.total-amount')</th>
                        <th>@lang('global.expense-category.fields.paid-to-date')</th>
                        <th>@lang('global.expense-category.fields.balance')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($expense_categories) > 0)
            @foreach ($expense_categories as $expense_category)
                <tr data-entry-id="{{ $expense_category->id }}">
                    <td field-key='transaction_type'>{{ $expense_category->transaction_type->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $expense_category->transaction_number->operation_number or '' }}</td>
                                <td field-key='entry_date'>{{ $expense_category->entry_date }}</td>
                                <td field-key='due_date'>{{ $expense_category->due_date }}</td>
                                <td field-key='prepared_by'>{{ $expense_category->prepared_by }}</td>
                                <td field-key='credit_note_number'>{{ $expense_category->credit_note_number }}</td>
                                <td field-key='vendor'>{{ $expense_category->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $expense_category->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $expense_category->account_manager->name or '' }}</td>
                                <td field-key='purchase_order_number'>{{ $expense_category->purchase_order_number->purchase_order_number or '' }}</td>
                                <td field-key='vendor_purchase_order_number'>{{ $expense_category->vendor_purchase_order_number }}</td>
                                <td field-key='upload_document'>@if($expense_category->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $expense_category->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='status'>{{ $expense_category->status }}</td>
                                <td field-key='terms_and_conditions'>{!! $expense_category->terms_and_conditions !!}</td>
                                <td field-key='subtotal'>{{ $expense_category->subtotal }}</td>
                                <td field-key='percent_discount'>{{ $expense_category->percent_discount }}</td>
                                <td field-key='discount_amount'>{{ $expense_category->discount_amount }}</td>
                                <td field-key='discounted_subtotal'>{{ $expense_category->discounted_subtotal }}</td>
                                <td field-key='vat'>{{ $expense_category->vat }}</td>
                                <td field-key='vat_amount'>{{ $expense_category->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $expense_category->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $expense_category->paid_to_date }}</td>
                                <td field-key='balance'>{{ $expense_category->balance }}</td>
                                                                <td>
                                    @can('expense_category_view')
                                    <a href="{{ route('admin.expense_categories.show',[$expense_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('expense_category_edit')
                                    <a href="{{ route('admin.expense_categories.edit',[$expense_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('expense_category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.expense_categories.destroy', $expense_category->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="28">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="expense">
<table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.expense.fields.entry-date')</th>
                        <th>@lang('global.expense.fields.payment-type')</th>
                        <th>@lang('global.expense.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.expense.fields.prepared-by')</th>
                        <th>@lang('global.expense.fields.payment-number')</th>
                        <th>@lang('global.expense.fields.vendor-credit-note-number')</th>
                        <th>@lang('global.expense.fields.debit-note-number')</th>
                        <th>@lang('global.expense.fields.vendor')</th>
                        <th>@lang('global.expense.fields.client-credit-note-number')</th>
                        <th>@lang('global.expense.fields.client')</th>
                        <th>@lang('global.expense.fields.operation-type')</th>
                        <th>@lang('global.expense.fields.transaction-type')</th>
                        <th>@lang('global.expense.fields.transaction-number')</th>
                        <th>@lang('global.expense.fields.expense-category')</th>
                        <th>@lang('global.expense.fields.amount')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($expenses) > 0)
            @foreach ($expenses as $expense)
                <tr data-entry-id="{{ $expense->id }}">
                    <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                <td field-key='payment_type'>{{ $expense->payment_type }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $expense->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='prepared_by'>{{ $expense->prepared_by }}</td>
                                <td field-key='payment_number'>{{ $expense->payment_number }}</td>
                                <td field-key='vendor_credit_note_number'>{{ $expense->vendor_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $expense->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='vendor'>{{ $expense->vendor->name or '' }}</td>
                                <td field-key='client_credit_note_number'>{{ $expense->client_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='client'>{{ $expense->client->name or '' }}</td>
                                <td field-key='operation_type'>{{ $expense->operation_type->name or '' }}</td>
                                <td field-key='transaction_type'>{{ $expense->transaction_type->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $expense->transaction_number->operation_number or '' }}</td>
                                <td field-key='expense_category'>{{ $expense->expense_category }}</td>
                                <td field-key='amount'>{{ $expense->amount }}</td>
                                                                <td>
                                    @can('expense_view')
                                    <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('expense_edit')
                                    <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('expense_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="bank_payments">
<table class="table table-bordered table-striped {{ count($bank_payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.bank-payments.fields.entry-date')</th>
                        <th>@lang('global.bank-payments.fields.depositor')</th>
                        <th>@lang('global.bank-payments.fields.payment-mode')</th>
                        <th>@lang('global.bank-payments.fields.prepared-by')</th>
                        <th>@lang('global.bank-payments.fields.payment-number')</th>
                        <th>@lang('global.bank-payments.fields.client')</th>
                        <th>@lang('global.bank-payments.fields.account-number')</th>
                        <th>@lang('global.bank-payments.fields.vendor')</th>
                        <th>@lang('global.bank-payments.fields.vendor-account-number')</th>
                        <th>@lang('global.bank-payments.fields.debit-note-number')</th>
                        <th>@lang('global.bank-payments.fields.amount')</th>
                        <th>@lang('global.bank-payments.fields.balance')</th>
                        <th>@lang('global.bank-payments.fields.upload-document')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($bank_payments) > 0)
            @foreach ($bank_payments as $bank_payment)
                <tr data-entry-id="{{ $bank_payment->id }}">
                    <td field-key='entry_date'>{{ $bank_payment->entry_date }}</td>
                                <td field-key='depositor'>{{ $bank_payment->depositor }}</td>
                                <td field-key='payment_mode'>{{ $bank_payment->payment_mode }}</td>
                                <td field-key='prepared_by'>{{ $bank_payment->prepared_by }}</td>
                                <td field-key='payment_number'>{{ $bank_payment->payment_number }}</td>
                                <td field-key='client'>{{ $bank_payment->client->name or '' }}</td>
                                <td field-key='account_number'>{{ $bank_payment->account_number->account_number or '' }}</td>
                                <td field-key='vendor'>{{ $bank_payment->vendor->name or '' }}</td>
                                <td field-key='vendor_account_number'>{{ $bank_payment->vendor_account_number->account_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $bank_payment->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='amount'>{{ $bank_payment->amount }}</td>
                                <td field-key='balance'>{{ $bank_payment->balance }}</td>
                                <td field-key='upload_document'>@if($bank_payment->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $bank_payment->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                                                <td>
                                    @can('bank_payment_view')
                                    <a href="{{ route('admin.bank_payments.show',[$bank_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('bank_payment_edit')
                                    <a href="{{ route('admin.bank_payments.edit',[$bank_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('bank_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.bank_payments.destroy', $bank_payment->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="income">
<table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income.fields.entry-date')</th>
                        <th>@lang('global.income.fields.payment-type')</th>
                        <th>@lang('global.income.fields.deposit-transaction-number')</th>
                        <th>@lang('global.income.fields.prepared-by')</th>
                        <th>@lang('global.income.fields.payment-number')</th>
                        <th>@lang('global.income.fields.invoice-number')</th>
                        <th>@lang('global.income.fields.sales-credit-note-number')</th>
                        <th>@lang('global.income.fields.client')</th>
                        <th>@lang('global.income.fields.debit-note-number')</th>
                        <th>@lang('global.income.fields.vendor')</th>
                        <th>@lang('global.income.fields.operation-type')</th>
                        <th>@lang('global.income.fields.project-type')</th>
                        <th>@lang('global.income.fields.project-number')</th>
                        <th>@lang('global.income.fields.income-category')</th>
                        <th>@lang('global.income.fields.amount')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($incomes) > 0)
            @foreach ($incomes as $income)
                <tr data-entry-id="{{ $income->id }}">
                    <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                <td field-key='payment_type'>{{ $income->payment_type }}</td>
                                <td field-key='deposit_transaction_number'>{{ $income->deposit_transaction_number->payment_number or '' }}</td>
                                <td field-key='prepared_by'>{{ $income->prepared_by }}</td>
                                <td field-key='payment_number'>{{ $income->payment_number }}</td>
                                <td field-key='invoice_number'>{{ $income->invoice_number->invoice_number or '' }}</td>
                                <td field-key='sales_credit_note_number'>{{ $income->sales_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='client'>{{ $income->client->name or '' }}</td>
                                <td field-key='debit_note_number'>{{ $income->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='vendor'>{{ $income->vendor->name or '' }}</td>
                                <td field-key='operation_type'>{{ $income->operation_type->name or '' }}</td>
                                <td field-key='project_type'>{{ $income->project_type->name or '' }}</td>
                                <td field-key='project_number'>{{ $income->project_number->operation_number or '' }}</td>
                                <td field-key='income_category'>{{ $income->income_category }}</td>
                                <td field-key='amount'>{{ $income->amount }}</td>
                                                                <td>
                                    @can('income_view')
                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_edit')
                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="road_freights">
<table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.road-freights.fields.project-number')</th>
                        <th>@lang('global.road-freights.fields.road-freight-number')</th>
                        <th>@lang('global.road-freights.fields.freight-contract-type')</th>
                        <th>@lang('global.road-freights.fields.route')</th>
                        <th>@lang('global.road-freights.fields.client')</th>
                        <th>@lang('global.road-freights.fields.contact-person')</th>
                        <th>@lang('global.road-freights.fields.project-manager')</th>
                        <th>@lang('global.road-freights.fields.driver')</th>
                        <th>@lang('global.road-freights.fields.vehicle')</th>
                        <th>@lang('global.road-freights.fields.trailers')</th>
                        <th>@lang('global.road-freights.fields.subcontractor-number')</th>
                        <th>@lang('global.road-freights.fields.vendor')</th>
                        <th>@lang('global.road-freights.fields.vendor-contact-person')</th>
                        <th>@lang('global.road-freights.fields.vendor-drivers')</th>
                        <th>@lang('global.road-freights.fields.vendor-vehicles')</th>
                        <th>@lang('global.road-freights.fields.road-freight-income')</th>
                        <th>@lang('global.road-freights.fields.road-freight-expenses')</th>
                        <th>@lang('global.road-freights.fields.machinery-costs')</th>
                        <th>@lang('global.road-freights.fields.breakdown')</th>
                        <th>@lang('global.road-freights.fields.total-expenses')</th>
                        <th>@lang('global.road-freights.fields.net-income')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($road_freights) > 0)
            @foreach ($road_freights as $road_freight)
                <tr data-entry-id="{{ $road_freight->id }}">
                    <td field-key='project_number'>{{ $road_freight->project_number->operation_number or '' }}</td>
                                <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                <td field-key='freight_contract_type'>{{ $road_freight->freight_contract_type }}</td>
                                <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $road_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $road_freight->project_manager->name or '' }}</td>
                                <td field-key='driver'>{{ $road_freight->driver->name or '' }}</td>
                                <td field-key='vehicle'>{{ $road_freight->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailers'>
                                    @foreach ($road_freight->trailers as $singleTrailers)
                                        <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='subcontractor_number'>{{ $road_freight->subcontractor_number->subcontractor_number or '' }}</td>
                                <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                <td field-key='vendor_contact_person'>{{ $road_freight->vendor_contact_person->contact_name or '' }}</td>
                                <td field-key='vendor_drivers'>
                                    @foreach ($road_freight->vendor_drivers as $singleVendorDrivers)
                                        <span class="label label-info label-many">{{ $singleVendorDrivers->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor_vehicles'>
                                    @foreach ($road_freight->vendor_vehicles as $singleVendorVehicles)
                                        <span class="label label-info label-many">{{ $singleVendorVehicles->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='road_freight_income'>{{ $road_freight->road_freight_income }}</td>
                                <td field-key='road_freight_expenses'>{{ $road_freight->road_freight_expenses }}</td>
                                <td field-key='machinery_costs'>{{ $road_freight->machinery_costs }}</td>
                                <td field-key='breakdown'>{{ $road_freight->breakdown }}</td>
                                <td field-key='total_expenses'>{{ $road_freight->total_expenses }}</td>
                                <td field-key='net_income'>{{ $road_freight->net_income }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.restore', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.perma_del', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('road_freight_view')
                                    <a href="{{ route('admin.road_freights.show',[$road_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('road_freight_edit')
                                    <a href="{{ route('admin.road_freights.edit',[$road_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('road_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.destroy', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="26">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.vendors.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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



