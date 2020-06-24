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
                                <h1><span style="color:#CE8F64">PAYSLIP PAYMENT</span></h1>
                                <h4><b>Payslip pymt No</b>: <span style="color:red">{{ $payee_payment->payee_payment_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Payment made by</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
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
                            @if ($payee_payment->employee != '')
                                <h4><b>Employee</b>: <span style="color:#CE8F64">{{ $payee_payment->employee->name or '' }}</span></h4>
                            @endif                           
                            @if ($payee_payment->entry_date != '')
                                <b>Date</b>: {{ $payee_payment->entry_date }}<br>
                            @endif
                            @if ($payee_payment->payslip_number != '')
                                <b>Payslip No</b>: {{ $payee_payment->payslip_number->payslip_number or '' }}<br>
                            @endif
                            @if ($payee_payment->batch_number != '')
                                <b>Batch No.</b>: {{ $payee_payment->batch_number->batch_number or '' }}<br>
                            @endif
                            @if ($payee_payment->withdrawal_transaction_number != '')
                                <b>Batch deposit No</b>: {{ $payee_payment->withdrawal_transaction_number->payment_number or '' }}<br>
                            @endif
                            @if ($payee_payment->payee_account_number != '')
                                <b>Employee account No</b>: {{ $payee_payment->payee_account_number->account_number or '' }}<br>
                            @endif
                            @if ($payee_payment->payment_mode != '')
                                <b>Payment type</b>: {{ $payee_payment->payment_mode }}<br>
                            @endif
                            @if ($payee_payment->prepared_by != '')
                                <br><b>Processed by</b>: {{ $payee_payment->prepared_by }}
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            <br><h3><span style="color:#CE8F64"><b>Amount</b>: R {{ number_format($payee_payment->amount ,2) }}</spam></h3>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.payee_payments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
