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
                                <h1><span style="color:#CE8F64">PAYSLIP</span></h1>
                                <h4><b>Payslip No</b>: <span style="color:red">{{ $payslip->payslip_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Payslip To</b>: <span style="color:#CE8F64">{{ $payslip->account_number->employee->name or '' }}</span>
                            @if ($payslip->employee->position != '')
                                <br><b>Position</b>: {{ $payslip->employee->position or '' }}
                            @endif
                            @if ($payslip->account_number->account_number != '')
                                <br><b>Department</b>: {{ $payslip->account_number->department->dept_name or '' }}
                            @endif
                            @if ($payslip->employee->street_address != '')
                                <br><b>Address</b>: {{ $payslip->account_number->employee->street_address or '' }}
                            @endif
                            @if ($payslip->employee->city != '')
                                <br>{{ $payslip->account_number->employee->city or '' }}
                            @endif
                            @if ($payslip->employee->country != '')
                                ,{{ $payslip->employee->country or '' }}
                            @endif
                            @if ($payslip->employee->sa_mobile != '')
                                <br><b>Tel</b>: {{ $payslip->employee->sa_mobile or '' }}
                            @endif
                             @if ($payslip->employee->int_mobile != '')
                                <br><b>Int Tel</b>: {{ $payslip->employee->int_mobile or '' }}
                            @endif
                            @if ($payslip->employee->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $payslip->employee->email or '' }}</span>
                            @endif                            
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Batch No</b>: {{ $payslip->batch_number->batch_number or '' }}<br>
                            <b>Account No</b>: {{ $payslip->account_number->account_number or '' }}<br>
                            <b>Payment date</b>: {{ $payslip->date }}<br>
                            <b>Payment period</b>: {{ $payslip->batch_number->starting_pay_date }} <b> - </b> {{ $payslip->batch_number->ending_pay_date }}<br>
                            <b>Status</b>: {{ $payslip->status }}<br><br>
                            <b>Processed by</b>: {{ $payslip->prepared_by }}<br>
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Payslip From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                        </div>
                    </div>
                    <br>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tab_logic_overtime_bonus">
                                <legend class="text-center"><span style="color:#CE8F64">INCOME</span></legend>
                                <thead>
                                <tr>
                                    <th>@lang('global.invoice-items.fields.item-description')</th>
                                    <th class="text-center" width="15%">@lang('global.invoice-items.fields.qty')</th>
                                    <th class="text-right" width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                                    <th class="text-right" width="15%">@lang('global.invoice-items.fields.total')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payslip->overtime_and_bonus_items as $item)
                                    <tr id='addr0'>
                                        <td>{{ $item->item_description }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right col-md-3">
                                <table class="table" id="tab_logic_overtime_bonus_total">
                                    <tr>
                                        <th class="text-right" width="50%">Gross Income</th>
                                        <td class="text-right">R {{ number_format($payslip->overtime_and_bonus_total, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tab_logic_overtime_bonus">
                                <legend class="text-center"><span style="color:#CE8F64">DEDUCTIONS</span></legend>
                                <thead>
                                <tr>
                                    <th>@lang('global.invoice-items.fields.item-description')</th>
                                    <th class="text-center" width="15%">@lang('global.invoice-items.fields.qty')</th>
                                    <th class="text-right" width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                                    <th class="text-right" width="15%">@lang('global.invoice-items.fields.total')</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payslip->deduction_items as $item)
                                    <tr id='addr0'>
                                        <td>{{ $item->item_description }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                                        <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pull-right col-md-4">
                                <table class="table" id="tab_logic_overtime_bonus_total">
                                    <tr>
                                        <th class="text-right" width="60%">Total Deductions</th>
                                        <td class="text-right">R {{ number_format($payslip->deductions_total, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="pull-right col-md-4">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="45%">Taxable income</th>
                                    <td class="text-right">R {{ number_format($payslip->gross, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Income tax rate</th>
                                    <td class="text-right">{{ $payslip->income_tax }}%</td>
                                </tr>
                                <tr>
                                    <th class="text-right">Income tax amount</th>
                                    <td class="text-right">R {{ number_format($payslip->income_tax_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right"><span style="color:#CE8F64">Net income</span></th>
                                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($payslip->net_income, 2) }}</span></td>
                                </tr>
                                 <tr>
                                    <th class="text-right">Paid to date</th>
                                    <td class="text-right">R {{ number_format($payslip->paid_to_date, 2) }}</td>
                                </tr>
                                 <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-right">R {{ number_format($payslip->balance, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
                                <br>
                                <span style="color:#CE8F64"><b>YTD Figures</b></span><br>
                                <b>Gross Income</b>: <br>
                                <b>Taxable Income</b>: <br>
                                <b>Income Tax</b>: <br>
                                <b>Net Income</b>: <br>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#deduction_items" aria-controls="deduction_items" role="tab" data-toggle="tab">Deduction items</a></li>
<li role="presentation" class=""><a href="#overtime_and_bonus_items" aria-controls="overtime_and_bonus_items" role="tab" data-toggle="tab">Overtime & bonus items</a></li>
<li role="presentation" class=""><a href="#payee_payments" aria-controls="payee_payments" role="tab" data-toggle="tab">Payslip payments</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="deduction_items">
<table class="table table-bordered table-striped {{ count($deduction_items) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.deduction-items.fields.item-description')</th>
                        <th>@lang('global.deduction-items.fields.unit-price')</th>
                        <th>@lang('global.deduction-items.fields.qty')</th>
                        <th>@lang('global.deduction-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($deduction_items) > 0)
            @foreach ($deduction_items as $deduction_item)
                <tr data-entry-id="{{ $deduction_item->id }}">
                    <td field-key='item_description'>{{ $deduction_item->item_description }}</td>
                                <td field-key='unit_price'>{{ $deduction_item->unit_price }}</td>
                                <td field-key='qty'>{{ $deduction_item->qty }}</td>
                                <td field-key='total'>{{ $deduction_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.restore', $deduction_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.perma_del', $deduction_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deduction_item_view')
                                    <a href="{{ route('admin.deduction_items.show',[$deduction_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deduction_item_edit')
                                    <a href="{{ route('admin.deduction_items.edit',[$deduction_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deduction_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.destroy', $deduction_item->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="overtime_and_bonus_items">
<table class="table table-bordered table-striped {{ count($overtime_and_bonus_items) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.overtime-and-bonus-items.fields.item-description')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.unit-price')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.qty')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($overtime_and_bonus_items) > 0)
            @foreach ($overtime_and_bonus_items as $overtime_and_bonus_item)
                <tr data-entry-id="{{ $overtime_and_bonus_item->id }}">
                    <td field-key='item_description'>{{ $overtime_and_bonus_item->item_description }}</td>
                                <td field-key='unit_price'>{{ $overtime_and_bonus_item->unit_price }}</td>
                                <td field-key='qty'>{{ $overtime_and_bonus_item->qty }}</td>
                                <td field-key='total'>{{ $overtime_and_bonus_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.restore', $overtime_and_bonus_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.perma_del', $overtime_and_bonus_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('overtime_and_bonus_item_view')
                                    <a href="{{ route('admin.overtime_and_bonus_items.show',[$overtime_and_bonus_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('overtime_and_bonus_item_edit')
                                    <a href="{{ route('admin.overtime_and_bonus_items.edit',[$overtime_and_bonus_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('overtime_and_bonus_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.destroy', $overtime_and_bonus_item->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="10">@lang('global.app_no_entries_in_table')</td>
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

            <a href="{{ route('admin.payslips.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
