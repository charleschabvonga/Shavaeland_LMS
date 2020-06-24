@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('job_request_create')
    <p>
        <a href="{{ route('admin.job_requests.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.job_requests.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.job_requests.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">JOB REQUESTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($job_requests) > 0 ? 'datatable' : '' }} @can('job_request_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('job_request_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.job-requests.fields.project-number')</th>
                        <th>@lang('global.job-requests.fields.job-request-number')</th>
                        <th>@lang('global.job-requests.fields.client')</th>
                        <th>@lang('global.job-requests.fields.date')</th>
                        <th>@lang('global.job-requests.fields.vehicle-type')</th>
                        <th>@lang('global.job-requests.fields.vehicle-registration-number')</th>
                        <th>@lang('global.job-requests.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($job_requests) > 0)
                        @foreach ($job_requests as $job_request)
                            <tr data-entry-id="{{ $job_request->id }}">
                                @can('job_request_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='project_number'>{{ $job_request->project_number->operation_number or '' }}</td>
                                <td field-key='job_request_number'>{{ $job_request->job_request_number }}</td>
                                <td field-key='client'>{{ $job_request->client->name or '' }}</td>
                                <td field-key='date'>{{ $job_request->date }}</td>
                                <td field-key='vehicle_type'>{{ $job_request->vehicle_type }}</td>
                                <td field-key='vehicle_registration_number'>{{ $job_request->vehicle_registration_number }}</td>
                                <td field-key='status'>{{ $job_request->status }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_requests.restore', $job_request->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_requests.perma_del', $job_request->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('job_request_view')
                                    <a href="{{ route('admin.job_requests.show',[$job_request->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('job_request_edit')
                                    <a href="{{ route('admin.job_requests.edit',[$job_request->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('job_request_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_requests.destroy', $job_request->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('job_request_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.job_requests.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection