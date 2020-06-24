@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.non-machine-costs.title')</h3>
    @can('non_machine_cost_create')
    <p>
        <a href="{{ route('admin.non_machine_costs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.non_machine_costs.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.non_machine_costs.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($non_machine_costs) > 0 ? 'datatable' : '' }} @can('non_machine_cost_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('non_machine_cost_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.non-machine-costs.fields.road-freight-number')</th>
                        <th>@lang('global.non-machine-costs.fields.item-description')</th>
                        <th>@lang('global.non-machine-costs.fields.qty')</th>
                        <th>@lang('global.non-machine-costs.fields.cost')</th>
                        <th>@lang('global.non-machine-costs.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($non_machine_costs) > 0)
                        @foreach ($non_machine_costs as $non_machine_cost)
                            <tr data-entry-id="{{ $non_machine_cost->id }}">
                                @can('non_machine_cost_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='road_freight_number'>{{ $non_machine_cost->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='item_description'>{{ $non_machine_cost->item_description }}</td>
                                <td field-key='qty'>{{ $non_machine_cost->qty }}</td>
                                <td field-key='cost'>{{ $non_machine_cost->cost }}</td>
                                <td field-key='total'>{{ $non_machine_cost->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.non_machine_costs.restore', $non_machine_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.non_machine_costs.perma_del', $non_machine_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('non_machine_cost_view')
                                    <a href="{{ route('admin.non_machine_costs.show',[$non_machine_cost->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('non_machine_cost_edit')
                                    <a href="{{ route('admin.non_machine_costs.edit',[$non_machine_cost->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('non_machine_cost_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.non_machine_costs.destroy', $non_machine_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('non_machine_cost_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.non_machine_costs.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection