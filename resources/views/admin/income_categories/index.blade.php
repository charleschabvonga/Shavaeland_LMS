@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('income_category_create')
    <p>
        <a href="{{ route('admin.income_categories.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>  
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
                        <h1><span style="color:#CE8F64">TAX INVOICES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($income_categories) > 0 ? 'datatable' : '' }} @can('income_category_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('income_category_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.income-category.fields.client')</th>
                        <th>@lang('global.income-category.fields.invoice-number')</th>
                        <th>@lang('global.income-category.fields.project-number')</th>
                        <th>@lang('global.income-category.fields.total-amount')</th>
                        <th>@lang('global.income-category.fields.paid-to-date')</th>
                        <th>@lang('global.income-category.fields.balance')</th>
                        <th class="text-center">@lang('global.income-category.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($income_categories) > 0)
                        @foreach ($income_categories as $income_category)
                            <tr data-entry-id="{{ $income_category->id }}">
                                @can('income_category_delete')
                                    <td></td>
                                @endcan

                                <td field-key='client'>{{ $income_category->client->name or '' }}</td>
                                <td field-key='invoice_number'>{{ $income_category->invoice_number }}</td>
                                <td field-key='project_number'>{{ $income_category->project_number->operation_number or '' }}</td>
                                <td field-key='total_amount'>R {{ number_format($income_category->total_amount, 2) }}</td>
                                <td field-key='paid_to_date'>R {{ number_format($income_category->paid_to_date, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($income_category->balance, 2) }}</td>
                                @if($income_category->status == 'Draft')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                @if($income_category->status == 'Sent')
                                <td class="label-md label-info text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                @if($income_category->status == 'Paid')
                                <td class="label-md label-success text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                @if($income_category->status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                @if($income_category->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                @if($income_category->status == 'Up to date')
                                <td class="label-md label-default text-center" field-key='status'>{{ $income_category->status }}</td>
                                @endif
                                                                <td>
                                    @can('income_category_view')
                                    <a href="{{ route('admin.income_categories.show',[$income_category->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_category_edit')
                                    <!--a href="{{ route('admin.income_categories.edit',[$income_category->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('income_category_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_categories.destroy', $income_category->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.income_categories.download',$income_category->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="22">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">TOTALS:</th>
                        <th field-key='total_amount'>R {{ number_format($income_categories->sum('total_amount'),2) }}</th>
                        <th field-key='paid_to_date'>R {{ number_format($income_categories->sum('paid_to_date'),2) }}</th>
                        <th field-key='balance'>R {{ number_format($income_categories->sum('balance'),2) }}</th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('income_category_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.income_categories.mass_destroy') }}';
        @endcan

    </script>
@endsection