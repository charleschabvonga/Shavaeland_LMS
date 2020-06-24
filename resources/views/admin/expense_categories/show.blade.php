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
                        <a href="{{ route('admin.expense_categories.download',$expense_category->id) }}" class="btn btn btn-warning">View Purchase Credit Note in PDF</a>
                    </p>

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">VENDOR TAX INVOICE</span></h1>
                                <h4><b>Credit Note No</b>: <span style="color:red">{{ $expense_category->credit_note_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Credit Note To</b>: <span style="color:#CE8F64">{{ $expense_category->vendor->name or '' }}</span>
                            @if ($expense_category->vendor->vat != '')
                                <br><b>VAT No</b>: {{ $expense_category->vendor->vat or '' }}
                            @endif
                            @if ($expense_category->vendor->street_address != '')
                                <br><b>Address</b>: {{ $expense_category->vendor->street_address or '' }}
                            @endif
                            @if ($expense_category->vendor->city != '')
                                <br>{{ $expense_category->vendor->city or '' }}
                            @endif
                            @if ($expense_category->vendor->country != '')
                                ,{{ $expense_category->vendor->country or '' }}
                            @endif
                            @if ($expense_category->vendor->zip_code != '')
                                ,{{ $expense_category->vendor->zip_code or '' }}
                            @endif
                            @if ($expense_category->vendor->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $expense_category->vendor->phone_number_1 or '' }}
                            @endif
                            @if ($expense_category->vendor->fax_number != '')
                                <br><b>Fax</b>: {{ $expense_category->vendor->fax_number or '' }}
                            @endif
                            @if ($expense_category->vendor->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $expense_category->vendor->email or '' }}</span>
                            @endif
                            @if ($expense_category->vendor->website != '')
                                <br><b>Website</b>: {{ $expense_category->vendor->website or '' }}
                            @endif
                            @if ($expense_category->contact_person->contact_name != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $expense_category->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($expense_category->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $expense_category->contact_person->phone_number or '' }}
                            @endif
                            @if ($expense_category->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $expense_category->contact_person->email or '' }}</span>
                            @endif<br><br>
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Entry Date</b>: {{ $expense_category->entry_date }}<br>
                            <b>Due Date</b>: {{ $expense_category->due_date }}<br>
                            <b>Status</b>: {{ $expense_category->status }}<br><br>
                            <b>Transaction type</b>: {{ $expense_category->transaction_type->name or '' }}<br>
                            <b>Transaction No</b>: {{ $expense_category->transaction_number->operation_number or '' }}<br>
                            <b>Purchase order No</b>: {{ $expense_category->purchase_order_number->purchase_order_number or '' }}<br>
                            <b>Vendor sales order No</b>: {{ $expense_category->vendor_purchase_order_number }}<br>
                            <td field-key='upload_document'>@if($expense_category->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $expense_category->upload_document) }}" target="_blank">Download file</a>@endif</td>
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Credit Note From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($expense_category->account_manager->name != '')
                                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $expense_category->account_manager->name or '' }}</span>
                            @endif<br>
                            @if ($expense_category->account_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $expense_category->account_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($expense_category->account_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $expense_category->account_manager->email or '' }}</span>
                            @endif<br><br>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped " id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Invoice items</a></li>
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
                            @foreach ($expense_category->invoice_items as $item)
                            <tr id='addr0'>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td class="text-center">{{ number_format($item->qty, 2) }}</td>
                                <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="pull-right col-md-4">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="55%">Sub Total</th>
                                    <td class="text-right">R {{ number_format($expense_category->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Discount Amount @ {{$expense_category->percent_discount}}%</th>
                                    <td class="text-right">R {{ number_format($expense_category->discount_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount @ {{$expense_category->vat}}%</th>
                                    <td class="text-right">R {{ number_format($expense_category->vat_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($expense_category->total_amount, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to Date</th>
                                    <td class="text-right">{{ number_format($expense_category->paid_to_date, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-right">{{ number_format($expense_category->balance, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
                                @if ($expense_category->terms_and_conditions != '')
                                <b>Terms and conditions</b>: <br> <td field-key='terms_and_conditions'>{!! $expense_category->terms_and_conditions !!}</td>
                                @endif<br>
                            </div>
                        </div>
                    </div>
 
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#invoice_items" aria-controls="invoice_items" role="tab" data-toggle="tab">Item descriptions</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Credit note pymts</a></li>
<li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
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
<div role="tabpanel" class="tab-pane " id="expense">
<table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.expense.fields.entry-date')</th>
                        <th>@lang('global.expense.fields.payment-type')</th>
                        <th>@lang('global.expense.fields.vendor')</th>
                        <th>@lang('global.expense.fields.client')</th>
                        <th>@lang('global.expense.fields.vendor-credit-note-number')</th>
                        <th>@lang('global.expense.fields.client-credit-note-number')</th>
                        <th>@lang('global.expense.fields.debit-note-number')</th>
                        <th>@lang('global.expense.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.expense.fields.operation-type')</th>
                        <th>@lang('global.expense.fields.transaction-type')</th>
                        <th>@lang('global.expense.fields.transaction-number')</th>
                        <th>@lang('global.expense.fields.payment-number')</th>
                        <th>@lang('global.expense.fields.expense-category')</th>
                        <th>@lang('global.expense.fields.amount')</th>
                        <th>@lang('global.expense.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($expenses) > 0)
            @foreach ($expenses as $expense)
                <tr data-entry-id="{{ $expense->id }}">
                    <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                <td field-key='payment_type'>{{ $expense->payment_type }}</td>
                                <td field-key='vendor'>{{ $expense->vendor->name or '' }}</td>
                                <td field-key='client'>{{ $expense->client->name or '' }}</td>
                                <td field-key='vendor_credit_note_number'>{{ $expense->vendor_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='client_credit_note_number'>{{ $expense->client_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $expense->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $expense->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='operation_type'>{{ $expense->operation_type->name or '' }}</td>
                                <td field-key='transaction_type'>{{ $expense->transaction_type->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $expense->transaction_number->operation_number or '' }}</td>
                                <td field-key='payment_number'>{{ $expense->payment_number }}</td>
                                <td field-key='expense_category'>{{ $expense->expense_category }}</td>
                                <td field-key='amount'>{{ $expense->amount }}</td>
                                <td field-key='prepared_by'>{{ $expense->prepared_by }}</td>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.expense_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
