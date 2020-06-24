@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.invoice-items.title')</h3>
    @can('invoice_item_create')
    <p>
        <a href="{{ route('admin.invoice_items.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.invoice_items.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.invoice_items.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($invoice_items) > 0 ? 'datatable' : '' }} @can('invoice_item_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('invoice_item_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.invoice-items.fields.invoice-number')</th>
                        <th>@lang('global.invoice-items.fields.bill-number')</th>
                        <th>@lang('global.invoice-items.fields.credit-note-number')</th>
                        <th>@lang('global.invoice-items.fields.debit-note-number')</th>
                        <th>@lang('global.invoice-items.fields.clearance-and-forwarding-number')</th>
                        <th>@lang('global.invoice-items.fields.quotation-number')</th>
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
                                @can('invoice_item_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='invoice_number'>{{ $invoice_item->invoice_number->invoice_number or '' }}</td>
                                <td field-key='bill_number'>{{ $invoice_item->bill_number->invoice_number or '' }}</td>
                                <td field-key='credit_note_number'>{{ $invoice_item->credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $invoice_item->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='clearance_and_forwarding_number'>{{ $invoice_item->clearance_and_forwarding_number->clearance_and_forwarding_number or '' }}</td>
                                <td field-key='quotation_number'>{{ $invoice_item->quotation_number->quotation_number or '' }}</td>
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
@stop

@section('javascript') 
    <script>
        @can('invoice_item_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.invoice_items.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection