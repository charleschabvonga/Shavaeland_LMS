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
                        <a href="{{ route('admin.client_accounts.download',$client_account->id) }}" class="btn btn btn-warning">View Client Account Statement in PDF</a>
                    </p>

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">CLIENT STATEMENT</span></h1>
                                <h4><b>Account No</b>: <span style="color:red">{{ $client_account->account_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Statement To</b>: <span style="color:#CE8F64">{{ $client_account->client->name or '' }}</span>
                            @if ($client_account->client->vat != '')
                                <br><b>VAT No</b>: {{ $client_account->client->vat or '' }}
                            @endif
                            @if ($client_account->client->street_address != '')
                                <br><b>Address</b>: {{ $client_account->client->street_address or '' }}
                            @endif
                            @if ($client_account->client->city != '')
                                <br>{{ $client_account->client->city or '' }}
                            @endif
                            @if ($client_account->client->country != '')
                                ,{{ $client_account->client->country or '' }}
                            @endif
                            @if ($client_account->client->zip_code != '')
                                ,{{ $client_account->client->zip_code or '' }}
                            @endif
                            @if ($client_account->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $client_account->client->phone_number_1 or '' }}
                            @endif
                            @if ($client_account->client->fax_number != '')
                                <br><b>Fax</b>: {{ $client_account->client->fax_number or '' }}
                            @endif
                            @if ($client_account->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $client_account->client->email or '' }}</span>
                            @endif
                            @if ($client_account->client->website != '')
                                <br><b>Website</b>: {{ $client_account->client->website or '' }}
                            @endif
                            @if ($client_account->contact_person != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $client_account->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($client_account->contact_person != '')
                                <br><b>Tel</b>: {{ $client_account->contact_person->phone_number or '' }}
                            @endif
                            @if ($client_account->contact_person != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $client_account->contact_person->email or '' }}</span>
                            @endif<br><br>
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Status</b>: {{ $client_account->status }}<br><br>
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
                            @if ($client_account->account_manager->name != '')
                                <b>Account Manager</b>: <span style="color:#CE8F64">{{ $client_account->account_manager->name or '' }}</span>
                            @endif<br>
                            @if ($client_account->account_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $client_account->account_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($client_account->account_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $client_account->account_manager->email or '' }}</span>
                            @endif<br><br>
                        </div>
                    </div>

<!---------------------------------------------- Transaction Start ------------------------------------------------------------------------->


<!---------------------------------------------- Transaction End --------------------------------------------------------------------------->

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">INVOICES</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Due date')</th>
                                            <th>@lang('Invoice No.')</th>
                                            <th>@lang('Sales Order No.')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Total amount')</th>
                                            <th>@lang('Paid to date')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($client_account->income_category) > 0)
                                                @foreach ($client_account->income_category as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->entry_date }}</td>
                                                        <td class="text-left">{{ $item->due_date }}</td>
                                                        <td class="text-left">{{ $item->invoice_number }}</td>
                                                        <td class="text-left">{{ $item->sales_order_number }}</td>
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
                                                <th>R {{ number_format($client_account->inv_total_due, 2) }}</th>
                                                <th>R {{ number_format($client_account->inv_total_paid, 2) }}</th>
                                                <th>R {{ number_format($client_account->inv_total_balance, 2) }}</th>
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
                                            @if (count($client_account->inbound_deposits) > 0)
                                                @foreach ($client_account->inbound_deposits as $item)
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
                                                <th>R {{ number_format($client_account->total_inbound_deposit, 2) }}</th>
                                                <th>R {{ number_format($client_account->total_inbound_deposit_balance, 2) }}</th>
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
                                            <th>@lang('Invoice No.')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Deposit No.')</th>
                                            <th>@lang('Amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($client_account->inbound_payments) > 0)
                                                @foreach ($client_account->inbound_payments as $item)
                                                    <tr>
                                                        <td class="text-left" width="15%">{{ $item->entry_date }}</td>
                                                        <td class="text-left" width="18%">{{ $item->payment_type }}</td>
                                                        <td class="text-left" width="15%">{{ $item->payment_number }}</td>
                                                        <td class="text-left" width="15%">{{ $item->invoice_number->invoice_number or '' }}</td>
                                                        <td class="text-left" width="15%">{{ $item->sales_credit_note_number->credit_note_number or '' }}</td>
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
                                                <th>R {{ number_format($client_account->total_payments, 2) }}</th>
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
                                        <legend class="text-center"><span style="color:#CE8F64">CREDIT NOTES(REFUNDS)</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Date')</th>
                                            <th>@lang('Refund type')</th>
                                            <th>@lang('Credit Note No.')</th>
                                            <th>@lang('Invoice No.')</th>
                                            <th>@lang('Deposit trans No.')</th>
                                            <th>@lang('Status')</th>
                                            <th>@lang('Total amount')</th>
                                            <th>@lang('Paid to date')</th>
                                            <th>@lang('Balance')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($client_account->sales_credit_note) > 0)
                                                @foreach ($client_account->sales_credit_note as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->date }}</td>
                                                        <td class="text-left">{{ $item->refund_type }}</td>
                                                        <td class="text-left">{{ $item->credit_note_number }}</td>
                                                        <td class="text-left">{{ $item->invoice_number->invoice_number or '' }}</td>
                                                        <td class="text-left">{{ $item->bank_reference->payment_number or '' }}</td>
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
                                                <th colspan="6">TOTALS:</th>
                                                <th>R {{ number_format($client_account->sales_credit_note_total_due, 2) }}</th>
                                                <th>R {{ number_format($client_account->sales_credit_note_total_paid, 2) }}</th>
                                                <th>R {{ number_format($client_account->sales_credit_note_total_balance, 2) }}</th>
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
                                            @if (count($client_account->outbound_deposit) > 0)
                                                @foreach ($client_account->outbound_deposit as $item)
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
                                                <th>R {{ number_format($client_account->total_outbound_deposit, 2) }}</th>
                                                <th>R {{ number_format($client_account->total_outbound_deposit_balance, 2) }}</th>
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
                                            <th>@lang('Deposit/Refund No.')</th>
                                            <th>@lang('Amount')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($client_account->outbound_payments) > 0)
                                                @foreach ($client_account->outbound_payments as $item)
                                                    <tr>
                                                        <td class="text-left" width="15%">{{ $item->entry_date }}</td>
                                                        <td class="text-left" width="18%">{{ $item->payment_type }}</td>
                                                        <td class="text-left" width="15%">{{ $item->payment_number }}</td>
                                                        <td class="text-left" width="18%">{{ $item->client_credit_note_number->credit_note_number or '' }}</td>
                                                        <td class="text-left" width="15%">
                                                        @if($item->withdrawal_transaction_number != '')
                                                        {{ $item->withdrawal_transaction_number->payment_number or '' }}
                                                        @endif
                                                        @if($item->withdrawal_transaction_number == '')
                                                        {{ $item->client_credit_note_number->credit_note_number or '' }}
                                                        @endif
                                                        </td>
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
                                                <th>R {{ number_format($client_account->total_outbound_payments, 2) }}</th>
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
                                    <td class="text-center"><h4><span style="color:#CE8F64"> R {{ number_format($client_account->account_balance, 2) }}</span></h4></td>
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

            <a href="{{ route('admin.client_accounts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


