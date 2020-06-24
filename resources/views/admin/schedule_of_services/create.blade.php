@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.schedule_of_services.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">SCHEDULE OF SERVICE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('client_type', trans('global.schedule-of-service.fields.client-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_type', $enum_client_type, old('client_type'), ['class' => 'form-control select2 client_type']) !!}
                    @if($errors->has('client_type'))
                        <p class="help-block">
                            {{ $errors->first('client_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.schedule-of-service.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('job_card_number_id', trans('global.schedule-of-service.fields.job-card-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_card_number_id', $job_card_numbers, old('job_card_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('job_card_number_id'))
                        <p class="help-block">
                            {{ $errors->first('job_card_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group pull-right"></div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('schedule_number', trans('global.schedule-of-service.fields.schedule-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='schedule_number' value='{{ $schedule_number }}' class="form-control" required readonly/></td>
                    @if($errors->has('schedule_number'))
                        <p class="help-block">
                            {{ $errors->first('schedule_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-5 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">CUSTOMER INFO</span></legend> 
                            <div class="row">
                                <div class="col-xs-2 form-group"></div>
                                <div class="col-xs-8 form-group">
                                    {!! Form::label('client_vehicle_id', trans('global.schedule-of-service.fields.client-vehicle').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('client_vehicle_id', $client_vehicles, old('client_vehicle_id'), ['class' => 'form-control select2 client_vehicle_id']) !!}
                                    @if($errors->has('client_vehicle_id'))
                                        <p class="help-block">
                                            {{ $errors->first('client_vehicle_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-2 form-group"></div>
                            </div>
                            </table>
                        </div>
                    </div>
                </div>
               <div class="col-xs-1 form-group pull-right"></div>
                <div class="col-xs-5 form-group pull-right">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">DEPARTMENT INFO</span></legend>
                            <div class="row">
                                <div class="col-xs-2 form-group"></div>
                                <div class="col-xs-8 form-group">
                                    {!! Form::label('vehicle_id', trans('global.schedule-of-service.fields.vehicle').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control select2 vehicle_id']) !!}
                                    @if($errors->has('vehicle_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vehicle_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-2 form-group"></div>
                            </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-1 form-group"></div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('description', trans('global.schedule-of-service.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Description']) !!}
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('next_service_mileage', trans('global.schedule-of-service.fields.next-service-mileage').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_mileage', old('next_service_mileage'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('next_service_mileage'))
                        <p class="help-block">
                            {{ $errors->first('next_service_mileage') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('next_service_date', trans('global.schedule-of-service.fields.next-service-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('next_service_date', old('next_service_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('next_service_date'))
                        <p class="help-block">
                            {{ $errors->first('next_service_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.schedule-of-service.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-1 form-group"></div>
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

    <script>
        $(document).ready(function(){            
            $('.vehicle_id').prop('disabled', true);

            $('.client_type').change(function(){
                var selectedOption = $('.client_type option:selected');
                if(selectedOption.val() === 'Customer'){
                    $('.vehicle_id').prop('disabled', true);
                    $('.client_vehicle_id').prop('disabled', false); 
                }

                if(selectedOption.val() === 'Department'){
                    $('.vehicle_id').prop('disabled', false);
                    $('.client_vehicle_id').prop('disabled', true); 
                }
            });
        });
    </script>            
@stop