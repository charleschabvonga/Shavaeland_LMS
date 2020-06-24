@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('client_vehicle_create')
    <p>
        <a href="{{ route('admin.client_vehicles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.client_vehicles.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.client_vehicles.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">CLIENT VEHICLES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($client_vehicles) > 0 ? 'datatable' : '' }} @can('client_vehicle_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('client_vehicle_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.client-vehicle.fields.client')</th>
                        <th>@lang('global.client-vehicle.fields.registration-number')</th>
                        <th>@lang('global.client-vehicle.fields.vehicle-type')</th>
                        <th>@lang('global.client-vehicle.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_vehicles) > 0)
                        @foreach ($client_vehicles as $client_vehicle)
                            <tr data-entry-id="{{ $client_vehicle->id }}">
                                @can('client_vehicle_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='client'>{{ $client_vehicle->client->name or '' }}</td>
                                <td field-key='registration_number'>{{ $client_vehicle->registration_number }}</td>
                                <td field-key='vehicle_type'>{{ $client_vehicle->vehicle_type }}</td>
                                @if($client_vehicle->status == 'Scheduled')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $client_vehicle->status }}</td>
                                @endif
                                @if($client_vehicle->status == 'Caution')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $client_vehicle->status }}</td>
                                @endif
                                @if($client_vehicle->status == 'Due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $client_vehicle->status }}</td>
                                @endif
                                @if($client_vehicle->status == 'Done')
                                <td class="label-md label-success text-center" field-key='status'>{{ $client_vehicle->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_vehicles.restore', $client_vehicle->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_vehicles.perma_del', $client_vehicle->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('client_vehicle_view')
                                    <a href="{{ route('admin.client_vehicles.show',[$client_vehicle->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_vehicle_edit')
                                    <a href="{{ route('admin.client_vehicles.edit',[$client_vehicle->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_vehicle_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_vehicles.destroy', $client_vehicle->id])) !!}
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
        @can('client_vehicle_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.client_vehicles.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection