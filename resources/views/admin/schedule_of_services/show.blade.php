@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" />
                                <h1><span style="color:#CE8F64">SCHEDULE OF SERVICE</span></h1>
                                <h4><b>Schedule No</b>: <span style="color:red">{{ $schedule_of_service->schedule_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($schedule_of_service->client != '')
                                <b>Client</b>: {{ $schedule_of_service->client->name or '' }}<br>
                            @endif
                            @if ($schedule_of_service->vehicle != '')
                                <b>Vehicle</b>: {{ $schedule_of_service->vehicle->vehicle_description or '' }}<br>
                            @endif
                            @if ($schedule_of_service->client_vehicle != '')
                                <b>Vehicle</b>: {{ $schedule_of_service->client_vehicle->registration_number or '' }}<br>
                            @endif
                            @if ($schedule_of_service->job_card_number != '' && $schedule_of_service->job_card_number->job_card_number != '')
                                <b>Job card No</b>: {{ $schedule_of_service->job_card_number->job_card_number or '' }}<br>
                            @endif
                            @if ($schedule_of_service->description != '')
                                <b>Description</b>: {{ $schedule_of_service->description }}<br>
                            @endif
                            @if ($schedule_of_service->next_service_mileage != '')
                                <b>Next service mileage</b>: {{ number_format($schedule_of_service->next_service_mileage, 2) }} kms<br>
                            @endif
                            @if ($schedule_of_service->next_service_date != '')
                                <b>Next service date</b>: {{ $schedule_of_service->next_service_date }}<br>
                            @endif
                            @if ($schedule_of_service->status != '')
                                <b>Status</b>: {{ $schedule_of_service->status }}<br>
                            @endif                            
                        </div>
                        <div class="col-xs-4 form-group text-right"></div>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.schedule_of_services.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
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
