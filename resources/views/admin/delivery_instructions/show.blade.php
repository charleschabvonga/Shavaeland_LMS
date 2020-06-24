@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <p class='pull-right'>
                        <a href="{{ route('admin.delivery_instructions.download',$delivery_instruction->id) }}" class="btn btn btn-warning">View Delivery Instruction in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br><br>
                                <b>Reg No</b>: {{ config('invoices.reg_number') }}<br>
                                <h1><span style="color:#CE8F64">DELIVERY NOTE</span></h1>
                                <h4><b>Delivery Instruction No</b>: <span style="color:red">{{ $delivery_instruction->delivery_instruction_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            <b>Loading Instruction To</b>: <span style="color:#CE8F64">{{ $delivery_instruction->client->name or '' }}</span>
                            @if ($delivery_instruction->client->vat != '')
                                <br><b>VAT No</b>: {{ $delivery_instruction->client->vat or '' }}
                            @endif
                            @if ($delivery_instruction->client->street_address != '')
                                <br><b>Address</b>: {{ $delivery_instruction->client->street_address or '' }}
                            @endif
                            @if ($delivery_instruction->client->city != '')
                                <br>{{ $delivery_instruction->client->city or '' }}
                            @endif
                            @if ($delivery_instruction->client->country != '')
                                ,{{ $delivery_instruction->client->country or '' }}
                            @endif
                            @if ($delivery_instruction->client->zip_code != '')
                                ,{{ $delivery_instruction->client->zip_code or '' }}
                            @endif
                            @if ($delivery_instruction->client->phone_number_1 != '')
                                <br><b>Tel</b>: {{ $delivery_instruction->client->phone_number_1 or '' }}
                            @endif
                             @if ($delivery_instruction->client->fax_number != '')
                                <br><b>Fax</b>: {{ $delivery_instruction->client->fax_number or '' }}
                            @endif
                            @if ($delivery_instruction->client->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $delivery_instruction->client->email or '' }}</span>
                            @endif
                            @if ($delivery_instruction->client->website != '')
                                <br><b>Website</b>: {{ $delivery_instruction->client->website or '' }}
                            @endif
                            @if ($delivery_instruction->contact_person->contact_name != '')
                                <br><br><b>Attention</b>: <span style="color:#CE8F64">{{ $delivery_instruction->contact_person->contact_name or '' }}</span>
                            @endif
                            @if ($delivery_instruction->contact_person->phone_number != '')
                                <br><b>Tel</b>: {{ $delivery_instruction->contact_person->phone_number or '' }}
                            @endif
                            @if ($delivery_instruction->contact_person->email != '')
                                <br><b>Email</b>: <span style="color:blue">{{ $delivery_instruction->contact_person->email or '' }}</span>
                            @endif

                             @if ($delivery_instruction->delivery_company_name != '')
                                 <br><br><b>Pickup Company Name</b>: <span style="color:#CE8F64">{{ $delivery_instruction->delivery_company_name }}</span>
                            @endif
                            @if ($delivery_instruction->delivery_address_address != '')
                                <br><b>Address</b>: {{ $delivery_instruction->delivery_address_address }}
                            @endif
                            
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            <b>Road Freight No</b>: {{ $delivery_instruction->road_freight_number->road_freight_number or '' }}<br>
                            @if ($delivery_instruction->order_number != '')
                                <b>Order No</b>: {{ $delivery_instruction->order_number }}<br>
                            @endif
                            @if ($delivery_instruction->driver != '')
                                <b>Driver</b>: {{ $delivery_instruction->driver->name or '' }}<br>
                            @endif
                            @if ($delivery_instruction->vendor_driver != '')
                                <b>Driver</b>: {{ $delivery_instruction->vendor_driver->name or '' }}<br>
                            @endif 
                            @if ($delivery_instruction->pickup_date_time != '')
                                <b>Date</b>: {{ $delivery_instruction->pickup_date_time or '' }}<br>
                            @endif
                            @if ($delivery_instruction->status != '')
                                <b>Status</b>: {{ $delivery_instruction->status or '' }}<br>
                            @endif

                            @if ($delivery_instruction->freight_contract_type != '')
                                <b>Carrier type</b>: {{ $delivery_instruction->freight_contract_type }}<br>
                            @endif

                            @if ($delivery_instruction->freight_contract_type != 'Shavaeland')
                                <b>Subcontractor</b>: {{ $delivery_instruction->vendor->name or '' }}<br>
                            @endif

                            @if ($delivery_instruction->vehicle != '')
                                <b>Horse reg No</b>: {{ $delivery_instruction->vehicle->vehicle_description or '' }}<br>
                                <b>Trailer(s)</b>:
                                @foreach ($delivery_instruction->trailers as $singleTrailers)
                                    <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                @endforeach
                            @endif
                   
                            @if ($delivery_instruction->vehicle == '')
                            <b>Vehicle(s)</b>: 
                            @foreach ($delivery_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                <b>Vehicle(s)</b>: <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                            @endforeach
                            @endif

                            @if ($delivery_instruction->prepared_by != '')
                                <br><br><b>Quoted by</b>: <span style="color:#CE8F64">{{ $delivery_instruction->prepared_by }}</span>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Loading Instruction From</b>: <span style="color:#CE8F64">{{ config('invoices.seller.name') }}</span><br>
                            <b>VAT No</b>: {{ config('invoices.vat_number') }}<br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($delivery_instruction->project_manager != '')
                                <b>Project Manager</b>: <span style="color:#CE8F64">{{ $delivery_instruction->project_manager->name or '' }}</span>
                            @endif<br>
                            @if ($delivery_instruction->project_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $delivery_instruction->project_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($delivery_instruction->project_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $delivery_instruction->project_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped" id="tab_logic">
                                <legend class="text-center"><span style="color:#CE8F64">LOAD DESCRIPTIONS</span></legend>
                                <thead>
                                <tr>
                                    <th>@lang('global.load-descriptions.fields.description')</th>
                                    <th width="15%" class="text-center">@lang('global.load-descriptions.fields.qty')</th>
                                    <th width="15%" class="text-center">@lang('global.load-descriptions.fields.weight-volume')</th>
                                </tr>
                                </thead>
                                <tbody id="load-descriptions">
                                @foreach($delivery_instruction->load_descriptions as $item)
                                    <tr id='addr0'>
                                        <td class="text-left">{{ $item->description }}</td>
                                        <td class="text-center">{{ $item->qty }}</td>
                                        <td class="text-center">{{ $item->weight_volume }} kg/tonnes</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <strong>{{ $delivery_instruction->delivery_address_address }}</strong>
                    <div id='delivery_address-map' style='width: 1025px;height: 200px;' class='map' data-key='delivery_address' data-latitude='{{$delivery_instruction->delivery_address_latitude}}' data-longitude='{{$delivery_instruction->delivery_address_longitude}}'></div>

                    <div class="row text-center">
                        <br><br><p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue accounts are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs --> 

            <a href="{{ route('admin.delivery_instructions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop
