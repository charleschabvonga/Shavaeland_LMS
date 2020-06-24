@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.sea-freight.title')</h3>
    @can('sea_freight_create')
    <p>
        <a href="{{ route('admin.sea_freights.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.sea_freights.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.sea_freights.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($sea_freights) > 0 ? 'datatable' : '' }} @can('sea_freight_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('sea_freight_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

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
                                @can('sea_freight_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

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
    </div>
@stop

@section('javascript') 
    <script>
        @can('sea_freight_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.sea_freights.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection