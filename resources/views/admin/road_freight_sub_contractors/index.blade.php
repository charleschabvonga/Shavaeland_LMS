@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('road_freight_sub_contractor_create')
    <p>
        <a href="{{ route('admin.road_freight_sub_contractors.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.road_freight_sub_contractors.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.road_freight_sub_contractors.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">TRANSPORTER REQUIREMENTS</span></h1>
                    </div>
                @endif
            </div>
            
            <table class="table table-bordered table-striped {{ count($road_freight_sub_contractors) > 0 ? 'datatable' : '' }} @can('road_freight_sub_contractor_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('road_freight_sub_contractor_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan
                        <th>@lang('global.road-freight-sub-contractors.fields.vendor')</th>
                        <th>@lang('global.road-freight-sub-contractors.fields.subcontractor-number')</th>
                        <th>@lang('global.road-freight-sub-contractors.fields.git-cover-number')</th>
                        <th class="text-center">@lang('global.road-freight-sub-contractors.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($road_freight_sub_contractors) > 0)
                        @foreach ($road_freight_sub_contractors as $road_freight_sub_contractor)
                            <tr data-entry-id="{{ $road_freight_sub_contractor->id }}">
                                @can('road_freight_sub_contractor_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan
                                <td field-key='vendor'>{{ $road_freight_sub_contractor->vendor->name or '' }}</td>
                                <td field-key='director_id_number'>{{ $road_freight_sub_contractor->subcontractor_number }}</td>
                                <td field-key='director_id_number'>{{ $road_freight_sub_contractor->git_cover_number }}</td>
                                @if($road_freight_sub_contractor->status == '')
                                <td field-key='status'>{{ $road_freight_sub_contractor->status }}</td>
                                @endif
                                @if($road_freight_sub_contractor->status == 'Under process')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $road_freight_sub_contractor->status }}</td>
                                @endif
                                @if($road_freight_sub_contractor->status == 'Approved')
                                <td class="label-md label-success text-center" field-key='status'>{{ $road_freight_sub_contractor->status }}</td>
                                @endif
                                @if($road_freight_sub_contractor->status == 'Declined')
                                <td class="label-md label-default text-center" field-key='status'>{{ $road_freight_sub_contractor->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.restore', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.perma_del', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('road_freight_sub_contractor_view')
                                    <a href="{{ route('admin.road_freight_sub_contractors.show',[$road_freight_sub_contractor->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('road_freight_sub_contractor_edit')
                                    <a href="{{ route('admin.road_freight_sub_contractors.edit',[$road_freight_sub_contractor->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('road_freight_sub_contractor_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freight_sub_contractors.destroy', $road_freight_sub_contractor->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('road_freight_sub_contractor_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.road_freight_sub_contractors.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection