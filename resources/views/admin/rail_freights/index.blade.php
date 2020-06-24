@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.rail-freight.title')</h3>
    @can('rail_freight_create')
    <p>
        <a href="{{ route('admin.rail_freights.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.rail_freights.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.rail_freights.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($rail_freights) > 0 ? 'datatable' : '' }} @can('rail_freight_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('rail_freight_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('rail_freight_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('rail_freight_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.rail_freights.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection