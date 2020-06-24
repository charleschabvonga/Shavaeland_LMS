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
                                <h1><span style="color:#CE8F64">INBOUND DEPOSIT</span></h1>
                                <h4><b>Deposit No</b>: <span style="color:red">{{ $bank_payment->payment_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if (($bank_payment->client != '' || $bank_payment->vendor == '') && $bank_payment->depositor == 'Client')
                                <h4><b>Client</b>: <span style="color:#CE8F64">{{ $bank_payment->client->name or '' }}</span></h4>
                            @endif
                            @if (($bank_payment->client == '' || $bank_payment->vendor != '') && $bank_payment->depositor == 'Vendor')
                                <h4><b>Vendor</b>: <span style="color:#CE8F64">{{ $bank_payment->vendor->name or '' }}</span></h4>
                            @endif
                            @if ($bank_payment->prepared_by != '')
                                <b>Processed by</b>: {{ $bank_payment->prepared_by }}
                            @endif
                        </div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($bank_payment->account_number != '')
                                <b>Account No</b>: {{ $bank_payment->account_number->account_number or '' }}
                            @endif
                            @if ($bank_payment->client_account_number != '')
                                <b>Account No</b>: {{ $bank_payment->client_account_number->account_number or '' }}
                            @endif
                            @if ($bank_payment->entry_date != '')
                                <br><b>Entry date</b>: {{ $bank_payment->entry_date }}
                            @endif
                            @if ($bank_payment->payment_mode != '')
                                <br><b>Bank payment mode</b>: {{ $bank_payment->payment_mode }}
                            @endif
                            @if ($bank_payment->upload_document != '')
                                <br><b>File</b>: <a href="{{ asset(env('UPLOAD_PATH').'/' . $bank_payment->upload_document) }}" target="_blank">Download file</a>
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            <b>Amount deposited</b>: R {{ number_format($bank_payment->amount ,2) }}<br>
                            <b>Deposit balance</b>: R {{ number_format($bank_payment->balance, 2) }}<br>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Sales credit notes</a></li>
<li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Invoice/Debit note pymts</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="credit_note">
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

            <a href="{{ route('admin.bank_payments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
