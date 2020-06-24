@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clearance-and-forwarding.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.project-number')</th>
                            <td field-key='project_number'>{{ $clearance_and_forwarding->project_number->operation_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.clearance-and-forwarding-number')</th>
                            <td field-key='clearance_and_forwarding_number'>{{ $clearance_and_forwarding->clearance_and_forwarding_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.border-post')</th>
                            <td field-key='border_post'>{{ $clearance_and_forwarding->border_post }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.client')</th>
                            <td field-key='client'>{{ $clearance_and_forwarding->client->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.contact-person')</th>
                            <td field-key='contact_person'>{{ $clearance_and_forwarding->contact_person->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.agent')</th>
                            <td field-key='agent'>{{ $clearance_and_forwarding->agent->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.agent-contact')</th>
                            <td field-key='agent_contact'>{{ $clearance_and_forwarding->agent_contact->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.clearance-and-forwarding.fields.project-manager')</th>
                            <td field-key='project_manager'>{{ $clearance_and_forwarding->project_manager->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#invoice_items" aria-controls="invoice_items" role="tab" data-toggle="tab">Item descriptions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="invoice_items">
<table class="table table-bordered table-striped {{ count($invoice_items) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.invoice-items.fields.item-description')</th>
                        <th>@lang('global.invoice-items.fields.unit-price')</th>
                        <th>@lang('global.invoice-items.fields.qty')</th>
                        <th>@lang('global.invoice-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($invoice_items) > 0)
            @foreach ($invoice_items as $invoice_item)
                <tr data-entry-id="{{ $invoice_item->id }}">
                    <td field-key='item_description'>{{ $invoice_item->item_description }}</td>
                                <td field-key='unit_price'>{{ $invoice_item->unit_price }}</td>
                                <td field-key='qty'>{{ $invoice_item->qty }}</td>
                                <td field-key='total'>{{ $invoice_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.invoice_items.restore', $invoice_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.invoice_items.perma_del', $invoice_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('invoice_item_view')
                                    <a href="{{ route('admin.invoice_items.show',[$invoice_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('invoice_item_edit')
                                    <a href="{{ route('admin.invoice_items.edit',[$invoice_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('invoice_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.invoice_items.destroy', $invoice_item->id])) !!}
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.clearance_and_forwardings.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


