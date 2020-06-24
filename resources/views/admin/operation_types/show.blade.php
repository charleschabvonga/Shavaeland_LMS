@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.operation-type.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.operation-type.fields.name')</th>
                            <td field-key='name'>{{ $operation_type->name }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#time_work_types" aria-controls="time_work_types" role="tab" data-toggle="tab">Work types</a></li>
<li role="presentation" class=""><a href="#time_entries" aria-controls="time_entries" role="tab" data-toggle="tab">Operations</a></li>
<li role="presentation" class=""><a href="#expense" aria-controls="expense" role="tab" data-toggle="tab">Credit note pymts</a></li>
<li role="presentation" class=""><a href="#income" aria-controls="income" role="tab" data-toggle="tab">Invoice/Debit note pymts</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="time_work_types">
<table class="table table-bordered table-striped {{ count($time_work_types) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.time-work-types.fields.name')</th>
                        <th>@lang('global.time-work-types.fields.operation-type')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($time_work_types) > 0)
            @foreach ($time_work_types as $time_work_type)
                <tr data-entry-id="{{ $time_work_type->id }}">
                    <td field-key='name'>{{ $time_work_type->name }}</td>
                                <td field-key='operation_type'>{{ $time_work_type->operation_type->name or '' }}</td>
                                                                <td>
                                    @can('time_work_type_view')
                                    <a href="{{ route('admin.time_work_types.show',[$time_work_type->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('time_work_type_edit')
                                    <a href="{{ route('admin.time_work_types.edit',[$time_work_type->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('time_work_type_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_work_types.destroy', $time_work_type->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="time_entries">
<table class="table table-bordered table-striped {{ count($time_entries) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.time-entries.fields.operation-number')</th>
                        <th>@lang('global.time-entries.fields.entry-date')</th>
                        <th>@lang('global.time-entries.fields.operation-type')</th>
                        <th>@lang('global.time-entries.fields.work-type')</th>
                        <th>@lang('global.time-entries.fields.client')</th>
                        <th>@lang('global.time-entries.fields.vendor')</th>
                        <th>@lang('global.time-entries.fields.start-time')</th>
                        <th>@lang('global.time-entries.fields.end-time')</th>
                        <th>@lang('global.time-entries.fields.status')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($time_entries) > 0)
            @foreach ($time_entries as $time_entry)
                <tr data-entry-id="{{ $time_entry->id }}">
                    <td field-key='operation_number'>{{ $time_entry->operation_number }}</td>
                                <td field-key='entry_date'>{{ $time_entry->entry_date }}</td>
                                <td field-key='operation_type'>{{ $time_entry->operation_type->name or '' }}</td>
                                <td field-key='work_type'>{{ $time_entry->work_type->name or '' }}</td>
                                <td field-key='client'>{{ $time_entry->client->name or '' }}</td>
                                <td field-key='vendor'>{{ $time_entry->vendor->name or '' }}</td>
                                <td field-key='start_time'>{{ $time_entry->start_time }}</td>
                                <td field-key='end_time'>{{ $time_entry->end_time }}</td>
                                <td field-key='status'>{{ $time_entry->status }}</td>
                                                                <td>
                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$time_entry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$time_entry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $time_entry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="expense">
<table class="table table-bordered table-striped {{ count($expenses) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.expense.fields.entry-date')</th>
                        <th>@lang('global.expense.fields.payment-type')</th>
                        <th>@lang('global.expense.fields.vendor')</th>
                        <th>@lang('global.expense.fields.client')</th>
                        <th>@lang('global.expense.fields.vendor-credit-note-number')</th>
                        <th>@lang('global.expense.fields.client-credit-note-number')</th>
                        <th>@lang('global.expense.fields.debit-note-number')</th>
                        <th>@lang('global.expense.fields.withdrawal-transaction-number')</th>
                        <th>@lang('global.expense.fields.operation-type')</th>
                        <th>@lang('global.expense.fields.transaction-type')</th>
                        <th>@lang('global.expense.fields.transaction-number')</th>
                        <th>@lang('global.expense.fields.payment-number')</th>
                        <th>@lang('global.expense.fields.expense-category')</th>
                        <th>@lang('global.expense.fields.amount')</th>
                        <th>@lang('global.expense.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($expenses) > 0)
            @foreach ($expenses as $expense)
                <tr data-entry-id="{{ $expense->id }}">
                    <td field-key='entry_date'>{{ $expense->entry_date }}</td>
                                <td field-key='payment_type'>{{ $expense->payment_type }}</td>
                                <td field-key='vendor'>{{ $expense->vendor->name or '' }}</td>
                                <td field-key='client'>{{ $expense->client->name or '' }}</td>
                                <td field-key='vendor_credit_note_number'>{{ $expense->vendor_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='client_credit_note_number'>{{ $expense->client_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $expense->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='withdrawal_transaction_number'>{{ $expense->withdrawal_transaction_number->payment_number or '' }}</td>
                                <td field-key='operation_type'>{{ $expense->operation_type->name or '' }}</td>
                                <td field-key='transaction_type'>{{ $expense->transaction_type->name or '' }}</td>
                                <td field-key='transaction_number'>{{ $expense->transaction_number->operation_number or '' }}</td>
                                <td field-key='payment_number'>{{ $expense->payment_number }}</td>
                                <td field-key='expense_category'>{{ $expense->expense_category }}</td>
                                <td field-key='amount'>{{ $expense->amount }}</td>
                                <td field-key='prepared_by'>{{ $expense->prepared_by }}</td>
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
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="income">
<table class="table table-bordered table-striped {{ count($incomes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income.fields.payment-number')</th>
                        <th>@lang('global.income.fields.entry-date')</th>
                        <th>@lang('global.income.fields.payment-type')</th>
                        <th>@lang('global.income.fields.client')</th>
                        <th>@lang('global.income.fields.vendor')</th>
                        <th>@lang('global.income.fields.invoice-number')</th>
                        <th>@lang('global.income.fields.debit-note-number')</th>
                        <th>@lang('global.income.fields.sales-credit-note-number')</th>
                        <th>@lang('global.income.fields.deposit-transaction-number')</th>
                        <th>@lang('global.income.fields.operation-type')</th>
                        <th>@lang('global.income.fields.project-type')</th>
                        <th>@lang('global.income.fields.project-number')</th>
                        <th>@lang('global.income.fields.income-category')</th>
                        <th>@lang('global.income.fields.amount')</th>
                        <th>@lang('global.income.fields.prepared-by')</th>
                                                <th>&nbsp;</th>

        </tr>
    </thead>

    <tbody>
        @if (count($incomes) > 0)
            @foreach ($incomes as $income)
                <tr data-entry-id="{{ $income->id }}">
                    <td field-key='payment_number'>{{ $income->payment_number }}</td>
                                <td field-key='entry_date'>{{ $income->entry_date }}</td>
                                <td field-key='payment_type'>{{ $income->payment_type }}</td>
                                <td field-key='client'>{{ $income->client->name or '' }}</td>
                                <td field-key='vendor'>{{ $income->vendor->name or '' }}</td>
                                <td field-key='invoice_number'>{{ $income->invoice_number->invoice_number or '' }}</td>
                                <td field-key='debit_note_number'>{{ $income->debit_note_number->debit_note_number or '' }}</td>
                                <td field-key='sales_credit_note_number'>{{ $income->sales_credit_note_number->credit_note_number or '' }}</td>
                                <td field-key='deposit_transaction_number'>{{ $income->deposit_transaction_number->payment_number or '' }}</td>
                                <td field-key='operation_type'>{{ $income->operation_type->name or '' }}</td>
                                <td field-key='project_type'>{{ $income->project_type->name or '' }}</td>
                                <td field-key='project_number'>{{ $income->project_number->operation_number or '' }}</td>
                                <td field-key='income_category'>{{ $income->income_category }}</td>
                                <td field-key='amount'>{{ $income->amount }}</td>
                                <td field-key='prepared_by'>{{ $income->prepared_by }}</td>
                                                                <td>
                                    @can('income_view')
                                    <a href="{{ route('admin.incomes.show',[$income->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_edit')
                                    <a href="{{ route('admin.incomes.edit',[$income->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.incomes.destroy', $income->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="20">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.operation_types.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


