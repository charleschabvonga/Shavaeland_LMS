@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">

            <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">OUTBOUND DEPOSIT</span></h1>
                                <h4><b>Deposit No</b>: <span style="color:red">{{ $vendor_bank_payment->payment_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if (($vendor_bank_payment->client != '' || $vendor_bank_payment->vendor == '') && $vendor_bank_payment->withdrawer == 'Client')
                                <h4><b>Client</b>: <span style="color:#CE8F64">{{ $vendor_bank_payment->client->name or '' }}</span></h4>
                            @endif
                            @if (($vendor_bank_payment->client == '' || $vendor_bank_payment->vendor != '') && $vendor_bank_payment->withdrawer == 'Vendor')
                                <h4><b>Vendor</b>: <span style="color:#CE8F64">{{ $vendor_bank_payment->vendor->name or '' }}</span></h4>
                            @endif
                            @if ($vendor_bank_payment->prepared_by != '')
                                <b>Processed by</b>: {{ $vendor_bank_payment->prepared_by }}
                            @endif
                        </div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($vendor_bank_payment->account_number != '')
                                <b>Account No</b>: {{ $vendor_bank_payment->account_number->account_number or '' }}
                            @endif
                            @if ($vendor_bank_payment->client_account_number != '')
                                <b>Account No</b>: {{ $vendor_bank_payment->client_account_number->account_number or '' }}
                            @endif
                            @if ($vendor_bank_payment->entry_date != '')
                                <br><b>Entry date</b>: {{ $vendor_bank_payment->entry_date }}
                            @endif
                            @if ($vendor_bank_payment->payment_mode != '')
                                <br><b>Bank payment mode</b>: {{ $vendor_bank_payment->payment_mode }}
                            @endif
                            @if ($vendor_bank_payment->upload_document != '')
                                <br><b>File</b>: <a href="{{ asset(env('UPLOAD_PATH').'/' . $vendor_bank_payment->upload_document) }}" target="_blank">Download file</a>
                            @endif
                            @if ($vendor_bank_payment->credit_note_number != '')
                                <br><b>Refund reference No</b>: {{ $vendor_bank_payment->credit_note_number->credit_note_number or '' }}
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            <h3><span style="color:#CE8F64"><b>Amount</b>: R {{ number_format($vendor_bank_payment->amount ,2) }}</spam></h3>
                            <h4><b>Balance</b>: R {{ number_format($vendor_bank_payment->balance, 2) }}</h4>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#payee_payments" aria-controls="payee_payments" role="tab" data-toggle="tab">Payslip payments</a></li>
<li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Credit note pymts</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="payee_payments">
<table class="table table-bordered table-striped {{ count($payee_payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.payee-payments.fields.entry-date')</th>
                        <th>@lang('global.payee-payments.fields.employee')</th>
                        <th>@lang('global.payee-payments.fields.payslip-number')</th>
                        <th>@lang('global.payee-payments.fields.batch-number')</th>
                        <th>@lang('global.payee-payments.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.payee-payments.fields.payee-account-number')</th>
                        <th>@lang('global.payee-payments.fields.payee-payment-number')</th>
                        <th>@lang('global.payee-payments.fields.payment-mode')</th>
                        <th>@lang('global.payee-payments.fields.amount')</th>
                        <th>@lang('global.payee-payments.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($payee_payments) > 0)
            @foreach ($payee_payments as $payee_payment)
                <tr data-entry-id="{{ $payee_payment->id }}">
                    <td field-key='entry_date'>{{ $payee_payment->entry_date }}</td>
                                <td field-key='employee'>{{ $payee_payment->employee->name or '' }}</td>
                                <td field-key='payslip_number'>{{ $payee_payment->payslip_number->payslip_number or '' }}</td>
                                <td field-key='batch_number'>{{ $payee_payment->batch_number->batch_number or '' }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $payee_payment->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='payee_account_number'>{{ $payee_payment->payee_account_number->account_number or '' }}</td>
                                <td field-key='payee_payment_number'>{{ $payee_payment->payee_payment_number }}</td>
                                <td field-key='payment_mode'>{{ $payee_payment->payment_mode }}</td>
                                <td field-key='amount'>{{ $payee_payment->amount }}</td>
                                <td field-key='prepared_by'>{{ $payee_payment->prepared_by }}</td>
                                                                <td>
                                    @can('payee_payment_view')
                                    <a href="{{ route('admin.payee_payments.show',[$payee_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payee_payment_edit')
                                    <a href="{{ route('admin.payee_payments.edit',[$payee_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payee_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payee_payments.destroy', $payee_payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.vendor_bank_payments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
