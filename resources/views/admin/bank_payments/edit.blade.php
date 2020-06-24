@extends('layouts.app')

@section('content')
    
    {!! Form::model($bank_payment, ['method' => 'PUT', 'route' => ['admin.bank_payments.update', $bank_payment->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">INBOUND DEPOSIT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.bank-payments.fields.entry-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'Entry date', 'required' => '']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('depositor', trans('global.bank-payments.fields.depositor').'', ['class' => 'control-label']) !!}
                    {!! Form::select('depositor', $enum_depositor, old('depositor'), ['class' => 'form-control select2 depositor']) !!}
                    @if($errors->has('depositor'))
                        <p class="help-block">
                            {{ $errors->first('depositor') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('payment_mode', trans('global.bank-payments.fields.payment-mode').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('payment_mode', $enum_payment_mode, old('payment_mode'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('payment_mode'))
                        <p class="help-block">
                            {{ $errors->first('payment_mode') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('payment_number', trans('global.bank-payments.fields.payment-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('payment_number', old('payment_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('payment_number'))
                        <p class="help-block">
                            {{ $errors->first('payment_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.bank-payments.fields.prepared-by').'', ['class' => 'control-label']) !!}
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
                            <legend class="text-center"><span style="color:#CE8F64">CLIENT INFO</span></legend>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('client_id', trans('global.bank-payments.fields.client').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2 client_id']) !!}
                                    @if($errors->has('client_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('account_number_id', trans('global.bank-payments.fields.account-number').'', ['class' => 'control-label']) !!}
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
                            <legend class="text-center"><span style="color:#CE8F64">VENDOR INFO</span></legend>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('vendor_id', trans('global.bank-payments.fields.vendor').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2 vendor_id']) !!}
                                    @if($errors->has('vendor_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-4 form-group">
                                    {!! Form::label('vendor_account_number_id', trans('global.bank-payments.fields.vendor-account-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_account_number_id', $vendor_account_numbers, old('vendor_account_number_id'), ['class' => 'form-control select2 vendor_account_number_id']) !!}
                                    @if($errors->has('vendor_account_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_account_number_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-4 form-group pull-right">
                                    {!! Form::label('debit_note_number_id', trans('global.bank-payments.fields.debit-note-number').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('debit_note_number_id', $debit_note_numbers, old('debit_note_number_id'), ['class' => 'form-control select2 debit_note_number_id']) !!}
                                    @if($errors->has('debit_note_number_id'))
                                        <p class="help-block">
                                            {{ $errors->first('debit_note_number_id') }}
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
                    {!! Form::label('upload_document', trans('global.bank-payments.fields.upload-document').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('balance', trans('global.bank-payments.fields.balance').'', ['class' => 'control-label']) !!}
                    {!! Form::text('balance', old('balance'), ['class' => 'form-control', 'placeholder' => '0.00', 'readonly']) !!}
                    @if($errors->has('balance'))
                        <p class="help-block">
                            {{ $errors->first('balance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('amount', trans('global.bank-payments.fields.amount').'*', ['class' => 'control-label']) !!}
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
            $('.vendor_account_number_id').prop('disabled', true);
            $('.debit_note_number_id').prop('disabled', true);

            $('.depositor').change(function(){
                var selectedOption = $('.depositor option:selected');
                if(selectedOption.val() === 'Client'){     
                    $('.vendor_id').prop('disabled', true);
                    $('.vendor_account_number_id').prop('disabled', true);
                    $('.debit_note_number_id').prop('disabled', true);

                    $('.client_id').prop('disabled', false);
                    $('.account_number_id').prop('disabled', false); 
                }

                if(selectedOption.val() === 'Vendor advance pymt refund'){ 
                    $('.client_id').prop('disabled', true);
                    $('.account_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', false);
                    $('.vendor_account_number_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', false);
                }

                if(selectedOption.val() === 'Vendor purchase refund'){  
                    $('.client_id').prop('disabled', true);
                    $('.account_number_id').prop('disabled', true);

                    $('.vendor_id').prop('disabled', false);
                    $('.vendor_account_number_id').prop('disabled', false);
                    $('.debit_note_number_id').prop('disabled', true);
                }
            });
        });
    </script>            
@stop