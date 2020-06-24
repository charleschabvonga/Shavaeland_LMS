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
                        <a href="{{ route('admin.income_categories.download',$income_category->id) }}" class="btn btn btn-warning">View Tax Invoice in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">TAX INVOICE</span></h1>
                                <h4><b>Tax Invoice No</b>: <span style="color:red">{{ $income_category->invoice_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Tax Invoice To</b>: <span style="color:#CE8F64">{{ $income_category->client->name or '' }}</span>
                            @if ($income_category->client->vat != '')
                                <br><b>VAT No</b>: {{ $income_category->client->vat or '' }}
                            @endif
                            @if ($income_category->client->street_address != '')
                                <br><b>Address</b>: {{ $income_category->client->street_address or '' }}
                            @endif
                            @if ($income_category->client->city != '')
                                <br>{{ $income_category->client->city or '' }}
                            @endif
                            @if ($income_category->client->country != '')
                                ,{{ $income_category->client->country or '' }}
                            @endif
                            @if ($income_category->client->zip_code != '')
                                ,{{ $income_category->client->zip_code or '' }}
                            @endif
                            @if ($income_category->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $income_category->client->phone_number_1 or '' }}
                            @endif
                             @if ($income_category->client->fax_number != '')
                                <br><b>Fax</b>: {{ $income_category->client->fax_number or '' }}
                            @endif
                            @if ($income_category->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $income_category->client->email or '' }}</span>
                            @endif
                            @if ($income_category->client->website != '')
                                <br><b>Website</b>: {{ $income_category->client->website or '' }}
                            @endif
                            @if ($income_category->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $income_category->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($income_category->contact_person != '' && $income_category->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $income_category->contact_person->phone_number or '' }}
                            @endif
                            @if ($income_category->contact_person != '' && $income_category->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $income_category->contact_person->email or '' }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">                            
                            @if ($income_category->project_type != '')
                                <b>Project type</b>: {{ $income_category->project_type->name or '' }}<br>
                            @endif
                            @if ( $income_category->project_number->operation_number != '')
                                <b>Project No</b>: {{ $income_category->project_number->operation_number or '' }}
                            @endif
                            @if ($income_category->quotation_number != '')
                                <br><b>Quotation No</b>: {{ $income_category->quotation_number->quotation_number or '' }}
                            @endif
                            @if ($income_category->sales_order_number != '')
                                <br><b>Sales order No</b>: {{ $income_category->sales_order_number }}
                            @endif
                            @if ($income_category->entry_date != '')
                                <br><b>Invoice date</b>: {{ $income_category->entry_date }}
                            @endif
                            @if ($income_category->due_date != '')
                                <br><b>Due date</b>: {{ $income_category->due_date }}
                            @endif
                            <br><b>Status</b>: {{ $income_category->status }}<br>
                            @if ($income_category->prepared_by != '')
                                <br><b>Invoiced by</b>: <span style="color:#CE8F64">{{ $income_category->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Tax Invoice From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($income_category->account_manager != '')
                                <b>Account Manager</b>: <span style="color:#CE8F64">{{ $income_category->account_manager->name or '' }}</span>
                            @endif<br>
                            @if ($income_category->account_manager != '' && $income_category->account_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $income_category->account_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($income_category->account_manager != '' && $income_category->account_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $income_category->account_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>
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
                            @foreach ($income_category->invoice_items as $item)
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
                        <div class="pull-right col-md-4">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="55%">Sub Total</th>
                                    <td class="text-right">R {{ number_format($income_category->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Discount Amount @ {{$income_category->percent_discount}}%</th>
                                    <td class="text-right">R {{ number_format($income_category->discount_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount @ {{$income_category->vat}}%</th>
                                    <td class="text-right">R {{ number_format($income_category->vat_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($income_category->total_amount, 2) }}</span></td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to Date</th>
                                    <td class="text-right">R {{ number_format($income_category->paid_to_date, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-right">R {{ number_format($income_category->balance, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
                                <br>
                                <b>Account Name</b>: <span style="color:#CE8F64">{{ config('invoices.bank.name') }}</span><br>
                                <b>Bank Name</b>: {{ config('invoices.bank.bank') }}<br>
                                <b>Branch</b>: {{ config('invoices.bank.branch') }}<br>
                                <b>Branch Code</b>: {{ config('invoices.bank.code') }}<br>
                                <b>Account No</b>: {{ config('invoices.bank.account') }}<br>
                            </div>
                        </div>
                    </div>
                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Invoice pymts</a></li>
<li role="presentation" class=""><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Sales credit notes</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="income">
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
                        <!--a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                        @endcan
                        @can('income_delete')
                        <!--{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.incomes.destroy', $income->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
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
                        <!--a href="{{ route('admin.credit_notes.edit',[$credit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                        @endcan
                        @can('credit_note_delete')
                        <!--{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.credit_notes.destroy', $credit_note->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.income_categories.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
