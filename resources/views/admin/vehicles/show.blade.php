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
                                <h1><span style="color:#CE8F64">HORSE</span></h1>
                                <h4><b>Horse Reg No.</b>: <span style="color:red">{{ $vehicle->vehicle_description }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if ($vehicle->service_status != '')
                                <b>Service status</b>: {{ $vehicle->service_status }}<br>
                            @endif
                            @if ($vehicle->starting_mileage != '')
                                <b>Starting mileage</b>: {{ number_format($vehicle->starting_mileage) }} kms<br>
                            @endif
                            @if ($vehicle->starting_mileage != '')
                                <b>Current mileage</b>: {{ number_format($vehicle->mileage) }} kms<br>
                            @endif
                            @if ($vehicle->next_service_mileage != '')
                                <b>Next service mileage</b>: {{ number_format($vehicle->next_service_mileage) }} kms<br>
                            @endif
                            @if ($vehicle->next_service_date != '')
                                <b>Next service date</b>: {{ $vehicle->next_service_date }}<br>
                            @endif
                        </div>
                        <div class="col-xs-4 form-group text-center">
                            @if ($vehicle->make != '')
                                <b>Make</b>: {{ $vehicle->make }}<br>
                            @endif
                            @if ($vehicle->model != '')
                                <b>Model</b>: {{ $vehicle->model }}<br>
                            @endif
                            @if ($vehicle->chasis_number != '')
                                <b>Chasis No</b>: {{ $vehicle->chasis_number }}<br>
                            @endif
                            @if ($vehicle->engine_number != '')
                                <b>Engine No</b>: {{ $vehicle->engine_number }}<br>
                            @endif
                            @if ($vehicle->size != '' && $vehicle->size->size != '')
                                <b>Size</b>: {{ $vehicle->size->size or '' }}<br>
                            @endif
                            @if ($vehicle->availability != '')
                                <b>Availability</b>: {{ $vehicle->availability }}<br>
                            @endif
                        </div>
                        <div class="col-xs-4 text-right">
                            @if ($vehicle->purchase_date != '')
                                <b>Purchase date</b>: {{ $vehicle->purchase_date }}<br>
                            @endif
                            @if ($vehicle->purchase_price != '')
                                <b>Purchase price</b>: R {{ number_format($vehicle->purchase_price, 2) }}<br>
                            @endif
                            @if ($vehicle->salvage_value != '')
                                <b>Salvage value</b>: R {{ number_format($vehicle->salvage_value, 2) }}<br>
                            @endif
                            @if ($vehicle->depreciation > 0)
                                <b>Depreciation</b>: <span style="color:red"> R {{ number_format($vehicle->depreciation, 2) }}</span><br>
                            @endif
                            @if ($vehicle->maintenance > 0)
                                <b>Maintenance bank</b>: R {{ number_format($vehicle->maintenance, 2) }}<br>
                            @endif
                            @if ($vehicle->tyre > 0)
                                <b>Tyre bank</b>: R {{ number_format($vehicle->tyre, 2) }}<br>
                            @endif
                        </div>
                    </div>

                </div>
                <ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#violations" aria-controls="violations" role="tab" data-toggle="tab">Traffic Violations</a></li>
<li role="presentation" class=""><a href="#fuel_costs" aria-controls="fuel_costs" role="tab" data-toggle="tab">Fuel purchases</a></li>
<li role="presentation" class=""><a href="#schedule_of_services" aria-controls="schedule_of_services" role="tab" data-toggle="tab">Schedule of services</a></li>
<li role="presentation" class=""><a href="#loading_instruction" aria-controls="loading_instruction" role="tab" data-toggle="tab">Loading instructions</a></li>
<li role="presentation" class=""><a href="#delivery_instruction" aria-controls="delivery_instruction" role="tab" data-toggle="tab">Delivery instructions</a></li>
<li role="presentation" class=""><a href="#income_expense_calculator" aria-controls="income_expense_calculator" role="tab" data-toggle="tab">Road freight estimations</a></li>
<li role="presentation" class=""><a href="#machinery_costs" aria-controls="machinery_costs" role="tab" data-toggle="tab">Machinery costs</a></li>
<li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
<li role="presentation" class=""><a href="#inhouse_job_cards" aria-controls="inhouse_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="violations">
<table class="table table-bordered table-striped {{ count($violations) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.violations.fields.employee-name')</th>
                        <th>@lang('global.violations.fields.vehicle-description')</th>
                        <th>@lang('global.violations.fields.trailer')</th>
                        <th>@lang('global.violations.fields.road-freight-number')</th>
                        <th>@lang('global.violations.fields.citation-number')</th>
                        <th>@lang('global.violations.fields.citation-date')</th>
                        <th>@lang('global.violations.fields.description')</th>
                        <th>@lang('global.violations.fields.location-issued')</th>
                        <th>@lang('global.violations.fields.status')</th>
                        <th>@lang('global.violations.fields.amount')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($violations) > 0)
            @foreach ($violations as $violation)
                <tr data-entry-id="{{ $violation->id }}">
                    <td field-key='employee_name'>{{ $violation->employee_name->name or '' }}</td>
                                <td field-key='vehicle_description'>{{ $violation->vehicle_description->vehicle_description or '' }}</td>
                                <td field-key='trailer'>{{ $violation->trailer->trailer_description or '' }}</td>
                                <td field-key='road_freight_number'>{{ $violation->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='citation_number'>{{ $violation->citation_number }}</td>
                                <td field-key='citation_date'>{{ $violation->citation_date }}</td>
                                <td field-key='description'>{{ $violation->description }}</td>
                                <td field-key='location_issued'>{{ $violation->location_issued_address }}</td>
                                <td field-key='file'>@if($violation->file)<a href="{{ asset(env('UPLOAD_PATH').'/' . $violation->file) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='status'>{{ $violation->status }}</td>
                                <td field-key='amount'>{{ $violation->amount }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.violations.restore', $violation->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.violations.perma_del', $violation->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('violation_view')
                                    <a href="{{ route('admin.violations.show',[$violation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('violation_edit')
                                    <a href="{{ route('admin.violations.edit',[$violation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('violation_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.violations.destroy', $violation->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
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
<div role="tabpanel" class="tab-pane " id="fuel_costs">
<table class="table table-bordered table-striped {{ count($fuel_costs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.fuel-costs.fields.receipt-number')</th>
                        <th>@lang('global.fuel-costs.fields.road-freight-number')</th>
                        <th>@lang('global.fuel-costs.fields.vehicle')</th>
                        <th>@lang('global.fuel-costs.fields.description')</th>
                        <th>@lang('global.fuel-costs.fields.qty')</th>
                        <th>@lang('global.fuel-costs.fields.cost')</th>
                        <th>@lang('global.fuel-costs.fields.unit')</th>
                        <th>@lang('global.fuel-costs.fields.total')</th>
                        <th>@lang('global.fuel-costs.fields.currency')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($fuel_costs) > 0)
            @foreach ($fuel_costs as $fuel_cost)
                <tr data-entry-id="{{ $fuel_cost->id }}">
                    <td field-key='receipt_number'>{{ $fuel_cost->receipt_number }}</td>
                                <td field-key='road_freight_number'>{{ $fuel_cost->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='vehicle'>{{ $fuel_cost->vehicle->vehicle_description or '' }}</td>
                                <td field-key='description'>{{ $fuel_cost->description }}</td>
                                <td field-key='qty'>{{ $fuel_cost->qty }}</td>
                                <td field-key='cost'>{{ $fuel_cost->cost }}</td>
                                <td field-key='unit'>{{ $fuel_cost->unit }}</td>
                                <td field-key='total'>{{ $fuel_cost->total }}</td>
                                <td field-key='currency'>{{ $fuel_cost->currency->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.restore', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.perma_del', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('fuel_cost_view')
                                    <a href="{{ route('admin.fuel_costs.show',[$fuel_cost->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('fuel_cost_edit')
                                    <a href="{{ route('admin.fuel_costs.edit',[$fuel_cost->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('fuel_cost_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.destroy', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="schedule_of_services">
<table class="table table-bordered table-striped {{ count($schedule_of_services) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.schedule-of-services.fields.client-type')</th>
                        <th>@lang('global.schedule-of-services.fields.client')</th>
                        <th>@lang('global.schedule-of-services.fields.job-card-number')</th>
                        <th>@lang('global.schedule-of-services.fields.vehicle')</th>
                        <th>@lang('global.schedule-of-services.fields.client-vehicle')</th>
                        <th>@lang('global.schedule-of-services.fields.description')</th>
                        <th>@lang('global.schedule-of-services.fields.next-service-mileage')</th>
                        <th>@lang('global.schedule-of-services.fields.next-service-date')</th>
                        <th>@lang('global.schedule-of-services.fields.status')</th>
                        <th>@lang('global.schedule-of-services.fields.schedule-number')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($schedule_of_services) > 0)
            @foreach ($schedule_of_services as $schedule_of_service)
                <tr data-entry-id="{{ $schedule_of_service->id }}">
                    <td field-key='client_type'>{{ $schedule_of_service->client_type }}</td>
                                <td field-key='client'>{{ $schedule_of_service->client->name or '' }}</td>
                                <td field-key='job_card_number'>{{ $schedule_of_service->job_card_number->job_card_number or '' }}</td>
                                <td field-key='vehicle'>{{ $schedule_of_service->vehicle->vehicle_description or '' }}</td>
                                <td field-key='client_vehicle'>{{ $schedule_of_service->client_vehicle->registration_number or '' }}</td>
                                <td field-key='description'>{{ $schedule_of_service->description }}</td>
                                <td field-key='next_service_mileage'>{{ $schedule_of_service->next_service_mileage }}</td>
                                <td field-key='next_service_date'>{{ $schedule_of_service->next_service_date }}</td>
                                <td field-key='status'>{{ $schedule_of_service->status }}</td>
                                <td field-key='schedule_number'>{{ $schedule_of_service->schedule_number }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedule_of_services.restore', $schedule_of_service->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedule_of_services.perma_del', $schedule_of_service->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('schedule_of_service_view')
                                    <a href="{{ route('admin.schedule_of_services.show',[$schedule_of_service->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('schedule_of_service_edit')
                                    <a href="{{ route('admin.schedule_of_services.edit',[$schedule_of_service->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('schedule_of_service_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.schedule_of_services.destroy', $schedule_of_service->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="loading_instruction">
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
<div role="tabpanel" class="tab-pane " id="income_expense_calculator">
<table class="table table-bordered table-striped {{ count($income_expense_calculators) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income-expense-calculator.fields.route')</th>
                        <th>@lang('global.income-expense-calculator.fields.distance')</th>
                        <th>@lang('global.income-expense-calculator.fields.load-status')</th>
                        <th>@lang('global.income-expense-calculator.fields.truck-attachment-status')</th>
                        <th>@lang('global.income-expense-calculator.fields.machinery-attachment-type')</th>
                        <th>@lang('global.income-expense-calculator.fields.size')</th>
                        <th>@lang('global.income-expense-calculator.fields.vehicles')</th>
                        <th>@lang('global.income-expense-calculator.fields.purchase-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.salvage-value')</th>
                        <th>@lang('global.income-expense-calculator.fields.avg-investment')</th>
                        <th>@lang('global.income-expense-calculator.fields.depreciation')</th>
                        <th>@lang('global.income-expense-calculator.fields.insurance')</th>
                        <th>@lang('global.income-expense-calculator.fields.license')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-usage')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-consumption')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil-usage')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil-consumption')</th>
                        <th>@lang('global.income-expense-calculator.fields.tyre-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.number-of-tyres')</th>
                        <th>@lang('global.income-expense-calculator.fields.tyre')</th>
                        <th>@lang('global.income-expense-calculator.fields.repair-maintenance')</th>
                        <th>@lang('global.income-expense-calculator.fields.contigency-factor')</th>
                        <th>@lang('global.income-expense-calculator.fields.trip-income')</th>
                        <th>@lang('global.income-expense-calculator.fields.other-costs')</th>
                        <th>@lang('global.income-expense-calculator.fields.total-costs')</th>
                        <th>@lang('global.income-expense-calculator.fields.balance')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($income_expense_calculators) > 0)
            @foreach ($income_expense_calculators as $income_expense_calculator)
                <tr data-entry-id="{{ $income_expense_calculator->id }}">
                    <td field-key='route'>{{ $income_expense_calculator->route->route or '' }}</td>
                                <td field-key='distance'>{{ $income_expense_calculator->distance }}</td>
                                <td field-key='load_status'>{{ $income_expense_calculator->load_status }}</td>
                                <td field-key='truck_attachment_status'>{{ $income_expense_calculator->truck_attachment_status->attachment or '' }}</td>
                                <td field-key='machinery_attachment_type'>{{ $income_expense_calculator->machinery_attachment_type->machinery_type or '' }}</td>
                                <td field-key='size'>{{ $income_expense_calculator->size->size or '' }}</td>
                                <td field-key='vehicles'>{{ $income_expense_calculator->vehicles->vehicle_description or '' }}</td>
                                <td field-key='purchase_price'>{{ $income_expense_calculator->purchase_price }}</td>
                                <td field-key='salvage_value'>{{ $income_expense_calculator->salvage_value }}</td>
                                <td field-key='avg_investment'>{{ $income_expense_calculator->avg_investment }}</td>
                                <td field-key='depreciation'>{{ $income_expense_calculator->depreciation }}</td>
                                <td field-key='insurance'>{{ $income_expense_calculator->insurance }}</td>
                                <td field-key='license'>{{ $income_expense_calculator->license }}</td>
                                <td field-key='fuel_price'>{{ $income_expense_calculator->fuel_price }}</td>
                                <td field-key='fuel_usage'>{{ $income_expense_calculator->fuel_usage }}</td>
                                <td field-key='fuel'>{{ $income_expense_calculator->fuel }}</td>
                                <td field-key='fuel_consumption'>{{ $income_expense_calculator->fuel_consumption }}</td>
                                <td field-key='oil_price'>{{ $income_expense_calculator->oil_price }}</td>
                                <td field-key='oil_usage'>{{ $income_expense_calculator->oil_usage }}</td>
                                <td field-key='oil'>{{ $income_expense_calculator->oil }}</td>
                                <td field-key='oil_consumption'>{{ $income_expense_calculator->oil_consumption }}</td>
                                <td field-key='tyre_price'>{{ $income_expense_calculator->tyre_price }}</td>
                                <td field-key='number_of_tyres'>{{ $income_expense_calculator->number_of_tyres }}</td>
                                <td field-key='tyre'>{{ $income_expense_calculator->tyre }}</td>
                                <td field-key='repair_maintenance'>{{ $income_expense_calculator->repair_maintenance }}</td>
                                <td field-key='contigency_factor'>{{ $income_expense_calculator->contigency_factor }}</td>
                                <td field-key='trip_income'>{{ $income_expense_calculator->trip_income }}</td>
                                <td field-key='other_costs'>{{ $income_expense_calculator->other_costs }}</td>
                                <td field-key='total_costs'>{{ $income_expense_calculator->total_costs }}</td>
                                <td field-key='balance'>{{ $income_expense_calculator->balance }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.restore', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.perma_del', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('income_expense_calculator_view')
                                    <a href="{{ route('admin.income_expense_calculators.show',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_expense_calculator_edit')
                                    <a href="{{ route('admin.income_expense_calculators.edit',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_expense_calculator_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.destroy', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="35">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="machinery_costs">
<table class="table table-bordered table-striped {{ count($machinery_costs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.machinery-costs.fields.road-freight-number')</th>
                        <th>@lang('global.machinery-costs.fields.route')</th>
                        <th>@lang('global.machinery-costs.fields.distance')</th>
                        <th>@lang('global.machinery-costs.fields.load-status')</th>
                        <th>@lang('global.machinery-costs.fields.truck-attachment-status')</th>
                        <th>@lang('global.machinery-costs.fields.machinery-attachment-type')</th>
                        <th>@lang('global.machinery-costs.fields.size')</th>
                        <th>@lang('global.machinery-costs.fields.vehicle-description')</th>
                        <th>@lang('global.machinery-costs.fields.purchase-price')</th>
                        <th>@lang('global.machinery-costs.fields.salvage-value')</th>
                        <th>@lang('global.machinery-costs.fields.avg-investment')</th>
                        <th>@lang('global.machinery-costs.fields.depreciation')</th>
                        <th>@lang('global.machinery-costs.fields.insurance')</th>
                        <th>@lang('global.machinery-costs.fields.license')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-price')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-usage')</th>
                        <th>@lang('global.machinery-costs.fields.fuel')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-consumption')</th>
                        <th>@lang('global.machinery-costs.fields.oil-price')</th>
                        <th>@lang('global.machinery-costs.fields.oil-usage')</th>
                        <th>@lang('global.machinery-costs.fields.oil')</th>
                        <th>@lang('global.machinery-costs.fields.oil-consumption')</th>
                        <th>@lang('global.machinery-costs.fields.number-of-tyres')</th>
                        <th>@lang('global.machinery-costs.fields.tyre-price')</th>
                        <th>@lang('global.machinery-costs.fields.tyre')</th>
                        <th>@lang('global.machinery-costs.fields.repair-maintenance')</th>
                        <th>@lang('global.machinery-costs.fields.contigency-factor')</th>
                        <th>@lang('global.machinery-costs.fields.total-costs')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($machinery_costs) > 0)
            @foreach ($machinery_costs as $machinery_cost)
                <tr data-entry-id="{{ $machinery_cost->id }}">
                    <td field-key='road_freight_number'>{{ $machinery_cost->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='route'>{{ $machinery_cost->route->route or '' }}</td>
                                <td field-key='distance'>{{ $machinery_cost->distance }}</td>
                                <td field-key='load_status'>{{ $machinery_cost->load_status }}</td>
                                <td field-key='truck_attachment_status'>{{ $machinery_cost->truck_attachment_status->attachment or '' }}</td>
                                <td field-key='machinery_attachment_type'>{{ $machinery_cost->machinery_attachment_type->machinery_type or '' }}</td>
                                <td field-key='size'>{{ $machinery_cost->size->size or '' }}</td>
                                <td field-key='vehicle_description'>{{ $machinery_cost->vehicle_description->vehicle_description or '' }}</td>
                                <td field-key='purchase_price'>{{ $machinery_cost->purchase_price }}</td>
                                <td field-key='salvage_value'>{{ $machinery_cost->salvage_value }}</td>
                                <td field-key='avg_investment'>{{ $machinery_cost->avg_investment }}</td>
                                <td field-key='depreciation'>{{ $machinery_cost->depreciation }}</td>
                                <td field-key='insurance'>{{ $machinery_cost->insurance }}</td>
                                <td field-key='license'>{{ $machinery_cost->license }}</td>
                                <td field-key='fuel_price'>{{ $machinery_cost->fuel_price }}</td>
                                <td field-key='fuel_usage'>{{ $machinery_cost->fuel_usage }}</td>
                                <td field-key='fuel'>{{ $machinery_cost->fuel }}</td>
                                <td field-key='fuel_consumption'>{{ $machinery_cost->fuel_consumption }}</td>
                                <td field-key='oil_price'>{{ $machinery_cost->oil_price }}</td>
                                <td field-key='oil_usage'>{{ $machinery_cost->oil_usage }}</td>
                                <td field-key='oil'>{{ $machinery_cost->oil }}</td>
                                <td field-key='oil_consumption'>{{ $machinery_cost->oil_consumption }}</td>
                                <td field-key='number_of_tyres'>{{ $machinery_cost->number_of_tyres }}</td>
                                <td field-key='tyre_price'>{{ $machinery_cost->tyre_price }}</td>
                                <td field-key='tyre'>{{ $machinery_cost->tyre }}</td>
                                <td field-key='repair_maintenance'>{{ $machinery_cost->repair_maintenance }}</td>
                                <td field-key='contigency_factor'>{{ $machinery_cost->contigency_factor }}</td>
                                <td field-key='total_costs'>{{ $machinery_cost->total_costs }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.restore', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.perma_del', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('machinery_cost_view')
                                    <a href="{{ route('admin.machinery_costs.show',[$machinery_cost->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('machinery_cost_edit')
                                    <a href="{{ route('admin.machinery_costs.edit',[$machinery_cost->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('machinery_cost_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.destroy', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="33">@lang('global.app_no_entries_in_table')</td>
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
<div role="tabpanel" class="tab-pane " id="inhouse_job_cards">
<table class="table table-bordered table-striped {{ count($inhouse_job_cards) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.inhouse-job-cards.fields.date')</th>
                        <th>@lang('global.inhouse-job-cards.fields.vehicle-type')</th>
                        <th>@lang('global.inhouse-job-cards.fields.mileage')</th>
                        <th>@lang('global.inhouse-job-cards.fields.job-card-number')</th>
                        <th>@lang('global.inhouse-job-cards.fields.prepared-by')</th>
                        <th>@lang('global.inhouse-job-cards.fields.project-number')</th>
                        <th>@lang('global.inhouse-job-cards.fields.client-type')</th>
                        <th>@lang('global.inhouse-job-cards.fields.job-card-type')</th>
                        <th>@lang('global.inhouse-job-cards.fields.job-type')</th>
                        <th>@lang('global.inhouse-job-cards.fields.repair-center')</th>
                        <th>@lang('global.inhouse-job-cards.fields.technician')</th>
                        <th>@lang('global.inhouse-job-cards.fields.vehicle')</th>
                        <th>@lang('global.inhouse-job-cards.fields.trailer')</th>
                        <th>@lang('global.inhouse-job-cards.fields.light-vehicles')</th>
                        <th>@lang('global.inhouse-job-cards.fields.client-vehicle-reg-no')</th>
                        <th>@lang('global.inhouse-job-cards.fields.road-freight-number')</th>
                        <th>@lang('global.inhouse-job-cards.fields.remarks')</th>
                        <th>@lang('global.inhouse-job-cards.fields.instructions')</th>
                        <th>@lang('global.inhouse-job-cards.fields.subtotal')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($inhouse_job_cards) > 0)
            @foreach ($inhouse_job_cards as $inhouse_job_card)
                <tr data-entry-id="{{ $inhouse_job_card->id }}">
                    <td field-key='date'>{{ $inhouse_job_card->date }}</td>
                                <td field-key='vehicle_type'>{{ $inhouse_job_card->vehicle_type }}</td>
                                <td field-key='mileage'>{{ $inhouse_job_card->mileage }}</td>
                                <td field-key='job_card_number'>{{ $inhouse_job_card->job_card_number }}</td>
                                <td field-key='prepared_by'>{{ $inhouse_job_card->prepared_by }}</td>
                                <td field-key='project_number'>{{ $inhouse_job_card->project_number->operation_number or '' }}</td>
                                <td field-key='client_type'>{{ $inhouse_job_card->client_type }}</td>
                                <td field-key='job_card_type'>{{ $inhouse_job_card->job_card_type }}</td>
                                <td field-key='job_type'>{{ $inhouse_job_card->job_type }}</td>
                                <td field-key='repair_center'>{{ $inhouse_job_card->repair_center->center_name or '' }}</td>
                                <td field-key='technician'>
                                    @foreach ($inhouse_job_card->technician as $singleTechnician)
                                        <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vehicle'>{{ $inhouse_job_card->vehicle->vehicle_description or '' }}</td>
                                <td field-key='trailer'>{{ $inhouse_job_card->trailer->trailer_description or '' }}</td>
                                <td field-key='light_vehicles'>{{ $inhouse_job_card->light_vehicles->vehicle_description or '' }}</td>
                                <td field-key='client_vehicle_reg_no'>{{ $inhouse_job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                                <td field-key='road_freight_number'>{{ $inhouse_job_card->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='remarks'>{!! $inhouse_job_card->remarks !!}</td>
                                <td field-key='instructions'>{!! $inhouse_job_card->instructions !!}</td>
                                <td field-key='subtotal'>{{ $inhouse_job_card->subtotal }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.restore', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.perma_del', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('inhouse_job_card_view')
                                    <a href="{{ route('admin.inhouse_job_cards.show',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('inhouse_job_card_edit')
                                    <a href="{{ route('admin.inhouse_job_cards.edit',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('inhouse_job_card_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.destroy', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="24">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
