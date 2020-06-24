@extends('layouts.app')

@section('content')
    
    {!! Form::model($debit_note, ['method' => 'PUT', 'route' => ['admin.debit_notes.update', $debit_note->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">DEBIT NOTES</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.debit-notes.fields.prepared-by').'', ['class' => 'control-label']) !!}
                     {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('debit_note_number', trans('global.debit-notes.fields.debit-note-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('debit_note_number', old('debit_note_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('debit_note_number'))
                        <p class="help-block">
                            {{ $errors->first('debit_note_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.debit-notes.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('refund_type', trans('global.debit-notes.fields.refund-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('refund_type', $enum_refund_type, old('refund_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('refund_type'))
                        <p class="help-block">
                            {{ $errors->first('refund_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('credit_note_payment_number_id', trans('global.debit-notes.fields.credit-note-payment-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('credit_note_payment_number_id', $credit_note_payment_numbers, old('credit_note_payment_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('credit_note_payment_number_id'))
                        <p class="help-block">
                            {{ $errors->first('credit_note_payment_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('transaction_number_id', trans('global.debit-notes.fields.transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_number_id', $transaction_numbers, old('transaction_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('transaction_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('credit_note_number_id', trans('global.debit-notes.fields.credit-note-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('credit_note_number_id', $credit_note_numbers, old('credit_note_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('credit_note_number_id'))
                        <p class="help-block">
                            {{ $errors->first('credit_note_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('withdrawal_transaction_number_id', trans('global.debit-notes.fields.withdrawal-transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('withdrawal_transaction_number_id', $withdrawal_transaction_numbers, old('withdrawal_transaction_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('withdrawal_transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('withdrawal_transaction_number_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('vendor_id', trans('global.debit-notes.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.debit-notes.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('account_manager_id', trans('global.debit-notes.fields.account-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('account_manager_id', $account_managers, old('account_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('account_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('account_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.debit-notes.fields.status').'', ['class' => 'control-label']) !!}
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
                            @foreach ($debit_note->invoice_items as $item)
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
                                            <input type="text" name='subtotal' value='{{ $debit_note->subtotal }}' placeholder='0.00' class="form-control" id="subtotal" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT</th>
                                    <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                            <input type="text" name="vat" value='{{ $debit_note->vat }}' class="form-control" id="tax" placeholder="0" name="invoice[vat_percent]">
                                            <div class="input-group-addon">%</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">VAT Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='vat_amount' value='{{ $debit_note->vat_amount }}' id="vat_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Total Amount</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='total_amount' value='{{ $debit_note->total_amount }}' id="total_amount" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Paid to date</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='paid_to_date' value='{{ $debit_note->paid_to_date }}' id="paid_to_date" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-right">Balance</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='balance' value='{{ $debit_note->balance }}' id="balance" placeholder='0.00' class="form-control" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <input type="button" id="add_row" class="btn btn-primary float-left" value="Add Row" />
                            <input type="button" id='delete_row' class="float-right btn btn-info" value="Delete Row" /><br><br>
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
        @include('admin.debit_notes.invoice_items_row',
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
@stop