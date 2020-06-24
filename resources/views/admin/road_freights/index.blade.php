@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('road_freight_create')
    <p>
        <a href="{{ route('admin.road_freights.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.road_freights.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.road_freights.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">ROAD FREIGHTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }} @can('road_freight_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('road_freight_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.road-freights.fields.road-freight-number')</th>
                        <th>@lang('global.road-freights.fields.client')</th>
                        <th>@lang('global.road-freights.fields.vendor')</th>
                        <th>@lang('global.road-freights.fields.route')</th>
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
                                @can('road_freight_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                @if($road_freight->vendor != '')
                                <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                @endif
                                @if($road_freight->vendor == '')
                                    <td field-key='vendor'>Shavaeland</td>
                                @endif
                                <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                <td field-key='net_income'>R {{ number_format($road_freight->net_income, 2) }}</td>
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
                                    <a href="{{ route('admin.road_freights.download',$road_freight->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="19">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('road_freight_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.road_freights.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection