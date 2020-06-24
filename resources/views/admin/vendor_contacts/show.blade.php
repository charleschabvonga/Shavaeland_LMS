@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.vendor-contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.vendor-contacts.fields.contact-name')</th>
                            <td field-key='contact_name'>{{ $vendor_contact->contact_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.vendor-contacts.fields.phone-number')</th>
                            <td field-key='phone_number'>{{ $vendor_contact->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.vendor-contacts.fields.email')</th>
                            <td field-key='email'>{{ $vendor_contact->email }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#vendor_accounts" aria-controls="vendor_accounts" role="tab" data-toggle="tab">Vendor accounts</a></li>
<li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
<li role="presentation" class=""><a href="#expense_category" aria-controls="expense_category" role="tab" data-toggle="tab">Purchase credit notes</a></li>
<li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
<li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
<li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
<li role="presentation" class=""><a href="#clearance_and_forwarding" aria-controls="clearance_and_forwarding" role="tab" data-toggle="tab">Clearance & forwarding</a></li>
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
<div role="tabpanel" class="tab-pane " id="debit_notes">
<table class="table table-bordered table-striped {{ count($debit_notes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.debit-notes.fields.refund-type')</th>
                        <th>@lang('global.debit-notes.fields.vendor')</th>
                        <th>@lang('global.debit-notes.fields.contact-person')</th>
                        <th>@lang('global.debit-notes.fields.account-manager')</th>
                        <th>@lang('global.debit-notes.fields.transaction-number')</th>
                        <th>@lang('global.debit-notes.fields.credit-note-number')</th>
                        <th>@lang('global.debit-notes.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.debit-notes.fields.credit-note-payment-number')</th>
                        <th>@lang('global.debit-notes.fields.debit-note-number')</th>
                        <th>@lang('global.debit-notes.fields.date')</th>
                        <th>@lang('global.debit-notes.fields.payment-status')</th>
                        <th>@lang('global.debit-notes.fields.subtotal')</th>
                        <th>@lang('global.debit-notes.fields.vat')</th>
                        <th>@lang('global.debit-notes.fields.vat-amount')</th>
                        <th>@lang('global.debit-notes.fields.total-amount')</th>
                        <th>@lang('global.debit-notes.fields.paid-to-date')</th>
                        <th>@lang('global.debit-notes.fields.balance')</th>
                        <th>@lang('global.debit-notes.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($debit_notes) > 0)
            @foreach ($debit_notes as $debit_note)
                <tr data-entry-id="{{ $debit_note->id }}">
                    <td field-key='refund_type'>{{ $debit_note->refund_type }}</td>
                                <td field-key='vendor'>{{ $debit_note->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $debit_note->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $debit_note->account_manager->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $debit_note->transaction_number->operation_number or '' }}</td>
                                <td field-key='credit_note_number'>{{ $debit_note->credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $debit_note->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='credit_note_payment_number'>{{ $debit_note->credit_note_payment_number->payment_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $debit_note->debit_note_number }}</td>
                                <td field-key='date'>{{ $debit_note->date }}</td>
                                <td field-key='payment_status'>{{ $debit_note->payment_status }}</td>
                                <td field-key='subtotal'>{{ $debit_note->subtotal }}</td>
                                <td field-key='vat'>{{ $debit_note->vat }}</td>
                                <td field-key='vat_amount'>{{ $debit_note->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $debit_note->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $debit_note->paid_to_date }}</td>
                                <td field-key='balance'>{{ $debit_note->balance }}</td>
                                <td field-key='prepared_by'>{{ $debit_note->prepared_by }}</td>
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
<div role="tabpanel" class="tab-pane " id="expense_category">
<table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.expense-category.fields.credit-note-number')</th>
                        <th>@lang('global.expense-category.fields.vendor')</th>
                        <th>@lang('global.expense-category.fields.contact-person')</th>
                        <th>@lang('global.expense-category.fields.account-manager')</th>
                        <th>@lang('global.expense-category.fields.transaction-type')</th>
                        <th>@lang('global.expense-category.fields.transaction-number')</th>
                        <th>@lang('global.expense-category.fields.purchase-order-number')</th>
                        <th>@lang('global.expense-category.fields.entry-date')</th>
                        <th>@lang('global.expense-category.fields.due-date')</th>
                        <th>@lang('global.expense-category.fields.status')</th>
                        <th>@lang('global.expense-category.fields.subtotal')</th>
                        <th>@lang('global.expense-category.fields.vat')</th>
                        <th>@lang('global.expense-category.fields.vat-amount')</th>
                        <th>@lang('global.expense-category.fields.total-amount')</th>
                        <th>@lang('global.expense-category.fields.paid-to-date')</th>
                        <th>@lang('global.expense-category.fields.balance')</th>
                        <th>@lang('global.expense-category.fields.terms-and-conditions')</th>
                        <th>@lang('global.expense-category.fields.upload-document')</th>
                        <th>@lang('global.expense-category.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($expense_categories) > 0)
            @foreach ($expense_categories as $expense_category)
                <tr data-entry-id="{{ $expense_category->id }}">
                    <td field-key='credit_note_number'>{{ $expense_category->credit_note_number }}</td>
                                <td field-key='vendor'>{{ $expense_category->vendor->name or '' }}</td>
                                <td field-key='contact_person'>{{ $expense_category->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $expense_category->account_manager->name or '' }}</td>
                                <td field-key='transaction_type'>{{ $expense_category->transaction_type->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $expense_category->transaction_number->operation_number or '' }}</td>
                                <td field-key='purchase_order_number'>{{ $expense_category->purchase_order_number }}</td>
                                <td field-key='entry_date'>{{ $expense_category->entry_date }}</td>
                                <td field-key='due_date'>{{ $expense_category->due_date }}</td>
                                <td field-key='status'>{{ $expense_category->status }}</td>
                                <td field-key='subtotal'>{{ $expense_category->subtotal }}</td>
                                <td field-key='vat'>{{ $expense_category->vat }}</td>
                                <td field-key='vat_amount'>{{ $expense_category->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $expense_category->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $expense_category->paid_to_date }}</td>
                                <td field-key='balance'>{{ $expense_category->balance }}</td>
                                <td field-key='terms_and_conditions'>{!! $expense_category->terms_and_conditions !!}</td>
                                <td field-key='upload_document'>@if($expense_category->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $expense_category->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='prepared_by'>{{ $expense_category->prepared_by }}</td>
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
                <td colspan="24">@lang('global.app_no_entries_in_table')</td>
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
                        <th>@lang('global.road-freights.fields.vehicles')</th>
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
                                <td field-key='driver'>
                                    @foreach ($road_freight->driver as $singleDriver)
                                        <span class="label label-info label-many">{{ $singleDriver->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vehicles'>
                                    @foreach ($road_freight->vehicles as $singleVehicles)
                                        <span class="label label-info label-many">{{ $singleVehicles->vehicle_description }}</span>
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
                <td colspan="25">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.vendor_contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


