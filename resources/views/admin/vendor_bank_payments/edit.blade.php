@extends('layouts.app')

@section('content')
    
    {!! Form::model($vendor_bank_payment, ['method' => 'PUT', 'route' => ['admin.vendor_bank_payments.update', $vendor_bank_payment->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">OUTBOUND DEPOSIT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.vendor-bank-payments.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('withdrawer', trans('global.vendor-bank-payments.fields.withdrawer').'', ['class' => 'control-label']) !!}
                    {!! Form::select('withdrawer', $enum_withdrawer, old('withdrawer'), ['class' => 'form-control select2 withdrawer']) !!}
                    @if($errors->has('withdrawer'))
                        <p class="help-block">
                            {{ $errors->first('withdrawer') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payment_mode', trans('global.vendor-bank-payments.fields.payment-mode').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payment_mode', $enum_payment_mode, old('payment_mode'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('payment_mode'))
                        <p class="help-block">
                            {{ $errors->first('payment_mode') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('payment_number', trans('global.vendor-bank-payments.fields.payment-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_number', old('payment_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('payment_number'))
                        <p class="help-block">
                            {{ $errors->first('payment_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.vendor-bank-payments.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated','readonly']) !!}
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-5 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">VENDOR INFO</span></legend>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('vendor_id', trans('global.vendor-bank-payments.fields.vendor').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2 vendor_id']) !!}
                                    @if($errors->has('vendor_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('account_number_id', trans('global.vendor-bank-payments.fields.account-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('account_number_id', $account_numbers, old('account_number_id'), ['class' => 'form-control select2 account_number_id']) !!}
                                    @if($errors->has('account_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('account_number_id') }}
                                        </p>
                                    @endif
                                </div> 
                            </table>
                        </div>
                    </div>
                </div>
               
                <div class="col-xs-7 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">CLIENT INFO</span></legend>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('client_id', trans('global.vendor-bank-payments.fields.client').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2 client_id']) !!}
                                    @if($errors->has('client_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('client_account_number_id', trans('global.vendor-bank-payments.fields.client-account-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_account_number_id', $client_account_numbers, old('client_account_number_id'), ['class' => 'form-control select2 client_account_number_id']) !!}
                                    @if($errors->has('client_account_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_account_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-4 form-group pull-right">
                                    {!! Form::label('credit_note_number_id', trans('global.vendor-bank-payments.fields.credit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('credit_note_number_id', $credit_note_numbers, old('credit_note_number_id'), ['class' => 'form-control select2 credit_note_number_id']) !!}
                                    @if($errors->has('credit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('credit_note_number_id') }}
                                        </p>
                                    @endif
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>            
            
            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('upload_document', trans('global.vendor-bank-payments.fields.upload-document').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('upload_document', old('upload_document')) !!}
                    {!! Form::file('upload_document', ['class' => 'form-control']) !!}
                    {!! Form::hidden('upload_document_max_size', 2) !!}
                    @if($errors->has('upload_document'))
                        <p class="help-block">
                            {{ $errors->first('upload_document') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('balance', trans('global.vendor-bank-payments.fields.balance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('balance', old('balance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('balance'))
                        <p class="help-block">
                            {{ $errors->first('balance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('amount', trans('global.vendor-bank-payments.fields.amount').'*', ['class' => 'control-label']) !!}
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
            $('.client_id').prop('disabled', true);
            $('.client_account_number_id').prop('disabled', true);
            $('.credit_note_number_id').prop('disabled', true);

            $('.withdrawer').change(function(){
                var selectedOption = $('.withdrawer option:selected');
                if(selectedOption.val() === 'Vendor'){
                    $('.client_id').prop('disabled', true);
                    $('.client_account_number_id').prop('disabled', true);
                    $('.credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', false);
                    $('.account_number_id').prop('disabled', false);
                }

                if(selectedOption.val() === 'Client advance pymt refund'){
                    $('.client_id').prop('disabled', false);
                    $('.client_account_number_id').prop('disabled', false);
                    $('.credit_note_number_id').prop('disabled', false);

                    $('.vendor_id').prop('disabled', true);
                    $('.account_number_id').prop('disabled', true);
                }

                if(selectedOption.val() === 'Client sale refund'){
                    $('.client_id').prop('disabled', false);
                    $('.client_account_number_id').prop('disabled', false);
                    $('.credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', true);
                    $('.account_number_id').prop('disabled', true);
                }

                if(selectedOption.val() === 'Department'){
                    $('.client_id').prop('disabled', false);
                    $('.client_account_number_id').prop('disabled', false);
                    $('.credit_note_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', true);
                    $('.account_number_id').prop('disabled', true);
                }
            });
        });
    </script>
            
@stop