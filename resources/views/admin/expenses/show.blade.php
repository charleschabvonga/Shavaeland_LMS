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
                                @if ($expense->payment_type == 'Vendor tax invoice pymt')
                                    <h1><span style="color:#CE8F64">VENDOR TAX INVOICE PYMT</span></h1>
                                    <h4><b>Vendor tax invoice pymt No</b>: <span style="color:red">{{ $expense->payment_number }}</span></h4>
                                @endif
                                @if ($expense->payment_type == 'Purchase credit note & debit note pymt')
                                    <h1><span style="color:#CE8F64">PURCHASE CREDIT & DEBIT NOTE PYMT</span></h1>
                                    <h4><b>Purchase credit note & debit note pymt No</b>: <span style="color:red">{{ $expense->payment_number }}</span></h4>
                                @endif
                                @if ($expense->payment_type == 'Refund account credit')
                                    <h1><span style="color:#CE8F64">REFUND ACCOUNT CREDIT</span></h1>
                                    <h4><b>Refund credit No</b>: <span style="color:red">{{ $expense->payment_number }}</span></h4>
                                @endif
                                @if ($expense->payment_type == 'Refund cashback')
                                    <h1><span style="color:#CE8F64">REFUND CASHBACK</span></h1>
                                    <h4><b>Refund Pymt No</b>: <span style="color:red">{{ $expense->payment_number }}</span></h4>
                                @endif
                                @if ($expense->payment_type == 'Salaries')
                                    <h1><span style="color:#CE8F64">SALARIES PYMT</span></h1>
                                    <h4><b>Salary Pymt No</b>: <span style="color:red">{{ $expense->payment_number }}</span></h4>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Payment Made to</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.accounts.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                        </div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($expense->client != '')
                                <h4><b>Client</b>: <span style="color:#CE8F64">{{ $expense->client->name or '' }}</span></h4>
                            @endif                           
                            @if ($expense->vendor != '')
                                <h4><b>Vendor</b>: <span style="color:#CE8F64">{{ $expense->vendor->name or '' }}</span></h4>
                            @endif
                            @if ($expense->vendor_credit_note_number != '')
                                <b>Purchase Credit Note No</b>: {{ $expense->vendor_credit_note_number->credit_note_number or '' }}<br>
                            @endif
                            @if ($expense->client_credit_note_number != '')
                                <b>Sales Credit Note No</b>: {{ $expense->client_credit_note_number->credit_note_number or '' }}<br>
                            @endif
                            @if ($expense->debit_note_number != '')
                                <b>Debit Note No</b>: {{ $expense->debit_note_number->debit_note_number or '' }}<br>
                            @endif
                            <!--@if ($expense->withdrawal_transaction_number != '')
                                <b>Deposit Trans No</b>: {{ $expense->withdrawal_transaction_number->payment_number or '' }}<br>
                            @endif

                            @if ($expense->operation_type != '')
                                <b>Operation type</b>: {{ $expense->operation_type->name or '' }}<br>
                            @endif

                            @if ($expense->transaction_type != '')
                                <b>Work type</b>: {{ $expense->transaction_type->name or '' }}<br>
                            @endif
                            @if ($expense->transaction_number != '')
                                <b>Operation No</b>: {{ $expense->transaction_number->operation_number or '' }}<br>
                            @endif-->
                            @if ($expense->expense_category != '')
                                <b>Payment for</b>: {{ $expense->expense_category }}<br>
                            @endif
                            @if ($expense->entry_date != '')
                                <b>Entry date</b>: {{ $expense->entry_date }}<br>
                            @endif
                            @if ($expense->prepared_by != '')
                                <br><b>Processed by</b>: {{ $expense->prepared_by }}
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            <br><h3><span style="color:#CE8F64"><b>Amount</b>: R {{ number_format($expense->amount ,2) }}</spam></h3>
                            <!--@if ($expense->payment_type == 'Purchase credit note')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif
                            @if ($expense->payment_type == 'Sales credit note')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif
                            @if ($expense->payment_type == 'Refund account credit')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif
                            @if ($expense->payment_type == 'Refund cash back')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif
                            @if ($expense->payment_type == 'Advance pymt cash back')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif
                            @if ($expense->payment_type == 'Salary pymts')
                                <h4><b>Credit Note Balance</b>: R {{ number_format($expense->balance, 2) }}</h4><br>
                            @endif-->
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="debit_notes">
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

            <a href="{{ route('admin.expenses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
