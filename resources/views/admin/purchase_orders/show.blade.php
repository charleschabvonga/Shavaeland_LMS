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
                    <a href="{{ route('admin.purchase_orders.download',$purchase_order->id) }}" class="btn btn btn-warning">View Purchase Order in PDF</a>
                </p>

                <div class="row">
                    @if (config('invoices.logo_file') != '')
                        <div class="col-md-12 text-center">
                            <img src="{{ config('invoices.logo_file') }}" /><br><br>
                            <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                            <h1><span style="color:#CE8F64">PURCHASE ORDER</span></h1>
                            <h4><b>Purchase Order No</b>: <span style="color:red">{{ $purchase_order->purchase_order_number }}</span></h4>
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-4 ">
                        <b>Purchase_order To</b>: <span style="color:#CE8F64">{{ $purchase_order->vendor->name or '' }}</span>
                        @if ($purchase_order->vendor->street_address != '')
                            <br><b>Address</b>: {{ $purchase_order->vendor->street_address or '' }}
                        @endif
                        @if ($purchase_order->vendor->city != '')
                            <br>{{ $purchase_order->vendor->city or '' }}
                        @endif
                        @if ($purchase_order->vendor->country != '')
                            , {{ $purchase_order->vendor->country or '' }}
                        @endif
                        @if ($purchase_order->vendor->zip_code != '')
                            ,{{ $purchase_order->vendor->zip_code or '' }}
                        @endif
                        @if ($purchase_order->vendor->phone_number_1 != '')
                            <br><b>Tel</b>: {{ $purchase_order->vendor->phone_number_1 or '' }}
                        @endif
                            @if ($purchase_order->vendor->fax_number != '')
                            <br><b>Fax</b>: {{ $purchase_order->vendor->fax_number or '' }}
                        @endif
                        @if ($purchase_order->vendor->email != '')
                            <br><b>Email</b>: <span style="color:blue">{{ $purchase_order->vendor->email or '' }}</span>
                        @endif
                        @if ($purchase_order->vendor->website != '')
                            <br><b>Website</b>: {{ $purchase_order->vendor->website or '' }}
                        @endif
                        @if ($purchase_order->contact_person->contact_name != '')
                            <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $purchase_order->contact_person->contact_name or '' }}</span>
                        @endif
                        @if ($purchase_order->contact_person->phone_number != '')
                            <br><b>Tel</b>: {{ $purchase_order->contact_person->phone_number or '' }}
                        @endif
                        @if ($purchase_order->contact_person->email != '')
                            <br><b>Email</b>: {{ $purchase_order->contact_person->email or '' }}
                        @endif
                    </div>
                    
                    <div class="col-xs-4 form-group text-center">
                        <b>Date</b>: {{ $purchase_order->date }}<br>
                        <b>Status</b>: {{ $purchase_order->status }}
                        @if ($purchase_order->quotation_number != '')
                            <br><b>Quotation No</b>: {{ $purchase_order->quotation_number }}
                        @endif
                        @if ($purchase_order->prepared_by != '')
                            <br><br><b>Processed by</b>: <span style="color:#CE8F64">{{ $purchase_order->prepared_by }}</span>
                        @endif
                        @if ($purchase_order->requested_by != '')
                            <br><b>Requested by</b>: <span style="color:#CE8F64">{{ $purchase_order->requested_by }}</span>
                        @endif
                        @if ($purchase_order->request_date != '')
                            <br><b>Requested date</b>: <span style="color:#CE8F64">{{ $purchase_order->request_date }}</span>
                        @endif
                        <br><b>HOD</b>: {{ Form::checkbox("hod", 1, $purchase_order->hod == 1 ? true : false, ["disabled"]) }}
                        <b>GM</b>: {{ Form::checkbox("gm", 1, $purchase_order->gm == 1 ? true : false, ["disabled"]) }}
                        <b>Accounts</b>: {{ Form::checkbox("accounts", 1, $purchase_order->accounts == 1 ? true : false, ["disabled"]) }}
                    </div>

                    <div class="col-xs-4 form-group text-right">
                        <b>purchase_order From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                        <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                        <b></b> {{ config('invoices.seller.city') }},
                        <b></b> {{ config('invoices.seller.country') }},
                        <b></b> {{ config('invoices.seller.postal_code') }}<br>
                        <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                        <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                        <b>Email</b>: {{ config('invoices.sales.email') }}<br>
                        <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                        @if ($purchase_order->buyer->name != '')
                            <b>Buyer</b>: <span style="color:#CE8F64">{{ $purchase_order->buyer->name or '' }}</span>
                        @endif<br>
                        @if ($purchase_order->buyer->sa_mobile != '')
                            <b>Tel</b>: {{ $purchase_order->buyer->sa_mobile or '' }}
                        @endif<br>
                        @if ($purchase_order->buyer->email != '')
                            <b>Email</b>: {{ $purchase_order->buyer->email or '' }}
                        @endif
                    </div>
                </div>
                <br>
                <table class="table table-bordered table-striped " id="tab_logic">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a role="tab" data-toggle="tab">Quatation Items</a></li>
                    </ul>
                    <thead>
                    <tr>
                        <th class="text-center">@lang('#')</th>
                        <th>@lang('global.invoice-items.fields.item-description')</th>
                        <th class="text-center" width="15%">@lang('global.invoice-items.fields.qty')</th>
                        <th class="text-right" width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                        <th class="text-right" width="15%">@lang('global.invoice-items.fields.total')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase_order->invoice_items as $item)
                        <tr id='addr0'>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->item_description }}</td>
                            <td class="text-center">{{ $item->qty }} {{ $item->unit }} </td>
                            <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                            <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="row">
                    <div class="pull-right col-md-3">
                        <table class="table">
                            <tr>
                                <th class="text-right" width="50%">Sub Total</th>
                                <td class="text-right">R {{ number_format($purchase_order->subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right">VAT @ {{ $purchase_order->vat }}%</th>
                                <td class="text-right">R {{ number_format($purchase_order->vat_amount, 2) }}</td>
                            </tr>
                            <tr>
                                <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                                <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($purchase_order->total_amount, 2) }}</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div><!-- Nav tabs --> 
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#invoice_items" aria-controls="invoice_items" role="tab" data-toggle="tab">Item descriptions</a></li>
<li role="presentation" class=""><a href="#expense_category" aria-controls="expense_category" role="tab" data-toggle="tab">Purchase credit notes</a></li>
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
                <td colspan="16">@lang('global.app_no_entries_in_table')</td>
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
                <td colspan="25">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.purchase_orders.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
