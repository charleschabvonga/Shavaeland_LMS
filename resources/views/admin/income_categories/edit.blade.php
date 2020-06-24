@extends('layouts.app')

@section('content')
    
    {!! Form::model($income_category, ['method' => 'PUT', 'route' => ['admin.income_categories.update', $income_category->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">TAX INVOICE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_type_id', trans('global.income-category.fields.project-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_type_id', $project_types, old('project_type_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('project_type_id'))
                        <p class="help-block">
                            {{ $errors->first('project_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.income-category.fields.project-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.income-category.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('due_date', trans('global.income-category.fields.due-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('due_date', old('due_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('due_date'))
                        <p class="help-block">
                            {{ $errors->first('due_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('prepared_by', trans('global.income-category.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated','readonly']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('invoice_number', trans('global.income-category.fields.invoice-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('invoice_number', old('invoice_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('invoice_number'))
                        <p class="help-block">
                            {{ $errors->first('invoice_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('client_id', trans('global.income-category.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('contact_person_id', trans('global.income-category.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('account_manager_id', trans('global.income-category.fields.account-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('account_manager_id', $account_managers, old('account_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('account_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('account_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('quotation_number_id', trans('global.income-category.fields.quotation-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('quotation_number_id', $quotation_numbers, old('quotation_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('quotation_number_id'))
                        <p class="help-block">
                            {{ $errors->first('quotation_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('sales_order_number', trans('global.income-category.fields.sales-order-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sales_order_number', old('sales_order_number'), ['class' => 'form-control', 'placeholder' => 'Sales order No.']) !!}
                    @if($errors->has('sales_order_number'))
                        <p class="help-block">
                            {{ $errors->first('sales_order_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.income-category.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Quotation items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th class="text-center">@lang('#')</th>
                            <th >@lang('global.invoice-items.fields.item-description')</th>
                            <th width="19%">@lang('global.invoice-items.fields.qty')</th>
                            <th width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th width="15%">@lang('global.invoice-items.fields.total')</th>
                            <th width="9%">@lang('')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            @foreach ($income_category->invoice_items as $item)
                                <tr id='addr0'>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><input type="text" name='item_description[]' value='{{ $item->item_description }}'  placeholder='Enter Product Name' class="form-control"/></td>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name='qty[]' value='{{ $item->qty }}' placeholder='0' class="form-control qty" step="0" min="0"/>
                                            <div class="input-group-addon">km/m<sup>2</sup></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='unit_price[]' value='{{ $item->unit_price }}' placeholder='0.00' class="form-control price" step="0.00" min="0"/>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='total[]' placeholder='0.00' value='{{ $item->qty * $item->unit_price }}' class="form-control total" readonly/>
                                        </div>
                                    </td>
                                    <td class="text-center"><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                                </tr>
                            @endforeach
                            <tr id='addr1'>
                                <td class="text-center">1</td>
                                <td><input type="text" name='item_description[]'  placeholder='Enter Product Name' class="form-control"/></td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='qty[]' placeholder='0' class="form-control qty" step="0" min="0"/>
                                        <div class="input-group-addon">km/m<sup>2</sup></div>
                                    </div>
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
                                            <input type="text" name='subtotal' value='{{ $income_category->subtotal }}' placeholder='0.00' class="form-control" id="subtotal" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name="vat" value='{{ $income_category->vat }}' class="form-control" id="tax" placeholder="0" name="invoice[vat_percent]">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='vat_amount' value='{{ $income_category->vat_amount }}' id="vat_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Total Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='tota$l_amount' value='{{ $income_category->total_amount }}' id="total_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to date</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='paid_to_date' value='{{ $income_category->paid_to_date }}' id="paid_to_date" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='balance' value='{{ $income_category->balance }}' id="balance" placeholder='0.00' class="form-control" readonly/>
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

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="item-descriptions-template">
        @include('admin.income_categories.invoice_items_row',
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