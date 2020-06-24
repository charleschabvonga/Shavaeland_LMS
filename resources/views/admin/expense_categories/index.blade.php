@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('expense_category_create')
    <p>
        <a href="{{ route('admin.expense_categories.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>  
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
                        <h1><span style="color:#CE8F64">VENDOR TAX INVOICE</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($expense_categories) > 0 ? 'datatable' : '' }} @can('expense_category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('expense_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        
                        <th>@lang('global.expense-category.fields.vendor')</th>
                        <th>@lang('global.expense-category.fields.credit-note-number')</th>
                        <th>@lang('global.expense-category.fields.transaction-number')</th>
                        <th>@lang('global.expense-category.fields.total-amount')</th>
                        <th>@lang('global.expense-category.fields.paid-to-date')</th>
                        <th>@lang('global.expense-category.fields.balance')</th>
                        <th>@lang('global.expense-category.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($expense_categories) > 0)
                        @foreach ($expense_categories as $expense_category)
                            <tr data-entry-id="{{ $expense_category->id }}">
                                @can('expense_category_delete')
                                    <td></td>
                                @endcan

                                <td field-key='vendor'>{{ $expense_category->vendor->name or '' }}</td>
                                <td field-key='credit_note_number'>{{ $expense_category->credit_note_number }}</td>
                                <td field-key='transaction_number'>{{ $expense_category->transaction_number->operation_number or '' }}</td>
                                <td field-key='total_amount'>R {{ number_format($expense_category->total_amount, 2) }}</td>
                                <td field-key='paid_to_date'>R {{ number_format($expense_category->paid_to_date, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($expense_category->balance, 2) }}</td>
                                @if($expense_category->status == 'Draft')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                @if($expense_category->status == 'Sent')
                                <td class="label-md label-info text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                @if($expense_category->status == 'Paid')
                                <td class="label-md label-success text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                @if($expense_category->status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                @if($expense_category->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                @if($expense_category->status == 'Up to date')
                                <td class="label-md label-default text-center" field-key='status'>{{ $expense_category->status }}</td>
                                @endif
                                                                <td>
                                    @can('expense_category_view')
                                    <a href="{{ route('admin.expense_categories.show',[$expense_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    <!--@can('expense_category_edit')
                                    <a href="{{ route('admin.expense_categories.edit',[$expense_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan-->
                                    @can('expense_category_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.expense_categories.destroy', $expense_category->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.expense_categories.download',$expense_category->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">TOTALS:</th>
                        <th field-key='total_amount'>R {{ number_format($expense_categories->sum('total_amount'),2) }}</th>
                        <th field-key='paid_to_date'>R {{ number_format($expense_categories->sum('paid_to_date'),2) }}</th>
                        <th field-key='balance'>R {{ number_format($expense_categories->sum('balance'),2) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('expense_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.expense_categories.mass_destroy') }}';
        @endcan

    </script>
@endsection