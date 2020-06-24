@extends('layouts.app')

@section('content')
    
    {!! Form::model($payslip, ['method' => 'PUT', 'route' => ['admin.payslips.update', $payslip->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PAYSLIPS</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('payslip_number', trans('global.payslips.fields.payslip-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payslip_number', old('payslip_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    @if($errors->has('payslip_number'))
                        <p class="help-block">
                            {{ $errors->first('payslip_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.payslips.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('ending_date', trans('global.payslips.fields.ending-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ending_date', old('ending_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('ending_date'))
                        <p class="help-block">
                            {{ $errors->first('ending_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('starting_date', trans('global.payslips.fields.starting-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('starting_date', old('starting_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('starting_date'))
                        <p class="help-block">
                            {{ $errors->first('starting_date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('employee_id', trans('global.payslips.fields.employee').'', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_id', $employees, old('employee_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('batch_number_id', trans('global.payslips.fields.batch-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('batch_number_id', $batch_numbers, old('batch_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('batch_number_id'))
                        <p class="help-block">
                            {{ $errors->first('batch_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('account_number_id', trans('global.payslips.fields.account-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('account_number_id', $account_numbers, old('account_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('account_number_id'))
                        <p class="help-block">
                            {{ $errors->first('account_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.payslips.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('date', trans('global.payslips.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic_overtime_bonus">
                        <legend class="text-center"><span style="color:#CE8F64">INCOME</span></legend>
                        <thead>
                        <tr>
                            <th class="text-center">@lang('#')</th>
                            <th>@lang('global.invoice-items.fields.item-description')</th>
                            <th width="15%">@lang('global.invoice-items.fields.qty')</th>
                            <th width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th width="15%">@lang('global.invoice-items.fields.total')</th>
                            <th width="9%">@lang('')</th>                              
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            @foreach ($payslip->overtime_and_bonus_items as $item)
                                <tr id='addr0'>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><input type="text" name='item_description[]' value='{{ $item->item_description }}'  placeholder='Enter Product Name' class="form-control"/></td>
                                    <td><input type="text" name='qty[]' value='{{ $item->qty }}' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                    <td><input type="text" name='unit_price[]' value='{{ $item->unit_price }}' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                    <td><input type="text" name='total[]' placeholder='0.00' value='{{ number_format($item->qty * $item->unit_price, 2) }}' class="form-control total" readonly/></td>
                                    <td><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                                </tr>
                            @endforeach
                            <tr id='addr1'>
                                <td>1</td>
                                <td><input type="text" name='item_description[]'  placeholder='Enter Product Name' class="form-control"/></td>
                                <td><input type="text" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                <td><input type="text" name='unit_price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                <td><input type="text" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                <td><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-6">
                        <input type="button" id="add_row1" class="btn btn-primary float-left" value="Add Row" />
                        <input type="button" id='delete_row1' class="float-right btn btn-info" value="Delete Row" />
                    </div>
                    <div class="col-md-1 form-group pull-right"></div>
                    <div class="pull-right col-md-5">
                        <table class="table" id="tab_logic_overtime_bonus_total">
                            <tbody>
                            <tr>
                                <th class="text-right" width="45%">Gross Income</th>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='overtime_and_bonus_total' value='{{$payslip->overtime_and_bonus_total}}' placeholder='0.00' class="form-control overtime_and_bonus_total" id="overtime_and_bonus_total" readonly/>
                                    </div>
                                </td>
                            </tr>                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic_deduction">
                        <legend class="text-center"><span style="color:#CE8F64">DEDUCTIONS</span></legend>
                        <thead>
                        <tr>
                            <th class="text-center">@lang('#')</th>
                            <th>@lang('global.invoice-items.fields.item-description')</th>
                            <th width="15%">@lang('global.invoice-items.fields.qty')</th>
                            <th width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th width="15%">@lang('global.invoice-items.fields.total')</th>
                            <th width="9%">@lang('')</th>                              
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                             @foreach ($payslip->deduction_items as $item)
                                <tr id='addr0'>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><input type="text" name='item_description[]' value='{{ $item->item_description }}'  placeholder='Enter Product Name' class="form-control"/></td>
                                    <td><input type="text" name='qty[]' value='{{ $item->qty }}' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                    <td><input type="text" name='unit_price[]' value='{{ $item->unit_price }}' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                    <td><input type="text" name='total[]' placeholder='0.00' value='{{ number_format($item->qty * $item->unit_price, 2) }}' class="form-control total" readonly/></td>
                                    <td><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                                </tr>
                            @endforeach
                            <tr id='addr1'>
                                <td>1</td>
                                <td><input type="text" name='item_description[]'  placeholder='Enter Product Name' class="form-control"/></td>
                                <td><input type="text" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0"/></td>
                                <td><input type="text" name='unit_price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0"/></td>
                                <td><input type="text" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
                                <td><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-md-6">
                        <input type="button" id="add_row2" class="btn btn-primary float-left" value="Add Row" />
                        <input type="button" id='delete_row2' class="float-right btn btn-info" value="Delete Row" />
                    </div>
                    <div class="col-md-1 form-group pull-right"></div>
                    <div class="pull-right col-md-4">
                        <table class="table" id="tab_logic_deduction_total">
                            <tbody>
                            <tr>
                                <th class="text-right" width="42%">Total Deductions</th>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='deductions_total' value='{{$payslip->deductions_total}}' placeholder='0.00' class="form-control deductions_total" id="deductions_total" readonly/>
                                    </div>
                                </td>
                            </tr>                     
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-1 form-group pull-right"></div>
                <div class="pull-right col-md-4">
                    <table class="table" id="tab_logic_total">
                        <tbody>
                        <tr>
                            <th class="text-right" width="45%">Taxable income</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">R</div>
                                    <input type="text" name='gross' value='{{$payslip->gross}}' placeholder='0.00' class="form-control" id="gross" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Income tax rate</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <input type="text" name="income_tax" value='{{$payslip->income_tax}}' class="form-control" id="tax" placeholder="0" name="invoice[vat_percent]">
                                    <div class="input-group-addon">%</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Income tax amount</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">R</div>
                                    <input type="text" name='income_tax_amount' value='{{$payslip->income_tax_amount}}' id="income_tax_amount" placeholder='0.00' class="form-control" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Net income</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">R</div>
                                    <input type="text" name='net_income' value='{{$payslip->net_income}}' id="net_income" placeholder='0.00' class="form-control" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Paid to date</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">R</div>
                                    <input type="text" name='paid_to_date' value='{{$payslip->paid_to_date}}' id="paid_to_date" placeholder='0.00' class="form-control" readonly/>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-right">Balance</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <div class="input-group-addon">R</div>
                                    <input type="text" name='balance' value='{{$payslip->balance}}' id="balance" placeholder='0.00' class="form-control" readonly/>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="deduction-items-template">
        @include('admin.payslips.deduction_items_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="overtime-bonus-items-template">
        @include('admin.payslips.overtime_and_bonus_items_row',
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
            $("#add_row1").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic_overtime_bonus').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row1").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
                calc_overtime_bonus();
            });

            var j=1;
            $("#add_row2").click(function(){b=j-1;
                $('#adds'+j).html($('#adds'+b).html()).find('td:first-child').html(j+1);
                $('#tab_logic_deduction').append('<tr id="adds'+(j+1)+'"></tr>');
                j++;
            });
            $("#delete_row2").click(function(){
                if(j>1){
                    $("#adds"+(j-1)).html('');
                    j--;
                }
                calc_deduction();
            });

            $('#tab_logic_overtime_bonus tbody').on('keyup change',function(){
                calc_overtime_bonus();
            });
            $('#tab_logic_deduction tbody').on('keyup change',function(){
                calc_deduction();
            });
            $('#tax').on('keyup change',function(){
                calc_total();
            });
        });

        function calc_overtime_bonus()
        {
            $('#tab_logic_overtime_bonus tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty1 = $(this).find('.qty1').val();
                    var price1 = $(this).find('.price1').val();
                    $(this).find('.total1').val(qty1*price1);

                    calc_total();
                }
            });
        }

        function calc_deduction()
        {
            $('#tab_logic_deduction tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty2 = $(this).find('.qty2').val();
                    var price2 = $(this).find('.price2').val();
                    $(this).find('.total2').val(qty2*price2);

                    calc_total();
                }
            });
        }

        function calc_total()
        {
            total1=0;
            $('.total1').each(function() {
                total1 += parseInt($(this).val());
            });
            $('#overtime_and_bonus_total').val(total1.toFixed(2));

            total2=0;
            $('.total2').each(function() {
                total2 += parseInt($(this).val());
            });
            $('#deductions_total').val(total2.toFixed(2));

            total = total1-total2;

            $('#gross').val((total).toFixed(2));
            tax_sum=total/100*$('#tax').val();
            $('#income_tax_amount').val(tax_sum.toFixed(2));
            $('#net_income').val((total-tax_sum).toFixed(2));
            $('#balance').val(((total-tax_sum)-$('#paid_to_date').val()).toFixed(2));
        }
    </script>
@stop