@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('parts_acquired_create')
    <p>
        <a href="{{ route('admin.parts_acquireds.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.parts_acquireds.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.parts_acquireds.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">PARTS/ACCESSORIES PROCUREMENTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($parts_acquireds) > 0 ? 'datatable' : '' }} @can('parts_acquired_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('parts_acquired_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th width="8%">@lang('global.parts-acquired.fields.date')</th>
                        <th width="20%">@lang('global.parts-acquired.fields.repair-center')</th>
                        <th width="15%">@lang('global.parts-acquired.fields.transaction-type')</th>
                        <th width="30%">@lang('global.parts-acquired.fields.part')</th>
                        <th width="8%" class="text-center">@lang('global.parts-acquired.fields.qty')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($parts_acquireds) > 0)
                        @foreach ($parts_acquireds as $parts_acquired)
                            <tr data-entry-id="{{ $parts_acquired->id }}">
                                @can('parts_acquired_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='date'>{{ $parts_acquired->date }}</td>
                                <td field-key='repair_center'>{{ $parts_acquired->repair_center->center_name or '' }}</td>
                                <td field-key='part'>{{ $parts_acquired->transaction_type or '' }}</td>
                                <td field-key='part'>{{ $parts_acquired->part->part or '' }}</td>
                                <td field-key='qty' class="text-center">{{ $parts_acquired->qty }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.parts_acquireds.restore', $parts_acquired->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.parts_acquireds.perma_del', $parts_acquired->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('parts_acquired_view')
                                    <a href="{{ route('admin.parts_acquireds.show',[$parts_acquired->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('parts_acquired_edit')
                                    <a href="{{ route('admin.parts_acquireds.edit',[$parts_acquired->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('parts_acquired_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.parts_acquireds.destroy', $parts_acquired->id])) !!}
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
        @can('parts_acquired_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.parts_acquireds.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection