@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-contacts.title')</h3>
    @can('client_contact_create')
    <p>
        <a href="{{ route('admin.client_contacts.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.client_contacts.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.client_contacts.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($client_contacts) > 0 ? 'datatable' : '' }} @can('client_contact_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('client_contact_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.client-contacts.fields.company-name')</th>
                        <th>@lang('global.client-contacts.fields.contact-name')</th>
                        <th>@lang('global.client-contacts.fields.phone-number')</th>
                        <th>@lang('global.client-contacts.fields.email')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_contacts) > 0)
                        @foreach ($client_contacts as $client_contact)
                            <tr data-entry-id="{{ $client_contact->id }}">
                                @can('client_contact_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='company_name'>{{ $client_contact->company_name->name or '' }}</td>
                                <td field-key='contact_name'>{{ $client_contact->contact_name }}</td>
                                <td field-key='phone_number'>{{ $client_contact->phone_number }}</td>
                                <td field-key='email'>{{ $client_contact->email }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_contacts.restore', $client_contact->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_contacts.perma_del', $client_contact->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('client_contact_view')
                                    <a href="{{ route('admin.client_contacts.show',[$client_contact->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('client_contact_edit')
                                    <a href="{{ route('admin.client_contacts.edit',[$client_contact->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('client_contact_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_contacts.destroy', $client_contact->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_contact_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.client_contacts.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection