@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('salaries_request_total_create')
    <p>
        <a href="{{ route('admin.salaries_request_totals.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.salaries_request_totals.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.salaries_request_totals.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">MONTHLY PAYSLIP BATCHES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($salaries_request_totals) > 0 ? 'datatable' : '' }} @can('salaries_request_total_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('salaries_request_total_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.salaries-request-totals.fields.batch-number')</th>
                        <th>@lang('global.salaries-request-totals.fields.starting-pay-date')</th>
                        <th>@lang('global.salaries-request-totals.fields.ending-pay-date')</th>
                        <th class="text-center">@lang('global.salaries-request-totals.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($salaries_request_totals) > 0)
                        @foreach ($salaries_request_totals as $salaries_request_total)
                            <tr data-entry-id="{{ $salaries_request_total->id }}">
                                @can('salaries_request_total_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='batch_number'>{{ $salaries_request_total->batch_number }}</td>
                                <td field-key='starting_pay_date'>{{ $salaries_request_total->starting_pay_date }}</td>
                                <td field-key='ending_pay_date'>{{ $salaries_request_total->ending_pay_date }}</td>
                                @if($salaries_request_total->status == 'In progress')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $salaries_request_total->status }}</td>
                                @endif
                                @if($salaries_request_total->status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $salaries_request_total->status }}</td>
                                @endif
                                @if($salaries_request_total->status == 'Paid')
                                <td class="label-md label-success text-center" field-key='status'>{{ $salaries_request_total->status }}</td>
                                @endif
                                @if($salaries_request_total->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $salaries_request_total->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries_request_totals.restore', $salaries_request_total->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries_request_totals.perma_del', $salaries_request_total->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('salaries_request_total_view')
                                    <a href="{{ route('admin.salaries_request_totals.show',[$salaries_request_total->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('salaries_request_total_edit')
                                    <a href="{{ route('admin.salaries_request_totals.edit',[$salaries_request_total->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('salaries_request_total_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.salaries_request_totals.destroy', $salaries_request_total->id])) !!}
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
        @can('salaries_request_total_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.salaries_request_totals.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection