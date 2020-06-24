@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.purchase_orders.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PURCHASE ORDER</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.purchase-orders.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('accounts', trans('global.purchase-orders.fields.accounts').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('accounts', 0) !!}
                    {!! Form::checkbox('accounts', 1, old('accounts', false), []) !!}
                    @if($errors->has('accounts'))
                        <p class="help-block">
                            {{ $errors->first('accounts') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group pull-right">
                    {!! Form::label('gm', trans('global.purchase-orders.fields.gm').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('gm', 0) !!}
                    {!! Form::checkbox('gm', 1, old('gm', false), []) !!}
                    @if($errors->has('gm'))
                        <p class="help-block">
                            {{ $errors->first('gm') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group pull-right">
                    {!! Form::label('hod', trans('global.purchase-orders.fields.hod').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('hod', 0) !!}
                    {!! Form::checkbox('hod', 1, old('hod', false), []) !!}
                    @if($errors->has('hod'))
                        <p class="help-block">
                            {{ $errors->first('hod') }}
                        </p>
                    @endif
                </div>
                
                
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('vendor_id', trans('global.purchase-orders.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.purchase-orders.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('requested_by', trans('global.purchase-orders.fields.requested-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('requested_by', old('requested_by'), ['class' => 'form-control', 'placeholder' => 'Requested by']) !!}
                    @if($errors->has('requested_by'))
                        <p class="help-block">
                            {{ $errors->first('requested_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('purchase_order_number', trans('global.purchase-orders.fields.purchase-order-number').'*', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='purchase_order_number' value='{{ $purchase_order_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('purchase_order_number'))
                        <p class="help-block">
                            {{ $errors->first('purchase_order_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('date', trans('global.purchase-orders.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'Date', 'required' => '']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('buyer_id', trans('global.purchase-orders.fields.buyer').'', ['class' => 'control-label']) !!}
                    {!! Form::select('buyer_id', $buyers, old('buyer_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('buyer_id'))
                        <p class="help-block">
                            {{ $errors->first('buyer_id') }}
                        </p>
                    @endif
                </div>
                
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.purchase-orders.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('request_date', trans('global.purchase-orders.fields.request-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('request_date', old('request_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('request_date'))
                        <p class="help-block">
                            {{ $errors->first('request_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('procurement_date', trans('global.purchase-orders.fields.procurement-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('procurement_date', old('procurement_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('procurement_date'))
                        <p class="help-block">
                            {{ $errors->first('procurement_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('quotation_number', trans('global.purchase-orders.fields.quotation-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('quotation_number', old('quotation_number'), ['class' => 'form-control', 'placeholder' => 'Quotation No']) !!}
                    @if($errors->has('quotation_number'))
                        <p class="help-block">
                            {{ $errors->first('quotation_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#purchase_order_number_items" aria-controls="purchase_order_number_items" role="tab" data-toggle="tab">Purchase Order Items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th>@lang('#')</th>
                            <th>@lang('global.invoice-items.fields.item-description')</th>
                            <th width="13%">@lang('global.invoice-items.fields.qty')</th>
                            <th width="11%">@lang('unit')</th>
                            <th width="16%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th width="18%">@lang('global.invoice-items.fields.total')</th>
                            <th width="9%">@lang('')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <tr id='addr0'>
                                <td>1</td>
                                <td><input type="text" name='item_description[]'  placeholder='Item description' class="form-control"/></td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='qty[]' placeholder='0' class="form-control qty" step="0" min="0"/>
                                    </div>
                                </td>
                                <td>
                                    <select name="unit[]" class="form-control" id="unit">
                                        @foreach($unit as $unit)
                                            <option value="{{ $unit->measurement_type }}"> {{ $unit->measurement_type }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='unit_price[]' placeholder='0.00' class="form-control price" step="0.00" min="0"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='total[]' placeholder='0.00' class="form-control total" readonly/>
                                    </div>
                                </td>
                                <td class="text-center"><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-1 form-group pull-right"></div>
                        <div class="pull-right col-md-4">
                            <table class="table" id="tab_logic_total">
                                <tbody>
                                <tr>
                                    <th class="text-right" width="31%">Sub Total</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='subtotal' placeholder='0.00' class="form-control" id="subtotal" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT</th>
                                    <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name="vat", class="form-control" id="tax" placeholder="0" name="invoice[vat_percent]">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='vat_amount' id="vat_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Total Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-7">
                            <input type="button" id="add_row" class="btn btn-primary float-left" value="Add Row" />
                            <input type="button" id='delete_row' class="float-right btn btn-info" value="Delete Row" />
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="item-descriptions-template">
        @include('admin.purchase_orders.invoice_items_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

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
            
            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>

        <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change',function(){
                calc();
            });
            $('#tax').on('keyup change',function(){
                calc_total();
            });
        });

        function calc()
        {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty*price);

                    calc_total();
                }
            });
        }

        function calc_total()
        {
            total=0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });

            $('#subtotal').val(total.toFixed(2));
            tax_sum=total/100*$('#tax').val();
            $('#vat_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum+total).toFixed(2));
            $('#balance').val(((tax_sum+total)-$('#paid_to_date').val()).toFixed(2));
        }
    </script>
@stop