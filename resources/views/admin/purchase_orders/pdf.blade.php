@extends('layouts.pdf')

@section('content')
    <div class="clearfix">
    	@if (config('invoices.logo_file') != '')
            <div class="col-md-12 text-center">
                <img src="{{ asset(config('invoices.logo_file')) }}" /><br>
                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                <h1><span style="color:#CE8F64">PURCHASE ORDER</span></h1>
                <h4><b>Purchase Order No</b>: <span style="color:red">{{ $purchase_order->purchase_order_number }}</span></h4>
            </div>
        @endif
    </div>

    <div class="row clearfix">
        <div class="col-xs-4 form-group text-center">
            <b>Date</b>: {{ $purchase_order->date }}<br>
            <b>Status</b>: {{ $purchase_order->status }}
            @if ($purchase_order->quotation_number != '')
                <br><b>Quotation No</b>: {{ $purchase_order->quotation_number }}
            @endif
            @if ($purchase_order->prepared_by != '')
                <br><br><b>Processed by</b>: <span style="color:#CE8F64">{{ $purchase_order->prepared_by }}</span>
            @endif
            @if ($purchase_order->requested_by != '')
                <br><b>Requested by</b>: <span style="color:#CE8F64">{{ $purchase_order->requested_by }}</span>
            @endif
            @if ($purchase_order->request_date != '')
                <br><b>Requested date</b>: <span style="color:#CE8F64">{{ $purchase_order->request_date }}</span>
            @endif
            <br><b>HOD</b>: {{ Form::checkbox("hod", 1, $purchase_order->hod == 1 ? true : false, ["disabled"]) }}
            <b>GM</b>: {{ Form::checkbox("gm", 1, $purchase_order->gm == 1 ? true : false, ["disabled"]) }}
            <b>Accounts</b>: {{ Form::checkbox("accounts", 1, $purchase_order->accounts == 1 ? true : false, ["disabled"]) }}
        </div>
        
        <div class="col-xs-4 form-group float-left text-left">
            <b>Purchase_order To</b>: <span style="color:#CE8F64">{{ $purchase_order->vendor->name or '' }}</span>
            @if ($purchase_order->vendor->street_address != '')
                <br><b>Address</b>: {{ $purchase_order->vendor->street_address or '' }}
            @endif
            @if ($purchase_order->vendor->city != '')
                <br>{{ $purchase_order->vendor->city or '' }}
            @endif
            @if ($purchase_order->vendor->country != '')
                , {{ $purchase_order->vendor->country or '' }}
            @endif
            @if ($purchase_order->vendor->zip_code != '')
                ,{{ $purchase_order->vendor->zip_code or '' }}
            @endif
            @if ($purchase_order->vendor->phone_number_1 != '')
                <br><b>Tel</b>: {{ $purchase_order->vendor->phone_number_1 or '' }}
            @endif
                @if ($purchase_order->vendor->fax_number != '')
                <br><b>Fax</b>: {{ $purchase_order->vendor->fax_number or '' }}
            @endif
            @if ($purchase_order->vendor->email != '')
                <br><b>Email</b>: <span style="color:blue">{{ $purchase_order->vendor->email or '' }}</span>
            @endif
            @if ($purchase_order->vendor->website != '')
                <br><b>Website</b>: {{ $purchase_order->vendor->website or '' }}
            @endif
            @if ($purchase_order->contact_person->contact_name != '')
                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $purchase_order->contact_person->contact_name or '' }}</span>
            @endif
            @if ($purchase_order->contact_person->phone_number != '')
                <br><b>Tel</b>: {{ $purchase_order->contact_person->phone_number or '' }}
            @endif
            @if ($purchase_order->contact_person->email != '')
                <br><b>Email</b>: {{ $purchase_order->contact_person->email or '' }}
            @endif
        </div>
        
        <div class="col-xs-4 form-group float-right text-right">
            <b>purchase_order From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
            <b></b> {{ config('invoices.seller.city') }},
            <b></b> {{ config('invoices.seller.country') }},
            <b></b> {{ config('invoices.seller.postal_code') }}<br>
            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
            <b>Email</b>: {{ config('invoices.sales.email') }}<br>
            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
            @if ($purchase_order->buyer->name != '')
                <b>Buyer</b>: <span style="color:#CE8F64">{{ $purchase_order->buyer->name or '' }}</span>
            @endif<br>
            @if ($purchase_order->buyer->sa_mobile != '')
                <b>Tel</b>: {{ $purchase_order->buyer->sa_mobile or '' }}
            @endif<br>
            @if ($purchase_order->buyer->email != '')
                <b>Email</b>: {{ $purchase_order->buyer->email or '' }}
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
                @foreach ($purchase_order->invoice_items as $item)
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
    	
        <div class="col-xs-4 form-group float-right">
        <table class="tbl-total">
            <tbody>           
                <tr>
                    <th class="text-right" width="50%">Sub Total</th>
                    <td class="text-right">R {{ number_format($purchase_order->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-right">VAT @ {{ $purchase_order->vat }}%</th>
                    <td class="text-right">R {{ number_format($purchase_order->vat_amount, 2) }}</td>
                </tr>
                <tr>
                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($purchase_order->total_amount, 2) }}</span></td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>
	<hr>
    <div class="row clearfix mt-3 text-center">
        
    </div>
     
@endsection
