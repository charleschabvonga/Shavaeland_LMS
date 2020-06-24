@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('loading_instruction_create')
    <p>
        <a href="{{ route('admin.loading_instructions.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.loading_instructions.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.loading_instructions.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">LOADING INSTRUCTIONS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($loading_instructions) > 0 ? 'datatable' : '' }} @can('loading_instruction_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('loading_instruction_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.loading-instruction.fields.loading-instruction-number')</th>
                        <th>@lang('global.loading-instruction.fields.client')</th>
                        <th>@lang('global.loading-instruction.fields.road-freight-number')</th>
                        <th>@lang('global.loading-instruction.fields.pickup-date-time')</th>
                        <th class="text-center">@lang('global.loading-instruction.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($loading_instructions) > 0)
                        @foreach ($loading_instructions as $loading_instruction)
                            <tr data-entry-id="{{ $loading_instruction->id }}">
                                @can('loading_instruction_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='loading_instruction_number'>{{ $loading_instruction->loading_instruction_number }}</td>
                                <td field-key='client'>{{ $loading_instruction->client->name or '' }}</td>
                                <td field-key='road_freight_number'>{{ $loading_instruction->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='pickup_date_time'>{{ $loading_instruction->pickup_date_time }}</td>
                                @if($loading_instruction->status == 'Draft')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $loading_instruction->status }}</td>
                                @endif
                                @if($loading_instruction->status == 'Delivered')
                                <td class="label-md label-success text-center" field-key='status'>{{ $loading_instruction->status }}</td>
                                @endif
                                @if($loading_instruction->status == 'Loaded')
                                <td class="label-md label-default text-center" field-key='status'>{{ $loading_instruction->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.restore', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.perma_del', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('loading_instruction_view')
                                    <a href="{{ route('admin.loading_instructions.show',[$loading_instruction->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('loading_instruction_edit')
                                    <!--a href="{{ route('admin.loading_instructions.edit',[$loading_instruction->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('loading_instruction_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.loading_instructions.destroy', $loading_instruction->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.loading_instructions.download',$loading_instruction->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('loading_instruction_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.loading_instructions.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection