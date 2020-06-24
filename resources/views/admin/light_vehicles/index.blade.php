@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('light_vehicle_create')
    <p>
        <a href="{{ route('admin.light_vehicles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.light_vehicles.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.light_vehicles.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">VEHICLES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($light_vehicles) > 0 ? 'datatable' : '' }} @can('light_vehicle_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('light_vehicle_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.light-vehicles.fields.vehicle-type')</th>
                        <th>@lang('global.light-vehicles.fields.vehicle-description')</th>
                        <th>@lang('global.light-vehicles.fields.make')</th>
                        <th>@lang('global.light-vehicles.fields.model')</th>
                        <th>@lang('global.light-vehicles.fields.availability')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($light_vehicles) > 0)
                        @foreach ($light_vehicles as $light_vehicle)
                            <tr data-entry-id="{{ $light_vehicle->id }}">
                                @can('light_vehicle_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='vehicle_type'>{{ $light_vehicle->vehicle_type }}</td>
                                <td field-key='vehicle_description'>{{ $light_vehicle->vehicle_description }}</td>
                                <td field-key='make'>{{ $light_vehicle->make }}</td>
                                <td field-key='model'>{{ $light_vehicle->model }}</td>
                                <td field-key='availability'>{{ $light_vehicle->availability }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.light_vehicles.restore', $light_vehicle->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.light_vehicles.perma_del', $light_vehicle->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('light_vehicle_view')
                                    <a href="{{ route('admin.light_vehicles.show',[$light_vehicle->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('light_vehicle_edit')
                                    <a href="{{ route('admin.light_vehicles.edit',[$light_vehicle->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('light_vehicle_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.light_vehicles.destroy', $light_vehicle->id])) !!}
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
@stop

@section('javascript') 
    <script>
        @can('light_vehicle_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.light_vehicles.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection