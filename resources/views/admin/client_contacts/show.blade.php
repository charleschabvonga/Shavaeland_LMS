@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-contacts.fields.contact-name')</th>
                            <td field-key='contact_name'>{{ $client_contact->contact_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-contacts.fields.phone-number')</th>
                            <td field-key='phone_number'>{{ $client_contact->phone_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-contacts.fields.email')</th>
                            <td field-key='email'>{{ $client_contact->email }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#client_accounts" aria-controls="client_accounts" role="tab" data-toggle="tab">Client accounts</a></li>
<li role="presentation" class=""><a href="#quotation" aria-controls="quotation" role="tab" data-toggle="tab">Quotations</a></li>
<li role="presentation" class=""><a href="#income_category" aria-controls="income_category" role="tab" data-toggle="tab">Invoices</a></li>
<li role="presentation" class=""><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Sales credit notes</a></li>
<li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
<li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
<li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
<li role="presentation" class=""><a href="#job_cards" aria-controls="job_cards" role="tab" data-toggle="tab">Job cards</a></li>
<li role="presentation" class=""><a href="#clearance_and_forwarding" aria-controls="clearance_and_forwarding" role="tab" data-toggle="tab">Clearance & forwarding</a></li>
<li role="presentation" class=""><a href="#releasing" aria-controls="releasing" role="tab" data-toggle="tab">Releasing</a></li>
<li role="presentation" class=""><a href="#receiving" aria-controls="receiving" role="tab" data-toggle="tab">Receiving</a></li>
<li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
<li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
<li role="presentation" class=""><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="client_accounts">
<table class="table table-bordered table-striped {{ count($client_accounts) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.client-accounts.fields.client')</th>
                        <th>@lang('global.client-accounts.fields.contact-person')</th>
                        <th>@lang('global.client-accounts.fields.account-manager')</th>
                        <th>@lang('global.client-accounts.fields.account-number')</th>
                        <th>@lang('global.client-accounts.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($client_accounts) > 0)
            @foreach ($client_accounts as $client_account)
                <tr data-entry-id="{{ $client_account->id }}">
                    <td field-key='client'>{{ $client_account->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $client_account->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $client_account->account_manager->name or '' }}</td>
                                <td field-key='account_number'>{{ $client_account->account_number }}</td>
                                <td field-key='status'>{{ $client_account->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_accounts.restore', $client_account->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_accounts.perma_del', $client_account->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('client_account_view')
                                    <a href="{{ route('admin.client_accounts.show',[$client_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_account_edit')
                                    <a href="{{ route('admin.client_accounts.edit',[$client_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_account_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_accounts.destroy', $client_account->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="quotation">
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
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="income_category">
<table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income-category.fields.invoice-number')</th>
                        <th>@lang('global.income-category.fields.client')</th>
                        <th>@lang('global.income-category.fields.contact-person')</th>
                        <th>@lang('global.income-category.fields.account-manager')</th>
                        <th>@lang('global.income-category.fields.project-type')</th>
                        <th>@lang('global.income-category.fields.project-number')</th>
                        <th>@lang('global.income-category.fields.quotation-number')</th>
                        <th>@lang('global.income-category.fields.sales-order-number')</th>
                        <th>@lang('global.income-category.fields.entry-date')</th>
                        <th>@lang('global.income-category.fields.due-date')</th>
                        <th>@lang('global.income-category.fields.subtotal')</th>
                        <th>@lang('global.income-category.fields.status')</th>
                        <th>@lang('global.income-category.fields.vat')</th>
                        <th>@lang('global.income-category.fields.vat-amount')</th>
                        <th>@lang('global.income-category.fields.total-amount')</th>
                        <th>@lang('global.income-category.fields.paid-to-date')</th>
                        <th>@lang('global.income-category.fields.balance')</th>
                        <th>@lang('global.income-category.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($income_categories) > 0)
            @foreach ($income_categories as $income_category)
                <tr data-entry-id="{{ $income_category->id }}">
                    <td field-key='invoice_number'>{{ $income_category->invoice_number }}</td>
                                <td field-key='client'>{{ $income_category->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $income_category->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $income_category->account_manager->name or '' }}</td>
                                <td field-key='project_type'>{{ $income_category->project_type->name or '' }}</td>
                                <td field-key='project_number'>{{ $income_category->project_number->operation_number or '' }}</td>
                                <td field-key='quotation_number'>{{ $income_category->quotation_number->quotation_number or '' }}</td>
                                <td field-key='sales_order_number'>{{ $income_category->sales_order_number }}</td>
                                <td field-key='entry_date'>{{ $income_category->entry_date }}</td>
                                <td field-key='due_date'>{{ $income_category->due_date }}</td>
                                <td field-key='subtotal'>{{ $income_category->subtotal }}</td>
                                <td field-key='status'>{{ $income_category->status }}</td>
                                <td field-key='vat'>{{ $income_category->vat }}</td>
                                <td field-key='vat_amount'>{{ $income_category->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $income_category->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $income_category->paid_to_date }}</td>
                                <td field-key='balance'>{{ $income_category->balance }}</td>
                                <td field-key='prepared_by'>{{ $income_category->prepared_by }}</td>
                                                                <td>
                                    @can('income_category_view')
                                    <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_category_edit')
                                    <a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="credit_note">
<table class="table table-bordered table-striped {{ count($credit_notes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.credit-note.fields.refund-type')</th>
                        <th>@lang('global.credit-note.fields.client')</th>
                        <th>@lang('global.credit-note.fields.contact-person')</th>
                        <th>@lang('global.credit-note.fields.account-manager')</th>
                        <th>@lang('global.credit-note.fields.project-number')</th>
                        <th>@lang('global.credit-note.fields.invoice-number')</th>
                        <th>@lang('global.credit-note.fields.bank-reference')</th>
                        <th>@lang('global.credit-note.fields.invoice-payment-number')</th>
                        <th>@lang('global.credit-note.fields.credit-note-number')</th>
                        <th>@lang('global.credit-note.fields.date')</th>
                        <th>@lang('global.credit-note.fields.status')</th>
                        <th>@lang('global.credit-note.fields.terms-and-conditions')</th>
                        <th>@lang('global.credit-note.fields.subtotal')</th>
                        <th>@lang('global.credit-note.fields.vat')</th>
                        <th>@lang('global.credit-note.fields.vat-amount')</th>
                        <th>@lang('global.credit-note.fields.total-amount')</th>
                        <th>@lang('global.credit-note.fields.paid-to-date')</th>
                        <th>@lang('global.credit-note.fields.balance')</th>
                        <th>@lang('global.credit-note.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($credit_notes) > 0)
            @foreach ($credit_notes as $credit_note)
                <tr data-entry-id="{{ $credit_note->id }}">
                    <td field-key='refund_type'>{{ $credit_note->refund_type }}</td>
                                <td field-key='client'>{{ $credit_note->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $credit_note->contact_person->contact_name or '' }}</td>
                                <td field-key='account_manager'>{{ $credit_note->account_manager->name or '' }}</td>
                                <td field-key='project_number'>{{ $credit_note->project_number->operation_number or '' }}</td>
                                <td field-key='invoice_number'>{{ $credit_note->invoice_number->invoice_number or '' }}</td>
                                <td field-key='bank_reference'>{{ $credit_note->bank_reference->payment_number or '' }}</td>
                                <td field-key='invoice_payment_number'>{{ $credit_note->invoice_payment_number->payment_number or '' }}</td>
                                <td field-key='credit_note_number'>{{ $credit_note->credit_note_number }}</td>
                                <td field-key='date'>{{ $credit_note->date }}</td>
                                <td field-key='status'>{{ $credit_note->status }}</td>
                                <td field-key='terms_and_conditions'>{!! $credit_note->terms_and_conditions !!}</td>
                                <td field-key='subtotal'>{{ $credit_note->subtotal }}</td>
                                <td field-key='vat'>{{ $credit_note->vat }}</td>
                                <td field-key='vat_amount'>{{ $credit_note->vat_amount }}</td>
                                <td field-key='total_amount'>{{ $credit_note->total_amount }}</td>
                                <td field-key='paid_to_date'>{{ $credit_note->paid_to_date }}</td>
                                <td field-key='balance'>{{ $credit_note->balance }}</td>
                                <td field-key='prepared_by'>{{ $credit_note->prepared_by }}</td>
                                                                <td>
                                    @can('credit_note_view')
                                    <a href="{{ route('admin.credit_notes.show',[$credit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('credit_note_edit')
                                    <a href="{{ route('admin.credit_notes.edit',[$credit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('credit_note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.credit_notes.destroy', $credit_note->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="job_cards">
<table class="table table-bordered table-striped {{ count($job_cards) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.job-cards.fields.project-number')</th>
                        <th>@lang('global.job-cards.fields.job-card-number')</th>
                        <th>@lang('global.job-cards.fields.client-type')</th>
                        <th>@lang('global.job-cards.fields.client')</th>
                        <th>@lang('global.job-cards.fields.contact-person')</th>
                        <th>@lang('global.job-cards.fields.client-vehicle-reg-no')</th>
                        <th>@lang('global.job-cards.fields.maintenance-type')</th>
                        <th>@lang('global.job-cards.fields.road-freight-number')</th>
                        <th>@lang('global.job-cards.fields.vehicle-type')</th>
                        <th>@lang('global.job-cards.fields.vehicle')</th>
                        <th>@lang('global.job-cards.fields.repair-center')</th>
                        <th>@lang('global.job-cards.fields.workshop-manager')</th>
                        <th>@lang('global.job-cards.fields.technician')</th>
                        <th>@lang('global.job-cards.fields.remarks')</th>
                        <th>@lang('global.job-cards.fields.subtotal')</th>
                        <th>@lang('global.job-cards.fields.prepared-by')</th>
                        <th>@lang('global.job-cards.fields.job-type')</th>
                        <th>@lang('global.job-cards.fields.status')</th>
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
                    <td field-key='project_number'>{{ $job_card->project_number->operation_number or '' }}</td>
                                <td field-key='job_card_number'>{{ $job_card->job_card_number }}</td>
                                <td field-key='client_type'>{{ $job_card->client_type }}</td>
                                <td field-key='client'>{{ $job_card->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $job_card->contact_person->contact_name or '' }}</td>
                                <td field-key='client_vehicle_reg_no'>{{ $job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                                <td field-key='maintenance_type'>{{ $job_card->maintenance_type }}</td>
                                <td field-key='road_freight_number'>{{ $job_card->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='vehicle_type'>{{ $job_card->vehicle_type }}</td>
                                <td field-key='vehicle'>{{ $job_card->vehicle->vehicle_type or '' }}</td>
                                <td field-key='repair_center'>{{ $job_card->repair_center->center_name or '' }}</td>
                                <td field-key='workshop_manager'>{{ $job_card->workshop_manager->name or '' }}</td>
                                <td field-key='technician'>
                                    @foreach ($job_card->technician as $singleTechnician)
                                        <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='remarks'>{!! $job_card->remarks !!}</td>
                                <td field-key='subtotal'>{{ $job_card->subtotal }}</td>
                                <td field-key='prepared_by'>{{ $job_card->prepared_by }}</td>
                                <td field-key='job_type'>{{ $job_card->job_type }}</td>
                                <td field-key='status'>{{ $job_card->status }}</td>
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
                                    <a href="{{ route('admin.job_cards.edit',[$job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('job_card_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_cards.destroy', $job_card->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="releasing">
<table class="table table-bordered table-striped {{ count($releasings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.releasing.fields.project-number')</th>
                        <th>@lang('global.releasing.fields.release-number')</th>
                        <th>@lang('global.releasing.fields.warehouse')</th>
                        <th>@lang('global.releasing.fields.client')</th>
                        <th>@lang('global.releasing.fields.contact-person')</th>
                        <th>@lang('global.releasing.fields.released-by')</th>
                        <th>@lang('global.releasing.fields.project-manager')</th>
                        <th>@lang('global.releasing.fields.date-time-received')</th>
                        <th>@lang('global.releasing.fields.area-coverd')</th>
                        <th>@lang('global.releasing.fields.prepared-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($releasings) > 0)
            @foreach ($releasings as $releasing)
                <tr data-entry-id="{{ $releasing->id }}">
                    <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                                <td field-key='release_number'>{{ $releasing->release_number }}</td>
                                <td field-key='warehouse'>{{ $releasing->warehouse->center_name or '' }}</td>
                                <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $releasing->contact_person->contact_name or '' }}</td>
                                <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                                <td field-key='project_manager'>{{ $releasing->project_manager->name or '' }}</td>
                                <td field-key='date_time_received'>{{ $releasing->date_time_received }}</td>
                                <td field-key='area_coverd'>{{ $releasing->area_coverd }}</td>
                                <td field-key='prepared_by'>{{ $releasing->prepared_by }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.releasings.restore', $releasing->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.releasings.perma_del', $releasing->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('releasing_view')
                                    <a href="{{ route('admin.releasings.show',[$releasing->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('releasing_edit')
                                    <a href="{{ route('admin.releasings.edit',[$releasing->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('releasing_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.releasings.destroy', $releasing->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="receiving">
<table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.receiving.fields.project-number')</th>
                        <th>@lang('global.receiving.fields.receipt-number')</th>
                        <th>@lang('global.receiving.fields.warehouse')</th>
                        <th>@lang('global.receiving.fields.client')</th>
                        <th>@lang('global.receiving.fields.contact-person')</th>
                        <th>@lang('global.receiving.fields.received-by')</th>
                        <th>@lang('global.receiving.fields.project-manager')</th>
                        <th>@lang('global.receiving.fields.total-area-coverd')</th>
                        <th>@lang('global.receiving.fields.prepared-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($receivings) > 0)
            @foreach ($receivings as $receiving)
                <tr data-entry-id="{{ $receiving->id }}">
                    <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                <td field-key='warehouse'>{{ $receiving->warehouse->center_name or '' }}</td>
                                <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $receiving->contact_person->contact_name or '' }}</td>
                                <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                                <td field-key='project_manager'>{{ $receiving->project_manager->name or '' }}</td>
                                <td field-key='total_area_coverd'>{{ $receiving->total_area_coverd }}</td>
                                <td field-key='prepared_by'>{{ $receiving->prepared_by }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.restore', $receiving->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('receiving_view')
                                    <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('receiving_edit')
                                    <a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('receiving_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.destroy', $receiving->id])) !!}
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
<div role="tabpanel" class="tab-pane " id="delivery_instruction">
<table class="table table-bordered table-striped {{ count($delivery_instructions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.delivery-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-instruction-number')</th>
                        <th>@lang('global.delivery-instruction.fields.driver')</th>
                        <th>@lang('global.delivery-instruction.fields.vehicle-description')</th>
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
                                <td field-key='delivery_instruction_number'>{{ $delivery_instruction->delivery_instruction_number }}</td>
                                <td field-key='driver'>{{ $delivery_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle_description'>
                                    @foreach ($delivery_instruction->vehicle_description as $singleVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVehicleDescription->vehicle_description }}</span>
                                    @endforeach
                                </td>
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
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
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
                        <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                        <th>@lang('global.loading-instruction.fields.driver')</th>
                        <th>@lang('global.loading-instruction.fields.vehicle-description')</th>
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
                                <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                <td field-key='driver'>{{ $loading_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle_description'>
                                    @foreach ($loading_instruction->vehicle_description as $singleVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVehicleDescription->vehicle_description }}</span>
                                    @endforeach
                                </td>
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
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


