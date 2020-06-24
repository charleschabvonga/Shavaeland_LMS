@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-card-items.title')</h3>
    @can('job_card_item_create')
    <p>
        <a href="{{ route('admin.job_card_items.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.job_card_items.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.job_card_items.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($job_card_items) > 0 ? 'datatable' : '' }} @can('job_card_item_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('job_card_item_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.job-card-items.fields.job-card-items')</th>
                        <th>@lang('global.job-card-items.fields.client-job-card-number')</th>
                        <th>@lang('global.job-card-items.fields.workshop')</th>
                        <th>@lang('global.job-card-items.fields.part')</th>
                        <th>@lang('global.job-card-items.fields.price')</th>
                        <th>@lang('global.job-card-items.fields.qty')</th>
                        <th>@lang('global.job-card-items.fields.unit')</th>
                        <th>@lang('global.job-card-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($job_card_items) > 0)
                        @foreach ($job_card_items as $job_card_item)
                            <tr data-entry-id="{{ $job_card_item->id }}">
                                @can('job_card_item_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='job_card_items'>{{ $job_card_item->job_card_items->job_card_number or '' }}</td>
                                <td field-key='client_job_card_number'>{{ $job_card_item->client_job_card_number->job_card_number or '' }}</td>
                                <td field-key='workshop'>{{ $job_card_item->workshop }}</td>
                                <td field-key='part'>{{ $job_card_item->part }}</td>
                                <td field-key='price'>{{ $job_card_item->price }}</td>
                                <td field-key='qty'>{{ $job_card_item->qty }}</td>
                                <td field-key='unit'>{{ $job_card_item->unit }}</td>
                                <td field-key='total'>{{ $job_card_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.restore', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.perma_del', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('job_card_item_view')
                                    <a href="{{ route('admin.job_card_items.show',[$job_card_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('job_card_item_edit')
                                    <a href="{{ route('admin.job_card_items.edit',[$job_card_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('job_card_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.destroy', $job_card_item->id])) !!}
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
        @can('job_card_item_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.job_card_items.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection