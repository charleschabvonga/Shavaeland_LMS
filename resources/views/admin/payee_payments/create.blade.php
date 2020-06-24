@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.payee_payments.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PAYSLIP PAYMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('payslip_number_id', trans('global.payee-payments.fields.payslip-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payslip_number_id', $payslip_numbers, old('payslip_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('payslip_number_id'))
                        <p class="help-block">
                            {{ $errors->first('payslip_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('employee_id', trans('global.payee-payments.fields.employee').'', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_id', $employees, old('employee_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('batch_number_id', trans('global.payee-payments.fields.batch-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('batch_number_id', $batch_numbers, old('batch_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('batch_number_id'))
                        <p class="help-block">
                            {{ $errors->first('batch_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payee_account_number_id', trans('global.payee-payments.fields.payee-account-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('payee_account_number_id', $payee_account_numbers, old('payee_account_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('payee_account_number_id'))
                        <p class="help-block">
                            {{ $errors->first('payee_account_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('entry_date', trans('global.payee-payments.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('payee_payment_number', trans('global.payee-payments.fields.payee-payment-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='payee_payment_number' value='{{ $payee_payment_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('payee_payment_number'))
                        <p class="help-block">
                            {{ $errors->first('payee_payment_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('prepared_by', trans('global.payee-payments.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('withdrawal_transaction_number_id', trans('global.payee-payments.fields.withdrawal-transaction-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('withdrawal_transaction_number_id', $withdrawal_transaction_numbers, old('withdrawal_transaction_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('withdrawal_transaction_number_id'))
                        <p class="help-block">
                            {{ $errors->first('withdrawal_transaction_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payment_mode', trans('global.payee-payments.fields.payment-mode').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payment_mode', $enum_payment_mode, old('payment_mode'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('payment_mode'))
                        <p class="help-block">
                            {{ $errors->first('payment_mode') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('amount', trans('global.payee-payments.fields.amount').'*', ['class' => 'control-label']) !!}
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

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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
            
@stop