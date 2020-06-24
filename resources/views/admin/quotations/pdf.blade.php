@extends('layouts.pdf')

@section('content')
    <div class="clearfix">
    	@if (config('invoices.logo_file') != '')
            <div class="col-md-12 text-center">
                <img src="{{ asset(config('invoices.logo_file')) }}" /><br>
                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                <h1><span style="color:#CE8F64">QUOTATION</span></h1>
                <h4><b>Quatation No</b>: <span style="color:red">{{ $quotation->quotation_number }}</span></h4>
            </div>
        @endif
    </div>

    <div class="row clearfix">
        <div class="col-xs-4 form-group text-center">
    	   <b>Date</b>: {{ $quotation->date }}<br>
            <b>Due Date</b>: {{ $quotation->due_date }}<br>
            <b>Status</b>: {{ $quotation->status }}<br>
            <b>Quoted by</b>: {{ $quotation->prepared_by }}
        </div>
        
        <div class="col-xs-4 form-group float-left text-left">
           <span style="color:#999999">Quotation To</span>: <span style="color:#CE8F64">{{ $quotation->client->name or '' }}</span>
            @if ($quotation->client->street_address != '')
                <br><b>Address</b>: {{ $quotation->client->street_address or '' }}
            @endif
            @if ($quotation->client->city != '')
                <br>{{ $quotation->client->city or '' }}
            @endif
            @if ($quotation->client->country != '')
                , {{ $quotation->client->country or '' }}
            @endif
            @if ($quotation->client->zip_code != '')
                ,{{ $quotation->client->zip_code or '' }}
            @endif
            @if ($quotation->client->phone_number_1 != '')
                <br><b>Tel</b>: {{ $quotation->client->phone_number_1 or '' }}
            @endif
                @if ($quotation->client->fax_number != '')
                <br><b>Fax</b>: {{ $quotation->client->fax_number or '' }}
            @endif
            @if ($quotation->client->email != '')
                <br><b>Email</b>: {{ $quotation->client->email or '' }}
            @endif
            @if ($quotation->client->website != '')
                <br><b>Website</b>: {{ $quotation->client->website or '' }}
            @endif
            @if ($quotation->contact_person != '')
                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $quotation->contact_person->contact_name or '' }}</span>
            @endif
            @if ($quotation->contact_person != '' && $quotation->contact_person->phone_number != '')
                <br><b>Tel</b>: {{ $quotation->contact_person->phone_number or '' }}
            @endif
            @if ($quotation->contact_person != '' && $quotation->contact_person->email != '')
                <br><b>Email</b>: {{ $quotation->contact_person->email or '' }}
            @endif
        </div>
        
        <div class="col-xs-4 form-group float-right text-right">
           <span style="color:#999999">Quotation From: </span>
           <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
           <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
           <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
           {{ config('invoices.seller.address') }}<br>
           {{ config('invoices.seller.city') }}, 
           {{ config('invoices.seller.country') }}, 
           {{ config('invoices.seller.postal_code') }}<br>
           <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
           <b>Email</b>: {{ config('invoices.seller.email') }}<br>
           <b>Website</b>: {{ config('invoices.seller.website') }}<br>
           @if ($quotation->sales_person != '')
                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $quotation->sales_person->name or '' }}</span><br>
            @endif
            @if ($quotation->sales_person != '' && $quotation->sales_person->sa_mobile != '')
                <b>Tel</b>: {{ $quotation->sales_person->sa_mobile or '' }}<br>
            @endif
            @if ($quotation->sales_person != '' && $quotation->sales_person->email != '')
                <b>Email</b>: {{ $quotation->sales_person->email or '' }}
            @endif
        </div>       
    </div>

    <div class="row clearfix">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="text-left"> Description </th>
                <th class="text-center"> Qty </th>
                <th class="text-right"> Price </th>
                <th class="text-right"> Total </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($quotation->invoice_items as $item)
                <tr id='addr0'>
                    <td>{{ $item->item_description }}</td>
                    <td class="text-center">{{ $item->qty }} {{ $item->unit }} </td>
                    <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class=" row clearfix">
    	<div class="col-xs-4 form-group float-left text-left">
            <b>Account Name</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
            <b>Bank Name</b>: {{ config('invoices.bank.bank') }}<br>
            <b>Branch</b>: {{ config('invoices.bank.branch') }}<br>
            <b>Branch Code</b>: {{ config('invoices.bank.code') }}<br>
            <b>Account No</b>: {{ config('invoices.bank.account') }}<br>
        </div>
        <div class="col-xs-4 form-group float-right">
        <table class="tbl-total">
            <tbody>           
                <tr>
                    <th class="text-right" width="50%">Sub Total</th>
                    <td class="text-right">R {{ number_format($quotation->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-right">VAT {{ $quotation->vat }}%</th>
                    <td class="text-right">R {{ number_format($quotation->vat_amount, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($quotation->total_amount, 2) }}</span></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
	<hr>
    <div class="row clearfix mt-3 text-center">
        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.<br>All transactions are COD or CBD.</p>
    </div>
     
@endsection
