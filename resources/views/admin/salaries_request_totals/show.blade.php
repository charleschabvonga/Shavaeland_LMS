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
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">MONTHLY PAYSLIP BATCHES</span></h1>
                                <h4><b>Batch No</b>: <span style="color:red">{{ $salaries_request_total->batch_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($salaries_request_total->starting_pay_date != '')
                                <b>Opening date</b>: {{ $salaries_request_total->starting_pay_date }}<br>
                            @endif
                            @if ($salaries_request_total->ending_pay_date != '')
                                <b>Closing date</b>: {{ $salaries_request_total->ending_pay_date }}<br>
                            @endif
                            @if ($salaries_request_total->status != '')
                                <b>Status</b>: {{ $salaries_request_total->status }}<br>
                            @endif
                            
                                <b>Available balance</b>: {{ $salaries_request_total->available_balance }}<br>
                            
                        </div>
                        <div class="col-xs-4 form-group text-right"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PAYSLIPS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Payslip No.')</th>
                                            <th>@lang('Employee')</th>
                                            <th>@lang('Batch No.')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Net income')</th>
                                            <th>@lang('Paid to date')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($salaries_request_total->payslips) > 0)
                                                @foreach ($salaries_request_total->payslips as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->date }}</td>
                                                        <td class="text-left">{{ $item->payslip_number }}</td>
                                                        <td class="text-left">{{ $item->employee->name or '' }}</td>
                                                        <td class="text-left">{{ $item->batch_number->batch_number or '' }}</td>
                                                        <td class="text-left">{{ $item->status }}</td>
                                                        <td class="text-left">R {{ number_format($item->net_income, 2) }}</td>
                                                        <td class="text-left">R {{ number_format($item->paid_to_date, 2) }}</td>
                                                        <td class="text-left">R {{ number_format($item->balance, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5">TOTALS:</th>
                                                <th>R {{ number_format($salaries_request_total->net_income_total, 2) }}</th>
                                                <th>R {{ number_format($salaries_request_total->paid_to_date_total, 2) }}</th>
                                                <th>R {{ number_format($salaries_request_total->balance_total, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PAYSLIPS PAYMENTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Payslip No.')</th>
                                            <th>@lang('Payment No.')</th>
                                            <th>@lang('Payment type')</th>
                                            <th>@lang('Amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($salaries_request_total->payslip_payments) > 0)
                                                @foreach ($salaries_request_total->payslip_payments as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->entry_date }}</td>
                                                        <td class="text-left">{{ $item->payslip_number->payslip_number or '' }}</td>
                                                        <td class="text-left">{{ $item->payee_payment_number }}</td>
                                                        <td class="text-left">{{ $item->payment_mode }}</td>
                                                        <td class="text-left">R {{ number_format($item->amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="4">TOTALS:</th>
                                                <th>R {{ number_format($salaries_request_total->amount_total, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div-->
                    
                </div>
            </div><!-- Nav tabs --> 
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#payslips" aria-controls="payslips" role="tab" data-toggle="tab">Payslips</a></li>
<li role="presentation" class=""><a href="#payee_payments" aria-controls="payee_payments" role="tab" data-toggle="tab">Payslip payments</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="payslips">
<table class="table table-bordered table-striped {{ count($payslips) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.payslips.fields.date')</th>
                        <th>@lang('global.payslips.fields.employee')</th>
                        <th>@lang('global.payslips.fields.batch-number')</th>
                        <th>@lang('global.payslips.fields.account-number')</th>
                        <th>@lang('global.payslips.fields.payslip-number')</th>
                        <th>@lang('global.payslips.fields.status')</th>
                        <th>@lang('global.payslips.fields.overtime-and-bonus-total')</th>
                        <th>@lang('global.payslips.fields.deductions-total')</th>
                        <th>@lang('global.payslips.fields.gross')</th>
                        <th>@lang('global.payslips.fields.income-tax')</th>
                        <th>@lang('global.payslips.fields.income-tax-amount')</th>
                        <th>@lang('global.payslips.fields.net-income')</th>
                        <th>@lang('global.payslips.fields.paid-to-date')</th>
                        <th>@lang('global.payslips.fields.balance')</th>
                        <th>@lang('global.payslips.fields.prepared-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($payslips) > 0)
            @foreach ($payslips as $payslip)
                <tr data-entry-id="{{ $payslip->id }}">
                    <td field-key='date'>{{ $payslip->date }}</td>
                                <td field-key='employee'>{{ $payslip->employee->name or '' }}</td>
                                <td field-key='batch_number'>{{ $payslip->batch_number->batch_number or '' }}</td>
                                <td field-key='account_number'>{{ $payslip->account_number->account_number or '' }}</td>
                                <td field-key='payslip_number'>{{ $payslip->payslip_number }}</td>
                                <td field-key='status'>{{ $payslip->status }}</td>
                                <td field-key='overtime_and_bonus_total'>{{ $payslip->overtime_and_bonus_total }}</td>
                                <td field-key='deductions_total'>{{ $payslip->deductions_total }}</td>
                                <td field-key='gross'>{{ $payslip->gross }}</td>
                                <td field-key='income_tax'>{{ $payslip->income_tax }}</td>
                                <td field-key='income_tax_amount'>{{ $payslip->income_tax_amount }}</td>
                                <td field-key='net_income'>{{ $payslip->net_income }}</td>
                                <td field-key='paid_to_date'>{{ $payslip->paid_to_date }}</td>
                                <td field-key='balance'>{{ $payslip->balance }}</td>
                                <td field-key='prepared_by'>{{ $payslip->prepared_by }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.restore', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.perma_del', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('payslip_view')
                                    <a href="{{ route('admin.payslips.show',[$payslip->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payslip_edit')
                                    <a href="{{ route('admin.payslips.edit',[$payslip->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payslip_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.destroy', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
<div role="tabpanel" class="tab-pane " id="payee_payments">
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.salaries_request_totals.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
