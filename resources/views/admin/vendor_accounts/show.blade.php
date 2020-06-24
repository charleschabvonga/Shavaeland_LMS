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
                        <a href="{{ route('admin.vendor_accounts.download',$vendor_account->id) }}" class="btn btn btn-warning">View Vendor Account Statement in PDF</a>
                    </p>

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">VENDOR STATEMENT</span></h1>
                                <h4><b>Account No</b>: <span style="color:red">{{ $vendor_account->account_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Statement To</b>: <span style="color:#CE8F64">{{ $vendor_account->vendor->name or '' }}</span>
                            @if ($vendor_account->vendor->vat != '')
                                <br><b>VAT No</b>: {{ $vendor_account->vendor->vat or '' }}
                            @endif
                            @if ($vendor_account->vendor->street_address != '')
                                <br><b>Address</b>: {{ $vendor_account->vendor->street_address or '' }}
                            @endif
                            @if ($vendor_account->vendor->city != '')
                                <br>{{ $vendor_account->vendor->city or '' }}
                            @endif
                            @if ($vendor_account->vendor->country != '')
                                ,{{ $vendor_account->vendor->country or '' }}
                            @endif
                            @if ($vendor_account->vendor->zip_code != '')
                                ,{{ $vendor_account->vendor->zip_code or '' }}
                            @endif
                            @if ($vendor_account->vendor->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $vendor_account->vendor->phone_number_1 or '' }}
                            @endif
                            @if ($vendor_account->vendor->fax_number != '')
                                <br><b>Fax</b>: {{ $vendor_account->vendor->fax_number or '' }}
                            @endif
                            @if ($vendor_account->vendor->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $vendor_account->vendor->email or '' }}</span>
                            @endif
                            @if ($vendor_account->vendor->website != '')
                                <br><b>Website</b>: {{ $vendor_account->vendor->website or '' }}
                            @endif
                            @if ($vendor_account->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $vendor_account->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($vendor_account->contact_person != '')
                                <br><b>Tel</b>: {{ $vendor_account->contact_person->phone_number or '' }}
                            @endif
                            @if ($vendor_account->contact_person != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $vendor_account->contact_person->email or '' }}</span>
                            @endif<br><br>
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Status</b>: {{ $vendor_account->status }}<br><br>
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Statement From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($vendor_account->account_manager->name != '')
                                <b>Account Manager</b>: <span style="color:#CE8F64">{{ $vendor_account->account_manager->name or '' }}</span>
                            @endif<br>
                            @if ($vendor_account->account_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $vendor_account->account_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($vendor_account->account_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $vendor_account->account_manager->email or '' }}</span>
                            @endif<br><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PURCHASE CREDIT NOTES</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Due date')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Purchase Order No.')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Total amount')</th>
                                            <th>@lang('Paid to date')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->expense_category) > 0)
                                                @foreach ($vendor_account->expense_category as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->entry_date }}</td>
                                                        <td class="text-left">{{ $item->due_date }}</td>
                                                        <td class="text-left">{{ $item->credit_note_number }}</td>
                                                        <td class="text-left">{{ $item->purchase_order_number }}</td>
                                                        <td class="text-left">{{ $item->status }}</td>
                                                        <td class="text-left">R {{ number_format($item->total_amount, 2) }}</td>
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
                                                <th>R {{ number_format($vendor_account->credit_note_total_due, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->credit_note_total_paid, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->credit_note_total_balance, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">OUTBOUND DEPOSITS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Deposit type')</th>
                                            <th>@lang('Deposit No.')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->outbound_deposit) > 0)
                                                @foreach ($vendor_account->outbound_deposit as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->entry_date }}</td>
                                                        <td class="text-left">{{ $item->payment_mode }}</td>
                                                        <td class="text-left">{{ $item->payment_number }}</td>
                                                        <td class="text-left">R {{ number_format($item->amount, 2) }}</td>
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
                                                <th colspan="3">TOTALS:</th>
                                                <th>R {{ number_format($vendor_account->total_outbound_deposit, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->total_outbound_deposit_balance, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">OUTBOUND PAYMENTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Pymt type')</th>
                                            <th>@lang('Pymt No.')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Deposit No.')</th>
                                            <th>@lang('Amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->outbound_payments) > 0)
                                                @foreach ($vendor_account->outbound_payments as $item)
                                                    <tr>
                                                        <td class="text-left" width="15%">{{ $item->entry_date }}</td>
                                                        <td class="text-left" width="18%">{{ $item->payment_type }}</td>
                                                        <td class="text-left" width="15%">{{ $item->payment_number }}</td>
                                                        <td class="text-left" width="18%">{{ $item->vendor_credit_note_number->credit_note_number or '' }}</td>
                                                        <td class="text-left" width="15%">{{ $item->withdrawal_transaction_number->payment_number or '' }}</td>
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
                                                <th colspan="5">TOTALS:</th>
                                                <th>R {{ number_format($vendor_account->total_outbound_payments, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">DEBIT NOTES(REFUNDS)</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Refund type')</th>
                                            <th>@lang('Debit Note No.')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Deposit trans No.')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Total amount')</th>
                                            <th>@lang('Paid to date')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->debit_notes) > 0)
                                                @foreach ($vendor_account->debit_notes as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->date }}</td>
                                                        <td class="text-left">{{ $item->refund_type }}</td>
                                                        <td class="text-left">{{ $item->debit_note_number }}</td>
                                                        <td class="text-left">{{ $item->credit_note_number->credit_note_number or '' }}</td>
                                                        <td class="text-left">{{ $item->withdrawal_transaction_number->payment_number or '' }}</td>
                                                        <td class="text-left">{{ $item->payment_status }}</td>
                                                        <td class="text-left">R {{ number_format($item->total_amount, 2) }}</td>
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
                                                <th colspan="6">TOTALS:</th>
                                                <th>R {{ number_format($vendor_account->debit_note_total_due, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->debit_note_total_paid, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->debit_note_total_balance, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">INBOUND DEPOSITS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Deposit type')</th>
                                            <th>@lang('Deposit No.')</th>
                                            <th>@lang('Amount')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->inbound_deposits) > 0)
                                                @foreach ($vendor_account->inbound_deposits as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->entry_date }}</td>
                                                        <td class="text-left">{{ $item->payment_mode }}</td>
                                                        <td class="text-left">{{ $item->payment_number }}</td>
                                                        <td class="text-left">R {{ number_format($item->amount, 2) }}</td>
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
                                                <th colspan="3">TOTALS:</th>
                                                <th>R {{ number_format($vendor_account->total_inbound_deposit, 2) }}</th>
                                                <th>R {{ number_format($vendor_account->total_inbound_deposit_balance, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">INBOUND PAYMENTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Pymt type')</th>
                                            <th>@lang('Pymt No.')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Debit Note No.')</th>
                                            <th>@lang('Deposit No.')</th>
                                            <th>@lang('Amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($vendor_account->inbound_payments) > 0)
                                                @foreach ($vendor_account->inbound_payments as $item)
                                                    <tr>
                                                        <td class="text-left" width="15%">{{ $item->entry_date }}</td>
                                                        <td class="text-left" width="18%">{{ $item->payment_type }}</td>
                                                        <td class="text-left" width="15%">{{ $item->payment_number }}</td>
                                                        <td class="text-left" width="15%">{{ $item->credit_note_number->credit_note_number or '' }}</td>
                                                        <td class="text-left" width="15%">{{ $item->debit_note_number->debit_note_number or '' }}</td>
                                                        <td class="text-left">{{ $item->deposit_transaction_number->payment_number or '' }}</td>
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
                                                <th colspan="6">TOTALS:</th>
                                                <th>R {{ number_format($vendor_account->total_inbound_payments, 2) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="pull-right col-md-5">
                            <table class="table">
                                <tr>
                                    <th class="text-center"><h4><span style="color:#CE8F64">Account Balance</span></h4></th>
                                    <td class="text-center"><h4><span style="color:#CE8F64"> R {{ number_format($vendor_account->account_balance, 2) }}</span></h4></td>
                                </tr>
                                <tr>
                                    <th class="text-right"></th>
                                    <td class="text-right"></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
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
    
<li role="presentation" class="active"><a href="#vendor_bank_payments" aria-controls="vendor_bank_payments" role="tab" data-toggle="tab">Outbound deposits</a></li>
<li role="presentation" class=""><a href="#bank_payments" aria-controls="bank_payments" role="tab" data-toggle="tab">Inbound deposits</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="vendor_bank_payments">
<table class="table table-bordered table-striped {{ count($vendor_bank_payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.vendor-bank-payments.fields.entry-date')</th>
                        <th>@lang('global.vendor-bank-payments.fields.withdrawer')</th>
                        <th>@lang('global.vendor-bank-payments.fields.vendor')</th>
                        <th>@lang('global.vendor-bank-payments.fields.account-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.client')</th>
                        <th>@lang('global.vendor-bank-payments.fields.client-account-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.payment-mode')</th>
                        <th>@lang('global.vendor-bank-payments.fields.payment-number')</th>
                        <th>@lang('global.vendor-bank-payments.fields.amount')</th>
                        <th>@lang('global.vendor-bank-payments.fields.balance')</th>
                        <th>@lang('global.vendor-bank-payments.fields.upload-document')</th>
                        <th>@lang('global.vendor-bank-payments.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($vendor_bank_payments) > 0)
            @foreach ($vendor_bank_payments as $vendor_bank_payment)
                <tr data-entry-id="{{ $vendor_bank_payment->id }}">
                    <td field-key='entry_date'>{{ $vendor_bank_payment->entry_date }}</td>
                                <td field-key='withdrawer'>{{ $vendor_bank_payment->withdrawer }}</td>
                                <td field-key='vendor'>{{ $vendor_bank_payment->vendor->name or '' }}</td>
                                <td field-key='account_number'>{{ $vendor_bank_payment->account_number->account_number or '' }}</td>
                                <td field-key='client'>{{ $vendor_bank_payment->client->name or '' }}</td>
                                <td field-key='client_account_number'>{{ $vendor_bank_payment->client_account_number->account_number or '' }}</td>
                                <td field-key='payment_mode'>{{ $vendor_bank_payment->payment_mode }}</td>
                                <td field-key='payment_number'>{{ $vendor_bank_payment->payment_number }}</td>
                                <td field-key='amount'>{{ $vendor_bank_payment->amount }}</td>
                                <td field-key='balance'>{{ $vendor_bank_payment->balance }}</td>
                                <td field-key='upload_document'>@if($vendor_bank_payment->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vendor_bank_payment->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='prepared_by'>{{ $vendor_bank_payment->prepared_by }}</td>
                                                                <td>
                                    @can('vendor_bank_payment_view')
                                    <a href="{{ route('admin.vendor_bank_payments.show',[$vendor_bank_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vendor_bank_payment_edit')
                                    <a href="{{ route('admin.vendor_bank_payments.edit',[$vendor_bank_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vendor_bank_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vendor_bank_payments.destroy', $vendor_bank_payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="bank_payments">
<table class="table table-bordered table-striped {{ count($bank_payments) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.bank-payments.fields.entry-date')</th>
                        <th>@lang('global.bank-payments.fields.depositor')</th>
                        <th>@lang('global.bank-payments.fields.client')</th>
                        <th>@lang('global.bank-payments.fields.account-number')</th>
                        <th>@lang('global.bank-payments.fields.vendor')</th>
                        <th>@lang('global.bank-payments.fields.vendor-account-number')</th>
                        <th>@lang('global.bank-payments.fields.payment-mode')</th>
                        <th>@lang('global.bank-payments.fields.payment-number')</th>
                        <th>@lang('global.bank-payments.fields.amount')</th>
                        <th>@lang('global.bank-payments.fields.balance')</th>
                        <th>@lang('global.bank-payments.fields.upload-document')</th>
                        <th>@lang('global.bank-payments.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($bank_payments) > 0)
            @foreach ($bank_payments as $bank_payment)
                <tr data-entry-id="{{ $bank_payment->id }}">
                    <td field-key='entry_date'>{{ $bank_payment->entry_date }}</td>
                                <td field-key='depositor'>{{ $bank_payment->depositor }}</td>
                                <td field-key='client'>{{ $bank_payment->client->name or '' }}</td>
                                <td field-key='account_number'>{{ $bank_payment->account_number->account_number or '' }}</td>
                                <td field-key='vendor'>{{ $bank_payment->vendor->name or '' }}</td>
                                <td field-key='vendor_account_number'>{{ $bank_payment->vendor_account_number->account_number or '' }}</td>
                                <td field-key='payment_mode'>{{ $bank_payment->payment_mode }}</td>
                                <td field-key='payment_number'>{{ $bank_payment->payment_number }}</td>
                                <td field-key='amount'>{{ $bank_payment->amount }}</td>
                                <td field-key='balance'>{{ $bank_payment->balance }}</td>
                                <td field-key='upload_document'>@if($bank_payment->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $bank_payment->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='prepared_by'>{{ $bank_payment->prepared_by }}</td>
                                                                <td>
                                    @can('bank_payment_view')
                                    <a href="{{ route('admin.bank_payments.show',[$bank_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('bank_payment_edit')
                                    <a href="{{ route('admin.bank_payments.edit',[$bank_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('bank_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.bank_payments.destroy', $bank_payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="17">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.vendor_accounts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


