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
                                <h1><span style="color:#CE8F64">DRIVER</span></h1>
                                <h4><b>Name</b>: <span style="color:red">{{ $driver->name }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if ($driver->drivers_license_number != '')
                                <b>Drivers license No</b>: {{ $driver->drivers_license_number }}
                            @endif
                            @if($driver->int_drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->int_drivers_license) }}" target="_blank">Download file</a>@endif<br>
                            @if ($driver->drivers_license_expiry_date != '')
                                <b>License expiry date</b>: {{ $driver->drivers_license_expiry_date }}<br>
                            @endif
                            @if ($driver->drivers_passport_number != '')
                                <b>Passport No</b>: {{ $driver->drivers_passport_number }}
                            @endif
                            @if($driver->drivers_passport)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->drivers_passport) }}" target="_blank">Download file</a>@endif<br>
                            @if ($driver->passport_expiry_date != '')
                                <b>Passport expiry date</b>: {{ $driver->passport_expiry_date }}<br>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($driver->date_of_birth != '')
                                <b>Date of birth</b>: {{ $driver->date_of_birth }}<br>
                            @endif
                            @if ($driver->sa_phone_number != '')
                                <b>SA Tel</b>: {{ $driver->sa_phone_number }}<br>
                            @endif
                            @if ($driver->int_phone_number != '')
                                <b>Int Tel</b>: {{ $driver->int_phone_number }}<br>
                            @endif
                            <b>Vendor</b>: <span style="color:#CE8F64">{{ $driver->vendor->name or '' }}</span><br>
                            @if ($driver->subcontractor_number != '')
                                <b>Subcontractor No</b>: {{ $driver->subcontractor_number->subcontractor_number or '' }}<br>
                            @endif                           
                        </div>
                        <div class="col-xs-4 form-group text-right">
                            @if ($driver->int_drivers_license_no != '')
                                <b>Int drivers license No</b>: {{ $driver->int_drivers_license_no }}
                                @if($driver->int_drivers_license)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->int_drivers_license) }}" target="_blank">Download file</a>@endif<br>
                            @endif
                            @if ($driver->int_drivers_license_expiry_date != '')
                                <b>Int license expiry date</b>: {{ $driver->int_drivers_license_expiry_date }}<br>
                            @endif
                            @if ($driver->retest_number != '')
                                <b>Retest No</b>: {{ $driver->retest_number }}
                                @if($driver->retest)<a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->retest) }}" target="_blank">Download file</a>@endif<br>
                            @endif
                            @if ($driver->retest_expiry_date != '')
                                <b>Retest expiry date</b>: {{ $driver->retest_expiry_date }}<br>
                            @endif
                            @if($driver->police_clearance)<b>Police clearance</b>: <a href="{{ asset(env('UPLOAD_PATH').'/' . $driver->police_clearance) }}" target="_blank">Download file</a>@endif<br>
                            @if ($driver->police_clearance_expiry_date != '')                           
                                <b>Police clearance expiry date</b>: {{ $driver->police_clearance_expiry_date }}
                            @endif
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
<li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
<li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="loading_instruction">
<table class="table table-bordered table-striped {{ count($loading_instructions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.loading-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.loading-instruction.fields.freight-contract-type')</th>
                        <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                        <th>@lang('global.loading-instruction.fields.driver')</th>
                        <th>@lang('global.loading-instruction.fields.vehicle')</th>
                        <th>@lang('global.loading-instruction.fields.trailers')</th>
                        <th>@lang('global.loading-instruction.fields.vendor')</th>
                        <th>@lang('global.loading-instruction.fields.vendor-driver')</th>
                        <th>@lang('global.loading-instruction.fields.vendor-vehicle-description')</th>
                        <th>@lang('global.loading-instruction.fields.order-number')</th>
                        <th>@lang('global.loading-instruction.fields.client')</th>
                        <th>@lang('global.loading-instruction.fields.contact-person')</th>
                        <th>@lang('global.loading-instruction.fields.project-manager')</th>
                        <th>@lang('global.loading-instruction.fields.pick-up-company-name')</th>
                        <th>@lang('global.loading-instruction.fields.pickup-address')</th>
                        <th>@lang('global.loading-instruction.fields.pickup-date-time')</th>
                        <th>@lang('global.loading-instruction.fields.prepared-by')</th>
                        <th>@lang('global.loading-instruction.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($loading_instructions) > 0)
            @foreach ($loading_instructions as $loading_instruction)
                <tr data-entry-id="{{ $loading_instruction->id }}">
                    <td field-key='road_freight_number'>{{ $loading_instruction->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='freight_contract_type'>{{ $loading_instruction->freight_contract_type }}</td>
                                <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                <td field-key='driver'>{{ $loading_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle'>{{ $loading_instruction->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailers'>
                                    @foreach ($loading_instruction->trailers as $singleTrailers)
                                        <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor'>{{ $loading_instruction->vendor->name or '' }}</td>
                                <td field-key='vendor_driver'>{{ $loading_instruction->vendor_driver->name or '' }}</td>
                                <td field-key='vendor_vehicle_description'>
                                    @foreach ($loading_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='order_number'>{{ $loading_instruction->order_number }}</td>
                                <td field-key='client'>{{ $loading_instruction->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $loading_instruction->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $loading_instruction->project_manager->name or '' }}</td>
                                <td field-key='pick_up_company_name'>{{ $loading_instruction->pick_up_company_name }}</td>
                                <td field-key='pickup_address'>{{ $loading_instruction->pickup_address_address }}</td>
                                <td field-key='pickup_date_time'>{{ $loading_instruction->pickup_date_time }}</td>
                                <td field-key='prepared_by'>{{ $loading_instruction->prepared_by }}</td>
                                <td field-key='status'>{{ $loading_instruction->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.restore', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.perma_del', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('loading_instruction_view')
                                    <a href="{{ route('admin.loading_instructions.show',[$loading_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('loading_instruction_edit')
                                    <a href="{{ route('admin.loading_instructions.edit',[$loading_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('loading_instruction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.destroy', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="23">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="delivery_instruction">
<table class="table table-bordered table-striped {{ count($delivery_instructions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.delivery-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.delivery-instruction.fields.freight-contract-type')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-instruction-number')</th>
                        <th>@lang('global.delivery-instruction.fields.driver')</th>
                        <th>@lang('global.delivery-instruction.fields.vehicle')</th>
                        <th>@lang('global.delivery-instruction.fields.trailers')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor-driver')</th>
                        <th>@lang('global.delivery-instruction.fields.vendor-vehicle-description')</th>
                        <th>@lang('global.delivery-instruction.fields.order-number')</th>
                        <th>@lang('global.delivery-instruction.fields.client')</th>
                        <th>@lang('global.delivery-instruction.fields.contact-person')</th>
                        <th>@lang('global.delivery-instruction.fields.project-manager')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-company-name')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-address')</th>
                        <th>@lang('global.delivery-instruction.fields.delivery-date-time')</th>
                        <th>@lang('global.delivery-instruction.fields.prepared-by')</th>
                        <th>@lang('global.delivery-instruction.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($delivery_instructions) > 0)
            @foreach ($delivery_instructions as $delivery_instruction)
                <tr data-entry-id="{{ $delivery_instruction->id }}">
                    <td field-key='road_freight_number'>{{ $delivery_instruction->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='freight_contract_type'>{{ $delivery_instruction->freight_contract_type }}</td>
                                <td field-key='delivery_instruction_number'>{{ $delivery_instruction->delivery_instruction_number }}</td>
                                <td field-key='driver'>{{ $delivery_instruction->driver->name or '' }}</td>
                                <td field-key='vehicle'>{{ $delivery_instruction->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailers'>
                                    @foreach ($delivery_instruction->trailers as $singleTrailers)
                                        <span class="label label-info label-many">{{ $singleTrailers->trailer_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor'>{{ $delivery_instruction->vendor->name or '' }}</td>
                                <td field-key='vendor_driver'>{{ $delivery_instruction->vendor_driver->name or '' }}</td>
                                <td field-key='vendor_vehicle_description'>
                                    @foreach ($delivery_instruction->vendor_vehicle_description as $singleVendorVehicleDescription)
                                        <span class="label label-info label-many">{{ $singleVendorVehicleDescription->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='order_number'>{{ $delivery_instruction->order_number }}</td>
                                <td field-key='client'>{{ $delivery_instruction->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $delivery_instruction->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $delivery_instruction->project_manager->name or '' }}</td>
                                <td field-key='delivery_company_name'>{{ $delivery_instruction->delivery_company_name }}</td>
                                <td field-key='delivery_address'>{{ $delivery_instruction->delivery_address_address }}</td>
                                <td field-key='delivery_date_time'>{{ $delivery_instruction->delivery_date_time }}</td>
                                <td field-key='prepared_by'>{{ $delivery_instruction->prepared_by }}</td>
                                <td field-key='status'>{{ $delivery_instruction->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.restore', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.perma_del', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('delivery_instruction_view')
                                    <a href="{{ route('admin.delivery_instructions.show',[$delivery_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('delivery_instruction_edit')
                                    <a href="{{ route('admin.delivery_instructions.edit',[$delivery_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('delivery_instruction_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.delivery_instructions.destroy', $delivery_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="23">@lang('global.app_no_entries_in_table')</td>
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

            <a href="{{ route('admin.drivers.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
