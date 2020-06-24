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
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">TRANSPORTER REQUIREMENT</span></h1>
                                <h4><b>Transporter No</b>: <span style="color:red">{{ $road_freight_sub_contractor->subcontractor_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-3 form-group"></div>
                        <div class="col-xs-6 form-group text-center">
                            <b>Transporter</b>: <span style="color:#CE8F64">{{ $road_freight_sub_contractor->vendor->name }}</span>
                            <br><b>Git cover No</b>: {{ $road_freight_sub_contractor->git_cover_number }}
                            @if($road_freight_sub_contractor->git_cover)<a href="{{ asset(env('UPLOAD_PATH').'/' . $road_freight_sub_contractor->git_cover) }}" target="_blank">Download file</a>@endif
                            <br><b>Status</b>: {{ $road_freight_sub_contractor->status }}<br>                  
                        </div>
                        <div class="col-xs-3 form-group"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">VEHICLES</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Registration No.')</th>
                                            <th>@lang('Vehicle type')</th>
                                            <th>@lang('Make')</th>
                                            <th>@lang('Model')</th>
                                            <th>@lang('COF No.')</th>
                                            <th>@lang('Tracker pin No.')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($road_freight_sub_contractor->vehicle_scs) > 0)
                                                @foreach ($road_freight_sub_contractor->vehicle_scs as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->registration_number }}</td>
                                                        <td class="text-left">{{ $item->vehicle_type }}</td>
                                                        <td class="text-left">{{ $item->make }}</td>
                                                        <td class="text-left">{{ $item->model }}</td>
                                                        <td class="text-left">{{ $item->certificate_of_fitness_number }}</td>
                                                        <td class="text-left">R {{ $item->tracker_pin_details }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">DRIVERS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Name')</th>
                                            <th>@lang('D.O.B')</th>
                                            <th>@lang('License No.')</th>
                                            <th>@lang('License expiry date')</th>
                                            <th>@lang('Passport')</th>
                                            <th>@lang('Passport date')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($road_freight_sub_contractor->driver) > 0)
                                                @foreach ($road_freight_sub_contractor->driver as $item)
                                                    <tr>
                                                        <td class="text-left">{{ $item->name }}</td>
                                                        <td class="text-left">{{ $item->date_of_birth }}</td>
                                                        <td class="text-left">{{ $item->drivers_license_number }}</td>
                                                        <td class="text-left">{{ $item->drivers_license_expiry_date }}</td>
                                                        <td class="text-left">{{ $item->drivers_passport_number }}</td>
                                                        <td class="text-left">{{ $item->passport_expiry_date }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#vehicle_sc" aria-controls="vehicle_sc" role="tab" data-toggle="tab">Transporter vehicles</a></li>
    <li role="presentation" class=""><a href="#drivers" aria-controls="drivers" role="tab" data-toggle="tab">Transporter drivers</a></li>
    <li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="vehicle_sc">
    <table class="table table-bordered table-striped {{ count($vehicle_scs) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.vehicle-sc.fields.vendor')</th>
                            <th>@lang('global.vehicle-sc.fields.subcontractor-number')</th>
                            <th>@lang('global.vehicle-sc.fields.vehicle-type')</th>
                            <th>@lang('global.vehicle-sc.fields.make')</th>
                            <th>@lang('global.vehicle-sc.fields.model')</th>
                            <th>@lang('global.vehicle-sc.fields.registration-number')</th>
                            <th>@lang('global.vehicle-sc.fields.certificate-of-registration')</th>
                            <th>@lang('global.vehicle-sc.fields.certificate-of-fitness-number')</th>
                            <th>@lang('global.vehicle-sc.fields.certificate-of-fitness')</th>
                            <th>@lang('global.vehicle-sc.fields.tracker-pin-details')</th>
                            <th>@lang('global.vehicle-sc.fields.tracker-password')</th>
                            <th>@lang('global.vehicle-sc.fields.expiration-date')</th>
                            <th>@lang('global.vehicle-sc.fields.service-history-reports')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($vehicle_scs) > 0)
                @foreach ($vehicle_scs as $vehicle_sc)
                    <tr data-entry-id="{{ $vehicle_sc->id }}">
                        <td field-key='vendor'>{{ $vehicle_sc->vendor->name or '' }}</td>
                                    <td field-key='subcontractor_number'>{{ $vehicle_sc->subcontractor_number->subcontractor_number or '' }}</td>
                                    <td field-key='vehicle_type'>{{ $vehicle_sc->vehicle_type }}</td>
                                    <td field-key='make'>{{ $vehicle_sc->make }}</td>
                                    <td field-key='model'>{{ $vehicle_sc->model }}</td>
                                    <td field-key='registration_number'>{{ $vehicle_sc->registration_number }}</td>
                                    <td field-key='certificate_of_registration'>@if($vehicle_sc->certificate_of_registration)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_registration) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='certificate_of_fitness_number'>{{ $vehicle_sc->certificate_of_fitness_number }}</td>
                                    <td field-key='certificate_of_fitness'>@if($vehicle_sc->certificate_of_fitness)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_fitness) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='tracker_pin_details'>{{ $vehicle_sc->tracker_pin_details }}</td>
                                    <td>---</td>
                                    <td field-key='expiration_date'>{{ $vehicle_sc->expiration_date }}</td>
                                    <td field-key='service_history_reports'>@if($vehicle_sc->service_history_reports)<a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->service_history_reports) }}" target="_blank">Download file</a>@endif</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vehicle_scs.restore', $vehicle_sc->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vehicle_scs.perma_del', $vehicle_sc->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('vehicle_sc_view')
                                        <a href="{{ route('admin.vehicle_scs.show',[$vehicle_sc->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('vehicle_sc_edit')
                                        <a href="{{ route('admin.vehicle_scs.edit',[$vehicle_sc->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('vehicle_sc_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.vehicle_scs.destroy', $vehicle_sc->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="drivers">
    <table class="table table-bordered table-striped {{ count($drivers) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.drivers.fields.vendor')</th>
                            <th>@lang('global.drivers.fields.subcontractor-number')</th>
                            <th>@lang('global.drivers.fields.name')</th>
                            <th>@lang('global.drivers.fields.date-of-birth')</th>
                            <th>@lang('global.drivers.fields.drivers-license-number')</th>
                            <th>@lang('global.drivers.fields.drivers-license')</th>
                            <th>@lang('global.drivers.fields.drivers-license-expiry-date')</th>
                            <th>@lang('global.drivers.fields.int-drivers-license-no')</th>
                            <th>@lang('global.drivers.fields.int-drivers-license')</th>
                            <th>@lang('global.drivers.fields.int-drivers-license-expiry-date')</th>
                            <th>@lang('global.drivers.fields.drivers-passport-number')</th>
                            <th>@lang('global.drivers.fields.drivers-passport')</th>
                            <th>@lang('global.drivers.fields.passport-expiry-date')</th>
                            <th>@lang('global.drivers.fields.sa-phone-number')</th>
                            <th>@lang('global.drivers.fields.int-phone-number')</th>
                            <th>@lang('global.drivers.fields.police-clearance-expiry-date')</th>
                            <th>@lang('global.drivers.fields.police-clearance')</th>
                            <th>@lang('global.drivers.fields.retest-number')</th>
                            <th>@lang('global.drivers.fields.retest')</th>
                            <th>@lang('global.drivers.fields.retest-expiry-date')</th>
                            <th>@lang('global.drivers.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($drivers) > 0)
                @foreach ($drivers as $driver)
                    <tr data-entry-id="{{ $driver->id }}">
                        <td field-key='vendor'>{{ $driver->vendor->name or '' }}</td>
                                    <td field-key='subcontractor_number'>{{ $driver->subcontractor_number->subcontractor_number or '' }}</td>
                                    <td field-key='name'>{{ $driver->name }}</td>
                                    <td field-key='date_of_birth'>{{ $driver->date_of_birth }}</td>
                                    <td field-key='drivers_license_number'>{{ $driver->drivers_license_number }}</td>
                                    <td field-key='drivers_license'>@if($driver->drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_license) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='drivers_license_expiry_date'>{{ $driver->drivers_license_expiry_date }}</td>
                                    <td field-key='int_drivers_license_no'>{{ $driver->int_drivers_license_no }}</td>
                                    <td field-key='int_drivers_license'>@if($driver->int_drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->int_drivers_license) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='int_drivers_license_expiry_date'>{{ $driver->int_drivers_license_expiry_date }}</td>
                                    <td field-key='drivers_passport_number'>{{ $driver->drivers_passport_number }}</td>
                                    <td field-key='drivers_passport'>@if($driver->drivers_passport)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_passport) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='passport_expiry_date'>{{ $driver->passport_expiry_date }}</td>
                                    <td field-key='sa_phone_number'>{{ $driver->sa_phone_number }}</td>
                                    <td field-key='int_phone_number'>{{ $driver->int_phone_number }}</td>
                                    <td field-key='police_clearance_expiry_date'>{{ $driver->police_clearance_expiry_date }}</td>
                                    <td field-key='police_clearance'>@if($driver->police_clearance)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->police_clearance) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='retest_number'>{{ $driver->retest_number }}</td>
                                    <td field-key='retest'>@if($driver->retest)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->retest) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='retest_expiry_date'>{{ $driver->retest_expiry_date }}</td>
                                    <td field-key='status'>{{ $driver->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drivers.restore', $driver->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drivers.perma_del', $driver->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('driver_view')
                                        <a href="{{ route('admin.drivers.show',[$driver->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('driver_edit')
                                        <a href="{{ route('admin.drivers.edit',[$driver->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('driver_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.drivers.destroy', $driver->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="26">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="road_freights">
    <table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.road-freights.fields.project-number')</th>
                            <th>@lang('global.road-freights.fields.road-freight-number')</th>
                            <th>@lang('global.road-freights.fields.freight-contract-type')</th>
                            <th>@lang('global.road-freights.fields.route')</th>
                            <th>@lang('global.road-freights.fields.client')</th>
                            <th>@lang('global.road-freights.fields.contact-person')</th>
                            <th>@lang('global.road-freights.fields.project-manager')</th>
                            <th>@lang('global.road-freights.fields.driver')</th>
                            <th>@lang('global.road-freights.fields.vehicle')</th>
                            <th>@lang('global.road-freights.fields.trailers')</th>
                            <th>@lang('global.road-freights.fields.subcontractor-number')</th>
                            <th>@lang('global.road-freights.fields.vendor')</th>
                            <th>@lang('global.road-freights.fields.vendor-contact-person')</th>
                            <th>@lang('global.road-freights.fields.vendor-drivers')</th>
                            <th>@lang('global.road-freights.fields.vendor-vehicles')</th>
                            <th>@lang('global.road-freights.fields.road-freight-income')</th>
                            <th>@lang('global.road-freights.fields.road-freight-expenses')</th>
                            <th>@lang('global.road-freights.fields.machinery-costs')</th>
                            <th>@lang('global.road-freights.fields.breakdown')</th>
                            <th>@lang('global.road-freights.fields.total-expenses')</th>
                            <th>@lang('global.road-freights.fields.net-income')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($road_freights) > 0)
                @foreach ($road_freights as $road_freight)
                    <tr data-entry-id="{{ $road_freight->id }}">
                        <td field-key='project_number'>{{ $road_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                    <td field-key='freight_contract_type'>{{ $road_freight->freight_contract_type }}</td>
                                    <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                    <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $road_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $road_freight->project_manager->name or '' }}</td>
                                    <td field-key='driver'>{{ $road_freight->driver->name or '' }}</td>
                                    <td field-key='vehicle'>{{ $road_freight->vehicle->vehicle_description or '' }}</td>
                                    <td field-key='trailers'>
                                        @foreach ($road_freight->trailers as $singleTrailers)
                                            <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='subcontractor_number'>{{ $road_freight->subcontractor_number->subcontractor_number or '' }}</td>
                                    <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                    <td field-key='vendor_contact_person'>{{ $road_freight->vendor_contact_person->contact_name or '' }}</td>
                                    <td field-key='vendor_drivers'>
                                        @foreach ($road_freight->vendor_drivers as $singleVendorDrivers)
                                            <span class="label label-info label-many">{{ $singleVendorDrivers->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='vendor_vehicles'>
                                        @foreach ($road_freight->vendor_vehicles as $singleVendorVehicles)
                                            <span class="label label-info label-many">{{ $singleVendorVehicles->registration_number }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='road_freight_income'>{{ $road_freight->road_freight_income }}</td>
                                    <td field-key='road_freight_expenses'>{{ $road_freight->road_freight_expenses }}</td>
                                    <td field-key='machinery_costs'>{{ $road_freight->machinery_costs }}</td>
                                    <td field-key='breakdown'>{{ $road_freight->breakdown }}</td>
                                    <td field-key='total_expenses'>{{ $road_freight->total_expenses }}</td>
                                    <td field-key='net_income'>{{ $road_freight->net_income }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.restore', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.perma_del', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('road_freight_view')
                                        <a href="{{ route('admin.road_freights.show',[$road_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('road_freight_edit')
                                        <a href="{{ route('admin.road_freights.edit',[$road_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('road_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.road_freights.destroy', $road_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="26">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
    
                <p>&nbsp;</p>
    
                <a href="{{ route('admin.road_freight_sub_contractors.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
    