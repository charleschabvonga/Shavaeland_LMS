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
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">TRAFFIC VIOLATION</span></h1>
                                <h4><b>Account No</b>: <span style="color:red">{{ $violation->citation_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Driver</b>: <span style="color:#CE8F64">{{ $violation->employee_name->name or '' }}</span>
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($violation->citation_date != '')
                                <b>Date</b>: {{ $violation->citation_date }}<br>
                            @endif
                            @if ($violation->road_freight_number != '')
                                <b>Road freight</b>: {{ $violation->road_freight_number->road_freight_number or '' }}<br>
                            @endif
                            @if ($violation->vehicle_description != '')
                                <b>Vehicle</b>: {{ $violation->vehicle_description->vehicle_description or '' }}<br>
                            @endif
                            @if ($violation->trailer != '')
                                <b>Vehicle</b>: {{ $violation->trailer->trailer_description or '' }}<br>
                            @endif
                            @if ($violation->description != '')
                                <b>Description</b>: {{ $violation->description }}<br>
                            @endif
                            @if ($violation->location_issued_address != '')
                                <b>Location</b>: {{ $violation->location_issued_address }}<br>
                            @endif
                            @if ($violation->status != '')
                                <b>Responsibilty status</b>: {{ $violation->status }}<br>
                            @endif
                            @if($violation->file)<b>File</b>: <a href="{{ asset(env('UPLOAD_PATH').'/' . $violation->file) }}" target="_blank">Download file</a>@endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <br><h3><span style="color:#CE8F64"><b>Amount</b>: R {{ number_format($violation->amount ,2) }}</spam></h3>
                        </div>
                    </div>
                    
                </div>
            </div><!-- Nav tabs -->


            <p>&nbsp;</p>

            <a href="{{ route('admin.violations.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
 
    <script>
        function initialize() {
            const maps = document.getElementsByClassName("map");
            for (let i = 0; i < maps.length; i++) {
                const field = maps[i]
                const fieldKey = field.dataset.key;
                const latitude = parseFloat(field.dataset.latitude) || -33.8688;
                const longitude = parseFloat(field.dataset.longitude) || 151.2195;
        
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });
        
                marker.setVisible(true);
            }    
              
          }
    </script>
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
