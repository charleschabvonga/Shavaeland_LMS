@extends('layouts.app')

@section('content')
    
    {!! Form::model($income, ['method' => 'PUT', 'route' => ['admin.incomes.update', $income->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">INCOME/DEBIT NOTE PAYMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.income.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payment_type', trans('global.income.fields.payment-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payment_type', $enum_payment_type, old('payment_type'), ['class' => 'form-control select2 payment_type', 'required' => '']) !!}
                    @if($errors->has('payment_type'))
                        <p class="help-block">
                            {{ $errors->first('payment_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('deposit_transaction_number_id', trans('global.income.fields.deposit-transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('deposit_transaction_number_id', $deposit_transaction_numbers, old('deposit_transaction_number_id'), ['class' => 'form-control select2 deposit_transaction_number_id']) !!}
                    @if($errors->has('deposit_transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('deposit_transaction_number_id') }}
                        </p>
                    @endif
                </div>
                
                <div class="col-xs-2 form-group pull-right">
                    <div class="col-xs-1 form-group pull-right"></div>
                    {!! Form::label('payment_number', trans('global.income.fields.payment-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_number', old('payment_number'), ['class' => 'form-control', 'placeholder' => 'Payment No.', 'readonly']) !!}
                    @if($errors->has('payment_number'))
                        <p class="help-block">
                            {{ $errors->first('payment_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.income.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">CLIENT INFO</span></legend>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('invoice_number_id', trans('global.income.fields.invoice-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('invoice_number_id', $invoice_numbers, old('invoice_number_id'), ['class' => 'form-control select2 invoice_number_id']) !!}
                                    @if($errors->has('invoice_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('invoice_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('sales_credit_note_number_id', trans('global.income.fields.sales-credit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('sales_credit_note_number_id', $sales_credit_note_numbers, old('sales_credit_note_number_id'), ['class' => 'form-control select2 sales_credit_note_number_id']) !!}
                                    @if($errors->has('sales_credit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('sales_credit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <br>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('client_id', trans('global.income.fields.client').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2 client_id']) !!}
                                    @if($errors->has('client_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_id') }}
                                        </p>
                                    @endif
                                </div> 
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xs-1 form-group pull-right"></div>
                <div class="col-xs-4 form-group pull-right">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">VENDOR INFO</span></legend>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('debit_note_number_id', trans('global.income.fields.debit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('debit_note_number_id', $debit_note_numbers, old('debit_note_number_id'), ['class' => 'form-control select2 debit_note_number_id']) !!}
                                    @if($errors->has('debit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('debit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <br>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('vendor_id', trans('global.income.fields.vendor').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2 vendor_id']) !!}
                                    @if($errors->has('vendor_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_id') }}
                                        </p>
                                    @endif
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('operation_type_id', trans('global.income.fields.operation-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('operation_type_id', $operation_types, old('operation_type_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('operation_type_id'))
                        <p class="help-block">
                            {{ $errors->first('operation_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('project_type_id', trans('global.income.fields.project-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_type_id', $project_types, old('project_type_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_type_id'))
                        <p class="help-block">
                            {{ $errors->first('project_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.income.fields.project-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('income_category', trans('global.income.fields.income-category').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('income_category', old('income_category'), ['class' => 'form-control', 'placeholder' => 'Income category', 'required' => '']) !!}
                    @if($errors->has('income_category'))
                        <p class="help-block">
                            {{ $errors->first('income_category') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('amount', trans('global.income.fields.amount').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '0.00', 'required' => '']) !!}
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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

    <script>
        $(document).ready(function(){            
            $('.vendor_id').prop('disabled', true);
            $('.debit_note_number_id').prop('disabled', true);
            $('.sales_credit_note_number_id').prop('disabled', true);

            $('.payment_type').change(function(){
                var selectedOption = $('.payment_type option:selected');
                if(selectedOption.val() === 'Invoice pymt'){
                    $('.client_id').prop('disabled', false);
                    $('.invoice_number_id').prop('disabled', false);
                    $('.sales_credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);

                    $('.deposit_transaction_number_id').prop('disabled', false);
                }

                if(selectedOption.val() === 'Invoice and credit note pymt'){
                    $('.client_id').prop('disabled', false);
                    $('.invoice_number_id').prop('disabled', false);
                    $('.sales_credit_note_number_id').prop('disabled', false);

                    $('.vendor_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);

                    $('.deposit_transaction_number_id').prop('disabled', true);
                }

                if(selectedOption.val() === 'Refund account credit'){
                    $('.client_id').prop('disabled', true);
                    $('.invoice_number_id').prop('disabled', true);
                    $('.sales_credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', false);

                    $('.deposit_transaction_number_id').prop('disabled', true);
                }

                if(selectedOption.val() === 'Refund cashback'){
                    $('.client_id').prop('disabled', true);
                    $('.invoice_number_id').prop('disabled', true);
                    $('.sales_credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', false);

                    $('.deposit_transaction_number_id').prop('disabled', false);
                }
            });
        });
    </script>
            
@stop