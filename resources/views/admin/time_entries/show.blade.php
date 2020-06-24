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
                                <h1><span style="color:#CE8F64">PROJECT</span></h1>
                                <h4><b>Project No</b>: <span style="color:red">{{ $time_entry->operation_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            <b>Client</b>: <span style="color:#CE8F64">{{ $time_entry->client->name or '' }}</span>
                            @if ($time_entry->work_type != '')
                                <br><b>Work type</b>: 
                                @foreach ($time_entry->work_type as $singleWorkType)
                                    <span class="label label-info label-many">{{ $singleWorkType->name }}</span>
                                @endforeach
                            @endif
                            @if ($time_entry->entry_date != '')
                                <br><b>Entry date</b>: {{ $time_entry->entry_date }}
                            @endif
                            @if ($time_entry->start_time != '')
                                <br><b>Start time</b>: {{ $time_entry->start_time }}
                            @endif
                            @if ($time_entry->end_time != '')
                                <br><b>End time</b>: {{ $time_entry->end_time }}
                            @endif
                            @if ($time_entry->status != '')
                                <br><b>Status</b>: {{ $time_entry->status }}
                            @endif
                        </div>
                        <div class="col-xs-4 "></div>
                    </div>

                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#job_requests" aria-controls="job_requests" role="tab" data-toggle="tab">Job requests</a></li>
    <li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
    <li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
    <li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
    <li role="presentation" class=""><a href="#clearance_and_forwarding" aria-controls="clearance_and_forwarding" role="tab" data-toggle="tab">Clearance & forwarding</a></li>
    <li role="presentation" class=""><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
    <li role="presentation" class=""><a href="#income_category" aria-controls="income_category" role="tab" data-toggle="tab">Client tax invoices</a></li>
    <li role="presentation" class=""><a href="#releasing" aria-controls="releasing" role="tab" data-toggle="tab">Goods collections</a></li>
    <li role="presentation" class=""><a href="#receiving" aria-controls="receiving" role="tab" data-toggle="tab">Goods Receipts</a></li>
    <li role="presentation" class=""><a href="#expense_category" aria-controls="expense_category" role="tab" data-toggle="tab">Vendor tax invoices</a></li>
    <li role="presentation" class=""><a href="#debit_notes" aria-controls="debit_notes" role="tab" data-toggle="tab">Debit notes</a></li>
    <li role="presentation" class=""><a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab">Credit notes</a></li>
    <li role="presentation" class=""><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#inhouse_job_cards" aria-controls="inhouse_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Expense/Credit note pymts</a></li>
    <li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Income/Debit note pymts</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="job_requests">
    <table class="table table-bordered table-striped {{ count($job_requests) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.job-requests.fields.project-number')</th>
                            <th>@lang('global.job-requests.fields.description')</th>
                            <th>@lang('global.job-requests.fields.workshop-manager')</th>
                            <th>@lang('global.job-requests.fields.job-request-number')</th>
                            <th>@lang('global.job-requests.fields.requested-by')</th>
                            <th>@lang('global.job-requests.fields.client')</th>
                            <th>@lang('global.job-requests.fields.contact-person')</th>
                            <th>@lang('global.job-requests.fields.date')</th>
                            <th>@lang('global.job-requests.fields.vehicle-type')</th>
                            <th>@lang('global.job-requests.fields.vehicle-registration-number')</th>
                            <th>@lang('global.job-requests.fields.make')</th>
                            <th>@lang('global.job-requests.fields.model')</th>
                            <th>@lang('global.job-requests.fields.mileage')</th>
                            <th>@lang('global.job-requests.fields.next-service-mileage')</th>
                            <th>@lang('global.job-requests.fields.next-service-date')</th>
                            <th>@lang('global.job-requests.fields.status')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($job_requests) > 0)
                @foreach ($job_requests as $job_request)
                    <tr data-entry-id="{{ $job_request->id }}">
                        <td field-key='project_number'>{{ $job_request->project_number->operation_number or '' }}</td>
                                    <td field-key='description'>{!! $job_request->description !!}</td>
                                    <td field-key='workshop_manager'>{{ $job_request->workshop_manager->name or '' }}</td>
                                    <td field-key='job_request_number'>{{ $job_request->job_request_number }}</td>
                                    <td field-key='requested_by'>{{ $job_request->requested_by }}</td>
                                    <td field-key='client'>{{ $job_request->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $job_request->contact_person->contact_name or '' }}</td>
                                    <td field-key='date'>{{ $job_request->date }}</td>
                                    <td field-key='vehicle_type'>{{ $job_request->vehicle_type }}</td>
                                    <td field-key='vehicle_registration_number'>{{ $job_request->vehicle_registration_number }}</td>
                                    <td field-key='make'>{{ $job_request->make }}</td>
                                    <td field-key='model'>{{ $job_request->model }}</td>
                                    <td field-key='mileage'>{{ $job_request->mileage }}</td>
                                    <td field-key='next_service_mileage'>{{ $job_request->next_service_mileage }}</td>
                                    <td field-key='next_service_date'>{{ $job_request->next_service_date }}</td>
                                    <td field-key='status'>{{ $job_request->status }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.restore', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.perma_del', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('job_request_view')
                                        <a href="{{ route('admin.job_requests.show',[$job_request->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('job_request_edit')
                                        <a href="{{ route('admin.job_requests.edit',[$job_request->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('job_request_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.job_requests.destroy', $job_request->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="air_freight">
    <table class="table table-bordered table-striped {{ count($air_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.air-freight.fields.project-number')</th>
                            <th>@lang('global.air-freight.fields.air-freight-number')</th>
                            <th>@lang('global.air-freight.fields.client')</th>
                            <th>@lang('global.air-freight.fields.contact-person')</th>
                            <th>@lang('global.air-freight.fields.airline-or-agent')</th>
                            <th>@lang('global.air-freight.fields.airline-or-agent-contact')</th>
                            <th>@lang('global.air-freight.fields.project-manager')</th>
                            <th>@lang('global.air-freight.fields.flight-number')</th>
                            <th>@lang('global.air-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($air_freights) > 0)
                @foreach ($air_freights as $air_freight)
                    <tr data-entry-id="{{ $air_freight->id }}">
                        <td field-key='project_number'>{{ $air_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='air_freight_number'>{{ $air_freight->air_freight_number }}</td>
                                    <td field-key='client'>{{ $air_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $air_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='airline_or_agent'>
                                        @foreach ($air_freight->airline_or_agent as $singleAirlineOrAgent)
                                            <span class="label label-info label-many">{{ $singleAirlineOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='airline_or_agent_contact'>{{ $air_freight->airline_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $air_freight->project_manager->name or '' }}</td>
                                    <td field-key='flight_number'>{{ $air_freight->flight_number }}</td>
                                    <td field-key='route'>{{ $air_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.restore', $air_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.perma_del', $air_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('air_freight_view')
                                        <a href="{{ route('admin.air_freights.show',[$air_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('air_freight_edit')
                                        <a href="{{ route('admin.air_freights.edit',[$air_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('air_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.air_freights.destroy', $air_freight->id])) !!}
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
    <div role="tabpanel" class="tab-pane " id="sea_freight">
    <table class="table table-bordered table-striped {{ count($sea_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.sea-freight.fields.project-number')</th>
                            <th>@lang('global.sea-freight.fields.sea-freight-number')</th>
                            <th>@lang('global.sea-freight.fields.client')</th>
                            <th>@lang('global.sea-freight.fields.contact-person')</th>
                            <th>@lang('global.sea-freight.fields.shipper-or-agent')</th>
                            <th>@lang('global.sea-freight.fields.shipper-or-agent-contact')</th>
                            <th>@lang('global.sea-freight.fields.project-manager')</th>
                            <th>@lang('global.sea-freight.fields.voyage-number')</th>
                            <th>@lang('global.sea-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($sea_freights) > 0)
                @foreach ($sea_freights as $sea_freight)
                    <tr data-entry-id="{{ $sea_freight->id }}">
                        <td field-key='project_number'>{{ $sea_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='sea_freight_number'>{{ $sea_freight->sea_freight_number }}</td>
                                    <td field-key='client'>{{ $sea_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $sea_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='shipper__or_agent'>
                                        @foreach ($sea_freight->shipper__or_agent as $singleShipperOrAgent)
                                            <span class="label label-info label-many">{{ $singleShipperOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='shipper_or_agent_contact'>{{ $sea_freight->shipper_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $sea_freight->project_manager->name or '' }}</td>
                                    <td field-key='voyage_number'>{{ $sea_freight->voyage_number }}</td>
                                    <td field-key='route'>{{ $sea_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.restore', $sea_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.perma_del', $sea_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('sea_freight_view')
                                        <a href="{{ route('admin.sea_freights.show',[$sea_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('sea_freight_edit')
                                        <a href="{{ route('admin.sea_freights.edit',[$sea_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('sea_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.sea_freights.destroy', $sea_freight->id])) !!}
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
    <div role="tabpanel" class="tab-pane " id="rail_freight">
    <table class="table table-bordered table-striped {{ count($rail_freights) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.rail-freight.fields.project-number')</th>
                            <th>@lang('global.rail-freight.fields.rail-freight-number')</th>
                            <th>@lang('global.rail-freight.fields.client')</th>
                            <th>@lang('global.rail-freight.fields.contact-person')</th>
                            <th>@lang('global.rail-freight.fields.railline-or-agent')</th>
                            <th>@lang('global.rail-freight.fields.railline-or-agent-contact')</th>
                            <th>@lang('global.rail-freight.fields.project-manager')</th>
                            <th>@lang('global.rail-freight.fields.trip-number')</th>
                            <th>@lang('global.rail-freight.fields.route')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($rail_freights) > 0)
                @foreach ($rail_freights as $rail_freight)
                    <tr data-entry-id="{{ $rail_freight->id }}">
                        <td field-key='project_number'>{{ $rail_freight->project_number->operation_number or '' }}</td>
                                    <td field-key='rail_freight_number'>{{ $rail_freight->rail_freight_number }}</td>
                                    <td field-key='client'>{{ $rail_freight->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $rail_freight->contact_person->contact_name or '' }}</td>
                                    <td field-key='railline_or_agent'>
                                        @foreach ($rail_freight->railline_or_agent as $singleRaillineOrAgent)
                                            <span class="label label-info label-many">{{ $singleRaillineOrAgent->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='railline_or_agent_contact'>{{ $rail_freight->railline_or_agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $rail_freight->project_manager->name or '' }}</td>
                                    <td field-key='trip_number'>{{ $rail_freight->trip_number }}</td>
                                    <td field-key='route'>{{ $rail_freight->route->route or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.restore', $rail_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.perma_del', $rail_freight->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('rail_freight_view')
                                        <a href="{{ route('admin.rail_freights.show',[$rail_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('rail_freight_edit')
                                        <a href="{{ route('admin.rail_freights.edit',[$rail_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('rail_freight_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.rail_freights.destroy', $rail_freight->id])) !!}
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
    <div role="tabpanel" class="tab-pane " id="clearance_and_forwarding">
    <table class="table table-bordered table-striped {{ count($clearance_and_forwardings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.clearance-and-forwarding.fields.project-number')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.clearance-and-forwarding-number')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.border-post')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.client')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.contact-person')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.agent')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.agent-contact')</th>
                            <th>@lang('global.clearance-and-forwarding.fields.project-manager')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($clearance_and_forwardings) > 0)
                @foreach ($clearance_and_forwardings as $clearance_and_forwarding)
                    <tr data-entry-id="{{ $clearance_and_forwarding->id }}">
                        <td field-key='project_number'>{{ $clearance_and_forwarding->project_number->operation_number or '' }}</td>
                                    <td field-key='clearance_and_forwarding_number'>{{ $clearance_and_forwarding->clearance_and_forwarding_number }}</td>
                                    <td field-key='border_post'>{{ $clearance_and_forwarding->border_post }}</td>
                                    <td field-key='client'>{{ $clearance_and_forwarding->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $clearance_and_forwarding->contact_person->contact_name or '' }}</td>
                                    <td field-key='agent'>{{ $clearance_and_forwarding->agent->name or '' }}</td>
                                    <td field-key='agent_contact'>{{ $clearance_and_forwarding->agent_contact->contact_name or '' }}</td>
                                    <td field-key='project_manager'>{{ $clearance_and_forwarding->project_manager->name or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.restore', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.perma_del', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('clearance_and_forwarding_view')
                                        <a href="{{ route('admin.clearance_and_forwardings.show',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('clearance_and_forwarding_edit')
                                        <a href="{{ route('admin.clearance_and_forwardings.edit',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('clearance_and_forwarding_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.clearance_and_forwardings.destroy', $clearance_and_forwarding->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="13">@lang('global.app_no_entries_in_table')</td>
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
    <div role="tabpanel" class="tab-pane " id="income_category">
    <table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.income-category.fields.project-type')</th>
                            <th>@lang('global.income-category.fields.project-number')</th>
                            <th>@lang('global.income-category.fields.entry-date')</th>
                            <th>@lang('global.income-category.fields.due-date')</th>
                            <th>@lang('global.income-category.fields.prepared-by')</th>
                            <th>@lang('global.income-category.fields.invoice-number')</th>
                            <th>@lang('global.income-category.fields.client')</th>
                            <th>@lang('global.income-category.fields.contact-person')</th>
                            <th>@lang('global.income-category.fields.account-manager')</th>
                            <th>@lang('global.income-category.fields.quotation-number')</th>
                            <th>@lang('global.income-category.fields.sales-order-number')</th>
                            <th>@lang('global.income-category.fields.status')</th>
                            <th>@lang('global.income-category.fields.subtotal')</th>
                            <th>@lang('global.income-category.fields.percent-discount')</th>
                            <th>@lang('global.income-category.fields.discount-amount')</th>
                            <th>@lang('global.income-category.fields.discounted-subtotal')</th>
                            <th>@lang('global.income-category.fields.vat')</th>
                            <th>@lang('global.income-category.fields.vat-amount')</th>
                            <th>@lang('global.income-category.fields.total-amount')</th>
                            <th>@lang('global.income-category.fields.paid-to-date')</th>
                            <th>@lang('global.income-category.fields.balance')</th>
                            <th>@lang('global.income-category.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($income_categories) > 0)
                @foreach ($income_categories as $income_category)
                    <tr data-entry-id="{{ $income_category->id }}">
                        <td field-key='project_type'>{{ $income_category->project_type->name or '' }}</td>
                                    <td field-key='project_number'>{{ $income_category->project_number->operation_number or '' }}</td>
                                    <td field-key='entry_date'>{{ $income_category->entry_date }}</td>
                                    <td field-key='due_date'>{{ $income_category->due_date }}</td>
                                    <td field-key='prepared_by'>{{ $income_category->prepared_by }}</td>
                                    <td field-key='invoice_number'>{{ $income_category->invoice_number }}</td>
                                    <td field-key='client'>{{ $income_category->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $income_category->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $income_category->account_manager->name or '' }}</td>
                                    <td field-key='quotation_number'>{{ $income_category->quotation_number->quotation_number or '' }}</td>
                                    <td field-key='sales_order_number'>{{ $income_category->sales_order_number }}</td>
                                    <td field-key='status'>{{ $income_category->status }}</td>
                                    <td field-key='subtotal'>{{ $income_category->subtotal }}</td>
                                    <td field-key='percent_discount'>{{ $income_category->percent_discount }}</td>
                                    <td field-key='discount_amount'>{{ $income_category->discount_amount }}</td>
                                    <td field-key='discounted_subtotal'>{{ $income_category->discounted_subtotal }}</td>
                                    <td field-key='vat'>{{ $income_category->vat }}</td>
                                    <td field-key='vat_amount'>{{ $income_category->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $income_category->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $income_category->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $income_category->balance }}</td>
                                    <td field-key='currency'>{{ $income_category->currency->name or '' }}</td>
                                                                    <td>
                                        @can('income_category_view')
                                        <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('income_category_edit')
                                        <a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('income_category_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="27">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="releasing">
    <table class="table table-bordered table-striped {{ count($releasings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.releasing.fields.date')</th>
                            <th>@lang('global.releasing.fields.project-number')</th>
                            <th>@lang('global.releasing.fields.warehouse')</th>
                            <th>@lang('global.releasing.fields.release-number')</th>
                            <th>@lang('global.releasing.fields.prepared-by')</th>
                            <th>@lang('global.releasing.fields.client')</th>
                            <th>@lang('global.releasing.fields.contact-person')</th>
                            <th>@lang('global.releasing.fields.released-by')</th>
                            <th>@lang('global.releasing.fields.project-manager')</th>
                            <th>@lang('global.releasing.fields.area-coverd')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($releasings) > 0)
                @foreach ($releasings as $releasing)
                    <tr data-entry-id="{{ $releasing->id }}">
                        <td field-key='date'>{{ $releasing->date }}</td>
                                    <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $releasing->warehouse->center_name or '' }}</td>
                                    <td field-key='release_number'>{{ $releasing->release_number }}</td>
                                    <td field-key='prepared_by'>{{ $releasing->prepared_by }}</td>
                                    <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $releasing->contact_person->contact_name or '' }}</td>
                                    <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $releasing->project_manager->name or '' }}</td>
                                    <td field-key='area_coverd'>{{ $releasing->area_coverd }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.restore', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.perma_del', $releasing->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('releasing_view')
                                        <a href="{{ route('admin.releasings.show',[$releasing->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('releasing_edit')
                                        <a href="{{ route('admin.releasings.edit',[$releasing->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('releasing_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.releasings.destroy', $releasing->id])) !!}
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
    <div role="tabpanel" class="tab-pane " id="receiving">
    <table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.receiving.fields.date')</th>
                            <th>@lang('global.receiving.fields.project-number')</th>
                            <th>@lang('global.receiving.fields.warehouse')</th>
                            <th>@lang('global.receiving.fields.receipt-number')</th>
                            <th>@lang('global.receiving.fields.prepared-by')</th>
                            <th>@lang('global.receiving.fields.client')</th>
                            <th>@lang('global.receiving.fields.contact-person')</th>
                            <th>@lang('global.receiving.fields.received-by')</th>
                            <th>@lang('global.receiving.fields.project-manager')</th>
                            <th>@lang('global.receiving.fields.rate')</th>
                            <th>@lang('global.receiving.fields.days')</th>
                            <th>@lang('global.receiving.fields.total-area-coverd')</th>
                            <th>@lang('global.receiving.fields.total-amount')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($receivings) > 0)
                @foreach ($receivings as $receiving)
                    <tr data-entry-id="{{ $receiving->id }}">
                        <td field-key='date'>{{ $receiving->date }}</td>
                                    <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                    <td field-key='warehouse'>{{ $receiving->warehouse->center_name or '' }}</td>
                                    <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                    <td field-key='prepared_by'>{{ $receiving->prepared_by }}</td>
                                    <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $receiving->contact_person->contact_name or '' }}</td>
                                    <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                                    <td field-key='project_manager'>{{ $receiving->project_manager->name or '' }}</td>
                                    <td field-key='rate'>{{ $receiving->rate }}</td>
                                    <td field-key='days'>{{ $receiving->days }}</td>
                                    <td field-key='total_area_coverd'>{{ $receiving->total_area_coverd }}</td>
                                    <td field-key='total_amount'>{{ $receiving->total_amount }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.restore', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('receiving_view')
                                        <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('receiving_edit')
                                        <a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('receiving_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.receivings.destroy', $receiving->id])) !!}
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
    <div role="tabpanel" class="tab-pane " id="expense_category">
    <table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.expense-category.fields.transaction-type')</th>
                            <th>@lang('global.expense-category.fields.transaction-number')</th>
                            <th>@lang('global.expense-category.fields.entry-date')</th>
                            <th>@lang('global.expense-category.fields.due-date')</th>
                            <th>@lang('global.expense-category.fields.prepared-by')</th>
                            <th>@lang('global.expense-category.fields.credit-note-number')</th>
                            <th>@lang('global.expense-category.fields.vendor')</th>
                            <th>@lang('global.expense-category.fields.contact-person')</th>
                            <th>@lang('global.expense-category.fields.account-manager')</th>
                            <th>@lang('global.expense-category.fields.purchase-order-number')</th>
                            <th>@lang('global.expense-category.fields.vendor-purchase-order-number')</th>
                            <th>@lang('global.expense-category.fields.upload-document')</th>
                            <th>@lang('global.expense-category.fields.status')</th>
                            <th>@lang('global.expense-category.fields.terms-and-conditions')</th>
                            <th>@lang('global.expense-category.fields.subtotal')</th>
                            <th>@lang('global.expense-category.fields.percent-discount')</th>
                            <th>@lang('global.expense-category.fields.discount-amount')</th>
                            <th>@lang('global.expense-category.fields.discounted-subtotal')</th>
                            <th>@lang('global.expense-category.fields.vat')</th>
                            <th>@lang('global.expense-category.fields.vat-amount')</th>
                            <th>@lang('global.expense-category.fields.total-amount')</th>
                            <th>@lang('global.expense-category.fields.paid-to-date')</th>
                            <th>@lang('global.expense-category.fields.balance')</th>
                            <th>@lang('global.expense-category.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($expense_categories) > 0)
                @foreach ($expense_categories as $expense_category)
                    <tr data-entry-id="{{ $expense_category->id }}">
                        <td field-key='transaction_type'>{{ $expense_category->transaction_type->name or '' }}</td>
                                    <td field-key='transaction_number'>{{ $expense_category->transaction_number->operation_number or '' }}</td>
                                    <td field-key='entry_date'>{{ $expense_category->entry_date }}</td>
                                    <td field-key='due_date'>{{ $expense_category->due_date }}</td>
                                    <td field-key='prepared_by'>{{ $expense_category->prepared_by }}</td>
                                    <td field-key='credit_note_number'>{{ $expense_category->credit_note_number }}</td>
                                    <td field-key='vendor'>{{ $expense_category->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $expense_category->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $expense_category->account_manager->name or '' }}</td>
                                    <td field-key='purchase_order_number'>{{ $expense_category->purchase_order_number->purchase_order_number or '' }}</td>
                                    <td field-key='vendor_purchase_order_number'>{{ $expense_category->vendor_purchase_order_number }}</td>
                                    <td field-key='upload_document'>@if($expense_category->upload_document)<a href="{{ asset(env('UPLOAD_PATH').'/' . $expense_category->upload_document) }}" target="_blank">Download file</a>@endif</td>
                                    <td field-key='status'>{{ $expense_category->status }}</td>
                                    <td field-key='terms_and_conditions'>{!! $expense_category->terms_and_conditions !!}</td>
                                    <td field-key='subtotal'>{{ $expense_category->subtotal }}</td>
                                    <td field-key='percent_discount'>{{ $expense_category->percent_discount }}</td>
                                    <td field-key='discount_amount'>{{ $expense_category->discount_amount }}</td>
                                    <td field-key='discounted_subtotal'>{{ $expense_category->discounted_subtotal }}</td>
                                    <td field-key='vat'>{{ $expense_category->vat }}</td>
                                    <td field-key='vat_amount'>{{ $expense_category->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $expense_category->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $expense_category->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $expense_category->balance }}</td>
                                    <td field-key='currency'>{{ $expense_category->currency->name or '' }}</td>
                                                                    <td>
                                        @can('expense_category_view')
                                        <a href="{{ route('admin.expense_categories.show',[$expense_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('expense_category_edit')
                                        <a href="{{ route('admin.expense_categories.edit',[$expense_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('expense_category_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.expense_categories.destroy', $expense_category->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="29">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="debit_notes">
    <table class="table table-bordered table-striped {{ count($debit_notes) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.debit-notes.fields.date')</th>
                            <th>@lang('global.debit-notes.fields.refund-type')</th>
                            <th>@lang('global.debit-notes.fields.credit-note-payment-number')</th>
                            <th>@lang('global.debit-notes.fields.transaction-number')</th>
                            <th>@lang('global.debit-notes.fields.credit-note-number')</th>
                            <th>@lang('global.debit-notes.fields.withdrawal-transaction-number')</th>
                            <th>@lang('global.debit-notes.fields.vendor')</th>
                            <th>@lang('global.debit-notes.fields.contact-person')</th>
                            <th>@lang('global.debit-notes.fields.account-manager')</th>
                            <th>@lang('global.debit-notes.fields.prepared-by')</th>
                            <th>@lang('global.debit-notes.fields.debit-note-number')</th>
                            <th>@lang('global.debit-notes.fields.status')</th>
                            <th>@lang('global.debit-notes.fields.subtotal')</th>
                            <th>@lang('global.debit-notes.fields.vat')</th>
                            <th>@lang('global.debit-notes.fields.vat-amount')</th>
                            <th>@lang('global.debit-notes.fields.total-amount')</th>
                            <th>@lang('global.debit-notes.fields.paid-to-date')</th>
                            <th>@lang('global.debit-notes.fields.balance')</th>
                            <th>@lang('global.debit-notes.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($debit_notes) > 0)
                @foreach ($debit_notes as $debit_note)
                    <tr data-entry-id="{{ $debit_note->id }}">
                        <td field-key='date'>{{ $debit_note->date }}</td>
                                    <td field-key='refund_type'>{{ $debit_note->refund_type }}</td>
                                    <td field-key='credit_note_payment_number'>{{ $debit_note->credit_note_payment_number->payment_number or '' }}</td>
                                    <td field-key='transaction_number'>{{ $debit_note->transaction_number->operation_number or '' }}</td>
                                    <td field-key='credit_note_number'>{{ $debit_note->credit_note_number->credit_note_number or '' }}</td>
                                    <td field-key='withdrawal_transaction_number'>{{ $debit_note->withdrawal_transaction_number->payment_number or '' }}</td>
                                    <td field-key='vendor'>{{ $debit_note->vendor->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $debit_note->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $debit_note->account_manager->name or '' }}</td>
                                    <td field-key='prepared_by'>{{ $debit_note->prepared_by }}</td>
                                    <td field-key='debit_note_number'>{{ $debit_note->debit_note_number }}</td>
                                    <td field-key='status'>{{ $debit_note->status }}</td>
                                    <td field-key='subtotal'>{{ $debit_note->subtotal }}</td>
                                    <td field-key='vat'>{{ $debit_note->vat }}</td>
                                    <td field-key='vat_amount'>{{ $debit_note->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $debit_note->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $debit_note->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $debit_note->balance }}</td>
                                    <td field-key='currency'>{{ $debit_note->currency->name or '' }}</td>
                                                                    <td>
                                        @can('debit_note_view')
                                        <a href="{{ route('admin.debit_notes.show',[$debit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('debit_note_edit')
                                        <a href="{{ route('admin.debit_notes.edit',[$debit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('debit_note_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.debit_notes.destroy', $debit_note->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
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
    <div role="tabpanel" class="tab-pane " id="credit_note">
    <table class="table table-bordered table-striped {{ count($credit_notes) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.credit-note.fields.date')</th>
                            <th>@lang('global.credit-note.fields.refund-type')</th>
                            <th>@lang('global.credit-note.fields.invoice-payment-number')</th>
                            <th>@lang('global.credit-note.fields.project-number')</th>
                            <th>@lang('global.credit-note.fields.invoice-number')</th>
                            <th>@lang('global.credit-note.fields.bank-reference')</th>
                            <th>@lang('global.credit-note.fields.client')</th>
                            <th>@lang('global.credit-note.fields.contact-person')</th>
                            <th>@lang('global.credit-note.fields.account-manager')</th>
                            <th>@lang('global.credit-note.fields.prepared-by')</th>
                            <th>@lang('global.credit-note.fields.credit-note-number')</th>
                            <th>@lang('global.credit-note.fields.status')</th>
                            <th>@lang('global.credit-note.fields.terms-and-conditions')</th>
                            <th>@lang('global.credit-note.fields.subtotal')</th>
                            <th>@lang('global.credit-note.fields.vat')</th>
                            <th>@lang('global.credit-note.fields.vat-amount')</th>
                            <th>@lang('global.credit-note.fields.total-amount')</th>
                            <th>@lang('global.credit-note.fields.paid-to-date')</th>
                            <th>@lang('global.credit-note.fields.balance')</th>
                            <th>@lang('global.credit-note.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($credit_notes) > 0)
                @foreach ($credit_notes as $credit_note)
                    <tr data-entry-id="{{ $credit_note->id }}">
                        <td field-key='date'>{{ $credit_note->date }}</td>
                                    <td field-key='refund_type'>{{ $credit_note->refund_type }}</td>
                                    <td field-key='invoice_payment_number'>{{ $credit_note->invoice_payment_number->payment_number or '' }}</td>
                                    <td field-key='project_number'>{{ $credit_note->project_number->operation_number or '' }}</td>
                                    <td field-key='invoice_number'>{{ $credit_note->invoice_number->invoice_number or '' }}</td>
                                    <td field-key='bank_reference'>{{ $credit_note->bank_reference->payment_number or '' }}</td>
                                    <td field-key='client'>{{ $credit_note->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $credit_note->contact_person->contact_name or '' }}</td>
                                    <td field-key='account_manager'>{{ $credit_note->account_manager->name or '' }}</td>
                                    <td field-key='prepared_by'>{{ $credit_note->prepared_by }}</td>
                                    <td field-key='credit_note_number'>{{ $credit_note->credit_note_number }}</td>
                                    <td field-key='status'>{{ $credit_note->status }}</td>
                                    <td field-key='terms_and_conditions'>{!! $credit_note->terms_and_conditions !!}</td>
                                    <td field-key='subtotal'>{{ $credit_note->subtotal }}</td>
                                    <td field-key='vat'>{{ $credit_note->vat }}</td>
                                    <td field-key='vat_amount'>{{ $credit_note->vat_amount }}</td>
                                    <td field-key='total_amount'>{{ $credit_note->total_amount }}</td>
                                    <td field-key='paid_to_date'>{{ $credit_note->paid_to_date }}</td>
                                    <td field-key='balance'>{{ $credit_note->balance }}</td>
                                    <td field-key='currency'>{{ $credit_note->currency->name or '' }}</td>
                                                                    <td>
                                        @can('credit_note_view')
                                        <a href="{{ route('admin.credit_notes.show',[$credit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('credit_note_edit')
                                        <a href="{{ route('admin.credit_notes.edit',[$credit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('credit_note_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.credit_notes.destroy', $credit_note->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="25">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="client_job_cards">
    <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <th>@lang('global.client-job-cards.fields.currency')</th>
                            @if( request('show_deleted') == 1 )
                            <th>&nbsp;</th>
                            @else
                            <th>&nbsp;</th>
                            @endif
            </tr>
        </thead>
    
        <tbody>
            @if (count($client_job_cards) > 0)
                @foreach ($client_job_cards as $client_job_card)
                    <tr data-entry-id="{{ $client_job_card->id }}">
                        <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                                    <td field-key='date'>{{ $client_job_card->date }}</td>
                                    <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                                    <td field-key='status'>{{ $client_job_card->status }}</td>
                                    <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($client_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                    <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                                    <td field-key='currency'>{{ $client_job_card->currency->name or '' }}</td>
                                    @if( request('show_deleted') == 1 )
                                    <td>
                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'POST',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.restore', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                                                        {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.perma_del', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                                                    </td>
                                    @else
                                    <td>
                                        @can('client_job_card_view')
                                        <a href="{{ route('admin.client_job_cards.show',[$client_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('client_job_card_edit')
                                        <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
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
    <div role="tabpanel" class="tab-pane " id="expense">
    <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.expense.fields.entry-date')</th>
                            <th>@lang('global.expense.fields.payment-type')</th>
                            <th>@lang('global.expense.fields.withdrawal-transaction-number')</th>
                            <th>@lang('global.expense.fields.prepared-by')</th>
                            <th>@lang('global.expense.fields.payment-number')</th>
                            <th>@lang('global.expense.fields.vendor-credit-note-number')</th>
                            <th>@lang('global.expense.fields.debit-note-number')</th>
                            <th>@lang('global.expense.fields.vendor')</th>
                            <th>@lang('global.expense.fields.client-credit-note-number')</th>
                            <th>@lang('global.expense.fields.client')</th>
                            <th>@lang('global.expense.fields.operation-type')</th>
                            <th>@lang('global.expense.fields.transaction-type')</th>
                            <th>@lang('global.expense.fields.transaction-number')</th>
                            <th>@lang('global.expense.fields.expense-category')</th>
                            <th>@lang('global.expense.fields.amount')</th>
                            <th>@lang('global.expense.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($expenses) > 0)
                @foreach ($expenses as $expense)
                    <tr data-entry-id="{{ $expense->id }}">
                        <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                    <td field-key='payment_type'>{{ $expense->payment_type }}</td>
                                    <td field-key='withdrawal_transaction_number'>{{ $expense->withdrawal_transaction_number->payment_number or '' }}</td>
                                    <td field-key='prepared_by'>{{ $expense->prepared_by }}</td>
                                    <td field-key='payment_number'>{{ $expense->payment_number }}</td>
                                    <td field-key='vendor_credit_note_number'>{{ $expense->vendor_credit_note_number->credit_note_number or '' }}</td>
                                    <td field-key='debit_note_number'>{{ $expense->debit_note_number->debit_note_number or '' }}</td>
                                    <td field-key='vendor'>{{ $expense->vendor->name or '' }}</td>
                                    <td field-key='client_credit_note_number'>{{ $expense->client_credit_note_number->credit_note_number or '' }}</td>
                                    <td field-key='client'>{{ $expense->client->name or '' }}</td>
                                    <td field-key='operation_type'>{{ $expense->operation_type->name or '' }}</td>
                                    <td field-key='transaction_type'>{{ $expense->transaction_type->name or '' }}</td>
                                    <td field-key='transaction_number'>{{ $expense->transaction_number->operation_number or '' }}</td>
                                    <td field-key='expense_category'>{{ $expense->expense_category }}</td>
                                    <td field-key='amount'>{{ $expense->amount }}</td>
                                    <td field-key='currency'>{{ $expense->currency->name or '' }}</td>
                                                                    <td>
                                        @can('expense_view')
                                        <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('expense_edit')
                                        <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('expense_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="income">
    <table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.income.fields.entry-date')</th>
                            <th>@lang('global.income.fields.payment-type')</th>
                            <th>@lang('global.income.fields.deposit-transaction-number')</th>
                            <th>@lang('global.income.fields.prepared-by')</th>
                            <th>@lang('global.income.fields.payment-number')</th>
                            <th>@lang('global.income.fields.invoice-number')</th>
                            <th>@lang('global.income.fields.sales-credit-note-number')</th>
                            <th>@lang('global.income.fields.client')</th>
                            <th>@lang('global.income.fields.debit-note-number')</th>
                            <th>@lang('global.income.fields.vendor')</th>
                            <th>@lang('global.income.fields.operation-type')</th>
                            <th>@lang('global.income.fields.project-type')</th>
                            <th>@lang('global.income.fields.project-number')</th>
                            <th>@lang('global.income.fields.income-category')</th>
                            <th>@lang('global.income.fields.amount')</th>
                            <th>@lang('global.income.fields.currency')</th>
                                                    <th>&nbsp;</th>
    
            </tr>
        </thead>
    
        <tbody>
            @if (count($incomes) > 0)
                @foreach ($incomes as $income)
                    <tr data-entry-id="{{ $income->id }}">
                        <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                    <td field-key='payment_type'>{{ $income->payment_type }}</td>
                                    <td field-key='deposit_transaction_number'>{{ $income->deposit_transaction_number->payment_number or '' }}</td>
                                    <td field-key='prepared_by'>{{ $income->prepared_by }}</td>
                                    <td field-key='payment_number'>{{ $income->payment_number }}</td>
                                    <td field-key='invoice_number'>{{ $income->invoice_number->invoice_number or '' }}</td>
                                    <td field-key='sales_credit_note_number'>{{ $income->sales_credit_note_number->credit_note_number or '' }}</td>
                                    <td field-key='client'>{{ $income->client->name or '' }}</td>
                                    <td field-key='debit_note_number'>{{ $income->debit_note_number->debit_note_number or '' }}</td>
                                    <td field-key='vendor'>{{ $income->vendor->name or '' }}</td>
                                    <td field-key='operation_type'>{{ $income->operation_type->name or '' }}</td>
                                    <td field-key='project_type'>{{ $income->project_type->name or '' }}</td>
                                    <td field-key='project_number'>{{ $income->project_number->operation_number or '' }}</td>
                                    <td field-key='income_category'>{{ $income->income_category }}</td>
                                    <td field-key='amount'>{{ $income->amount }}</td>
                                    <td field-key='currency'>{{ $income->currency->name or '' }}</td>
                                                                    <td>
                                        @can('income_view')
                                        <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                        @endcan
                                        @can('income_edit')
                                        <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('income_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.incomes.destroy', $income->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
    
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
    
                <p>&nbsp;</p>
    
                <a href="{{ route('admin.time_entries.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
                
                $('.datetime').datetimepicker({
                    format: "{{ config('app.datetime_format_moment') }}",
                    locale: "{{ App::getLocale() }}",
                    sideBySide: true,
                });
                
            });
        </script>
                
    @stop
    