@extends('layouts.app')

@section('content')
    
    {!! Form::model($expense, ['method' => 'PUT', 'route' => ['admin.expenses.update', $expense->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">EXPENSE/CREDIT NOTE PAYMENTS</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.expense.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payment_type', trans('global.expense.fields.payment-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payment_type', $enum_payment_type, old('payment_type'), ['class' => 'form-control select2 payment_type', 'required' => '']) !!}
                    @if($errors->has('payment_type'))
                        <p class="help-block">
                            {{ $errors->first('payment_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('withdrawal_transaction_number_id', trans('global.expense.fields.withdrawal-transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('withdrawal_transaction_number_id', $withdrawal_transaction_numbers, old('withdrawal_transaction_number_id'), ['class' => 'form-control select2 withdrawal_transaction_number_id']) !!}
                    @if($errors->has('withdrawal_transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('withdrawal_transaction_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('payment_number', trans('global.expense.fields.payment-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_number', old('payment_number'), ['class' => 'form-control', 'placeholder' => 'Payment No.', 'readonly']) !!}
                    @if($errors->has('payment_number'))
                        <p class="help-block">
                            {{ $errors->first('payment_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.expense.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated','readonly']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">VENDOR INFO</span></legend>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('vendor_credit_note_number_id', trans('global.expense.fields.vendor-credit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_credit_note_number_id', $vendor_credit_note_numbers, old('vendor_credit_note_number_id'), ['class' => 'form-control select2 vendor_credit_note_number_id']) !!}
                                    @if($errors->has('vendor_credit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_credit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('debit_note_number_id', trans('global.expense.fields.debit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('debit_note_number_id', $debit_note_numbers, old('debit_note_number_id'), ['class' => 'form-control select2 debit_note_number_id']) !!}
                                    @if($errors->has('debit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('debit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <br>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('vendor_id', trans('global.expense.fields.vendor').'', ['class' => 'control-label']) !!}
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
               
                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">CLIENT INFO</span></legend>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('client_credit_note_number_id', trans('global.expense.fields.client-credit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_credit_note_number_id', $client_credit_note_numbers, old('client_credit_note_number_id'), ['class' => 'form-control select2 client_credit_note_number_id']) !!}
                                    @if($errors->has('client_credit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_credit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <br>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('client_id', trans('global.expense.fields.client').'', ['class' => 'control-label']) !!}
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
            </div
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('operation_type_id', trans('global.expense.fields.operation-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('operation_type_id', $operation_types, old('operation_type_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('operation_type_id'))
                        <p class="help-block">
                            {{ $errors->first('operation_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('transaction_type_id', trans('global.expense.fields.transaction-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_type_id', $transaction_types, old('transaction_type_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('transaction_type_id'))
                        <p class="help-block">
                            {{ $errors->first('transaction_type_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('transaction_number_id', trans('global.expense.fields.transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_number_id', $transaction_numbers, old('transaction_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('transaction_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('expense_category', trans('global.expense.fields.expense-category').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('expense_category', old('expense_category'), ['class' => 'form-control', 'placeholder' => 'Expense category', 'required' => '']) !!}
                    @if($errors->has('expense_category'))
                        <p class="help-block">
                            {{ $errors->first('expense_category') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('amount', trans('global.expense.fields.amount').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => '0.00', 'required' => '']) !!}
                    @if($errors->has('amount'))
                        <p class="help-block">
                            {{ $errors->first('amount') }}
                        </p>
                    @endif
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
            $('.client_id').prop('disabled', true);
            $('.client_credit_note_number_id').prop('disabled', true);
            $('.debit_note_number_id').prop('disabled', true);

            $('.payment_type').change(function(){
                var selectedOption = $('.payment_type option:selected');
                if(selectedOption.val() === 'Purchase credit note pymt'){
                    $('.vendor_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', true);
                    $('.vendor_credit_note_number_id').prop('disabled', false);

                    $('.client_id').prop('disabled', true);
                    $('.client_credit_note_number_id').prop('disabled', true);  

                    $('.withdrawal_transaction_number_id').prop('disabled', false);                                  
                }

                if(selectedOption.val() === 'Purchase credit note and debit note pymt'){
                    $('.vendor_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', false);
                    $('.vendor_credit_note_number_id').prop('disabled', false);


                    $('.client_id').prop('disabled', true);
                    $('.client_credit_note_number_id').prop('disabled', true);

                    $('.withdrawal_transaction_number_id').prop('disabled', true); 
                }

                if(selectedOption.val() === 'Refund cashback'){
                    $('.vendor_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);
                    $('.vendor_credit_note_number_id').prop('disabled', true);

                    $('.client_id').prop('disabled', false);
                    $('.client_credit_note_number_id').prop('disabled', false);

                    $('.withdrawal_transaction_number_id').prop('disabled', false); 
                }

                if(selectedOption.val() === 'Refund account credit'){
                    $('.vendor_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);
                    $('.vendor_credit_note_number_id').prop('disabled', true);

                    $('.client_id').prop('disabled', false);
                    $('.client_credit_note_number_id').prop('disabled', false);

                    $('.withdrawal_transaction_number_id').prop('disabled', true);                    

                }

                if(selectedOption.val() === 'Salaries'){
                    $('.vendor_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);
                    $('.vendor_credit_note_number_id').prop('disabled', false);

                    $('.client_id').prop('disabled', false);
                    $('.client_credit_note_number_id').prop('disabled', false);

                    $('.withdrawal_transaction_number_id').prop('disabled', false); 
                }
            });
        });
    </script>
            
@stop