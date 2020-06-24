@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clearance-and-forwarding.title')</h3>
    @can('clearance_and_forwarding_create')
    <p>
        <a href="{{ route('admin.clearance_and_forwardings.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.clearance_and_forwardings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.clearance_and_forwardings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($clearance_and_forwardings) > 0 ? 'datatable' : '' }} @can('clearance_and_forwarding_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('clearance_and_forwarding_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.clearance-and-forwarding.fields.project-number')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.clearance-and-forwarding-number')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.border-post')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.client')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.contact-person')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.agent')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.agent-contact')</th>
                        <th>@lang('global.clearance-and-forwarding.fields.project-manager')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($clearance_and_forwardings) > 0)
                        @foreach ($clearance_and_forwardings as $clearance_and_forwarding)
                            <tr data-entry-id="{{ $clearance_and_forwarding->id }}">
                                @can('clearance_and_forwarding_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='project_number'>{{ $clearance_and_forwarding->project_number->operation_number or '' }}</td>
                                <td field-key='clearance_and_forwarding_number'>{{ $clearance_and_forwarding->clearance_and_forwarding_number }}</td>
                                <td field-key='border_post'>{{ $clearance_and_forwarding->border_post }}</td>
                                <td field-key='client'>{{ $clearance_and_forwarding->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $clearance_and_forwarding->contact_person->contact_name or '' }}</td>
                                <td field-key='agent'>{{ $clearance_and_forwarding->agent->name or '' }}</td>
                                <td field-key='agent_contact'>{{ $clearance_and_forwarding->agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $clearance_and_forwarding->project_manager->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.restore', $clearance_and_forwarding->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.perma_del', $clearance_and_forwarding->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('clearance_and_forwarding_view')
                                    <a href="{{ route('admin.clearance_and_forwardings.show',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('clearance_and_forwarding_edit')
                                    <a href="{{ route('admin.clearance_and_forwardings.edit',[$clearance_and_forwarding->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('clearance_and_forwarding_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.clearance_and_forwardings.destroy', $clearance_and_forwarding->id])) !!}
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
    </div>
@stop

@section('javascript') 
    <script>
        @can('clearance_and_forwarding_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.clearance_and_forwardings.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection