@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('vehicle_sc_create')
    <p>
        <a href="{{ route('admin.vehicle_scs.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.vehicle_scs.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.vehicle_scs.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">TRANSPORTER VEHICLES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($vehicle_scs) > 0 ? 'datatable' : '' }} @can('vehicle_sc_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('vehicle_sc_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.vehicle-sc.fields.vendor')</th>
                        <th>@lang('global.vehicle-sc.fields.subcontractor-number')</th>
                        <th>@lang('global.vehicle-sc.fields.vehicle-type')</th>
                        <th>@lang('global.vehicle-sc.fields.make')</th>
                        <th>@lang('global.vehicle-sc.fields.model')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($vehicle_scs) > 0)
                        @foreach ($vehicle_scs as $vehicle_sc)
                            <tr data-entry-id="{{ $vehicle_sc->id }}">
                                @can('vehicle_sc_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='vendor'>{{ $vehicle_sc->vendor->name or '' }}</td>
                                <td field-key='subcontractor_number'>{{ $vehicle_sc->subcontractor_number->subcontractor_number or '' }}</td>
                                <td field-key='vehicle_type'>{{ $vehicle_sc->vehicle_type }}</td>
                                <td field-key='make'>{{ $vehicle_sc->make }}</td>
                                <td field-key='model'>{{ $vehicle_sc->model }}</td>
                                
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.restore', $vehicle_sc->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.perma_del', $vehicle_sc->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('vehicle_sc_view')
                                    <a href="{{ route('admin.vehicle_scs.show',[$vehicle_sc->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('vehicle_sc_edit')
                                    <a href="{{ route('admin.vehicle_scs.edit',[$vehicle_sc->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('vehicle_sc_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.vehicle_scs.destroy', $vehicle_sc->id])) !!}
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
        @can('vehicle_sc_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.vehicle_scs.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection