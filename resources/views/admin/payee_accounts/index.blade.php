@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('payee_account_create')
    <p>
        <a href="{{ route('admin.payee_accounts.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.payee_accounts.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.payee_accounts.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">EMPLOYEE ACCOUNTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($payee_accounts) > 0 ? 'datatable' : '' }} @can('payee_account_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('payee_account_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.payee-accounts.fields.employee')</th>
                        <th>@lang('global.payee-accounts.fields.bank')</th>
                        <th>@lang('global.payee-accounts.fields.account-number')</th>
                        <th>@lang('global.payee-accounts.fields.status')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($payee_accounts) > 0)
                        @foreach ($payee_accounts as $payee_account)
                            <tr data-entry-id="{{ $payee_account->id }}">
                                @can('payee_account_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='employee'>{{ $payee_account->employee->name or '' }}</td>
                                <td field-key='bank'>{{ $payee_account->bank }}</td>
                                <td field-key='account_number'>{{ $payee_account->account_number }}</td>
                                @if ($payee_account->status == 'Not active')
                                <td class="label-md label-info text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if ($payee_account->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if ($payee_account->status == 'Up to date')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if ($payee_account->status == 'Paid off')
                                <td class="label-md label-success text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if ($payee_account->status == 'Debited')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if ($payee_account->status == 'Closed')
                                <td class="label-md label-default text-center" field-key='status'>{{ $payee_account->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payee_accounts.restore', $payee_account->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payee_accounts.perma_del', $payee_account->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('payee_account_view')
                                    <a href="{{ route('admin.payee_accounts.show',[$payee_account->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payee_account_edit')
                                    <a href="{{ route('admin.payee_accounts.edit',[$payee_account->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payee_account_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payee_accounts.destroy', $payee_account->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="17">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('payee_account_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.payee_accounts.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection