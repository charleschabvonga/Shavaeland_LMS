@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.load-descriptions.title')</h3>
    @can('load_description_create')
    <p>
        <a href="{{ route('admin.load_descriptions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.load_descriptions.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.load_descriptions.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($load_descriptions) > 0 ? 'datatable' : '' }} @can('load_description_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('load_description_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.load-descriptions.fields.description')</th>
                        <th>@lang('global.load-descriptions.fields.qty')</th>
                        <th>@lang('global.load-descriptions.fields.weight-volume')</th>
                        <th>@lang('global.load-descriptions.fields.loading-instruction-number')</th>
                        <th>@lang('global.load-descriptions.fields.delivery-instruction-number')</th>
                        <th>@lang('global.load-descriptions.fields.air-freight-number')</th>
                        <th>@lang('global.load-descriptions.fields.rail-freight-number')</th>
                        <th>@lang('global.load-descriptions.fields.sea-freight-number')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($load_descriptions) > 0)
                        @foreach ($load_descriptions as $load_description)
                            <tr data-entry-id="{{ $load_description->id }}">
                                @can('load_description_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='description'>{{ $load_description->description }}</td>
                                <td field-key='qty'>{{ $load_description->qty }}</td>
                                <td field-key='weight_volume'>{{ $load_description->weight_volume }}</td>
                                <td field-key='loading_instruction_number'>{{ $load_description->loading_instruction_number->loading_instruction_number or '' }}</td>
                                <td field-key='delivery_instruction_number'>{{ $load_description->delivery_instruction_number->delivery_instruction_number or '' }}</td>
                                <td field-key='air_freight_number'>{{ $load_description->air_freight_number->air_freight_number or '' }}</td>
                                <td field-key='rail_freight_number'>{{ $load_description->rail_freight_number->rail_freight_number or '' }}</td>
                                <td field-key='sea_freight_number'>{{ $load_description->sea_freight_number->sea_freight_number or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.restore', $load_description->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.perma_del', $load_description->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('load_description_view')
                                    <a href="{{ route('admin.load_descriptions.show',[$load_description->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('load_description_edit')
                                    <a href="{{ route('admin.load_descriptions.edit',[$load_description->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('load_description_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.destroy', $load_description->id])) !!}
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
        @can('load_description_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.load_descriptions.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection