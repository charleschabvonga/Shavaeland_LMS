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
                                @if ($income->payment_type == 'Invoice pymt')
                                    <h1><span style="color:#CE8F64">INVOICE PAYMENT</span></h1>
                                    <h4><b>Invoice pymt No</b>: <span style="color:red">{{ $income->payment_number }}</span></h4>
                                @endif
                                @if ($income->payment_type == 'Invoice & credit note pymt')
                                    <h1><span style="color:#CE8F64">DEBIT NOTE PAYMENT</span></h1>
                                    <h4><b>Invoice & credit note pymt No</b>: <span style="color:red">{{ $income->payment_number }}</span></h4>
                                @endif
                                @if ($income->payment_type == 'Refund account credit')
                                    <h1><span style="color:#CE8F64">ADVANCE PAYMENT</span></h1>
                                    <h4><b>Refund account credit No</b>: <span style="color:red">{{ $income->payment_number }}</span></h4>
                                @endif
                                @if ($income->payment_type == 'Refund cashback')
                                    <h1><span style="color:#CE8F64">ADVANCE PAYMENT</span></h1>
                                    <h4><b>Refund cashback No</b>: <span style="color:red">{{ $income->payment_number }}</span></h4>
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
                            @if ($income->client != '')
                                <h4><b>Client</b>: <span style="color:#CE8F64">{{ $income->client->name or '' }}</span></h4>
                            @endif                           
                            @if ($income->vendor != '')
                                <h4><b>Vendor</b>: <span style="color:#CE8F64">{{ $income->vendor->name or '' }}</span></h4>
                            @endif
                            @if ($income->invoice_number != '')
                                <b>Invoice No</b>: {{ $income->invoice_number->invoice_number or '' }}<br>
                            @endif
                            @if ($income->debit_note_number != '')
                                <b>Debit note No</b>: {{ $income->debit_note_number->debit_note_number or '' }}<br>
                            @endif
                            <!--@if ($income->deposit_transaction_number != '')
                                <b>Deposit tran No</b>: {{ $income->deposit_transaction_number->payment_number or '' }}<br>
                            @endif
                            @if ($income->operation_type != '')
                                <b>Operation type</b>: {{ $income->operation_type->name or '' }}<br>
                            @endif
                            @if ($income->project_type != '')
                                <b>Work type</b>: {{ $income->project_type->name or '' }}<br>
                            @endif
                            @if ($income->deposit_transaction_number != '')
                                <b>Operation No</b>: {{ $income->project_number->operation_number or '' }}<br>
                            @endif-->
                            @if ($income->income_category != '')
                                <b>Payment for</b>: {{ $income->income_category }}<br>
                            @endif
                            @if ($income->entry_date != '')
                                <b>Entry date</b>: {{ $income->entry_date }}<br>
                            @endif
                            @if ($income->prepared_by != '')
                                <br><b>Processed by</b>: {{ $income->prepared_by }}
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            <br><h3><span style="color:#CE8F64"><b>Amount</b>: R {{ number_format($income->amount ,2) }}</spam></h3>
                            <!--@if ($income->payment_type == 'Invoice')
                                <h4><b>Invoice Balance</b>: R {{ number_format($income->inv_balance, 2) }}</h4><br>
                            @endif
                            @if ($income->payment_type == 'Debit note')
                                <h4><b>Invoice Balance</b>: R {{ number_format($income->inv_balance, 2) }}</h4><br>
                            @endif
                            @if ($income->payment_type == 'Advance pymt')
                                <h4><b>Invoice Balance</b>: R {{ number_format($income->inv_balance, 2) }}</h4><br>
                            @endif-->
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Sales credit notes</a></li>
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.incomes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
