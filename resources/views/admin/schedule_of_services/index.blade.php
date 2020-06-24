@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('schedule_of_service_create')
    <p>
        <a href="{{ route('admin.schedule_of_services.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.schedule_of_services.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.schedule_of_services.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">SCHEDULE OF SERVICES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($schedule_of_services) > 0 ? 'datatable' : '' }} @can('schedule_of_service_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('schedule_of_service_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th width="35%">@lang('global.schedule-of-service.fields.schedule-number')</th>
                        <th width="35%">@lang('global.schedule-of-service.fields.vehicle')</th>
                        <th class="text-center">@lang('global.schedule-of-service.fields.status')</th>
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
                                @can('schedule_of_service_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='schedule_number'>{{ $schedule_of_service->schedule_number }}</td>
                                @if($schedule_of_service->vehicle != '')
                                    <td field-key='vehicle'>{{ $schedule_of_service->vehicle->vehicle_description or '' }}</td>
                                @endif
                                @if($schedule_of_service->client_vehicle != '')
                                    <td field-key='vehicle'>{{ $schedule_of_service->client_vehicle->registration_number or '' }}</td>
                                @endif
                                @if($schedule_of_service->status == 'Scheduled')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $schedule_of_service->status }}</td>
                                @endif
                                @if($schedule_of_service->status == 'Caution')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $schedule_of_service->status }}</td>
                                @endif
                                @if($schedule_of_service->status == 'Due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $schedule_of_service->status }}</td>
                                @endif
                                @if($schedule_of_service->status == 'Done')
                                <td class="label-md label-success text-center" field-key='status'>{{ $schedule_of_service->status }}</td>
                                @endif
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
                            <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('schedule_of_service_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.schedule_of_services.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection