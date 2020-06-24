@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('expense_create')
    <p>
        <a href="{{ route('admin.expenses.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">EXPENSE/CREDIT NOTE PAYMENTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }} @can('expense_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('expense_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.expense.fields.payment-number')</th>
                        <th>@lang('global.expense.fields.payment-type')</th>
                        <th>@lang('global.expense.fields.client')</th>
                        <th>@lang('global.expense.fields.vendor')</th>
                        <th>@lang('global.expense.fields.amount')</th>

                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($expenses) > 0)
                        @foreach ($expenses as $expense)
                            <tr data-entry-id="{{ $expense->id }}">
                                @can('expense_delete')
                                    <td></td>
                                @endcan

                                <td field-key='payment_number'>{{ $expense->payment_number }}</td>
                                <td field-key='payment_type'>{{ $expense->payment_type }}</td>
                                <td field-key='client'>{{ $expense->client->name or '' }}</td>
                                <td field-key='vendor'>{{ $expense->vendor->name or '' }}</td>
                                <td field-key='amount'>R {{ number_format($expense->amount, 2) }}</td>
                                                                <td>
                                    @can('expense_view')
                                    <a href="{{ route('admin.expenses.show',[$expense->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('expense_edit')
                                    <a href="{{ route('admin.expenses.edit',[$expense->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('expense_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.expenses.destroy', $expense->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="18">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('expense_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.expenses.mass_destroy') }}';
        @endcan

    </script>
@endsection