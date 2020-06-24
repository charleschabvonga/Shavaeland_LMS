@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('receiving_create')
    <p>
        <a href="{{ route('admin.receivings.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.receivings.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.receivings.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">WAREHOUSE GOODS RECEIPTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }} @can('receiving_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('receiving_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.receiving.fields.project-number')</th>
                        <th>@lang('global.receiving.fields.receipt-number')</th>
                        <th>@lang('global.receiving.fields.warehouse')</th>
                        <th>@lang('global.receiving.fields.client')</th>
                        <th>@lang('global.receiving.fields.total-area-coverd')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($receivings) > 0)
                        @foreach ($receivings as $receiving)
                            <tr data-entry-id="{{ $receiving->id }}">
                                @can('receiving_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                <td field-key='warehouse'>{{ $receiving->warehouse->center_name or '' }}</td>
                                <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                <td field-key='total_area_coverd'>{{ $receiving->total_area_coverd }} m<sup>2</sup></td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.restore', $receiving->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('receiving_view')
                                    <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('receiving_edit')
                                    <a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('receiving_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.receivings.destroy', $receiving->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.receivings.download',$receiving->id) }}" class="btn btn-xs btn-warning">View PDF</a>
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
        @can('receiving_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.receivings.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection