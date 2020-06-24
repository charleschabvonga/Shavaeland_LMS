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
                        <a href="{{ route('admin.credit_notes.download',$credit_note->id) }}" class="btn btn btn-warning">View Sales Credit Note in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">SALES CREDIT NOTE</span></h1>
                                <h4><b>Sales Credit Note No</b>: <span style="color:red">{{ $credit_note->credit_note_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Credit Note To</b>: <span style="color:#CE8F64">{{ $credit_note->client->name or '' }}</span>
                            @if ($credit_note->client->vat != '')
                                <br><b>VAT No</b>: {{ $credit_note->client->vat or '' }}
                            @endif
                            @if ($credit_note->client->street_address != '')
                                <br><b>Address</b>: {{ $credit_note->client->street_address or '' }}
                            @endif
                            @if ($credit_note->client->city != '')
                                <br>{{ $credit_note->client->city or '' }}
                            @endif
                            @if ($credit_note->client->country != '')
                                ,{{ $credit_note->client->country or '' }}
                            @endif
                            @if ($credit_note->client->zip_code != '')
                                ,{{ $credit_note->client->zip_code or '' }}
                            @endif
                            @if ($credit_note->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $credit_note->client->phone_number_1 or '' }}
                            @endif
                             @if ($credit_note->client->fax_number != '')
                                <br><b>Fax</b>: {{ $credit_note->client->fax_number or '' }}
                            @endif
                            @if ($credit_note->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $credit_note->client->email or '' }}</span>
                            @endif
                            @if ($credit_note->client->website != '')
                                <br><b>Website</b>: {{ $credit_note->client->website or '' }}
                            @endif
                            @if ($credit_note->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $credit_note->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($credit_note->contact_person != '')
                                <br><b>Tel</b>: {{ $credit_note->contact_person->phone_number or '' }}
                            @endif
                            @if ($credit_note->contact_person != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $credit_note->contact_person->email or '' }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Date</b>: {{ $credit_note->date }}<br>

                            @if ($credit_note->refund_type != '')
                                <b>Refund Type</b>: {{ $credit_note->refund_type }}<br>
                            @endif
                            @if ($credit_note->project_number != '')
                                <b>Project No</b>: {{ $credit_note->project_number->operation_number or '' }}<br>
                            @endif
                            
                            @if ($credit_note->invoice_number != '')
                                <b>Invoice No</b>: {{ $credit_note->invoice_number->invoice_number or '' }}<br>
                            @endif
                            @if ($credit_note->bank_reference != '')
                                <b>Deposit Trans No</b>: {{ $credit_note->bank_reference->payment_number or '' }}<br>
                            @endif
                            @if ($credit_note->invoice_payment_number != '')
                                <b>Invoice Pymt No</b>: {{ $credit_note->invoice_payment_number->payment_number or '' }}<br>
                            @endif                            

                            <b>Status</b>: {{ $credit_note->status }}<br>
                            @if ($credit_note->prepared_by != '')
                                <br><b>Credited by</b>: <span style="color:#CE8F64">{{ $credit_note->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Quotation From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($credit_note->account_manager != '')
                                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $credit_note->account_manager->name or '' }}</span>
                            @endif<br>
                            @if ($credit_note->account_manager != '')
                                <b>Tel</b>: {{ $credit_note->account_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($credit_note->account_manager != '')
                                <b>Email</b>: <span style="color:blue">{{ $credit_note->account_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped " id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Credited Items</a></li>
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
                            @foreach ($credit_note->invoice_items as $item)
                            <tr id='addr0'>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td class="text-center">{{ $item->qty }} km/m<sup>2</sup> </td>
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
                                    <td class="text-right">R {{ number_format($credit_note->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT</th>
                                    <td class="text-right">{{ $credit_note->vat }}%</td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount</th>
                                    <td class="text-right">R {{ number_format($credit_note->vat_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($credit_note->total_amount, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to Date</th>
                                    <td class="text-right">{{ number_format($credit_note->paid_to_date, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-right">{{ number_format($credit_note->balance, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
                                @if ($credit_note->terms_and_conditions != '')
                                <b>Terms and conditions</b>: <br> <td field-key='terms_and_conditions'>{!! $credit_note->terms_and_conditions !!}</td>
                                @endif<br>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->                        
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#invoice_items" aria-controls="invoice_items" role="tab" data-toggle="tab">Item descriptions</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Credit note pymts</a></li>
<li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Invoice/Debit note pymts</a></li>
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
<div role="tabpanel" class="tab-pane " id="income">
<table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income.fields.payment-number')</th>
                        <th>@lang('global.income.fields.entry-date')</th>
                        <th>@lang('global.income.fields.payment-type')</th>
                        <th>@lang('global.income.fields.client')</th>
                        <th>@lang('global.income.fields.vendor')</th>
                        <th>@lang('global.income.fields.invoice-number')</th>
                        <th>@lang('global.income.fields.debit-note-number')</th>
                        <th>@lang('global.income.fields.sales-credit-note-number')</th>
                        <th>@lang('global.income.fields.deposit-transaction-number')</th>
                        <th>@lang('global.income.fields.operation-type')</th>
                        <th>@lang('global.income.fields.project-type')</th>
                        <th>@lang('global.income.fields.project-number')</th>
                        <th>@lang('global.income.fields.income-category')</th>
                        <th>@lang('global.income.fields.amount')</th>
                        <th>@lang('global.income.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($incomes) > 0)
            @foreach ($incomes as $income)
                <tr data-entry-id="{{ $income->id }}">
                    <td field-key='payment_number'>{{ $income->payment_number }}</td>
                                <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                <td field-key='payment_type'>{{ $income->payment_type }}</td>
                                <td field-key='client'>{{ $income->client->name or '' }}</td>
                                <td field-key='vendor'>{{ $income->vendor->name or '' }}</td>
                                <td field-key='invoice_number'>{{ $income->invoice_number->invoice_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $income->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='sales_credit_note_number'>{{ $income->sales_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='deposit_transaction_number'>{{ $income->deposit_transaction_number->payment_number or '' }}</td>
                                <td field-key='operation_type'>{{ $income->operation_type->name or '' }}</td>
                                <td field-key='project_type'>{{ $income->project_type->name or '' }}</td>
                                <td field-key='project_number'>{{ $income->project_number->operation_number or '' }}</td>
                                <td field-key='income_category'>{{ $income->income_category }}</td>
                                <td field-key='amount'>{{ $income->amount }}</td>
                                <td field-key='prepared_by'>{{ $income->prepared_by }}</td>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.credit_notes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
