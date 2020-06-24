@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.air-freight.title')</h3>
    @can('air_freight_create')
    <p>
        <a href="{{ route('admin.air_freights.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.air_freights.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.air_freights.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($air_freights) > 0 ? 'datatable' : '' }} @can('air_freight_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('air_freight_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('air_freight_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('air_freight_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.air_freights.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection