@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('payslip_create')
    <p>
        <a href="{{ route('admin.payslips.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.payslips.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.payslips.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">PAYSLIPS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($payslips) > 0 ? 'datatable' : '' }} @can('payslip_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('payslip_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.payslips.fields.date')</th>
                        <th>@lang('global.payslips.fields.payslip-number')</th>
                        <th>@lang('global.payslips.fields.net-income')</th>
                        <th>@lang('global.payslips.fields.paid-to-date')</th>
                        <th>@lang('global.payslips.fields.balance')</th>
                        <th class="text-center">@lang('global.payslips.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($payslips) > 0)
                        @foreach ($payslips as $payslip)
                            <tr data-entry-id="{{ $payslip->id }}">
                                @can('payslip_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='date'>{{ $payslip->date }}</td>
                                <td field-key='payslip_number'>{{ $payslip->payslip_number }}</td>
                                <td field-key='account_number'>R {{ number_format($payslip->net_income, 2) }}</td>
                                <td field-key='paid_to_date'>R {{ number_format($payslip->paid_to_date, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($payslip->balance, 2) }}</td>
                                @if($payslip->status == 'Draft')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $payslip->status }}</td>
                                @endif
                                 @if($payslip->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $payslip->status }}</td>
                                @endif
                                @if($payslip->status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $payslip->status }}</td>
                                @endif
                                @if($payslip->status == 'Paid')
                                <td class="label-md label-success text-center" field-key='status'>{{ $payslip->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.restore', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.perma_del', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('payslip_view')
                                    <a href="{{ route('admin.payslips.show',[$payslip->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payslip_edit')
                                    <a href="{{ route('admin.payslips.edit',[$payslip->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payslip_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payslips.destroy', $payslip->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="19">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('payslip_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.payslips.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection