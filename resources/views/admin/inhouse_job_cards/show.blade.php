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
                        <a href="{{ route('admin.inhouse_job_cards.download',$inhouse_job_card->id) }}" class="btn btn btn-warning">View Job Card in PDF</a>
                    </p>
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">JOB CARD</span></h1>
                                <h4><b>Job Card No</b>: <span style="color:red">{{ $inhouse_job_card->job_card_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 ">
                            @if ( $inhouse_job_card->date != '')
                                <b>Date</b>: {{ $inhouse_job_card->date }}<br>
                            @endif
                            @if ( $inhouse_job_card->job_type != '')
                                <b>Job type</b>: {{ $inhouse_job_card->job_type }}<br>
                            @endif                           
                            @if ( $inhouse_job_card->road_freight_number != '')
                                <b>Road freight No</b>: {{ $inhouse_job_card->road_freight_number->road_freight_number or '' }}<br>
                            @endif
                            @if ( $inhouse_job_card->vehicle_type != '')
                                <b>Vehicle type</b>: {{ $inhouse_job_card->vehicle_type }}<br>
                            @endif
                           
                            @if ( $inhouse_job_card->vehicle != '')
                                <b>Vehicle reg No.</b>: {{ $inhouse_job_card->vehicle->vehicle_description or '' }}<br>
                            @endif
                            @if ( $inhouse_job_card->trailer != '')
                                <b>Trailer reg No.</b>: {{ $inhouse_job_card->trailer->trailer_description or '' }}<br>
                            @endif
                            @if ( $inhouse_job_card->light_vehicles != '')
                                <b>Light vehicle reg No.</b>: {{ $inhouse_job_card->light_vehicles->vehicle_description or '' }}<br>
                            @endif
                            @if ( $inhouse_job_card->client_vehicle_reg_no != '')
                                <b>Vendor vehicle reg No.</b>: {{ $inhouse_job_card->client_vehicle_reg_no->registration_number or '' }}<br>
                            @endif
                            @if ( $inhouse_job_card->mileage != '')
                                <b>Mileage</b>: {{ $inhouse_job_card->mileage or '' }}<br>
                            @endif
                            <b>Status</b>: {{ $inhouse_job_card->status }}<br>
                            @if ( $inhouse_job_card->vehicle != '')
                                <b>Technician(s)</b>: @foreach ($inhouse_job_card->technician as $singleTechnician)
                                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                                        @endforeach<br>
                            @endif
                            @if ($inhouse_job_card->prepared_by != '')
                                <br><b>Processed by</b>: <span style="color:#CE8F64">{{ $inhouse_job_card->prepared_by }}</span>
                            @endif
                        </div>
                        
                        <div class="col-xs-4 form-group text-center"> 
                            @if ( $inhouse_job_card->project_number != '')
                                <b>Project No</b>: {{ $inhouse_job_card->project_number->operation_number or '' }}<br>
                            @endif                            
                        </div>

                        <div class="col-xs-4 form-group text-right">
                            <b>Job Card From</b>: <span style="color:#CE8F64">{{ $inhouse_job_card->repair_center->center_name or '' }}</span><br>
                            <b>Address</b>: {{ config('invoices.seller.address') }}<br>
                            <b></b> {{ config('invoices.seller.city') }},
                            <b></b> {{ config('invoices.seller.country') }},
                            <b></b> {{ config('invoices.seller.postal_code') }}<br>
                            <b>Tel</b>: {{ config('invoices.seller.tel') }}<br>
                            <b>Fax</b>: {{ config('invoices.seller.fax') }}<br>
                            <b>Email</b>: <span style="color:blue">{{ config('invoices.sales.email') }}</span><br>
                            <b>Website</b>: {{ config('invoices.seller.website') }}<br><br>
                            @if ($inhouse_job_card->workshop_manager != '')
                                <b>Workshop Manager</b>: <span style="color:#CE8F64">{{ $inhouse_job_card->workshop_manager->name or '' }}</span>
                            @endif<br>
                            @if ($inhouse_job_card->workshop_manager != '' && $inhouse_job_card->workshop_manager->sa_mobile != '')
                                <b>Tel</b>: {{ $inhouse_job_card->workshop_manager->sa_mobile or '' }}
                            @endif<br>
                            @if ($inhouse_job_card->workshop_manager != '' && $inhouse_job_card->workshop_manager->email != '')
                                <b>Email</b>: <span style="color:blue">{{ $inhouse_job_card->workshop_manager->email or '' }}</span>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                    <legend class="text-center"><span style="color:#CE8F64">JOB CARD INSTRUCTIONS</span></legend> 
                                        <div class="col-xs-12 form-group">
                                            {{ $inhouse_job_card->remarks }}
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-xs-6 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                    <legend class="text-center"><span style="color:#CE8F64">JOB CARD REMARKS</span></legend>
                                        <div class="col-xs-12 form-group">
                                            {{ $inhouse_job_card->instructions }}
                                        </div>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped " id="tab_logic">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a role="tab" data-toggle="tab">Job Card Items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th width="5%" class="text-center">@lang('#')</th>
                            <th>@lang('global.job-card-items.fields.part')</th>
                            <th width="13%" class="text-center">@lang('global.job-card-items.fields.qty')</th>
                            <th class="text-center" width="13%">@lang('global.job-card-items.fields.price')</th>
                            <th class="text-center" width="13%">@lang('global.job-card-items.fields.total')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($inhouse_job_card->job_card_items as $item)
                            <tr id='addr0'>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-left">{{ $item->part }}</td>
                                <td class="text-center">{{ $item->qty }} {{ $item->unit }}</td>
                                <td class="text-center">R {{ number_format($item->price, 2) }}</td>
                                <td class="text-center">R {{ number_format($item->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="pull-right col-md-3">
                            <table class="table">
                                <tr>
                                    <th class="text-right" width="45%">Sub Total</th>
                                    <td class="text-center">R {{ number_format($inhouse_job_card->subtotal, 2) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row text-center">
                        <p>Make all payments to<span style="color:#CE8F64"> SHAVAELAND PTY LTD</span>. Overdue workshops are subject to a service charge of 3% per month.</p>
                    </div>

                </div>
            </div><!-- Nav tabs -->

<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#job_card_items" aria-controls="job_card_items" role="tab" data-toggle="tab">Job card items</a></li>
<li role="presentation" class=""><a href="#schedule_of_services" aria-controls="schedule_of_services" role="tab" data-toggle="tab">Schedule of services</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="job_card_items">
<table class="table table-bordered table-striped {{ count($job_card_items) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.job-card-items.fields.workshop')</th>
                        <th>@lang('global.job-card-items.fields.part')</th>
                        <th>@lang('global.job-card-items.fields.price')</th>
                        <th>@lang('global.job-card-items.fields.qty')</th>
                        <th>@lang('global.job-card-items.fields.unit')</th>
                        <th>@lang('global.job-card-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($job_card_items) > 0)
            @foreach ($job_card_items as $job_card_item)
                <tr data-entry-id="{{ $job_card_item->id }}">
                    <td field-key='workshop'>{{ $job_card_item->workshop }}</td>
                                <td field-key='part'>{{ $job_card_item->part }}</td>
                                <td field-key='price'>{{ $job_card_item->price }}</td>
                                <td field-key='qty'>{{ $job_card_item->qty }}</td>
                                <td field-key='unit'>{{ $job_card_item->unit }}</td>
                                <td field-key='total'>{{ $job_card_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.restore', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.perma_del', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('job_card_item_view')
                                    <a href="{{ route('admin.job_card_items.show',[$job_card_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('job_card_item_edit')
                                    <a href="{{ route('admin.job_card_items.edit',[$job_card_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('job_card_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.destroy', $job_card_item->id])) !!}
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
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.inhouse_job_cards.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
