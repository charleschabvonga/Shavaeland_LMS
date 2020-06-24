@extends('layouts.pdf')

@section('content')
    <div class="clearfix">
    	<div class="text-center">
           <img src="{{ asset(config('invoices.pdf_logo_file')) }}"/><br>
           <h1>TAX INVOICE</h1>
           <b>Invoice No</b>: {{ $income_category->invoice_number }}<br>
    	</div>
    </div>

    <div class="row clearfix">
        <div class="col-xs-4 form-group text-center">
    	   <br><b>Date</b>: {{ $income_category->date }}<br>
    	   <b>Transaction No</b>: {{ $income_category->project_number->project_number }}
        </div>
        
        <div class="col-xs-4 form-group float-left text-left">
            <span style="color:#999999">Tax Invoice To</span>: <span style="color:#CE8F64">{{ $income_category->client->name or '' }}</span>
            @if ($income_category->client->vat != '')
                <br><b>VAT No</b>: {{ $income_category->client->vat or '' }}
            @endif
            @if ($income_category->client->street_address != '')
                <br><b>Address</b>: {{ $income_category->client->street_address or '' }}
            @endif
            @if ($income_category->client->city != '')
                <br>{{ $income_category->client->city or '' }}
            @endif
            @if ($income_category->client->country != '')
                ,{{ $income_category->client->country or '' }}
            @endif
            @if ($income_category->client->zip_code != '')
                ,{{ $income_category->client->zip_code or '' }}
            @endif
            @if ($income_category->client->phone_number_1 != '')
                <br><b>Tel</b>: {{ $income_category->client->phone_number_1 or '' }}
            @endif
             @if ($income_category->client->fax_number != '')
                <br><b>Fax</b>: {{ $income_category->client->fax_number or '' }}
            @endif
            @if ($income_category->client->email != '')
                <br><b>Email</b>: <span style="color:blue">{{ $income_category->client->email or '' }}</span>
            @endif
            @if ($income_category->client->website != '')
                <br><b>Website</b>: {{ $income_category->client->website or '' }}
            @endif
            @if ($income_category->contact_person != '')
                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $income_category->contact_person->contact_name or '' }}</span>
            @endif
            @if ($income_category->contact_person != '' && $income_category->contact_person->phone_number != '')
                <br><b>Tel</b>: {{ $income_category->contact_person->phone_number or '' }}
            @endif
            @if ($income_category->contact_person != '' && $income_category->contact_person->email != '')
                <br><b>Email</b>: <span style="color:blue">{{ $income_category->contact_person->email or '' }}</span>
            @endif
        </div>
        
        <div class="col-xs-4 form-group float-right text-right">
           <span style="color:#999999">Invoice From: </span>
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
            @foreach ($income_category->invoice_items as $item)
                <tr>
                    <td class="text-left">{{ $item->item_description }}</td>
                    <td class="text-center">{{ $item->qty }}</td>
                    <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                    <td class="text-right">R {{ number_format($item->total, 2) }}</td>
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
	            <th class="text-right" width="40%">Sub Total:</th>
	            <td class="text-right">R {{ number_format($income_category->subtotal, 2) }}</td>
	        </tr>
	        <tr>
	            <th class="text-right">VAT @ {{ $income_category->vat }}%:</th>
	            <td class="text-right">R {{ number_format($income_category->vat_amount, 2) }}</td>
	        </tr>
	        <tr>
	            <th class="text-right">Total Amount:</th>
	            <td class="text-right">R {{ number_format($income_category->grand_total, 2) }}</td>
	        </tr>
            </tbody>
        </table>
        </div>
    </div>
	
    <div class="row clearfix mt-3 text-center">
    <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
    <hr>
    </div>
     
@endsection
