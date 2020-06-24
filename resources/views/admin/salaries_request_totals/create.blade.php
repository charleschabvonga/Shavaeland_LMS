@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.salaries_request_totals.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">MONTHLY PAYSLIP BATCH</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('batch_number', trans('global.salaries-request-totals.fields.batch-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='batch_number' value='{{ $batch_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('batch_number'))
                        <p class="help-block">
                            {{ $errors->first('batch_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('starting_pay_date', trans('global.salaries-request-totals.fields.starting-pay-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('starting_pay_date', old('starting_pay_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('starting_pay_date'))
                        <p class="help-block">
                            {{ $errors->first('starting_pay_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('ending_pay_date', trans('global.salaries-request-totals.fields.ending-pay-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('ending_pay_date', old('ending_pay_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('ending_pay_date'))
                        <p class="help-block">
                            {{ $errors->first('ending_pay_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.salaries-request-totals.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
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