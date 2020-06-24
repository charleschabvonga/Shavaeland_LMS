@extends('layouts.app')

@section('content')
    
    {!! Form::model($expense_category, ['method' => 'PUT', 'route' => ['admin.expense_categories.update', $expense_category->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            
            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">VENDOR TAX INVOICE</span></h1>
                    </div>
                @endif
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('transaction_type_id', trans('global.expense-category.fields.transaction-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_type_id', $transaction_types, old('transaction_type_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('transaction_type_id'))
                        <p class="help-block">
                            {{ $errors->first('transaction_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('transaction_number_id', trans('global.expense-category.fields.transaction-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_number_id', $transaction_numbers, old('transaction_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('transaction_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.expense-category.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('due_date', trans('global.expense-category.fields.due-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('due_date', old('due_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('due_date'))
                        <p class="help-block">
                            {{ $errors->first('due_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('prepared_by', trans('global.expense-category.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated','readonly']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('credit_note_number', trans('global.expense-category.fields.credit-note-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('credit_note_number', old('credit_note_number'), ['class' => 'form-control', 'placeholder' => 'Credit note No.', 'readonly']) !!}
                    @if($errors->has('credit_note_number'))
                        <p class="help-block">
                            {{ $errors->first('credit_note_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('vendor_id', trans('global.expense-category.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('contact_person_id', trans('global.expense-category.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('account_manager_id', trans('global.expense-category.fields.account-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('account_manager_id', $account_managers, old('account_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('account_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('account_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('purchase_order_number', trans('global.expense-category.fields.purchase-order-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('purchase_order_number', old('purchase_order_number'), ['class' => 'form-control', 'placeholder' => 'Purchase order No.']) !!}
                    @if($errors->has('purchase_order_number'))
                        <p class="help-block">
                            {{ $errors->first('purchase_order_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('upload_document', trans('global.expense-category.fields.upload-document').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('upload_document', old('upload_document')) !!}
                    {!! Form::file('upload_document', ['class' => 'form-control']) !!}
                    {!! Form::hidden('upload_document_max_size', 2) !!}
                    @if($errors->has('upload_document'))
                        <p class="help-block">
                            {{ $errors->first('upload_document') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.expense-category.fields.status').'', ['class' => 'control-label']) !!}
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
                            <th width="15%">@lang('global.invoice-items.fields.qty')</th>
                            <th width="15%">@lang('global.invoice-items.fields.unit-price')</th>
                            <th width="15%">@lang('global.invoice-items.fields.total')</th>
                            <th width="9%">@lang('')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            @foreach ($expense_category->invoice_items as $item)
                                <tr id='addr0'>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td><input type="text" name='item_description[]' value='{{ $item->item_description }}'  placeholder='Enter Product Name' class="form-control"/></td>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name='qty[]' value='{{ $item->qty }}' placeholder='0' class="form-control qty" step="0" min="0"/>
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
                                            <input type="text" name='subtotal' value='{{ $expense_category->subtotal }}' placeholder='0.00' class="form-control" id="subtotal" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT</th>
                                    <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name="vat" value='{{ $expense_category->vat }}' class="form-control" id="tax" placeholder="0" name="invoice[vat_percent]">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='vat_amount' value='{{ $expense_category->vat_amount }}' id="vat_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Total Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='total_amount' value='{{ $expense_category->total_amount }}' id="total_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to date</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='paid_to_date' value='{{ $expense_category->paid_to_date }}' id="paid_to_date" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='balance' value='{{ $expense_category->balance }}' id="balance" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <input type="button" id="add_row" class="btn btn-primary float-left" value="Add Row" />
                            <input type="button" id='delete_row' class="float-right btn btn-info" value="Delete Row" /><br><br>
                            <div>
                                {!! Form::label('terms_and_conditions', trans('global.credit-note.fields.terms-and-conditions').'', ['class' => 'control-label']) !!}
                                {!! Form::textarea('terms_and_conditions', old('terms_and_conditions'), ['class' => 'form-control ', 'placeholder' => 'Terms and conditions', 'rows'=> '8']) !!}
                                @if($errors->has('terms_and_conditions'))
                                    <p class="help-block">
                                        {{ $errors->first('terms_and_conditions') }}
                                    </p>
                                @endif
                            </div>
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
        @include('admin.expense_categories.invoice_items_row',
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
            rate=1+($('#tax').val()/100)
            $('.total').each(function() {
                //total += parseInt($(this).val())/rate;
                total += $(this).val()/rate;
            });
            $('#subtotal').val(total.toFixed(2));
            tax_sum=total/100*$('#tax').val();
            $('#vat_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum+total).toFixed(2));
            $('#balance').val(((tax_sum+total)-$('#paid_to_date').val()).toFixed(2));
        }
    </script>
@stop