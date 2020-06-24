@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.overtime-and-bonus-items.title')</h3>
    @can('overtime_and_bonus_item_create')
    <p>
        <a href="{{ route('admin.overtime_and_bonus_items.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.overtime_and_bonus_items.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.overtime_and_bonus_items.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($overtime_and_bonus_items) > 0 ? 'datatable' : '' }} @can('overtime_and_bonus_item_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('overtime_and_bonus_item_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.overtime-and-bonus-items.fields.item-number')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.item-description')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.unit-price')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.qty')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.total')</th>
                        <th>@lang('global.overtime-and-bonus-items.fields.unit')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($overtime_and_bonus_items) > 0)
                        @foreach ($overtime_and_bonus_items as $overtime_and_bonus_item)
                            <tr data-entry-id="{{ $overtime_and_bonus_item->id }}">
                                @can('overtime_and_bonus_item_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='item_number'>{{ $overtime_and_bonus_item->item_number->payslip_number or '' }}</td>
                                <td field-key='item_description'>{{ $overtime_and_bonus_item->item_description }}</td>
                                <td field-key='unit_price'>{{ $overtime_and_bonus_item->unit_price }}</td>
                                <td field-key='qty'>{{ $overtime_and_bonus_item->qty }}</td>
                                <td field-key='total'>{{ $overtime_and_bonus_item->total }}</td>
                                <td field-key='unit'>{{ $overtime_and_bonus_item->unit }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.restore', $overtime_and_bonus_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.perma_del', $overtime_and_bonus_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('overtime_and_bonus_item_view')
                                    <a href="{{ route('admin.overtime_and_bonus_items.show',[$overtime_and_bonus_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('overtime_and_bonus_item_edit')
                                    <a href="{{ route('admin.overtime_and_bonus_items.edit',[$overtime_and_bonus_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('overtime_and_bonus_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.overtime_and_bonus_items.destroy', $overtime_and_bonus_item->id])) !!}
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
        @can('overtime_and_bonus_item_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.overtime_and_bonus_items.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection