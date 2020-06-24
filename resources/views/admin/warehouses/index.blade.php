@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('warehouse_create')
    <p>
        <a href="{{ route('admin.warehouses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.warehouses.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.warehouses.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">WAREHOUSE CENTERS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($warehouses) > 0 ? 'datatable' : '' }} @can('warehouse_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('warehouse_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.warehouse.fields.vendor')</th>
                        <th>@lang('global.warehouse.fields.center-name')</th>
                        <th>@lang('global.warehouse.fields.square-meters')</th>
                        <th>@lang('global.warehouse.fields.available-space')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($warehouses) > 0)
                        @foreach ($warehouses as $warehouse)
                            <tr data-entry-id="{{ $warehouse->id }}">
                                @can('warehouse_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='vendor'>{{ $warehouse->vendor->name or '' }}</td>
                                <td field-key='center_name'>{{ $warehouse->center_name }}</td>
                                <td field-key='square_meters'>{{ number_format($warehouse->square_meters, 2) }} m<sup>2</sup> </td>
                                <td field-key='available_space'>{{ number_format($warehouse->available_space, 2) }} m<sup>2</sup></td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.restore', $warehouse->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.perma_del', $warehouse->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('warehouse_view')
                                    <a href="{{ route('admin.warehouses.show',[$warehouse->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('warehouse_edit')
                                    <a href="{{ route('admin.warehouses.edit',[$warehouse->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('warehouse_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.warehouses.destroy', $warehouse->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    <a href="{{ route('admin.warehouses.download',$warehouse->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('warehouse_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.warehouses.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection