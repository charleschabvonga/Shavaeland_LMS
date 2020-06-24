@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('time_entry_create')
    <p>
        <a href="{{ route('admin.time_entries.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PROJECTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($time_entries) > 0 ? 'datatable' : '' }} @can('time_entry_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('time_entry_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.time-entries.fields.operation-number')</th>
                        <th>@lang('global.time-entries.fields.work-type')</th>
                        <th>@lang('global.time-entries.fields.client')</th>
                        <th class="text-center">@lang('global.time-entries.fields.status')</th>
                        <th width="14%">&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($time_entries) > 0)
                        @foreach ($time_entries as $time_entry)
                            <tr data-entry-id="{{ $time_entry->id }}">
                                @can('time_entry_delete')
                                    <td></td>
                                @endcan

                                <td field-key='operation_number'>{{ $time_entry->operation_number }}</td>
                                <td field-key='work_type'>
                                    @foreach ($time_entry->work_type as $singleWorkType)
                                        <span class="label label-info label-many">{{ $singleWorkType->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='client'>{{ $time_entry->client->name or '' }}</td>
                                @if ($time_entry->status == 'Pending')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $time_entry->status }}</td>
                                @endif
                                @if ($time_entry->status == 'Open')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $time_entry->status }}</td>
                                @endif
                                @if ($time_entry->status == 'In progress')
                                <td class="label-md label-info text-center" field-key='status'>{{ $time_entry->status }}</td>
                                @endif
                                @if ($time_entry->status == 'Closed')
                                <td class="label-md label-success text-center" field-key='status'>{{ $time_entry->status }}</td>
                                @endif
                                                                <td>
                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$time_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$time_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $time_entry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('time_entry_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.time_entries.mass_destroy') }}';
        @endcan

    </script>
@endsection