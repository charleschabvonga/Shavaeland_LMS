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
                        <a href="{{ route('admin.quotations.download',$quotation->id) }}" class="btn btn btn-warning">View Quotation in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">QUOTATION</span></h1>
                                <h4><b>Quatation No</b>: <span style="color:red">{{ $quotation->quotation_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Quotation To</b>: <span style="color:#CE8F64">{{ $quotation->client->name or '' }}</span>
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
                                <br><b>Email</b>: <span style="color:blue">{{ $quotation->client->email or '' }}</span>
                            @endif
                            @if ($quotation->client->website != '')
                                <br><b>Website</b>: {{ $quotation->client->website or '' }}
                            @endif
                            @if ($quotation->contact_person->contact_name != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $quotation->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($quotation->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $quotation->contact_person->phone_number or '' }}
                            @endif
                            @if ($quotation->contact_person->email != '')
                                <br><b>Email</b>: {{ $quotation->contact_person->email or '' }}
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Date</b>: {{ $quotation->date }}<br>
                            <b>Due Date</b>: {{ $quotation->due_date }}<br>
                            <b>Status</b>: {{ $quotation->status }}
                            @if ($quotation->prepared_by != '')
                                <br><b>Quoted by</b>: <span style="color:#CE8F64">{{ $quotation->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Quotation From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: {{ config('invoices.sales.email') }}<br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($quotation->sales_person->name != '')
                                <b>Sales Person</b>: <span style="color:#CE8F64">{{ $quotation->sales_person->name or '' }}</span>
                            @endif<br>
                            @if ($quotation->sales_person->sa_mobile != '')
                                <b>Tel</b>: {{ $quotation->sales_person->sa_mobile or '' }}
                            @endif<br>
                            @if ($quotation->sales_person->email != '')
                                <b>Email</b>: {{ $quotation->sales_person->email or '' }}
                            @endif
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered table-striped " id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Quatation Items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th class="text-center">@lang('#')</th>
                            <th>@lang('global.invoice-items.fields.item-description')</th>
                            <th class="text-center" width="15%">@lang('global.invoice-items.fields.qty')</th>
                            <th class="text-right" width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th class="text-right" width="15%">@lang('global.invoice-items.fields.total')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($quotation->invoice_items as $item)
                            <tr id='addr0'>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td class="text-center">{{ $item->qty }} {{ $item->unit }} </td>
                                <td class="text-right">R {{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-right">R {{ number_format($item->qty * $item->unit_price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="pull-right col-md-3">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="50%">Sub Total</th>
                                    <td class="text-right">R {{ number_format($quotation->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT @ {{ $quotation->vat }}%</th>
                                    <td class="text-right">R {{ number_format($quotation->vat_amount, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-right"><span style="color:#CE8F64">Total Amount</span></th>
                                    <td class="text-right"><span style="color:#CE8F64"> R {{ number_format($quotation->total_amount, 2) }}</span></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <div class="col-xs-6 form-group float-left text-left">
                                <br>
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
                        <p class="text-center"> All transactions are COD or CBD. </p>
                    </div>

                </div>
            </div><!-- Nav tabs --> 
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#income_category" aria-controls="income_category" role="tab" data-toggle="tab">Invoices</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active " id="income_category">
<table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income-category.fields.entry-date')</th>
            <th>@lang('global.income-category.fields.invoice-number')</th>
            <th>@lang('global.income-category.fields.client')</th>
            <th>@lang('global.income-category.fields.due-date')</th>
            <th class="text-center">@lang('global.income-category.fields.status')</th>
            <th>@lang('global.income-category.fields.total-amount')</th>
            <th>@lang('global.income-category.fields.paid-to-date')</th>
            <th>@lang('global.income-category.fields.balance')</th>
                                    <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($income_categories) > 0)
            @foreach ($income_categories as $income_category)
                <tr data-entry-id="{{ $income_category->id }}">
                    <td field-key='entry_date'>{{ $income_category->entry_date }}</td>
                    <td field-key='invoice_number'>{{ $income_category->invoice_number }}</td>
                    <td field-key='client'>{{ $income_category->client->name or '' }}</td>
                    <td field-key='due_date'>{{ $income_category->due_date }}</td>
                    @if($income_category->status == 'Draft')
                    <td class="label-md label-primary text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    @if($income_category->status == 'Sent')
                    <td class="label-md label-info text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    @if($income_category->status == 'Paid')
                    <td class="label-md label-success text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    @if($income_category->status == 'Partially paid')
                    <td class="label-md label-warning text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    @if($income_category->status == 'Payment due')
                    <td class="label-md label-danger text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    @if($income_category->status == 'Up to date')
                    <td class="label-md label-default text-center" field-key='status'>{{ $income_category->status }}</td>
                    @endif
                    <td field-key='total_amount'>R {{ number_format($income_category->total_amount, 2) }}</td>
                    <td field-key='paid_to_date'>R {{ number_format($income_category->paid_to_date, 2) }}</td>
                    <td field-key='balance'>R {{ number_format($income_category->balance, 2) }}</td>
                                                    <td>
                                    @can('income_category_view')
                                    <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_category_edit')
                                    <!--a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('income_category_delete')
                                    <!--{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}-->
                                    @endcan
                                    <a href="{{ route('admin.income_categories.download',$income_category->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="23">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.quotations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
