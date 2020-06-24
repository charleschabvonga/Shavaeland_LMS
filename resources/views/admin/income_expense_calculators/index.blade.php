@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('income_expense_calculator_create')
    <p>
        <a href="{{ route('admin.income_expense_calculators.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>    
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.income_expense_calculators.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.income_expense_calculators.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">ROAD FREIGHT COST CULCULATOR</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($income_expense_calculators) > 0 ? 'datatable' : '' }} @can('income_expense_calculator_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('income_expense_calculator_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.income-expense-calculator.fields.load-status')</th>
                        <th>@lang('global.income-expense-calculator.fields.route')</th>
                        <th>@lang('global.income-expense-calculator.fields.trip-income')</th>
                        <th>@lang('Machine costs')</th>
                        <th>@lang('global.income-expense-calculator.fields.other-costs')</th>
                        <th>@lang('global.income-expense-calculator.fields.balance')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($income_expense_calculators) > 0)
                        @foreach ($income_expense_calculators as $income_expense_calculator)
                            <tr data-entry-id="{{ $income_expense_calculator->id }}">
                                @can('income_expense_calculator_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='return_load_status'>{{ $income_expense_calculator->load_status }}</td>
                                <td field-key='route'>{{ $income_expense_calculator->route->route or '' }}</td> 
                                <td field-key='trip_income'>R {{ number_format($income_expense_calculator->trip_income, 2) }}</td>
                                <td field-key='total_costs'>R {{ number_format($income_expense_calculator->total_costs, 2) }}</td>
                                <td field-key='subtotal'>R {{ number_format($income_expense_calculator->other_costs, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($income_expense_calculator->balance, 2) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.restore', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.perma_del', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('income_expense_calculator_view')
                                    <a href="{{ route('admin.income_expense_calculators.show',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_expense_calculator_edit')
                                    <a href="{{ route('admin.income_expense_calculators.edit',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_expense_calculator_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.destroy', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="31">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('income_expense_calculator_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.income_expense_calculators.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection