@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deduction-items.title')</h3>
    @can('deduction_item_create')
    <p>
        <a href="{{ route('admin.deduction_items.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.deduction_items.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.deduction_items.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($deduction_items) > 0 ? 'datatable' : '' }} @can('deduction_item_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('deduction_item_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.deduction-items.fields.item-number')</th>
                        <th>@lang('global.deduction-items.fields.item-description')</th>
                        <th>@lang('global.deduction-items.fields.unit-price')</th>
                        <th>@lang('global.deduction-items.fields.qty')</th>
                        <th>@lang('global.deduction-items.fields.total')</th>
                        <th>@lang('global.deduction-items.fields.unit')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($deduction_items) > 0)
                        @foreach ($deduction_items as $deduction_item)
                            <tr data-entry-id="{{ $deduction_item->id }}">
                                @can('deduction_item_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='item_number'>{{ $deduction_item->item_number->payslip_number or '' }}</td>
                                <td field-key='item_description'>{{ $deduction_item->item_description }}</td>
                                <td field-key='unit_price'>{{ $deduction_item->unit_price }}</td>
                                <td field-key='qty'>{{ $deduction_item->qty }}</td>
                                <td field-key='total'>{{ $deduction_item->total }}</td>
                                <td field-key='unit'>{{ $deduction_item->unit }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.restore', $deduction_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.perma_del', $deduction_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('deduction_item_view')
                                    <a href="{{ route('admin.deduction_items.show',[$deduction_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('deduction_item_edit')
                                    <a href="{{ route('admin.deduction_items.edit',[$deduction_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('deduction_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.deduction_items.destroy', $deduction_item->id])) !!}
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
        @can('deduction_item_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.deduction_items.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection