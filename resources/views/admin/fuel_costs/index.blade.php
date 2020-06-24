@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('fuel_cost_create')
    <p>
        <a href="{{ route('admin.fuel_costs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.fuel_costs.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.fuel_costs.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">FUEL PURCHASES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($fuel_costs) > 0 ? 'datatable' : '' }} @can('fuel_cost_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('fuel_cost_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.fuel-costs.fields.receipt-number')</th>
                        <th>@lang('global.fuel-costs.fields.road-freight-number')</th>
                        <th>@lang('global.fuel-costs.fields.description')</th>
                        <th>@lang('global.fuel-costs.fields.qty')</th>
                        <th>@lang('global.fuel-costs.fields.cost')</th>
                        <th>@lang('global.fuel-costs.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($fuel_costs) > 0)
                        @foreach ($fuel_costs as $fuel_cost)
                            <tr data-entry-id="{{ $fuel_cost->id }}">
                                @can('fuel_cost_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='receipt_number'>{{ $fuel_cost->receipt_number }}</td>
                                <td field-key='road_freight_number'>{{ $fuel_cost->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='description'>{{ $fuel_cost->description }}</td>
                                <td field-key='qty'>{{ number_format($fuel_cost->qty, 2) }}</td>
                                <td field-key='cost'>R {{ number_format($fuel_cost->cost, 2) }}</td>
                                <td field-key='total'>R {{ number_format($fuel_cost->total, 2) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.restore', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.perma_del', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('fuel_cost_view')
                                    <a href="{{ route('admin.fuel_costs.show',[$fuel_cost->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('fuel_cost_edit')
                                    <a href="{{ route('admin.fuel_costs.edit',[$fuel_cost->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('fuel_cost_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.fuel_costs.destroy', $fuel_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('fuel_cost_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.fuel_costs.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection