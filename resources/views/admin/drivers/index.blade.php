@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('driver_create')
    <p>
        <a href="{{ route('admin.drivers.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.drivers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.drivers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">VENDOR DRIVERS</span></h1>
                    </div>
                @endif
            </div>
            
            <table class="table table-bordered table-striped {{ count($drivers) > 0 ? 'datatable' : '' }} @can('driver_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('driver_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.drivers.fields.vendor')</th>
                        <th>@lang('global.drivers.fields.name')</th>
                        <th>@lang('global.drivers.fields.drivers-license-number')</th>
                        <th>@lang('global.drivers.fields.drivers-passport-number')</th>
                        <th>@lang('global.drivers.fields.sa-phone-number')</th>
                        <th>@lang('global.drivers.fields.int-phone-number')</th>
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
                                @can('driver_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='vendor'>{{ $driver->vendor->name or '' }}</td>
                                <td field-key='name'>{{ $driver->name }}</td>
                                <td field-key='drivers_license_number'>{{ $driver->drivers_license_number }}</td>
                                <td field-key='drivers_passport_number'>{{ $driver->drivers_passport_number }}</td>
                                <td field-key='sa_phone_number'>{{ $driver->sa_phone_number }}</td>
                                <td field-key='int_phone_number'>{{ $driver->int_phone_number }}</td>
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
                            <td colspan="17">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('driver_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.drivers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection